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
                <th>Product</th>
                <th>User</th>
                <th>Email</th>
                <th>expire</th>
                <th>created</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Models\Plans::orderby('expire_at')->get() as $plan)
                <tr>
                    <td>{{\App\Models\Product::find($plan->product_id	)->Product_Name}}</td>
                    <td>{{\App\Models\User::find($plan->user_id)->name}}</td>
                    <td>{{\App\Models\User::find($plan->user_id)->email}}</td>
                    <td>{{$plan->expire_at}}</td>
                    <th>{{$plan->created_at}}</th>
                    <td><a href="{{route("admin.plan.edit",$plan->product_id	)}}">Edite</a></td>
                    <td><a href="{{route("admin.plan.delete",$plan->product_id	)}}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <a class="absolute right-7 bottom-7 bg-blue-200 rounded-lg p-4" href="{{route("admin.plan.create")}}">+</a>
</div>
</body>
</html>
