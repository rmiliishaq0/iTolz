

<div class="flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full w-full h-svh
">
    <div class="relative p-4 w-full max-w-md max-h-full shadow-lg rounded-lg">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg  dark:bg-gray-700 ">
            <!-- Modal header -->
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form method="POST" class="space-y-4" action="{{ route('password.update') }}}">
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div id="err" class="err p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                <span class="font-medium">{{$error}}</span>
                            </div>
                        @endforeach
                    @endif
                    @csrf

                    <div>
                        <input type="hidden" name="token" value="{{ $slot }}">
                        <label id="lpass" for="password" class="@error("password") text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">New Password</label>
                        <input oninput="change()" type="password" name="password" id="password" placeholder="••••••••" class="@error("password") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" required autocomplete="new-password" />
                    </div>
                    <div>
                            <label id="lcpass" for="Confirm Password" class="@error("password") text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">Confirm Password</label>
                            <input oninput="change()" type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="@error("password") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" required autocomplete="new-password"/>
                    </div>
                    @if ($errors->has('rate_limit'))
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-400 disabled:bg-gray-300 disabled:text-gray-700 disabled:shadow-none dark:disabled:border-gray-700 dark:disabled:bg-gray-800/20" disabled="true">Reset Password</button>
                    @elseif ($errors->has('password') or $errors->has("password_confirmation"))
                        <button id="btnem" type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-400 disabled:bg-gray-300 disabled:text-gray-700 disabled:shadow-none dark:disabled:border-gray-700 dark:disabled:bg-gray-800/20" disabled="true">Reset Password</button>
                    @else
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Reset Password</button>
                    @endif
                </form>
            </div>

        </div>
    </div>
</div>

{{dd($slotcon)}}
<script>
    function change(){
        document.getElementById("btnem").disabled=false
        for(let ele of document.getElementsByClassName("err")){
            ele.style.display="none"
        }
        document.getElementById("password").className = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
        document.getElementById("lpass").className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        document.getElementById("lcpass").className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        document.getElementById("password_confirmation").className = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
    }
</script>
