@extends("main.head")
@section("root")
    @php
    $duration_convert =[
       "1m"=>"1 month",
       "2m"=>"2 months",
       "3m"=>"3 months",
       "6m"=>"6 months",
       "12"=>"1 year"
]
    @endphp
    <div style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; background-color: #f3f4f6;">
        <div style="background-color: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1); max-width: 600px; width: 100%; margin: 0 auto;">
            <div style="padding: 16px; background-color: #f3f4f6;">
                <div style="display: flex; justify-content: center;">
                    <a href="/" style="display: flex; align-items: center; text-decoration: none;">
                        <img src="{{ asset('/ltolz.png') }}" alt="iTolz Logo" style="width: 50px;"/>
                        <span style="font-size: 24px; font-weight: 600; color: #1f2937; font-family: monospace;">{{ config('app.name') }}</span>
                    </a>
                </div>
                <div style="text-align: center; padding: 16px;">
                    <h3 style="font-size: 24px; font-weight: 700; color:#1f2937; opacity: 80% ;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; text-align: center; margin-top: 10px;">Thank You for Your Purchase!</h3>
                </div>
            </div>
            <div style="padding: 24px; text-align: center;">
                <p style="color:#1f2937; opacity: 80%;font-size: 18px; font-weight: 600;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">Hello, <span style="font-weight: 700;">{{ $userName }}</span> , your order has been confirmed.</p>
                <p style="text-align: start; margin-top:30px ;font-size: 16px;   font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; font-weight: 500; color:#1f2937; opacity: 75%;margin-left: 15px;">Here’s a summary of your order: </p>
                <div style="padding: 24px;background-color: #f3f4f6; border-radius: 8px; margin-left: 15px; margin-right: 20px;margin-top: 15px">
                    <p style="text-align: start;color:#1f2937; opacity: 80%;font-size: 15px; font-weight: 600;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';"><span style="font-weight: 700">Order Number:</span >
                        {{$orderNumber}}</p>
                    <table style="margin-top: 24px;width: 100%">
                        <tr>
                            <th>Tool Name</th>
                            <th>Duration</th>
                            <th>Expire At</th>
                            <th>Price</th>
                        </tr>
                        @if($type == "all")
                            @foreach($toolsData as $product)
                                @if($product->Product_Type == "Product")
                                @php
                                    $priceArray = json_decode(\App\Models\Product::find($product->id)->value("price"), true);
                                @endphp
                                <tr>
                                    <td>{{ $product->Product_Name }}</td>
                                    <td  style="display: table-cell;">{{ $duration_convert[$duration] }}</td>
                                    <td  style="display: table-cell;">{{ date_format($expireAt, "Y/m/d") }}</td>
                                    <td>{{ $priceArray[$duration] }}</td>
                                </tr>
                                @endif
                            @endforeach
                        @elseif($type =="single")
                            <tr>
                                <td>{{ \App\Models\Product::find($toolsData)->Product_Name }}</td>
                                <td  style="display: table-cell;">{{ $duration_convert[$duration] }}</td>
                                <td  style="display: table-cell;">{{ date_format($expireAt, "Y/m/d") }}</td>
                                <td>{{ json_decode(\App\Models\Product::find($toolsData)->value("price"), true)[$duration] }}</td>
                            </tr>
                        @else
                        @foreach($toolsData as $product)
                            @php
                                $priceArray = json_decode(\App\Models\Product::find($product)->value("price"), true);
                                $productModel = \App\Models\Product::find($product);
                            @endphp
                            <tr>
                                <td>{{ $productModel->Product_Name }}</td>
                                <td  style="display: table-cell;">{{ $duration_convert[$duration] }}</td>
                                <td  style="display: table-cell;">{{ date_format($expireAt, "Y/m/d") }}</td>
                                <td>{{ $priceArray[$duration] }}</td>
                            </tr>
                        @endforeach
                        @endif
                    </table>
                    <p style="text-align: start;color:#1f2937; opacity: 80%;font-size: 15px; font-weight: 600;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';"><span style="font-weight: 700">Total: </span >{{\App\Models\Order::Where("order_id",$orderNumber)->pluck("amount")[0]}}</p>
                </div>
                <a href="{{env("APP_URL") . "/orders" }}" style="display: inline-block; background-color: #3F00E7; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; margin-top: 20px; font-family: sans-serif; font-weight: 600;">View Your Order</a>
                <p style="color:#1f2937;opacity:70%;font-size: 16px; margin-top: 20px;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; font-weight: 500;">Thank you for choosing {{ config('app.name') }}</p>
                <hr style="margin: 20px;">
                <p style="color:#1f2937;opacity:70%;font-size: 16px;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; font-weight: 400;">Regards,</p>
                <p style="color:#1f2937;opacity:70%;font-size: 16px;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; font-weight: 400;">The {{ config('app.name') }} Team</p>
            </div>
            <div style="padding: 16px; background-color: #f3f4f6;">
                <p style="text-align: center; font-size: 14px;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </div>



    <style>
        body,
        body *:not(html):not(style):not(br):not(tr):not(code) {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
            'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
        }
        table{
            border-collapse: collapse;
        }
        table th {
            border-bottom: 2px solid #49515D ;
            padding: 17px;
            color:#1f2937; opacity: 80%;font-size: 15px; font-weight: 700;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
        }
        table tr td{
            border-bottom: 1px solid gray;
            padding: 15px;
            color:#1f2937; opacity: 75%;font-size: 13px; font-weight: 600;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
        }
        table tr:nth-child(odd) {
            background-color: #f2f2f2; /* Light gray */
        }

        table tr:nth-child(even) {
            background-color: #ffffff; /* White */
        }
        table tr:last-child td {
            border-bottom: none;
        }
    </style>

@endsection
