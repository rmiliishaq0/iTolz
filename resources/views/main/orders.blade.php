@extends("main.head")

@section("root")
    <?php
    $user_order = \App\Models\Order::Where("user_id",Auth()->id())->orderByDesc('created_at')->get()->toArray();
    $durations = [
        "1m"=>"1 Month",
        "2m"=>"2 Months",
        "3m"=> "3 Months",
        "6m"=>"6 Months",
        "12m" =>"12 Months",
    ];
    ?>

    <div class=" min-h-screen flex flex-col dark:bg-gray-800">
        <x-nav></x-nav>
        @if(!empty($user_order))
            <div class="mb-4 mt-[120px] flex justify-end mx-6 md:mx-12 items-center gap-6">
                @if(session('status'))
                    <div role="alert" class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{session('status')}}</span>
                    </div>
                @endif
                <button class=" btn btn-error text-white" onclick="my_modal_3.showModal()">Delete all orders</button>
            </div>
            <dialog id="my_modal_3" class="modal !dark:bg-gray-800 ">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <h3 class="text-lg font-bold">Are you sure you want to delete all orders?</h3>
                    <div class="flex justify-end mt-6">
                        <div class="flex items-center gap-6">
                            <button class="btn">Cancels</button>
                            <a href="{{route("delete.orders")}}" class=" btn btn-error text-white">Delete all orders</a>
                        </div>
                    </div>
                </div>
            </dialog>
        <div class=" mx-6 lg:mx-16 grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach($user_order as $ordr)
                    <div class="p-6 lg:p-12 shadow-lg rounded-lg ">
                        <div class="flex justify-center w-full">
                            <div class="flex justify-between items-center gap-6">
                                @if($ordr['Product_Type'] =="Product")
                                <h1 class=" text-shadow-lg tracking-wide font-bold  text-xl lg:text-2xl">{{\App\Models\Product::find($ordr['product_id'])->Product_Name}}</h1>
                                @else
                                    <h1 class=" text-shadow-lg tracking-wide font-bold  text-xl lg:text-2xl">{{$ordr['Product_Type']}}</h1>
                                @endif
                                <div class="badge @if($ordr['status'] == 'paid') badge-success @else badge-warning @endif">{{$ordr['status']}}</div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center pt-4">
                            <h1 class=" font-medium  text-md lg:text-lg">{{$durations[$ordr['duration']]}}</h1>
                            <h1 class="font-medium  text-md lg:text-lg">$ {{$ordr['amount']}}</h1>
                        </div>
                        <div class="flex justify-between items-center pt-4 gap-4 flex-wrap">
                            <h1 class=" font-normal  text-base lg:text-lg">{{(new DateTime($ordr['created_at']))->format('d/m/Y')}}</h1>
                            <h1 class="font-medium text-md lg:text-lg">order_Id : <span class="text-shadow-md font-bold tracking-wide text-md lg:text-lg">{{$ordr['order_id']}}</span></h1>
                        </div>
                    </div>
            @endforeach
        </div>
        @else
            <div class="mt-[120px] mx-6 lg:mx-16">
                <div role="alert" class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span> You don’t have any orders yet. Start exploring our products to place your first order!</span>
                </div>
            </div>

        @endif

    </div>
    <div class="">
        <x-foter></x-foter>
    </div>
@endsection

