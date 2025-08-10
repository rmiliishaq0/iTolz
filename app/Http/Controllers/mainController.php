<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Models\ChatSupport;
use App\Models\Contact;
use App\Models\Extention;
use App\Models\Order;
use App\Models\Plans;
use App\Models\Product;
use App\Models\Ad;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\AbstractList;
use function Pest\Laravel\json;
use Illuminate\Support\Facades\RateLimiter;




class mainController extends Controller
{
    public function settings_get(){
        seo()->title('Manage Your Account Settings | Itolz')->description('Update your profile information, change your password for your Itolz account.');
        return view('main.settings',['is_active_chat'=>true]);
    }

    public function settings_post(Request $request){
        if(is_null($request->name) and is_null($request->email) and is_null($request->password)){
        return back()->withErrors([
            'empty_update' => 'You must provide at least one value'
        ]);
    }
    else {
        $user = Auth::user();
        $data = [];
        $updatedFields = [];

        if (!is_null($request->password)) {
            $data['password'] = Hash::make($request->password);
            $updatedFields[] = 'Password';
        }
        if (!is_null($request->email)) {
            $data['email'] = $request->email;
            $updatedFields[] = 'Email';
        }
        if (!is_null($request->name)) {
            $data['name'] = $request->name;
            $updatedFields[] = 'Name';
        }

        if (!empty($data)) {
            $user->update($data);
            $message = 'Updated: ' . implode(', ', $updatedFields) . ' successfully!';
            return redirect()->route('settings')->with('success', $message);
        }

        return redirect()->route('settings')->with('info', 'No changes were made.');
    }
    }

    public function admin_home(){
        return view("admin.home");
    }

    public function admin_users(){
        return view("admin.users");
    }

    public function admin_user_delete($id){
        User::destroy($id);
        return redirect()->route('admin_users',$id);
    }

    public function admin_user_post($id ,Request $request){
        if(is_null($request->name) and is_null($request->email) and is_null($request->password)){
        return back()->withErrors([
            'empty_update' => 'You must provide at least one value'
        ]);
    }
    else {
        $user = User::find($id);
        $data = [];
        $updatedFields = [];

        if (!is_null($request->email)) {
            $data['email'] = $request->email;
            $updatedFields[] = 'Email';
        }
        if (!is_null($request->name)) {
            $data['name'] = $request->name;
            $updatedFields[] = 'Name';
        }
        if (!is_null($request->Emial_verify)) {
            $data['email_verified_at'] = $request->Emial_verify;
            $updatedFields[] = 'Emial_verify';
        }
        if (!is_null($request->isAdmin)) {
            $data['isAdmin'] = $request->isAdmin;
            $updatedFields[] = 'isAdmin';
        }

        if (!empty($data)) {
            $user->update($data);
            $message = 'Updated: ' . implode(', ', $updatedFields) . ' successfully!';
            return redirect()->route('admin_user_post',$id)->with('success', $message);
        }

        return redirect()->route('admin_user_post',$id)->with('info', 'No changes were made.');
    }
    }

    public function admin_user($id){
        return view("admin.user",["id"=>$id]);
    }

    public function admin_products(){
        return view("admin.products");
    }

    public function admin_product($id){
        return view("admin.product",["id"=>$id]);
    }

    public function admin_product_post($id, Request $request){
        $product=Product::find($id);
        if ($request->hasFile('path')) {
            $path = $request->path->store('toolsPhotos','public');
            $product->path= $path;
            $product->name= $request->name;
            $product->url= $request->url;
            $product->data= $request->data;
            $product->removed= $request->removed;
            $product->is_local= $request->is_local;
            $product->Product_Name= $request->Product_Name;
            $product->Product_Description= $request->Product_Description;
            $product->Name_Seo= $request->Name_Seo;
            $product->Description_Seo= $request->Description_Seo;
            $product->Price= $request->Price;
            $product->Mode= $request->Mode;
            $product->Product_Type = $request->Product_Type;

            $product->update();
            return redirect()->route('admin_product',$id)->with('success',"product updated successfully");
        }else{
            $product->name= $request->name;
            $product->url= $request->url;
            $product->data= $request->data;
            $product->removed= $request->removed;
            $product->is_local= $request->is_local;
            $product->Product_Name= $request->Product_Name;
            $product->Product_Description= $request->Product_Description;
            $product->Name_Seo= $request->Name_Seo;
            $product->Description_Seo= $request->Description_Seo;
            $product->Price= $request->Price;
            $product->Mode= $request->Mode;
            $product->Product_Type = $request->Product_Type;

            $product->update();
            return redirect()->route('admin_product',$id)->with('success',"product updated successfully");
        }
    }

