@extends("main.head")

@section("root")
    <x-nav></x-nav>
    <?php
        $free_tools = \App\Models\Product::whereRaw("FIND_IN_SET('Free', Mode)")
        ->pluck('id')
        ->toArray();
        $paid_tools = \App\Models\Product::whereRaw("FIND_IN_SET('Paid', Mode)")->pluck('id')->toArray();
        $user_data = \App\Models\User::find(Auth()->id())->plans()->wherePivot('expire_at', '>', now())->pluck('product_id')->toArray();
    ?>
    <div class="my-10 grid grid-cols-4 gap-4 mx-10 max-md:grid-cols-2 max-md:mx-4 max-sm:grid-cols-1 max-lg:mx-6 max-lg:grid-cols-3">
        @foreach(\App\Models\Product::Orderby("Product_Type","desc")->get() as $product)
            <x-cards :src="asset('/storage/'.$product->path)">
                <h2 class="card-title">{{ucfirst($product->Product_Name)}}</h2>
                <div class="card-actions justify-end pt-3">
                    @if(in_array($product->id ,$free_tools) and in_array($product->id ,$user_data))
                    <a href="{{url('/Pro_Access/'.$product->id)}}" class="btn btn-primary bg-indigo-700 text-white hover:bg-indigo-800">Open</a>
                    @elseif(in_array($product->id ,$paid_tools) and in_array($product->id ,$user_data))
                        <a href="{{url('/Pro_Access/'.$product->id)}}" class="btn btn-primary bg-indigo-700 text-white hover:bg-indigo-800">Open</a>
                    @elseif((in_array($product->id ,$paid_tools) and !in_array($product->id ,$user_data)) and !in_array($product->id ,$free_tools))
                        @if($product->Product_Type=="Product")
                            <a href="{{url('/product/'.$product->name)}}" class="btn btn-primary bg-indigo-700 text-white hover:bg-indigo-800">Get This Tool</a>
                        @else
                            <a href="{{url('/pack/'.$product->name)}}" class="btn btn-primary bg-indigo-700 text-white hover:bg-indigo-800">Get This Pack</a>
                        @endif
                    @elseif(in_array($product->id ,$free_tools) and !in_array($product->id ,$user_data))
                        <div class="flex gap-4 justify-center">
                            <a href="{{url('/product/'.$product->name)}}" class="btn btn-primary bg-indigo-700 text-white hover:bg-indigo-800">Unlock All Features</a>
                            <a href="{{url('/access/'.$product->id)}}" class="btn btn-primary bg-indigo-700 text-white hover:bg-indigo-800">Use for Free</a>
                        </div>
                    @endif
                </div>
            </x-cards>
        @endforeach
            <x-cards :src="asset('/custom.png')">
                <h2 class="card-title">Custom Pack</h2>
                <div class="card-actions justify-end pt-3">
                   <a href="{{route("pack.custom")}}" class="btn btn-primary bg-indigo-700 text-white hover:bg-indigo-800">Get This Pack</a>
                </div>
            </x-cards>
    </div>
@endsection

