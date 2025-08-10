@extends("main.head")

@section("root")
    <div>
        <div>
            <p id="counter">20</p>
        </div>
        <div class="flex justify-center flex-col" style="display: flex;justify-content: center">
            <div class="w-1/2">
                 <div class="flex justify-between mb-1">
                <span class="text-base font-medium text-blue-700 dark:text-white"></span>
                <span class="text-sm font-medium text-blue-700 dark:text-white">45%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
                </div>
            </div>
        </div>
    </div>
<script>
        setInterval(()=>{
            let v = document.getElementById("counter").textContent
            document.getElementById("counter").innerHTML
            document.getElementById("counter").innerHTML--
        },1000)
        window.addEventListener("load", function () {
            window.postMessage(
                { source: "access_page", type: "check", message: {{$id}}},"*");})
        window.addEventListener("message", (event) => {
            if (event.source !== window) return;
            if (event.data?.source === "access_page" && event.data?.type === "check") {

            }
});
    </script>
@endsection
