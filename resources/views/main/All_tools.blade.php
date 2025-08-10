@extends("main.head")

@section("root")
    <?php
    $free_tools = \App\Models\Product::whereRaw("FIND_IN_SET('Free', Mode)")
        ->pluck('id')
        ->toArray();
    ?>
    <x-nav></x-nav>
    <div class="grid grid-cols-4 gap-4 mx-10 max-md:grid-cols-2 max-md:mx-4 max-sm:grid-cols-1 max-lg:mx-6 max-lg:grid-cols-3">
        @foreach(\App\Models\Product::Orderby("Product_Type","desc")->get() as $product)
            <a @if($product->Product_Type=="Product") href="{{route('product_page', ['id' => $product->name,"product"=>"product"])}}"  @elseif($product->Product_Type=="Custom") href="{{route('pack.custom')}}" @else href="{{route('product_page', ['id' => $product->name,"product"=>"pack"])}}"  @endif >
            <x-cards :src="asset('/storage/'.$product->path)" >
                <div class="flex justify-between gap-4 items-center w-full">
                    @if(in_array($product->id,$free_tools))
                        <div class="badge badge-soft badge-primary">In Free</div>
                    @endif
                    <h2 class="text-2xl font-bold">{{ucfirst($product->Product_Name)}}</h2>
                    <h2 class="font-bold text-xl  text-gray-400">{{"$ " .json_decode(($product->Price),true)["1m"]}}</h2>
                </div>
            </x-cards>
            </a>
        @endforeach
            <a href="{{route("pack.custom")}}">
            <x-cards :src="asset('/custom.png')" >
                <div class="flex justify-between gap-4 items-center w-full">
                    <h2 class="text-2xl font-bold">Custom Pack</h2>
                </div>
            </x-cards>
            </a>
    </div>
@endsection
