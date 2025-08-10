

<div class="flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full w-full h-svh
">
    <div class="relative p-4 w-full max-w-md max-h-full shadow-lg rounded-lg dark:bg-gray-800">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg  dark:bg-gray-800 ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Verify It's You
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form method="POST" class="space-y-4" action="{{ route('password.confirm') }}">
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div id="err" class="err p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-600 dark:text-red-400" role="alert">
                                <span class="font-medium">{{$error}}</span>
                            </div>
                        @endforeach
                    @endif
                    @csrf
                    <div>
                        <label id="lpass" for="password" class="@error("password") text-red-600 block mb-2 text-sm font-medium @else block mb-2 text-sm font-medium text-gray-900 dark:text-white @enderror">Your Password</label>
                        <input oninput="change()" type="password" name="password" id="password" placeholder="••••••••" class="@error("password") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" required autocomplete="new-password" />
                    </div>
                    @if ($errors->has('rate_limit'))
                        <button type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-400 disabled:bg-gray-300 disabled:text-gray-700 disabled:shadow-none dark:disabled:border-gray-700 dark:disabled:bg-gray-800/20" disabled="true">Confirm</button>
                    @elseif ($errors->has('email') or $errors->has("name") or $errors->has("password"))
                        <button id="btnem" type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-400 disabled:bg-gray-300 disabled:text-gray-700 disabled:shadow-none dark:disabled:border-gray-700 dark:disabled:bg-gray-800/20" disabled="true">Confirm</button>
                    @else
                        <button type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Confirm</button>
                    @endif
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
        document.getElementById("password").className = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600" +
            "00 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
        document.getElementById("lpass").className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white"
    }
</script>
