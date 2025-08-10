<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <title>Admin Page</title>
</head>
<body>
<div class="mx-12 my-4 h-screen  flex justify-center items-center flex-col" >
    <div class="mx-12 my-6 w-1/2" id="chat-container">
        @foreach(\App\Models\ChatSupport::all() as $message)
            @if($message->sender == $id)
                <div class="chat chat-start">
                    <div class="chat-bubble">{{$message->message}}</div>
                </div>
            @elseif($message->to == $id)
                <div class="chat chat-end">
                    <div class="chat-bubble">{{$message->message}}</div>
                </div>
            @endif
        @endforeach
    </div>

        <form class="">
            <label for="chat" class="sr-only">Your message</label>
            <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700">
                <textarea id="chat" rows="1" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your message..."></textarea>
                <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                    </svg>
                    <span class="sr-only">Send message</span>
                </button>
            </div>
        </form>

</div>
</body>
<script src="{{asset("build/assets/app.js")}}"></script>

<script>
    Echo.private(`chat.{{$id}}`)
        .listen('.chat.support', (e) => {
            const message = Object(e)
            document.getElementById("chat-container").innerHTML+= `<div class="chat chat-start">
                    <div class="chat-bubble">${message.message}</div>
                </div>`
        });
    document.addEventListener("submit",(e)=>{
        e.preventDefault(false)
        const textArea = document.getElementById("chat").value

        if (Echo.socketId()) {
            axios.post("/send",
                {
                    message: textArea,
                    to: {{$id}}
                },
                {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Socket-ID': Echo.socketId()
                    }
                }
            ).then(r => {
                document.getElementById("chat-container").innerHTML += `
            <div class="chat chat-end">
                <div class="chat-bubble">${textArea}</div>
            </div>`;
            });
        }

    })
</script>
</html>
