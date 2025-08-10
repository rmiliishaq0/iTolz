<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <title>Admin Page</title>
</head>
<body>


<div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-12 my-6">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Id
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Emial_verify
                </th>
                <th scope="col" class="px-6 py-3">
                    isAdmin
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
             @foreach (App\Models\User::all() as $product)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <th  scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->id }}</th>
                <td class="px-6 py-4">{{ $product->name }}</td>
                <td class="px-6 py-4">{{ $product->email}}</td>
                <td class="px-6 py-4">{{ $product->email_verified_at ? "yes" : "no" }}</td>
                <td class="px-6 py-4">{{ $product->isAdmin ? "yes" : "no" }}</td>

                <td class="px-6 py-4">
                    <a href="{{ route("admin_user",$product->id) }}" class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline">Edit</a>
                </td>
                <td class="px-6 py-4">
                    <button onclick="clicked({{ $product->id }})" data-modal-target="default-modal" data-modal-toggle="default-modal" href="" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</button>
                </td>
                </tr>
            @endforeach
         </tbody>
    </table>
</div>
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class=" text-center text-xl font-semibold text-gray-900 dark:text-white">
                    Are You Sure want to delete it ?
                </h3>
            </div>
            <div class="flex justify-around items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="default-modal" type="button" id="delete" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Yes Delete</button>
                <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    let x=null
    function clicked(f){
        x=f
    }
    document.getElementById("delete").addEventListener("click",()=>{
        if(x!=null){
            window.location.href=`user/delete/${x}`
        }
    })
</script>
</html>