     public function product_create(){
        return view("admin.product_create");
    }

    public function admin_product_delete($id){
        Product::destroy($id);
        return redirect()->route('admin_products',$id);
    }

    public function product_create_post(Request $request){
        if ($request->hasFile('path')) {
            $path = $request->path->store('toolsPhotos','public');
        }
        else{
            $path = "/";
        }

        $product = new Product;
        $product->path= $path;
        $product->name= $request->name;
        $product->url= $request->url;
        $product->data= $request->data;
        $product->removed= $request->removed;
        $product->is_local= $request->is_local;
        $product->Product_Name= $request->Product_Name;
        $product->Product_Description= $request->Product_Description;
        $product->Name_Seo= $request->Name_Seo;
        $product->Description_Seo= $request->Description_Seo;
        $product->Price= $request->Price;
        $product->Mode= $request->Mode;
        $product->Product_Type = $request->Product_Type;
        $product->save();
        return redirect()->route('product_create')->with('success',"product added successfully");
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function home()
    {
        seo()->title('Itolz: Cheap Subscriptions for Premium Tools | Save 90%')->description('Stop paying full price. Get instant access to shared subscriptions for top AI, design, and productivity tools at a fraction of the cost. Join Itolz and start saving today!');
        return view("Home",['is_active_chat'=>true]);
    }

    public function access($id)
    {
        $products = Product::all()->pluck("id")->toArray();
        if (!(in_array($id,$products))) {
            return response()->json(['error' => 'Invalid Product'], 400);
        }
        $product_name = ucfirst(Product::find($id)->Product_Name);
        seo()->title("Get ". $product_name. " for Free | Limited Time Access | Itolz")->description("Experience the full version of ".$product_name." with a free 20-minute trial from Itolz. no credit card needed.");
        return view("main.Tools-acess", ["id" => $id,'is_active_chat'=>true]);
    }

    public function Gettool($id, Request $request)
    {
        $products = Product::all()->pluck("id")->toArray();
        if (!(in_array($id,$products))) {
            return response()->json(['error' => 'Invalid Product'], 400);
        }
        $data = Product::findorfail($id)->data;
        $name = Product::findorfail($id)->name;
        $url = Product::findorfail($id)->url;
        $blocked = Product::findorfail($id)->removed;
        $is_local = Product::findorfail($id)->is_local;
//        $main = Ad::where('is_active', true)->get();
        return response()->json(["data" => $data, "name" => $name, "url" => $url, "blocked" => $blocked,"is_local" =>$is_local]);
    }

    public function Gettool_Pro($id, Request $request)
    {
        $data = Product::findorfail($id)->data;
        $name = Product::findorfail($id)->name;
        $url = Product::findorfail($id)->url;
        $blocked = Product::findorfail($id)->removed;
        $is_local = Product::findorfail($id)->is_local;;
        return response()->json(["data" => $data, "name" => $name, "url" => $url, "blocked" => $blocked,"is_local" =>$is_local]);
    }


    public function register(Request $request)
    {
        $extensionId = $request->input('extension_id');

        if (!$extensionId || !is_string($extensionId) || strlen($extensionId) < 10) {
            return response()->json(['error' => 'Invalid extension ID'], 400);
        }

        $extension = DB::table('extensions')->where('extension_id', $extensionId)->first();

        if (!$extension) {
            $token = Str::random(64);
            Extention::updateOrCreate(
                [
                    'extension_id' => $extensionId,
                    'token' => $token,
                ]
            );
        } else {
            $token = $extension->token;
        }

        return response()->json(['tok' => $token]);
    }

    public function getAll()
    {
        $products = Product::all("name");
        $url = Product::all("url");
        return response()->json([$products, $url]);
    }

/*
    public function popup()
    {
        $scriptUrl = Ad::where('is_active', true)
            ->where("type", "popup")
            ->value("main_script");

        if (!$scriptUrl) {
            return response()->json(['error' => 'No script found'], 404);
        }

        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
            'Referer' => 'https://example.com' // Fake referrer
        ])->get($scriptUrl);

        if ($response->successful()) {
            return Response::make($response->body(), 200, [
                'Content-Type' => 'application/javascript',
                'Access-Control-Allow-Origin' => '*',
            ]);
        }

        return response()->json(['error' => 'Failed to fetch script'], 500);
    }
*/
    public function download(){

        $name = 'itolz-extentions.zip';
        return Storage::disk('public')->download("itolz-extentions.zip",$name);
    }

    public function about(){
        seo()->title("Our Mission: Making Premium Software Affordable | About Itolz")->description("Our Mission: Making Premium Software Affordable | About Itolz");
        return view("/main/about",['is_active_chat'=>true]);
    }

    public function privacy(){
        seo()->title("Privacy Policy | Itolz")->description("Read the official Privacy Policy for Itolz. Understand how we collect, use, and protect your personal data and information.");
        return view("/main/Privacy",['is_active_chat'=>true]);
    }
    public function terms(){
        seo()->title("Terms and Conditions | Itolz")->description("Please review the Terms and Conditions governing the use of the Itolz website, extension, and services before creating an account.");
        return view("main/Terms",['is_active_chat'=>true]);
    }

    public function contact(){
        seo()->title("Contact Us | Itolz Support")->description("Have a question or need support? Contact the Itolz team. We're here to help you with your account, subscriptions, or any other inquiries.");
        return view("main/contact",['is_active_chat'=>true]);
    }

    public function contact_post(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:rfc,dns',
            'message' => 'required|max:255|min:10',
        ]);

