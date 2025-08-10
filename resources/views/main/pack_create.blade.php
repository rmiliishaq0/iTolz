@extends("main.head")

@section("root")
    <x-nav></x-nav>
    <?php
    $user_data = \App\Models\User::find(Auth()->id())->plans()->wherePivot('expire_at', '>', now())->pluck('product_id')->toArray();
    ?>
    <div class="relative h-dvh overflow-x-hidden dark:bg-gray-800" >
        <div style="margin-top: 120px">
            <div id="conttt" class=" hidden lg:mx-20 mx-6 mb-6  flex-col gap-4">
                <div id="cancel" role="alert" class="opacity-0 hidden alert alert-warning transition-all	duration-150 ease-in-out" style="display: none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span> Payment was cancelled.</span>
                </div>

                <div style="display: none" role="alert" class="opacity-0 hidden alert alert-error transition-all duration-150 ease-in-out" id="Err">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>An error occurred during the payment process. Please try again.</span>
                </div>

            </div>
            <div class="grid grid-cols-4 gap-4 mx-10 max-md:grid-cols-2 max-md:mx-4 max-sm:grid-cols-1 max-lg:mx-6 max-lg:grid-cols-3">
                @foreach(\App\Models\Product::all() as $product)
                    @if($product->Product_Type =="Product")
                        <x-cards :src="asset('/storage/'.$product->path)" marginT="none">
                            <div class="pt-3 flex justify-between gap-6 items-center">
                                <h2 id="Product_{{$product->id}}" class="text-2xl font-bold">{{ucfirst($product->name)}}</h2>
                                <h2 class="font-bold text-xl  text-gray-600">{{"$ " .json_decode(($product->Price),true)["1m"]}}</h2>
                                <button onclick="Addfct({{$product->id}})" id="{{$product->id}}" class=" add_btn transition-all bg-indigo-700 hover:bg-indigo-800 p-4 rounded-full w-10 h-10  flex justify-center items-center"> <svg  xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 401.994 401.994" style="font-size: 25px" xml:space="preserve" ><g><path d="M394 154.175c-5.331-5.33-11.806-7.994-19.417-7.994H255.811V27.406c0-7.611-2.666-14.084-7.994-19.414C242.488 2.666 236.02 0 228.398 0h-54.812c-7.612 0-14.084 2.663-19.414 7.993-5.33 5.33-7.994 11.803-7.994 19.414v118.775H27.407c-7.611 0-14.084 2.664-19.414 7.994S0 165.973 0 173.589v54.819c0 7.618 2.662 14.086 7.992 19.411 5.33 5.332 11.803 7.994 19.414 7.994h118.771V374.59c0 7.611 2.664 14.089 7.994 19.417 5.33 5.325 11.802 7.987 19.414 7.987h54.816c7.617 0 14.086-2.662 19.417-7.987 5.332-5.331 7.994-11.806 7.994-19.417V255.813h118.77c7.618 0 14.089-2.662 19.417-7.994 5.329-5.325 7.994-11.793 7.994-19.411v-54.819c-.002-7.616-2.661-14.087-7.993-19.414z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg></button>
                            </div>
                        </x-cards>
                    @endif
                @endforeach
            </div>
            <div class="absolute w-full dark:bg-gray-800" style="bottom: 0">
                <div class="bg-white rounded-lg shadow-lg m-6 p-6 overflow-y-auto dark:bg-gray-700">
                    <h1 id="alert" class="text-red-600 text-center mb-2 font-semibold">You need at least 3 tools to build your custom package.</h1>
                    <div  class="flex justify-between gap-4 items-center flex-wrap dark:bg-gray-">
                        <div id="itemes" class="flex gap-4 dark:bg-gray-700">

                        </div>
                        <button id="cont" onclick="payyment_modal.showModal()" disabled class=" text-gray-600 bg-gray-200 hover:bg-gray-300 transition-all px-4 py-2 rounded-lg shadow-lg ">Continue</button>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <dialog id="payyment_modal" class="modal ">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">✕</button>
            </form>
            <div class=" flex md:justify-start gap-4 md:items-center flex-col sm:flex-row flex-wrap mt-12">
                <div class="flex justify-between items-center gap-4 w-full flex-wrap">
                    <select id="plans" class="grow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                         <option selected value="1m" >1 Month</option>
                         <option value="2m">2 Months</option>
                        <option value="3m">3 Months</option>
                        <option value="6m">6 Months</option>
                        <option value="12m">12 Months</option>
                    </select>
                    <div>
                        <h1 class="text-left grow font-bold text-lg text-gray-600 w-fit">Total : <span id="price" class="inline text-2xl">0</span></h1>
                    </div>
                </div>
            </div>
            <hr class="mt-6">
            <div class="mt-6 w-full">
                <h1 class="text-center text-lg font-semibold">Pay With :</h1>
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-indigo-700 hover:text-indigo-800 dark:text-indigo-600 dark:hover:text-indigo-700 border-indigo-600 dark:border-indigo-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">PayPal</button>
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
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
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
        </div>
    </dialog>


    <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=USD&components=buttons,funding-eligibility&enable-funding=card"></script>

    <script>
        let products;
        document.addEventListener("DOMContentLoaded",()=>{
            products = JSON.parse(localStorage?.getItem("Products")) ?? []
            for(let id of products){
                const item =document.getElementById(id)
                if(item){
                    item.disabled = true
                    item.className="add_btn transition-all bg-gray-300 hover:bg-gray-400 p-4 rounded-full w-10 h-10  flex justify-center items-center cursor-not-allowed"
                    item.innerHTML=`<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 417.813 417" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M159.988 318.582c-3.988 4.012-9.43 6.25-15.082 6.25s-11.094-2.238-15.082-6.25L9.375 198.113c-12.5-12.5-12.5-32.77 0-45.246l15.082-15.086c12.504-12.5 32.75-12.5 45.25 0l75.2 75.203L348.104 9.781c12.504-12.5 32.77-12.5 45.25 0l15.082 15.086c12.5 12.5 12.5 32.766 0 45.246zm0 0" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>`
                }
            }
            add_Product_UI(true,"")
            Price()

        })
        function Addfct(id){
            const item =document.getElementById(id)
            if(item){
                item.disabled = true
                item.className="disabled add_btn transition-all bg-gray-300 hover:bg-gray-400 p-4 rounded-full w-10 h-10  flex justify-center items-center cursor-not-allowed"
                item.innerHTML=`<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 417.813 417" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M159.988 318.582c-3.988 4.012-9.43 6.25-15.082 6.25s-11.094-2.238-15.082-6.25L9.375 198.113c-12.5-12.5-12.5-32.77 0-45.246l15.082-15.086c12.504-12.5 32.75-12.5 45.25 0l75.2 75.203L348.104 9.781c12.504-12.5 32.77-12.5 45.25 0l15.082 15.086c12.5 12.5 12.5 32.766 0 45.246zm0 0" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>`
                products.push(id)
                add_Product_UI(false,id)
                localStorage.setItem("Products",JSON.stringify(products))
            }
            check()

        }
        function add_Product_UI(h,j){
            let ele = document.getElementById("itemes")
            if(!h){
                const name = document.getElementById("Product_"+j)?.textContent
                ele.innerHTML += `<div class=" dark:bg-gray-800 Product_div_${j} p-4 bg-white rounded-lg shadow-lg relative">
                            <h2 class="text-2xl font-bold">${name}</h2>
                            <div onclick="Remove(${j})" class=" absolute top-0 right-0 w-4 h-4 cursor-pointer rounded-full bg-red-600 text-white flex items-center justify-center ">
                                <svg class="w-2 h-2" viewBox="0 0 320.591 320.591" fill="white" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"/>
                                    <path d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"/>
                                </svg>
                            </div>
                        </div>`
            }else{
                products.forEach((e)=>{
                        const name = document.getElementById("Product_"+e)?.textContent
                        ele.innerHTML += `<div  class="dark:bg-gray-800 Product_div_${e} p-4 bg-white rounded-lg shadow-lg relative">
                            <h2 class="text-2xl font-bold">${name}</h2>
                            <div onclick="Remove(${e})" class=" absolute top-0 right-0 w-4 h-4 cursor-pointer rounded-full bg-red-600 text-white flex items-center justify-center ">
                                <svg class="w-2 h-2" viewBox="0 0 320.591 320.591" fill="white" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"/>
                                    <path d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"/>
                                </svg>
                            </div>
                        </div>`
                    }
                )
            }
            check()

        }
        function Remove(id){
            products = products.filter((e)=>
                e != id
            )
            check()
            document.querySelector(".Product_div_"+id)?.remove()
            const item =document.getElementById(id)
            item.disabled = false
            item.className="add_btn transition-all bg-indigo-700 hover:bg-indigo-800 p-4 rounded-full w-10 h-10  flex justify-center items-center"
            item.innerHTML= `<svg  xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 401.994 401.994" style="font-size: 25px" xml:space="preserve" ><g><path d="M394 154.175c-5.331-5.33-11.806-7.994-19.417-7.994H255.811V27.406c0-7.611-2.666-14.084-7.994-19.414C242.488 2.666 236.02 0 228.398 0h-54.812c-7.612 0-14.084 2.663-19.414 7.993-5.33 5.33-7.994 11.803-7.994 19.414v118.775H27.407c-7.611 0-14.084 2.664-19.414 7.994S0 165.973 0 173.589v54.819c0 7.618 2.662 14.086 7.992 19.411 5.33 5.332 11.803 7.994 19.414 7.994h118.771V374.59c0 7.611 2.664 14.089 7.994 19.417 5.33 5.325 11.802 7.987 19.414 7.987h54.816c7.617 0 14.086-2.662 19.417-7.987 5.332-5.331 7.994-11.806 7.994-19.417V255.813h118.77c7.618 0 14.089-2.662 19.417-7.994 5.329-5.325 7.994-11.793 7.994-19.411v-54.819c-.002-7.616-2.661-14.087-7.993-19.414z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>`
            localStorage.setItem("Products",JSON.stringify(products))
        }
        function check(){
            if(products.length>=3){
                const btn = document.getElementById("cont")
                btn.disabled =false
                btn.className="bg-indigo-700 hover:bg-indigo-800 transition-all px-4 py-2 rounded-lg shadow-lg text-white"
                document.getElementById("alert").style.display="none"
            }else{
                const btn = document.getElementById("cont")
                btn.disabled =true
                btn.className="text-gray-600 bg-gray-200 hover:bg-gray-300 transition-all px-4 py-2 rounded-lg shadow-lg "
                document.getElementById("alert").style.display="block"
            }
        }
        function Price(Duration ="1m"){
            if(products && products.length>=3) {
                axios.post("/CustomPrices", {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    Products: products,
                    Duration
                }).then((e) => {
                    const data = e.data
                    const price = document.getElementById("price")
                    price.innerText = data.after
                    console.log(data)
                })
            }
        }
        document.addEventListener("change",()=>{
            const plans = document.getElementById("plans").value
            Price(plans)
        })
    </script>

    <script>
        let duration = document.getElementById('plans').options[document.getElementById('plans').selectedIndex].getAttribute('data-id');
        const paypalContainer = document.getElementById('paypal-button-container');

        document.getElementById('plans').addEventListener('change', function () {
            duration = document.getElementById("plans").value
            renderPayPalButton()
            document.getElementById("buttons-container").classList.add('dark:bg-gray-800')
        });

        async function showHideCancel() {
            payyment_modal.close()
            document.getElementById("conttt").className=" flex lg:mx-20 mx-6 mb-6  flex-col gap-4"
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
            document.getElementById("conttt").className=" flex lg:mx-20 mx-6 mb-6  flex-col gap-4"
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
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return fetch("{{ route('paypal.api.create') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            product_Pack: products,
                            product_type:"Custom_pack",
                            duration : duration ?? "1m"
                        })
                    })
                        .then(res => res.json())
                        .then(data => {
                            return data.id
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
                            duration : duration ?? "1m",
                            product_type:"Custom_pack",
                            product_pack: products,

                        })
                    }).then(async (e)=>{
                        localStorage.removeItem("Products")
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
@endsection

