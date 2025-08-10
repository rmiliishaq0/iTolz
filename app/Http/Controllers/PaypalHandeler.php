<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Product;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\Plans;
use Illuminate\Support\Facades\Mail;

class PaypalHandeler extends Controller
{
    private function getAccessToken()

    {

        $client = new Client();

        $credentials = base64_encode(env('PAYPAL_CLIENT_ID') . ':' . env('PAYPAL_CLIENT_SECRET'));

        $res = $client->request('POST', env('PAYPAL_BASE_URL') . '/v1/oauth2/token', [
            'headers' => [
                'Authorization' => 'Basic ' . $credentials,
            ],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
        ]);

        $data = json_decode($res->getBody(), true);
        return $data['access_token'];
    }

    public function apiCreate(Request $request)
    {

        function handelPack($products,$duration,$token){

            if (count($products) < 3) {
                return response("Error: Minimum 3 tools required", 400);
            }

            $duration_to_int = [
                "1m" => 1,
                "2m" => 2,
                "3m" => 3,
                "6m" => 6,
                "12m" => 12,
            ];


            if (!isset($duration_to_int[$duration])) {
                return response("Error: Invalid duration", 400);
            }

            $total = 0;
            foreach ($products as $product) {
                $priceArray = json_decode(\App\Models\Product::where("id", $product)->value("price"), true);
                $total += $priceArray[$duration] ?? 0;
            }

            $productL = count($products);
            $Tdiscount = 0;
            $Mdiscount = 0;

            if ($productL >= 3 && $productL <= 4) {
                $Tdiscount = 0.05;
            } elseif ($productL >= 5 && $productL <= 6) {
                $Tdiscount = 0.1;
            } elseif ($productL >= 7 && $productL <= 9) {
                $Tdiscount = 0.15;
            } elseif ($productL >= 10) {
                $Tdiscount = 0.2;
            }

            switch ($duration) {
                case "2m":
                    $Mdiscount = 0.02;
                    break;
                case "3m":
                    $Mdiscount = 0.05;
                    break;
                case "6m":
                    $Mdiscount = 0.1;
                    break;
                case "12m":
                    $Mdiscount = 0.2;
                    break;
            }

            $TotalPrcice = $total * (1 - $Tdiscount) * (1 - $Mdiscount);
            $TotalPrcice = round($TotalPrcice, 2);
            $accessToken = $token;

            $client = new \GuzzleHttp\Client();
            $res = $client->post(env('PAYPAL_BASE_URL') . '/v2/checkout/orders', [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'intent' => 'CAPTURE',
                    'purchase_units' => [[
                        'amount' => [
                            'currency_code' => 'USD',
                            'value' => $TotalPrcice
                        ]
                    ]]
                ]
            ]);

            $paypalResponse = json_decode($res->getBody(), true);
            return [
                'paypal' => $paypalResponse,
                'amount' => $TotalPrcice
            ];
        }

        $token = $this->getAccessToken();

        function creatour($productId, $duration, $token)
        {
            $price = json_decode(\App\Models\Product::find($productId)->value("price"), true);

            if (!$price) {
                return ['error' => 'Invalid product'];
            }

            if (!isset($price[$duration])) {
                return ['error' => 'Invalid product or duration'];
            }

            $amount = (float) $price[$duration];
            $accessToken = $token;

            $client = new \GuzzleHttp\Client();
            $res = $client->post(env('PAYPAL_BASE_URL') . '/v2/checkout/orders', [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'intent' => 'CAPTURE',
                    'purchase_units' => [[
                        'amount' => [
                            'currency_code' => 'USD',
                            'value' => $amount
                        ]
                    ]]
                ]
            ]);

