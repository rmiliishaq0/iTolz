@extends("main.head")

@section("root")
    <div class=" min-h-screen flex flex-col dark:bg-gray-800">
    <x-nav></x-nav>
    <?php
        $free_tools = \App\Models\Product::whereRaw("FIND_IN_SET('Free', Mode)")
        ->pluck('id')
        ->toArray();
        $title = \App\Models\Product::where("name",$id)->value("Product_Name");
        $description = \App\Models\Product::where("name",$id)->value("Product_Description");
        $image =  \App\Models\Product::where("name",$id)->value("path");
        $seo_title = \App\Models\Product::where("name",$id)->value("Name_Seo");
        $seo_description = \App\Models\Product::where("name",$id)->value("Description_Seo");
        $price = json_decode(\App\Models\Product::where("name",$id)->value("price"),true);
        $id = \App\Models\Product::where("name",$id)->value("id");
        if(Auth()->check()){
            $user_data = \App\Models\User::find(Auth()->id())->plans()->wherePivot('expire_at', '>', now())->pluck('product_id')->toArray();
        }

    $durations = [
        "1m"=>"1 Month",
        "2m"=>"2 Months",
        "3m"=> "3 Months",
        "6m"=>"6 Months",
        "12m" =>"12 Months",
     ]
           ?>
    <div class="mt-[100px] grow dark:bg-gray-800">
        <div>
            <div class="lg:mx-20 mx-6 mb-6 flex flex-col gap-4 dark:bg-gray-800">
                @if($free_tools)
                <div  role="alert" class="alert alert-info">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-6 w-6 shrink-0 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-left">This tool is included in our Free Plan. <a href="/dashboard">Click here to access it in your dashboard.</a></span>
                </div>
                @endif
                <div id="cancel" role="alert" class="opacity-0 hidden alert alert-warning transition-all	duration-150 ease-in-out" style="display: none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span> Payment was cancelled.</span>
                </div>

                <div style="display: none" role="alert" class="hidden alert alert-error transition-all duration-150 ease-in-out" id="Err">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>An error occurred during the payment process. Please try again.</span>
                </div>

            </div>
            <div class="lg:card lg:card-side bg-base-100 shadow-lg lg:mx-20 mx-6">
            <figure class="lg:w-2/5 w-full flex justify-center" >
                <img class="rounded-lg w-5/6 lg:w-full"
                     src={{asset('/storage/'.$image)}}
                    alt="Tool" />
            </figure>
            <div class="card-body">
                <h1 class="card-title">{{$title}}</h1>
                <p>{{$description}}</p>
                <div class="flex md:justify-start gap-4 md:items-center flex-col sm:flex-row">
                    @if(Auth()->check() and !in_array($id,$user_data))
                        <div class="grow-[2]">
                            <select id="plans"  class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                @foreach($durations as $key => $value)
                                    @if($key == "1m")
                                        <option selected value="{{$price['1m']}}" data-id="1m">1 Month	</option>
                                    @else
                                        <option value="{{$price[$key]}}"  data-id={{$key}}>{{$value}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    @elseif(!auth()->check())
                        <div class="grow-[2]">
                            <select id="plans"  class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                @foreach($durations as $key => $value)
                                    @if($key == "1m")
                                        <option selected value="{{$price['1m']}}" data-id="1m">1 Month	</option>
                                    @else
                                        <option value="{{$price[$key]}}"  data-id={{$key}}>{{$value}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if(Auth::check())
                        @if(!in_array($id,$user_data))
                            <button class="grow px-6 btn btn-primary " onclick="payyment_modal.showModal()">Buy Now</button>
                                <h1 id="price" class="dark:text-gray-200 text-left font-bold text-lg w-fit text-gray-600">Total :<span class="dark:text-gray-200 text-2xl"> ${{$price['1m']}}</span></h1>
                            @else
                            <a href="{{url('/Pro_Access/'.$id)}}" class="grow px-6 btn btn-primary ">Open</a>
                        @endif
                    @else
                            <h1 id="price" class="dark:text-gray-200 text-left font-bold text-lg w-fit text-gray-600">Total :<span class="dark:text-gray-200 text-2xl"> ${{$price['1m']}}</span></h1>
                        @endif
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="">
        <x-foter></x-foter>
    </div>
    </div>

    <dialog id="payyment_modal" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <div class="mt-6 w-full">
            <h1 class="text-center text-lg font-semibold">Pay With : </h1>
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-indigo-700 hover:text-indigo-800 dark:text-indigo-600 dark:hover:text-indigo-700 border-indigo-600 dark:border-indigo-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="PayPal-styled-tab" data-tabs-target="#styled-PayPal" type="button" role="tab" aria-controls="PayPal" aria-selected="false">PayPal</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="styled-Wise-tab" data-tabs-target="#styled-Wise" type="button" role="tab" aria-controls="Wise" aria-selected="false">Wise</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="styled-Other-tab" data-tabs-target="#styled-Other" type="button" role="tab" aria-controls="Other" aria-selected="false">Other</button>
                    </li>
                </ul>
            </div>
            <div id="default-styled-tab-content">
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-PayPal" role="tabpanel" aria-labelledby="PayPal-tab">
                    <div id="paypal-button-container" class="dark:bg-gray-800"></div>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-Wise" role="tabpanel" aria-labelledby="Wise-tab">
                    <div class="flex flex-wrap justify-center ">
                        <h1 class="mb-4 lg:mb-6 text-lg lg:text-xl font-semibold">Pay using QR code or <a class="font-bold hover:text-indigo-700 transition-all decoration-2 underline-offset-4 hover:underline decoration-indigo-600" href="https://wise.com/pay/me/ishaqr10">click here</a></h1>
                        <img class="w-72" src="{{asset("/wise.png")}}" alt="wise-qr">
                    </div>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-Other" role="tabpanel" aria-labelledby="Other-tab">
                    <h1 class="text-center text-lg font-semibold">For special payment requests, <a class="decoration-2 underline-offset-4 font-bold transition-all ease-in-out  hover:underline decoration-indigo-600" href="https://wa.me/212701666282" target="_blank">contact us on WhatsApp</a>.</h1>
                </div>
            </div>

        </div>
    </dialog>
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=USD&components=buttons,funding-eligibility&enable-funding=card"></script>
    <script>
        let duration = document.getElementById('plans').options[document.getElementById('plans').selectedIndex].getAttribute('data-id');
        const paypalContainer = document.getElementById('paypal-button-container');

        document.getElementById('plans').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            duration = selectedOption.getAttribute('data-id');
            renderPayPalButton()
        });

        async function showHideCancel() {
            payyment_modal.close()
            const cancelEl = document.getElementById("cancel");
            cancelEl.style.display = "flex";
            cancelEl.className = "delay-200 opacity-100 alert alert-warning transition-all duration-150 ease-in-out";
            setTimeout(()=>{
                cancelEl.className = "opacity-0 alert alert-warning transition-all duration-150 ease-in-out"
                setTimeout(()=>{
                    cancelEl.style.display = "none";
                },600)
            },6000)
        }

        async function showHideErr() {
            payyment_modal.close()
            const cancelEl = document.getElementById("Err");
            cancelEl.style.display = "flex";
            cancelEl.className = "delay-200 opacity-100 alert alert-error transition-all duration-150 ease-in-out";
            setTimeout(()=>{
                cancelEl.className = "opacity-0  alert alert-error transition-all duration-150 ease-in-out"
                setTimeout(()=>{
                    cancelEl.style.display = "none";
                },600)
            },6000)
        }

        function renderPayPalButton() {
            paypalContainer.innerHTML = '';
            const productId =  {{$id}} ;
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return fetch("{{ route('paypal.api.create') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            @if(\App\Models\Product::find($id)->Product_Type == "Product")
                            product_id: productId,
                            duration
                            @elseif(\App\Models\Product::find($id)->Product_Type == "All")
                            product_id: productId,
                            product_type:"All_pack",
                            duration
                            @endif
                        })
                    })
                        .then(res => res.json())
                        .then(data => data.id)
                        .catch((e)=>{
                            console.log(e)
                        })
                },

                onApprove: function(data, actions) {
                    return fetch(`{{ route('paypal.api.capture') }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            orderID: data.orderID,
                            duration,
                            @if(App\Models\Product::find($id)->Product_Type == "All")
                                product_type:"All_pack",
                            @endif
                            product_id: productId,

                        })
                    }).then(()=>{
                        window.location.href = "{{env('APP_URL')}}" + "/dashboard"
                    })
                },

                onCancel: function (data) {
                    showHideCancel()
                },

                onError: function (err) {
                    showHideErr()
                }
            }).render(paypalContainer);
        }

        renderPayPalButton();

    </script>
    <script>
        document.getElementById("plans").addEventListener("change",(e)=>{
            document.getElementById("price").innerHTML= `Total :<span class="text-2xl"> $${e.target.value}</span>`
        })

    </script>
@endsection

