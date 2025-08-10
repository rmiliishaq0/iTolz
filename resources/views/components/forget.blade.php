<div class="w-1/3  bg-white border border-gray-200 rounded-lg shadow-sm  dark:bg-gray-800 dark:border-gray-700 max-xl:w-1/2 max-md:w-full max-md:mx-6">
    <div class="bg-gray-100 w-full mb-4 p-4 dark:bg-gray-800">
        <h5 class="text-base font-medium text-gray-900 dark:text-white text-center">Forgot your password? Enter your email, and we’ll send you a reset link.</h5>
    </div>
    <form class="space-y-6 sm:px-6 md:px-6 mb-6 " method="POST" action="{{ route('password.email') }}">
        @if ($errors->any())
             @foreach($errors->all() as $error)
                 <div id="err" class="err p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-600 dark:text-red-400" role="alert">
                     <span class="font-medium">{{$error}}</span>
                 </div>
             @endforeach
        @endif
            @if (session('status') == 'We have emailed your password reset link.')
                <div class="p-4  text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-600 dark:text-green-400" role="alert">
                    <span class="font-medium">{{session('status')}}</span>
                </div>
            @endif
        @csrf
        <div>
            <label id="lemail" for="email" class="@error("email") text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">Your email</label>
            <input oninput="change()" type="email" name="email" id="email" class="@error("email") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" placeholder="name@company.com" required autofocus autocomplete="username" value="{{old('email')}}" />
        </div>
        <div>
            {!! NoCaptcha::display() !!}
        </div>
            @if ($errors->has('rate_limit'))
                <button type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-600 disabled:bg-gray-400 disabled:text-gray-400 disabled:shadow-none dark:disabled:border-gray-600 dark:disabled:bg-gray-600" disabled="true">Send Reset Link</button>
            @else
                <button type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Send Reset Link</button>
            @endif
    </form>
</div>
</div>

<script>
    function change(){
        document.getElementById("btnem").disabled=false
        document.getElementById("err").style.display="none"
        document.getElementById("email").className = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
        document.getElementById("lemail").className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white"
    }
</script>