            $paypalResponse = json_decode($res->getBody(), true);
            return [
                'paypal' => $paypalResponse,
                'amount' => $amount
            ];
        }

        $pack = $request->product_type;
        $duration = $request->duration;
        $productId =$request->product_id;

        if($pack){
            if($pack =="All_pack"){
                $result = creatour($productId,$duration, $token);
                if (isset($result['error'])) {
                    return response()->json(['error' => $result['error']], 400);
                }
                Order::create([
                    'user_id' => Auth()->id(),
                    'product_id' => $request->product_id,
                    "product_type" => "All Tools",
                    'duration' => $request->duration,
                    'amount' => $result['amount'],
                    'order_id' => $result['paypal']['id'],
                    'status' => 'unpaid'
                ]);

                return response()->json($result['paypal']);

            }else if($pack == "Custom_pack"){
                $request->validate([
                    'product_Pack' => 'required|array',
                    'product_Pack.*' => 'required|numeric',
                    'duration' => 'required',
                ]);

                $products= $request->product_Pack;

                $result = handelPack($products,$duration, $token);

                Order::create([
                    'user_id' => Auth()->id(),
                    "product_type" => "Custom_pack",
                    'duration' => $request->duration,
                    'amount' => $result['amount'],
                    'order_id' => $result['paypal']['id'],
                    'status' => 'unpaid'
                ]);
                return response()->json($result['paypal']);
            }
        }else{
            $request->validate([
                'product_id' => 'required',
                'duration' => 'required',
            ]);

            $result = creatour($productId,$duration, $token);

            if (isset($result['error'])) {
                return response()->json(['error' => $result['error']], 400);
            }

            Order::create([
                'user_id' => Auth()->id(),
                'product_id' => $request->product_id,
                'duration' => $request->duration,
                'amount' => $result['amount'],
                'order_id' => $result['paypal']['id'],
                'status' => 'unpaid'
            ]);

            return response()->json($result['paypal']);
        }
    }




    public function apiCapture(Request $request)
    {
        $paypalOrderId = $request->orderID;
        $accessToken = $this->getAccessToken();
        $duration = $request->duration;
        $productId = $request->product_id;

        if($request->product_type =="Custom_pack"){
            $request->validate([
                'product_pack' => 'required',
                'product_pack.*' => 'required|numeric',
                'duration' => 'required',
            ]);

            $products = $request->product_pack;
            if (count($products) < 3) {
                return response("Error: Minimum 3 tools required", 400);
            }
            $client = new Client();
            $res = $client->post(env('PAYPAL_BASE_URL') . "/v2/checkout/orders/{$paypalOrderId}/capture", [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ]
            ]);

            $result = json_decode($res->getBody(), true);

            $durations = [
                "1m"=>1,
                "2m"=>2,
                "3m"=> 3,
                "6m"=>6,
                "12m" =>12,
            ];

            $duration_month = $durations[$duration];

            if ($result['status'] === 'COMPLETED') {
                Order::where('order_id', $paypalOrderId)->update([
                    'status' => 'paid'
                ]);
                foreach ($products as $product){
                        Plans::create([
                            'user_id' => Auth()->id(),
                            'product_id' =>$product,
                            'expire_At' => Carbon::now()->addMonths($duration_month),
                        ]);
                }
            }
            Mail::to(Auth()->user()->email)->send(new OrderShipped("custom",$request->user()->name,$paypalOrderId,$products,$duration,Carbon::now()->addMonths($duration_month)));
            return response()->json($result);
        }

        $request->validate([
            'orderID' => 'required|string',
            'duration' => 'required',
            'product_id' => 'required',
        ]);

        $client = new Client();
        $res = $client->post(env('PAYPAL_BASE_URL') . "/v2/checkout/orders/{$paypalOrderId}/capture", [
            'headers' => [
                'Authorization' => "Bearer {$accessToken}",
                'Content-Type' => 'application/json',
            ]
        ]);

        $result = json_decode($res->getBody(), true);

        $durations = [
            "1m"=>1,
            "2m"=>2,
            "3m"=> 3,
            "6m"=>6,
            "12m" =>12,
            ];

        $duration_month = $durations[$duration];

        if ($result['status'] === 'COMPLETED') {
            Order::where('order_id', $paypalOrderId)->update([
                'status' => 'paid'
            ]);
            if($request->product_type == "All_pack"){
                foreach (Product::where("Product_Type","Product")->get() as $product){
                    if($product->id != $productId){
                        Plans::create([
                            'user_id' => Auth()->id(),
                            'product_id' =>$product->id,
                            'expire_At' => Carbon::now()->addMonths($duration_month),
                        ]);
                    }
                }
                Mail::to(Auth()->user()->email)->send(new OrderShipped("all",$request->user()->name,$paypalOrderId,Product::all(),$duration,Carbon::now()->addMonths($duration_month)));
            }else{
                Plans::create([
                    'user_id' => Auth()->id(),
                    'product_id' => $productId,
                    'expire_At' => Carbon::now()->addMonths($duration_month),

                ]);
                Mail::to(Auth()->user()->email)->send(new OrderShipped("single",$request->user()->name,$paypalOrderId,$productId,$duration,Carbon::now()->addMonths($duration_month)));

            }
        }
        return response()->json($result);
    }

    public function admin_orders(){
        return view('admin.orders');
    }
}
