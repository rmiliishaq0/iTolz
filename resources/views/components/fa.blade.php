
<!-- Main modal -->
<div class="flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full shadow-lg opacity-100" id="first">
    <div class="relative p-4 w-full max-w-md max-h-full shadow-lg rounded-lg">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg  dark:bg-gray-700 ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Enter the authentication code to confirm access.</h3>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form method="POST" class="space-y-4" action="{{ route('two-factor.login') }}">
                    @if ($errors->has('code'))
                        <div id="err" class="p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <span class="font-medium">{{ $errors->first('code') }}
                        </div>
                    @endif
                        @if ($errors->has('rate_limit'))
                            <div id="err" class="p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                <span class="font-medium">{{ $errors->first('rate_limit') }}
                            </div>
                        @endif
                    @csrf
                    <div>
                        <label id="lcode" for="code" class="@error("code") text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">Using authenticator application</label>
                        <input name="code" oninput="change()" type="text" inputmode="numeric" id="code" class="@error("code") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" placeholder="Enter the 6-digit code from your Authenticator app" required x-ref="recovery_code" autocomplete="one-time-code"" />
                    </div>
                    @if ($errors->has('rate_limit'))
                        <button type="submit" class="w-full text-white bg-b-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-400 disabled:bg-gray-300 disabled:text-gray-700 disabled:shadow-none dark:disabled:border-gray-700 dark:disabled:bg-gray-800/20" disabled="true">Check</button>
                    @elseif ($errors->has('code'))
                        <button id="btnem" type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-400 disabled:bg-gray-300 disabled:text-gray-700 disabled:shadow-none dark:disabled:border-gray-700 dark:disabled:bg-gray-800/20" disabled="true">Check</button>
                    @else
                        <button type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Check</button>
                    @endif
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        Or Using <a onclick="toggl()" class="cursor-pointer text-indigo-700 hover:underline dark:text-indigo-500">Recovery Codes</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Main modal -->
<div class="flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full shadow-lg opacity-0 hidden opacity-0" id="second">
    <div class="relative p-4 w-full max-w-md max-h-full shadow-lg rounded-lg">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg  dark:bg-gray-700 ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Please enter one of your recovery codes to confirm access.</h3>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form method="POST" class="space-y-4" action="{{ route('two-factor.login') }}">
                    @csrf
                    @if ($errors->has('recovery_code'))
                        <div id="err" class="p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <span class="font-medium">{{ $errors->first('recovery_code') }}
                        </div>
                    @endif
                    @if ($errors->has('rate_limit'))
                        <div id="err" class="p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <span class="font-medium">{{ $errors->first('rate_limit') }}
                        </div>
                    @endif
                    <div>
                        <label id="lrecovery_code" for="Recovery Code" class="@error("recovery_code") text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">Using Recovery Code</label>
                        <input name="recovery_code" oninput="change()" type="text" id="recovery_code" class="@error("recovery_code") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" placeholder="Enter your code to confirm access." required autofocus x-ref="code" autocomplete="one-time-code" />
                    </div>
                    @if ($errors->has('rate_limit'))
                        <button type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-400 disabled:bg-gray-300 disabled:text-gray-700 disabled:shadow-none dark:disabled:border-gray-700 dark:disabled:bg-gray-800/20" disabled="true">Check</button>
                    @elseif ($errors->has('recovery_code'))
                        <button id="btnem" type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-400 disabled:bg-gray-300 disabled:text-gray-700 disabled:shadow-none dark:disabled:border-gray-700 dark:disabled:bg-gray-800/20" disabled="true">Check</button>
                    @else
                        <button type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Check</button>
                    @endif
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300" id="toggl">
                        Or Using <a id="toggl" onclick="toggl()" class="cursor-pointer text-indigo-700 hover:underline dark:text-indigo-500">Authenticator Application</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded",()=>{
        if(localStorage.getItem("health") != undefined ){
            if(localStorage.getItem("health") == "true"){
                document.getElementById("first").className = "flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full shadow-lg opacity-0 hidden transition delay-50 duration-300 ease-in-out"
                document.getElementById("second").className = "flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full shadow-lg opacity-100 transition delay-50 duration-300 ease-in-out"
            }else if(localStorage.getItem("health") == "false"){
                console.log("fg")
                document.getElementById("first").className = "flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full shadow-lg opacity-100  transition delay-50 duration-300 ease-in-out"
                document.getElementById("second").className = "flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full shadow-lg opacity-0 hidden transition delay-50 duration-300 ease-in-out"
            }
        }
    });

    function toggl(){
        if(localStorage.getItem("health") == undefined){
            document.getElementById("first").className = "flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full shadow-lg opacity-0 hidden transition delay-50 duration-300 ease-in-out"
            document.getElementById("second").className = "flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full shadow-lg opacity-100 transition delay-50 duration-300 ease-in-out"
            localStorage.setItem("health","true")
        }else if (localStorage.getItem("health") == "true"){
            document.getElementById("first").className = "flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full shadow-lg opacity-100 transition delay-50 duration-300 ease-in-out"
            document.getElementById("second").className = "flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full shadow-lg opacity-0 hidden transition delay-50 duration-300 ease-in-out"
            localStorage.setItem("health","false")
        }
        else if (localStorage.getItem("health") == "false"){
            document.getElementById("first").className = "flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full shadow-lg opacity-0 hidden transition delay-50 duration-300 ease-in-out"
            document.getElementById("second").className = "flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full shadow-lg opacity-100  transition delay-50 duration-300 ease-in-out"
            localStorage.setItem("health","true")
        }
    }
    function change(){
        document.getElementById("btnem").disabled=false
        document.getElementById("err").style.display="none"
        document.getElementById("code").className = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
        document.getElementById("lcode").className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        document.getElementById("recovery_code").className = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
        document.getElementById("lrecovery_code").className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white"


    }
</script>