        $user_id = Auth::id(); // Make sure you're using Auth::id() not Auth()->id()
        $phone = $request->phone;
        $email = $request->email;
        $message = $request->message;

        $executed = RateLimiter::attempt(
            'send-message:' . $user_id,
            $perMinute = 3,
            function () use ($user_id, $phone, $email, $message) {
                Contact::create([
                    'user_id' => $user_id,
                    'PhoneNumber' => $phone,
                    'email' => $email,
                    'message' => $message,
                ]);
            }
        );

        if (!$executed) {
            return back()->withErrors(['Too many attempts. Please try again later.']);
        }

        return back()->with('success', 'Thank you! Your message has been sent.');
    }

    public function product_page($product,$id){
        $products = Product::all()->pluck("name")->toArray();
        if (!(in_array($id,$products))) {
            return response()->json(['error' => 'Invalid Product'], 400);
        }
        $product_name = ucfirst(Product::Where("name",$id)->pluck("Product_Name")[0]);
        $price = json_decode(Product::Where("name",$id)->pluck("price")[0],true)["1m"];
        seo()->title("Get ".$product_name." for Cheap | Itolz Subscription Deal")->description("Unlock full access to ".$product_name." for as low as ".$price."/month. Get your affordable Itolz subscription now and enjoy instant, unlimited access.");
        return view("main.product", ["id"=>$id],['is_active_chat'=>true]);
    }

    public function pro_access($id){
        $products = Product::all()->pluck("id")->toArray();
        if (!(in_array($id,$products))) {
            return response()->json(['error' => 'Invalid Product'], 400);
        }
        $prodct_name=ucfirst(Product::find($id)->Product_Name);
        seo()->title("Accessing ".$prodct_name. "... | Itolz")->description("You have unlocked premium access to ".$prodct_name." with your Itolz plan. Enjoy unlimited, ad-free access.");
        return view("main.pro_access" ,["id" => $id]);
    }

    public function All_tools(){
        seo()->title("All Premium Tools & Affordable Plans | Itolz Catalog")->description("Explore our full library of premium tools. Find incredibly cheap subscription plans for the best software in AI, design, marketing, and more. See all deals!");
        return view("main.All_tools",['is_active_chat'=>true]);
    }

    public function orders(){
        seo()->title("My Order History | Itolz")->description("Review your past purchases and subscription orders on Itolz. Keep track of all your payments and plan details.");
        return view("main.orders",['is_active_chat'=>true]);
    }

    public function active_plans()
    {
        seo()->title("My Active Subscription Plans | Itolz")->description("View and manage your current active subscription plans and their renewal dates. Upgrade or modify your tool access anytime.");
        return view("main.active_plans",['is_active_chat'=>true]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|min:5|max:100',
        ]);
        $message = $request->message;
        $user_id = auth()->id();
        if(!$message || ! $user_id){
            return response()->json(["invalid request"=>true]);
        }

        if(auth()->user()->isAdmin == 1){
            $to = $request->to;
            ChatSupport::create([
                'to' => $to,
                'message' => $message,
            ]);
            broadcast(new ChatEvent($to,$message,true))->toOthers();
            return response()->json(['sucess'=>true]);
        }

        ChatSupport::create([
            'sender' => $user_id,
            'message' => $message,
        ]);

        broadcast(new ChatEvent($user_id,$message))->toOthers();
        return response()->json(['sucess'=>true]);
    }

    public function update_read(Request $request){
        ChatSupport::where('to', auth()->id())
            ->whereNull('readAt')
            ->update([
                'readAt' => now(),
                'updated_at' => now(),
            ]);
    }

    public function admin_messages(){
        $users = User::wherehas("messages")->orderBy('created_at','desc')->get();
        return view("admin.messages",["users"=>$users]);
    }

    public function admin_single_message($id){
        ChatSupport::where('sender',$id)->update([
            'readAt'=> now()
        ]);
        $messages = ChatSupport::Where('sender',$id)->get();
        $admin_messages = ChatSupport::Where('to',$id)->get();
        return view("admin.singel_message",["messages"=>$messages,'admin_messages'=>$admin_messages,'id'=>$id]);
    }

    public function pack_create()
    {
        seo()->title("Build a Custom Tool Subscription Pack & Save Big | Itolz")->description("Why pay for bundles? Hand-pick the premium tools you need and build your own affordable subscription pack. Maximum savings, zero waste. Start building now!");
        return view("main.pack_create",['is_active_chat'=>true]);
    }

    public function CustomPrices(Request $request)
    {

        $request->validate([
            'Products' => 'required|array',
            'Products.*' => 'required|numeric',
            'Duration' => 'required'
        ]);
        $products = $request->Products;

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

        $duration = $request->Duration;

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

        return [
            "before" => $total,
            "after" => $TotalPrcice,
            "tool_discount" => $Tdiscount,
            "duration_discount" => $Mdiscount,
            "tools_count" => $productL,
            "duration_months" => $duration_to_int[$duration]
        ];
    }

    public function admin_orders()
    {
        return view('admin.orders');
    }

    public function admin_order_delete($id)
    {
        Order::find($id)->delete();
        return redirect()->back()->with('status', 'Operation successful!');

    }

    public function admin_order_edit($id)
    {
        return view("admin.order_edit",["id"=>$id]);
    }

    public function admin_order_edit_post($id,Request $request){

        Order::find($id)->update([
            'product_id' =>  $request->product_id,
            'status' => $request->status,
            'order_id' => $request->order_id,
            'amount' => $request->amount,
            'duration' => $request->duration,
            'user_id' => $request->user_id,
            'Product_Type' => $request->Product_Type,
        ]);
        return back();
    }

    public function admin_order_submit(Request $request)
    {
        Order::Create([
            'product_id' =>  $request->product_id,
            'status' => $request->status,
            'order_id' => $request->order_id,
            'amount' => $request->amount,
            'duration' => $request->duration,
            'user_id' => $request->user_id,
            'Product_Type' => $request->Product_Type,
        ]);
        return back();
    }

    public function admin_order_creat()
    {
        return view('admin.order_creat');
    }

    public function admin_plan_create()
    {
        return view("admin.creatPlan");
    }

    public function admin_plan_submit(Request $request)
    {
        $user = $request->user;
        $product=$request->product;
        $duration =$request->duration;

        $durations = [
            "1m"=>1,
            "2m"=>2,
            "3m"=> 3,
            "6m"=>6,
            "12m" =>12,
        ];

        $duration_month = $durations[$duration];
        Plans::create([
            'user_id' =>$user,
            'product_id' =>$product,
            'expire_at'=>Carbon::now()->addMonths($duration_month)
        ]);
        return back();
    }

    public function admin_plan(){
        return view("admin.Plans");
    }

    public function admin_plan_edit($id)
    {
        return view("admin.editView",["id"=>$id]);
    }

    public  function admin_plan_edit_submit($id ,Request $request)
    {
        $user = $request->user;
        $product=$request->product;
        $duration =$request->duration;

        $durations = [
            "1m"=>1,
            "2m"=>2,
            "3m"=> 3,
            "6m"=>6,
            "12m" =>12,
        ];

        $duration_month = $durations[$duration];
        Plans::Where("product_id",$id)->update([
            'user_id' =>$user,
            'product_id' =>$product,
            'expire_at'=>Carbon::now()->addMonths($duration_month),
        ]);

        return back();
    }

    public function  admin_plan_delete($id)
    {
        Plans::Where("product_id" ,$id)->delete();
        return back();
    }

}
