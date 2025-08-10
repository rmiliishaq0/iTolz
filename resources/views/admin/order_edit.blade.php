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
<div class="w-full flex justify-center items-center h-dvh ">
    <form action="{{route("admin.order.edit.post",$id)}}" method="POST" class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
        @csrf
        <label class="label">product_id</label>
        <input type="text" class="input" placeholder="product_id" name="product_id" value=" {{\App\Models\Order::find($id)->product_id}}"/>

        <label class="label">user_id</label>
        <input type="text" class="input" placeholder="user_id" name="user_id" value="{{\App\Models\Order::find($id)->user_id}}" />

        <label class="label">duration</label>
        <input type="text" class="input" placeholder="duration" name="duration" value="{{\App\Models\Order::find($id)->duration}}"/>

        <label class="label">amount</label>
        <input type="text" class="input" placeholder="amount" name="amount" value="{{\App\Models\Order::find($id)->amount}}"/>

        <label class="label">order_id</label>
        <input type="text" class="input" placeholder="order_id" name="order_id" value="{{\App\Models\Order::find($id)->order_id}}"/>

        <label class="label">status</label>
        <input type="text" class="input" placeholder="status" name="status" value="{{\App\Models\Order::find($id)->status}}"/>

        <label class="label">Product_Type</label>
        <input type="text" class="input" placeholder="Product_Type" name="Product_Type" value="{{\App\Models\Order::find($id)->Product_Type}}"/>
        <button class="btn btn-neutral mt-4">Update</button>
    </form>
</div>
</body>
</html>
