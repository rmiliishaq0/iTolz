
<!-- Main modal -->
<div class="flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full rounded-lg shadow-lg dark:shadow-none">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg  dark:bg-gray-700 ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Join iTolz & Unlock Premium Deals!
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form method="POST" class="space-y-4" action="{{ route('register') }}">
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                           <div id="err" class="err p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-600 dark:text-red-400" role="alert">
                               <span class="font-medium">{{$error}}</span>
                            </div>
                        @endforeach
                    @endif
                    @csrf
                    <div>
                        <label id="lname" for="name" class="@error("name") text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">Your Name</label>
                         <input oninput="change()" type="text" name="name" id="name" class="@error("name") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" placeholder="Your Name" required autofocus autocomplete="name" value="{{old('name')}}" />
                    </div>
                    <div>
                        <label id="lemail" for="email" class="@error("email") text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">Your Email</label>
                        <input oninput="change()" type="email" name="email" id="email" class="@error("email") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blu-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" placeholder="name@company.com" required autofocus autocomplete="username" value="{{old('email')}}" />
                    </div>
                    <div>
                        <label id="lpass" for="password" class="@error("password") text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">Your Password</label>
                        <input oninput="change()" type="password" name="password_confirmation" id="password" placeholder="••••••••" class="@error("password") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" required autocomplete="new-password" />
                    </div>
                    <div>
                        <label id="lcpass" for="password_confirmation" class="@error("password") text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">Confirm Password</label>
                        <input oninput="change()" type="password" name="password" id="password_confirmation" placeholder="••••••••" class="@error("password") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring--500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" required autocomplete="new-password" />
                    </div>

                    <div>
                        {!! NoCaptcha::display() !!}
                    </div>
                    @if ($errors->has('rate_limit'))
                        <button type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-400 disabled:bg-gray-300 disabled:text-gray-700 disabled:shadow-none dark:disabled:border-gray-700 dark:disabled:bg-gray-800/20" disabled="true">Register</button>
                    @elseif ($errors->has('email') or $errors->has("name") or $errors->has("password"))
                        <button id="btnem" type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-400 disabled:bg-gray-300 disabled:text-gray-700 disabled:shadow-none dark:disabled:border-gray-700 dark:disabled:bg-gray-800/20" disabled="true">Register</button>
                    @else
                        <button type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Register</button>
                    @endif
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">

                        <a href="{{ route('login') }}" class="text-indigo-700 hover:underline dark:text-indigo-500">Already registered?</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    function change(){
        document.getElementById("btnem").disabled=false
        for(let ele of document.getElementsByClassName("err")){
            ele.style.display="none"
        }
        document.getElementById("email").className = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
        document.getElementById("password").className = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
        document.getElementById("lemail").className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        document.getElementById("lpass").className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        document.getElementById("lcpass").className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        document.getElementById("password_confirmation").className = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
    }
</script>
