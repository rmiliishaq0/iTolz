<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <title>Admin Page</title>
</head>
<body>
  <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                <div class="w-full">
                    <div class="flex justify-center">
                        <div class="w-full max-w-sm bg-white   rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex justify-end px-4 pt-4">
                            </div>

                        </div>
                    </div>
                    <div class="w-full flex justify-center h-fit">
                        <form method="POST" class="max-lg:w-full w-1/2" action="{{route("admin_user_post",$id)  }}">
                            @if (session('success'))
                                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                                    <span class="font-medium">{{session("success")}}</span>
                                </div>
                            @endif

                            @csrf
                            <div class="my-4">
                                <input oninput="change()" type="text" name="name" id="name" class="@error("name") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" value="{{App\Models\User::find($id)->name}}" />
                            </div>
                            <div class="my-4">
                                <input oninput="change()" type="email" name="email" id="email" class="@error("email") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" value="{{App\Models\User::find($id)->email}}" />
                            </div>
                            <div class="my-4">
                                <input oninput="change()" type="text" name="Emial_verify" id="Emial_verify" class="@error("Emial_verify") bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" value="{{App\Models\User::find($id)->email_verified_at	}}"/>
                            </div>
                            <div class="my-4">
                                <input oninput="change()" type="text" name="isAdmin	" id="isAdmin" class="@error("isAdmin") mb-4 bottom-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:border-red-500 border-red-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 m-0 text-red-600 @else mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @enderror" value="{{App\Models\User::find($id)->isAdmin	}}"/>
                            </div>
                        </form>
                    </div>


                </div>

</body>
</html>
