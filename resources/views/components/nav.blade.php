

<?php
    if(auth()->check()) {
        $has_plan = true;
        $has_orders = false;
        $user_data = \App\Models\User::find(Auth()->id())->plans()->wherePivot('expire_at', '>', now())->pluck('product_id')->toArray();
        $user_order = \App\Models\Order::where("user_id",Auth()->id())->get()->toArray();

        $new_messages = \App\Models\ChatSupport::where('readAt', null)
            ->where('to', auth()->id())
            ->pluck('id')
            ->toArray();

        $admin_messages = \App\Models\ChatSupport::where('readAt', null)
            ->pluck('id')
            ->toArray();




        /*
        if (!empty($user_data)) {
            $has_plan = true;
        }
*/
        if (!empty($user_order)) {
            $has_orders = true;
        }

    }
?>
<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0  transition delay-150 duration-300 ease-in-out">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{asset("/ltolz.png")}}" class="w-[50px]" alt="iTolz Logo">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white font-mono">iTolz</span>
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            @if(auth()->check())
                @if(auth()->user()->isAdmin ==1 )
                    <div class="flex gap-4">
                        <div class="relative">
                            <span id="na_count" class="@if(!$admin_messages) hidden @endif bg-red-600 h-4 w-4  rounded-full flex justify-center items-center text-white text-sm z-50 top-[-3px] absolute left-2.5 border-[2px] box-content border-white">{{count($admin_messages)}}</span>
                            <a href="/admin/messages" id="chat_button" class="relative p-2 mx-4 cursor-pointer  flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                <img class=" object-center object-contain font-medium text-gray-600 dark:text-gray-300" src="{{asset("chat.svg")}}" alt="chat-icon">
                            </a>
                        </div>
                        <div class="flex cursor-pointer relative  items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start">
                            <span class="font-medium text-gray-600 dark:text-gray-300" >{{substr(\App\Models\User::find(auth()->id())->name,0,1)}}</span>
                        </div>
                    </div>
                @else
                <div class="flex gap-4">
                    <div class="relative">
                        <span id="n_count" class="@if(!$new_messages) hidden @endif bg-red-600 h-4 w-4  rounded-full flex justify-center items-center text-white text-sm z-50 top-[-3px] absolute left-2.5 border-[2px] box-content border-white">{{count($new_messages)}}</span>
                        <div id="chat_button" class="relative p-2 mx-4 cursor-pointer  flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600" type="button" data-dropdown-toggle="chat" data-dropdown-placement="bottom-start">
                            <img class=" object-center object-contain font-medium text-gray-600 dark:text-gray-300" src="{{asset("chat.svg")}}" alt="chat-icon">
                        </div>
                    </div>
                    <div class="flex cursor-pointer relative  items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start">
                        <span class="font-medium text-gray-600 dark:text-gray-300" >{{substr(\App\Models\User::find(auth()->id())->name,0,1)}}</span>
                    </div>
                </div>
            @endif

        @else
            <div>
            <a type="button" class="cursor-pointer text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800 transition delay-50 duration-300 ease-in-out" href="/login">Login</a>
            <a type="button" class="cursor-pointer blocktext-indigo-700 hover:text-white border border-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:border-indigo-500 dark:text-indigo-500 dark:hover:text-white dark:hover:bg-indigo-500 dark:focus:ring-indigo-800 bg-white transition delay-50 duration-300 ease-in-out" href="/register">Register</a>
            </div>
            @endif
            <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>
        @auth()
            <div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                    <div>{{\App\Models\User::find(auth()->id())->name}}</div>
                    <div class="font-medium truncate">{{\App\Models\User::find(auth()->id())->email}}</div>
                </div>

                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                    <li id="dash">
                        <a href="/dashboard" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                    </li>
                    <li>
                        <a href="/settings" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                    </li>
                    @if($has_orders)

                    <li>
                        <a href="/orders" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Orders</a>
                    </li>
                    @endif
                    @if($has_plan)
                    <li>
                        <a href="/active_plans" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Active Plans</a>
                    </li>
                    @endif
                </ul>
                <div class="py-1">
                    @method("POST")
                    <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                </div>
            </div>


        @endauth
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700" >
                <li>
                    <a onclick="change_stat('home')" id="home" href="/" class="block py-2 px-3 text-white bg-indigo-700 rounded-sm md:bg-transparent md:text-indigo-700 md:p-0 md:dark:text-indigo-500" aria-current="page">Home</a>
                </li>
                <li>
                    <a onclick="change_stat('feat')"  id="feat" href="/#features" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Features</a>
                </li>
                <li>
                    <a onclick="change_stat('faq-tab')" id="fa" href="/#faq" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Faq</a>
                </li>
                <li>
                    <a onclick="change_stat('pric')" id="pric" href="/#pricing" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Pricing</a>
                </li>
                <li>
                    <a onclick="change_stat('contact')" id="contact" href="/tools" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">All Tools</a>
                </li>
            </ul>
        </div>
    </div>

