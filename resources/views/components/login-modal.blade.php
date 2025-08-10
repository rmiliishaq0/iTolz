
<!-- Main modal -->
<div class="flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full shadow-lg rounded-lg dark:shadow-none">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg  dark:bg-gray-700 ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Welcome Back to iTolz
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form method="POST" class="space-y-4" action="{{ route('login') }}">
                    @if ($errors->has('email'))
                        <div id="err" class="p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-600 dark:text-red-400" role="alert">
                            <span class="font-medium">Email</span> Or<span class="font-medium"> Password</span> is incorrect
                        </div>
                    @endif
                    @if ($errors->has('rate_limit'))
                            <div id="err" class="p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-600 dark:text-red-400" role="alert">
                                <span class="font-medium">{{ $errors->first('rate_limit') }}</span>
                            </div>
                     @endif
                        @error('g-recaptcha-response')
                        <div id="err" class="p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-600 dark:text-red-400" role="alert">
                            <span class="font-medium">CAPTCHA field is required.</span>
                        </div>
                        @enderror
                        @csrf
                    <div>
                        <label id="lemail" for="email" class="@error("email") dark:text-red-600 text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">Your email</label>
                        <input oninput="change()" type="email" name="email" id="email" class="@error("email") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-red-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" placeholder="name@company.com" required autofocus autocomplete="username" value="{{old('email')}}" />
                    </div>
                    <div>
                        <label id="lpass" for="password" class="@error("email") text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">Your password</label>
                        <input oninput="change()" type="password" name="password" id="password" placeholder="••••••••" class="@error("email") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" required />
                    </div>
                    <div>
                        {!! NoCaptcha::display() !!}
                    </div>
                    <div class="flex justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember_me" name="remember"  type="checkbox" class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-indigo-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"  autocomplete="current-password" />
                            </div>
                            <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-700 hover:underline dark:text-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                        @if ($errors->has('rate_limit'))
                            <button type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-600 disabled:bg-gray-400 disabled:text-gray-400 disabled:shadow-none dark:disabled:border-gray-600 dark:disabled:bg-gray-600" disabled="true">Login to your account</button>
                        @elseif ($errors->has('email'))
                            <button id="btnem" type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-600 disabled:bg-gray-400 disabled:text-gray-400 disabled:shadow-none dark:disabled:border-gray-600 dark:disabled:bg-gray-600" disabled="true">Login to your account</button>
                        @else
                            <button type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Login to your account </button>
                        @endif
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">

                        Not registered? <a href="{{ route('register') }}" class="text-indigo-700 hover:underline dark:text-indigo-500">Create account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function change(){
        document.getElementById("btnem").disabled=false
        document.getElementById("err").style.display="none"
        document.getElementById("email").className = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
        document.getElementById("password").className = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
        document.getElementById("lemail").className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        document.getElementById("lpass").className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white"
    }
</script>
