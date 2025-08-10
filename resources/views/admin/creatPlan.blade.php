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
<form action="{{route("admin.plan.submit")}}" method="POST" class="w-full flex justify-center items-center h-dvh relative">
    @csrf
      <div class="w-1/3 flex justify-center items-center bg-white rounded-lg shadow-lg flex-col gap-4 py-6">
          <select name="user" class="select">
                  <option selected>Select User</option>
                  @foreach(\App\Models\User::all() as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                  @endforeach
          </select>
          <select name="product" class="select">
              <option selected>Select Product</option>
              @foreach(\App\Models\Product::Where("Product_Type","Product")->get() as $product)
                  <option value="{{$product->id}}">{{$product->Product_Name}}</option>
              @endforeach
          </select>
          <select name="duration" class="select">
              <option selected value="1m" >1 Month</option>
              <option value="2m">2 Months</option>
              <option value="3m">3 Months</option>
              <option value="6m">6 Months</option>
              <option value="12m">12 Months</option>
          </select>
          <button class="btn  w-fit">Submit</button>
      </div>
</form>
</body>
</html>