</nav>

<script src="{{asset("build/assets/app.js")}}"></script>
<script>
    @auth()
    @if(Auth()->user()->isAdmin == 1)
    @foreach(\App\Models\User::all() as $user)
    Echo.private(`chat.{{$user->id}}`)
        .listen('.chat.support', (e) => {
            document.getElementById("na_count").className="bg-red-600 h-4 w-4  rounded-full flex justify-center items-center text-white text-sm z-50 top-[-3px] absolute left-2.5 border-[2px] box-content border-white"
            const count = document.getElementById("na_count")?.textContent == null || undefined ? 0 : document.getElementById("na_count").textContent
            document.getElementById("na_count").textContent = parseInt(count) + 1
        });
    @endforeach
    @endif
    @endauth

</script>

<script>
    let url = document.URL
    if(url.includes("dashboard")){
        document.getElementById("dash").className+="hidden"
    }
        if(document.URL.includes("#about-tab")) {
            console.log("calloing from event")
            document.getElementById("feat").className = "block py-2 px-3 text-white bg-indigo-700 rounded-sm md:bg-transparent md:text-indigo-700 md:p-0 md:dark:text-indigo-500"
            document.getElementById("home").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("pric").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("fa").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
        }else if(document.URL.includes("#stats-tab")){
            document.getElementById("pric").className = "block py-2 px-3 text-white bg-indigo-700 rounded-sm md:bg-transparent md:text-indigo-700 md:p-0 md:dark:text-indigo-500"
            document.getElementById("home").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("feat").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("fa").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
        }else if(document.URL.includes("#faq-tab")){
            document.getElementById("fa").className = "block py-2 px-3 text-white bg-indigo-700 rounded-sm md:bg-transparent md:text-indigo-700 md:p-0 md:dark:text-indigo-500"
            document.getElementById("home").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("pric").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("feat").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
        }else if(document.URL.includes("/tools")){
            document.getElementById("contact").className = "block py-2 px-3 text-white bg-indigo-700 rounded-sm md:bg-transparent md:text-indigo-700 md:p-0 md:dark:text-indigo-500"
            document.getElementById("home").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("pric").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("fa").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("feat").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"

        }
    function change_stat(e){
        if(e == "feat") {
            document.getElementById("feat").className = "block py-2 px-3 text-white bg-indigo-700 rounded-sm md:bg-transparent md:text-indigo-700 md:p-0 md:dark:text-indigo-500"
            document.getElementById("home").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("pric").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("fa").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
        }else if(e=='pric'){
            document.getElementById("pric").className = "block py-2 px-3 text-white bg-indigo-700 rounded-sm md:bg-transparent md:text-indigo-700 md:p-0 md:dark:text-indigo-500"
            document.getElementById("home").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("feat").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("fa").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
        }else if(e=="faq-tab"){
            document.getElementById("fa").className = "block py-2 px-3 text-white bg-indigo-700 rounded-sm md:bg-transparent md:text-indigo-700 md:p-0 md:dark:text-indigo-500"
            document.getElementById("home").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("pric").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("feat").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
        }else if(e=="contact"){
            document.getElementById("contact").className = "block py-2 px-3 text-white bg-indigo-700 rounded-sm md:bg-transparent md:text-indigo-700 md:p-0 md:dark:text-indigo-500"
            document.getElementById("home").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("pric").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("fa").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
            document.getElementById("feat").className = "block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700 md:p-0 md:dark:hover:text-indigo-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"

        }
    }
</script>

