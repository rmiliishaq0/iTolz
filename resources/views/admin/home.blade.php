<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Admin Page</title>
</head>
<body>
    <div class="w-full flex justify-center items-center h-dvh ">
        <a href="{{ route("admin_users")}}" class="py-2 px-4 bg-indigo-700 hover:bg-indigo-800 text-white w-fit rounded-lg m-2">Users</a>
        <a class="py-2 px-4 bg-indigo-700 hover:bg-indigo-800 text-white w-fit rounded-lg m-2" href="admin/ads">Ads</a>
        <a class="py-2 px-4 bg-indigo-700 hover:bg-indigo-800 text-white w-fit rounded-lg m-2" href="{{ route("admin_products")}}">Products</a>
        <a class="py-2 px-4 bg-indigo-700 hover:bg-indigo-800 text-white w-fit rounded-lg m-2" href="/admin/messages">Messages</a>
        <a class="py-2 px-4 bg-indigo-700 hover:bg-indigo-800 text-white w-fit rounded-lg m-2" href="/admin/orders">Orders</a>
        <a class="py-2 px-4 bg-indigo-700 hover:bg-indigo-800 text-white w-fit rounded-lg m-2" href="{{route("admin.plan")}}">Plans</a>
    </div>
</body>
</html>
