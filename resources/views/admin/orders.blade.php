<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Admin Page</title>
</head>
<body>
<div class="w-full flex justify-center items-center h-dvh relative">
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th>order_id</th>
                <th>Product</th>
                <th>User</th>
                <th>Email</th>
                <th>duration</th>
                <th>amount</th>
                <th>status</th>
                <th>Creat at</th>
                <th>Product_Type</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>
            </thead>
            <tbody>
            @foreach(\App\Models\Order::orderby('status','desc')->get() as $order)
                <tr>
                    <th>{{$order->order_id}}</th>
                    <td>{{\App\Models\Product::find($order->product_id)->Product_Name}}</td>
                    <td>{{\App\Models\User::find($order->user_id)->name}}</td>
                    <td>{{\App\Models\User::find($order->user_id)->email}}</td>
                    <td>{{$order->duration}}</td>
                    <td>{{$order->amount}}</td>
                    <td>{{$order->status}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>{{$order->Product_Type}}</td>
                    <td><a href="{{route("admin.order.edit",$order->id)}}">Edite</a></td>
                    <td><a href="{{route("admin.order.delete",$order->id)}}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <a class="absolute right-7 bottom-7 bg-blue-200 rounded-lg p-4" href="{{route("admin.order.create")}}">+</a>
</div>
</body>
</html>
