@extends("main.head")

@section("root")
    <x-nav></x-nav>
<div style="margin-top: 100px" class="hidden justify-center flex-col items-center m-4 " id="alert">
       <div role="alert" class="alert alert-error w-4/5 transition delay-100 duration-500 ease-in-out opacity-100" id="err">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>Oops! The extension isn't installed. Please install it or enable it if disabled. Need help? Check the guide above.</span>
</div>
<div class="flex justify-center flex-col items-center m-4 transition delay-100 duration-500">
    <h1 class="font-sans mt-7 text-center text-3xl font-semibold transition delay-100 duration-500">Download the Extension Here.</h1>
    <a href="/download" class="btn btn-primary bg-indigo-700 text-white hover:bg-indigo-800 px-12 mt-6"><svg class="w-6 h-6" id="fi_7268609" enable-background="new 0 0 515.283 515.283" viewBox="0 0 515.283 515.283" xmlns="http://www.w3.org/2000/svg"><g><g><g><g><path d="m400.775 515.283h-286.268c-30.584 0-59.339-11.911-80.968-33.54-21.628-21.626-33.539-50.382-33.539-80.968v-28.628c0-15.811 12.816-28.628 28.627-28.628s28.627 12.817 28.627 28.628v28.628c0 15.293 5.956 29.67 16.768 40.483 10.815 10.814 25.192 16.771 40.485 16.771h286.268c15.292 0 29.669-5.957 40.483-16.771 10.814-10.815 16.771-25.192 16.771-40.483v-28.628c0-15.811 12.816-28.628 28.626-28.628s28.628 12.817 28.628 28.628v28.628c0 30.584-11.911 59.338-33.54 80.968-21.629 21.629-50.384 33.54-80.968 33.54zm-143.134-114.509c-3.96 0-7.73-.804-11.16-2.257-3.2-1.352-6.207-3.316-8.838-5.885-.001-.001-.001-.002-.002-.002-.019-.018-.038-.037-.057-.056-.005-.004-.011-.011-.016-.016-.016-.014-.03-.029-.045-.044-.01-.01-.019-.018-.029-.029-.01-.01-.023-.023-.032-.031-.02-.02-.042-.042-.062-.062l-114.508-114.509c-11.179-11.179-11.179-29.305 0-40.485 11.179-11.179 29.306-11.18 40.485 0l65.638 65.638v-274.409c-.001-15.811 12.815-28.627 28.626-28.627s28.628 12.816 28.628 28.627v274.408l65.637-65.637c11.178-11.179 29.307-11.179 40.485 0 11.179 11.179 11.179 29.306 0 40.485l-114.508 114.507c-.02.02-.042.042-.062.062-.011.01-.023.023-.032.031-.01.011-.019.019-.029.029-.014.016-.03.03-.044.044-.005.005-.012.012-.017.016-.018.019-.037.038-.056.056-.001 0-.001.001-.002.002-.315.307-.634.605-.96.895-2.397 2.138-5.067 3.805-7.89 4.995-.01.004-.018.008-.028.012-.011.004-.02.01-.031.013-3.412 1.437-7.158 2.229-11.091 2.229z" fill="rgb(255, 255, 255)"></path></g></g></g></g></svg></a>
</div>
<div class="flex justify-center flex-col items-center m-4 mt-12">
    <h1 class="font-sans text-center text-2xl font-semibold">How to Install the Extension</h1>
        <div class="mb-1 border-b border-gray-200 dark:border-gray-700 mt-6">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist" data-tabs-active-classes="border-b-2 rounded-t-lg text-indigo-700 hover:text-indigo-800 dark:text-indigo-500 dark:hover:text-indigo-500 border-indigo-700 dark:border-indigo-500">
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Google Chrome</button>
        </li>
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Microsoft Edge</button>
        </li>
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Mozilla Firefox</button>
        </li>
        <li role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Opera</button>
        </li>
         <li role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="brave-tab" data-tabs-target="#brave" type="button" role="tab" aria-controls="brave" aria-selected="false">Brave</button>
        </li>
    </ul>
</div>
    <div id="default-tab-content">
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <video class="w-full" controls>
        <source src="/docs/videos/flowbite.mp4" type="video/mp4">
        </video>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
        <video class="w-full" controls>
        <source src="/docs/videos/flowbite.mp4" type="video/mp4">
        </video>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
        <video class="w-full" controls>
        <source src="/docs/videos/flowbite.mp4" type="video/mp4">
        </video>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
        <video class="w-full" controls>
        <source src="/docs/videos/flowbite.mp4" type="video/mp4">
        </video>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="brave" role="tabpanel" aria-labelledby="brave-tab">
        <video class="w-full" controls>
        <source src="/docs/videos/flowbite.mp4" type="video/mp4">
        </video>
    </div>
</div>


</div>
</div>

<div class="flex flex-col h-svh" id="full-cont">
       <div style="margin-top: 100px" class="mx-12 flex justify-center" >
           <div id ="info" role="alert" class="opacity-0 alert alert-info transition delay-100 duration-500 ease-in-out">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-6 w-6 shrink-0 stroke-current">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
               </svg>
               <span>If access fails, simply retry or reload the extension..</span>
           </div>
       </div>
    <div id="counterr" class="flex justify-center w-full flex-col items-center justify-self-center self-center h-full opacity-100 transition delay-100 duration-500 ease-in-out">
        <div class="opacity-100 transition delay-100 duration-500 ease-in-out" id="c2">
            <h1 id="counter" class="font-mono text-4xl font-semibold m-4">25</h1>
        </div>
        <div class="flex justify-center w-full opacity-100 transition delay-100 duration-500 ease-in-out" id="c1">
            <div class="w-4/5">
                 <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                    <div class="transition-discrete bg-indigo-700 text-xs font-medium text-white text-center p-0.5 leading-none rounded-full transition delay-50 duration-300 ease-in-out" style="width: 0%" id="prog"> 0%</div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div>
        <x-foter></x-foter>
        <script>
        window.addEventListener("load", function () {
            if (!window.hasSentCheckMessage) {
                window.hasSentCheckMessage = true;
                window.postMessage({ source: "itolz_extension", type: "check", message: "some_id" }, "*");
            }
        });

        window.addEventListener("message", (event) => {
            if (event.source !== window) return;
            document.getElementById("alert").className="flex justify-center flex-col items-center m-4 hidden"
            document.getElementById("full-cont").style.display="flex"

            if (event.data?.source === "itolz_extension" && event.data?.type === "done") {
            let v= setTimeout(()=>{
                document.getElementById("info").className=" alert alert-info transition delay-700 duration-300 ease-in-out opacity-100"
            },2000)
                let prog = 0
                let x= setInterval(()=>{
                let v = document.getElementById("counter").textContent
                document.getElementById("counter").innerHTML
                document.getElementById("counter").innerHTML--
                prog +=4
                document.getElementById("prog").innerHTML=`${prog}%`
                document.getElementById("prog").style.width=`${prog}%`
                if(prog ==100 ){
                    clearInterval(x)
                    window.postMessage({ source: "access_page", type: "red", message: {{$id}} },"*");
                    document.getElementById("counterr").className="flex justify-center w-full flex-col items-center justify-self-center self-center h-full opacity-0 transition delay-100 duration-500 ease-in-out"
                    window.location.href="{{ env('APP_URL') . '/dashboard' }}"

              }  },1200)

        }else if(!(event.data?.source === "itolz_extension" && event.data?.type === "done")){
            document.getElementById("full-cont").style.display="none"
            document.getElementById("alert").className="flex justify-center flex-col items-center m-4"
        }
        });

    </script>
@endsection
