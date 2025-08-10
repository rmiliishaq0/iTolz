@extends("main.head")
@section("title") home Page @endsection
@section("description")@endsection
@section("root")
    <x-Nav></x-Nav>
    <div style="margin-top: 130px" class="h-full bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 mx-6 my-10" id="features">
        <div class="mt-6 flex justify-center"><h1 class="dark:text-gray-600 font-sans text-lg font-semibold bg-gray-100 rounded-full h-fit p-2 w-fit px-4">
                Itolz - Contact
            </h1></div>
        <div class="sh overflow-y-auto overflow-x-hidden flex z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full shadow-lg my-12 rounded-lg">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->

                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form method="POST" class="space-y-4" action="{{route("contact_post")}}">
                            @if ($errors->any())
                                @foreach($errors->all() as $error)
                                    <div id="err" class="err p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                        <span class="font-medium">{{$error}}</span>
                                    </div>
                                @endforeach
                            @endif
                                @if (session('success'))
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                                        <span class="font-medium">{{session("success")}}</span>
                                    </div>
                                @endif
                            @csrf
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                <input onchange="change()" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com"  value="{{\App\Models\User::find(Auth()->id())->value("email")}}" required/>
                            </div>
                            <label for="phone-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Whatsapp Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                        <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                                    </svg>
                                </div>
                                <input onchange="change()" name="phone" type="text" id="phone-input" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" minlength="7" maxlength="14" placeholder="123-456-7890"  />
                            </div>
                            <div>
                                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
                                <textarea onchange="change()" minlength="10" maxlength="255" name="message" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" placeholder="Write your thoughts here..." required></textarea>
                            </div>
                                @if ($errors->any())
                                    <button type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 focus:border-sky-500 focus:outline focus:outline-sky-500 disabled:border-gray-400 disabled:bg-gray-300 disabled:text-gray-700 disabled:shadow-none dark:disabled:border-gray-700 dark:disabled:bg-gray-800/20" disabled="true">Submit</button>
                                @else
                                    <button type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Submit </button>
                                @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <x-foter></x-foter>
    <script>
        function change(){
            document.getElementById("btnem").disabled=false
            document.getElementById("err").style.display="none"
        }
    </script>

@endsection

