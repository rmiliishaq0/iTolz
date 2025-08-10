<div class="flex flex-col items-center pb-10" style="margin-top: 60px;" >
    <div class="cursor-pointer relative inline-flex items-center justify-center w-20 h-20 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600" type="button" >
        <span class="font-bold text-xl text-gray-600 dark:text-gray-300" >{{substr(\App\Models\User::find(auth()->id())->name,0,1)}}</span>
    </div>
    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{auth()->user()->name}}</h5>
    <span class="text-sm text-gray-500 dark:text-gray-400">{{auth()->user()->email}}</span>
</div>
<div id="accordion-collapse" data-accordion="collapse" class="md:mx-12 mx-4 h-full">
     <h2 id="accordion-collapse-heading-1">
            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                <span>Personal Info</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                <div class="w-full">
                    <div class="flex justify-center">
                        <div class="w-full max-w-sm bg-white   rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex justify-end px-4 pt-4">
                            </div>

                        </div>
                    </div>
                    <div class="w-full flex justify-center h-fit">
                        <form method="POST" class="max-lg:w-full w-1/2" action="/settings">
                            @if (session('success'))
                                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                                    <span class="font-medium">{{session("success")}}</span>
                                </div>
                            @endif

                            @csrf
                            <div>
                                <label id="lname" for="name" class="@error("name") text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">Your Name</label>
                                <input oninput="change()" type="text" name="name" id="name" class="@error("name") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" placeholder="Your Name"  autofocus autocomplete="name" value="{{Auth()->user()->name}}" />
                            </div>
                            <div>
                                <label id="lemail" for="email" class="@error("email") text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">Your Email</label>
                                <input oninput="change()" type="email" name="email" id="email" class="@error("email") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" placeholder="name@company.com"  autofocus autocomplete="username" value="{{Auth()->user()->email}}" />
                            </div>
                            <div>
                                <label id="lpass" for="password" class="@error("password") text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">New Password</label>
                                <input oninput="change()" type="password" name="password_confirmation" id="password" placeholder="••••••••" class="@error("password") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror"  autocomplete="new-password" />
                            </div>
                            <div>
                                <label id="lcpass" for="password_confirmation" class="@error("password") text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">Confirm Password</label>
                                <input oninput="change()" type="password" name="password" id="password_confirmation" placeholder="••••••••" class="@error("password") mb-4 bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror"  autocomplete="new-password" />
                            </div>
                            @if ($errors->has('rate_limit'))
                                <button type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-400 disabled:bg-gray-300 disabled:text-gray-700 disabled:shadow-none dark:disabled:border-gray-700 dark:disabled:bg-gray-800/20" disabled="true">Update</button>
                            @elseif ($errors->has('email') or $errors->has("name") or $errors->has("password"))
                                <button id="btnem" type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-400 disabled:bg-gray-300 disabled:text-gray-700 disabled:shadow-none dark:disabled:border-gray-700 dark:disabled:bg-gray-800/20" disabled="true">Update</button>
                            @else
                                <div class="">
                                    <button type="submit" class="w-full  text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Update</button>
                                </div>

                            @endif
                        </form>
                    </div>


                </div>
            </div>
        </div>
        <h2 id="accordion-collapse-heading-3">
            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-3" aria-expanded="false" aria-controls="accordion-collapse-body-3">
                <span>Security</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-3" class="hidden" aria-labelledby="accordion-collapse-heading-3">
            <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700" id="scrt">
                @if ($errors->hasBag('confirmTwoFactorAuthentication'))
                    <div id="err" class="p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        <span class="font-medium">{{ $errors->getBag('confirmTwoFactorAuthentication')->first() }}
                    </div>
                @endif
            @if (session('status') == 'two-factor-authentication-confirmed')
                    <div id="pop" class="hidden p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 m-4" role="alert">
                        <span class="font-medium">Two factor authentication</span>confirmed and enabled successfully.
                    </div>
                @endif
                <div id="pop" class="hidden p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 m-4" role="alert">
                    <span class="font-medium">2fa Activated</span> Please finish configuring two factor authentication below.
                </div>
                <label class="flex items-center cursor-pointer  m-6">
                    <input type="checkbox" value="" class="sr-only peer" id="fa" onchange="fa()" @if(!is_null(auth()->user()->two_factor_secret)) checked @else @endif>
                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600 dark:peer-checked:bg-indigo-600"></div>
                    <span id="enable" class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300 text-xl">Enable 2fa</span>
                </label>
                <div class="hidden hidden w-full flex justify-center flex-column" id="qr" @if(!is_null(auth()->user()->two_factor_confirmed_at)) style="display: none" @endif>
                    <div class="bg-gray-100 w-fit p-4 rounded-md">
                <h5 class="m-4 font-medium text-gray-900 dark:text-white text-center text-base">To enable Two-Factor Authentication (2FA), please scan the QR code using an authenticator app.</h5>
                <div class="flex justify-center items-center" id="svg">
                    </div>
                    <form class="flex items-center max-w-lg mx-auto mt-4" method="POST" action="/user/confirmed-two-factor-authentication">
                        @csrf
                        <div class="relative w-full">
                            <input name="code" type="text" id="voice-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" placeholder="Enter the 6-digit code from your Authenticator app" required />
                        </div>
                        <button type="submit" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-indigo-700 rounded-lg border border-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">confirm</button>
                    </form>
                </div>
            </div>
             <div class="w-full" @if(is_null(auth()->user()->two_factor_confirmed_at)) style="display: none" @endif>
                 <h5 class="m-4 font-medium text-gray-900 dark:text-white text-center text-base">Recovery Codes</h5>
                 <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:grid-cols-2" id="recovry-code">
                 </div>
             </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded",()=>{
            if(document.getElementById("fa").checked){
                fa()
            }
        })
        function fa(){
            document.getElementById("enable").innerHTML="Disable 2fa"
            fetch("/user/two-factor-authentication", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
            })
                .then(()=>{
                    fetch("/user/two-factor-qr-code", {
                        method: "GET",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            document.getElementById("qr").className = "w-full flex justify-center flex-column"
                            let svg= data.svg
                            document.getElementById("svg").innerHTML =svg
                        })
                        .catch((error) => console.error(error));
                    fetch("/user/two-factor-recovery-codes", {
                        method: "GET",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            for(let ele of data){
                                document.getElementById("recovry-code").innerHTML+=`<x-codes value=${ele}  spec=${ele[5]}></x-codes>`
                            }
                       })
                        .catch((error) => console.error(error));
                })
                .catch((error) => console.error(error));
        }
            document.getElementById("fa").addEventListener("change",(e)=>{
                if(e.target.checked == false){
                    document.getElementById("enable").innerHTML="Enable 2fa"
                    fetch("/user/two-factor-authentication", {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                    })
                        .then((response) => {
                            window.location.reload()
                        })
                }else {
                    fa()
                }
            })


    document.addEventListener("click", function (event) {
        if (event.target.closest("[data-copy-to-clipboard-target]")) {
            const button = event.target.closest("[data-copy-to-clipboard-target]");
            const targetId = button.getAttribute("data-copy-to-clipboard-target");
            const input = document.getElementById(targetId);

            if (input) {
                navigator.clipboard.writeText(input.value).then(() => {
                    const defaultMessage = button.querySelector("#default-message");
                    const successMessage = button.querySelector("#success-message");

                    if (defaultMessage && successMessage) {
                        defaultMessage.classList.add("hidden");
                        successMessage.classList.remove("hidden");

                        setTimeout(() => {
                            successMessage.classList.add("hidden");
                            defaultMessage.classList.remove("hidden");
                        }, 1500);
                    }
                });
            }
        }
    });




    </script>
