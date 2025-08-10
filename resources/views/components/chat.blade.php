<div class="h-full">
    <div class=" max-h-[50%] overflow-auto  bg-white    dark:bg-gray-700 dark:divide-gray-600">
        <div class="p-4 mx-4 my-6 flex flex-col gap-4"  id="chat_container">
            @if(empty( (\App\Models\ChatSupport::Where("to",auth()->id())->where("sender",auth()->id())->get())->toArray()))
                <div id="nmessage" class="p-4 bg-zinc-50 rounded-lg shadow-md">
                    <h1 class="font-semibold">You don’t have any messages yet. Start chatting now!</h1>
                </div>
            @else
            @foreach(\App\Models\ChatSupport::Where("to",auth()->id())->where("sender",auth()->id())->get() as $message)
                @if($message->to == auth()->id())
            <div style="display: flex ;align-items:end " class="text-pretty chat chat-start mb-2 flex items-center">
                <div class="inline-flex  items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600" >
                    <span class="font-medium text-gray-600 dark:text-gray-300" >S</span>
                </div>
                <div class="chat-bubble  text-wrap">{{$message->message}}</div>
            </div>
                @elseif($message->sender == auth()->id())
                <div style="display: flex ;align-items:end;justify-content: end" class="chat chat-end mt-2 text-pretty ">
                    <div class="chat-bubble text-pretty">{{$message->message}}</div>
                    <div class="inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600" >
                        <span class="font-medium text-gray-600 dark:text-gray-300" >{{substr(\App\Models\User::find(auth()->id())->name,0,1)}}</span>
                    </div>
                </div>
                @endif
            @endforeach
            @endif
        </div>
    </div>



    <form id="form">
        <label for="chat" class="sr-only">Your message</label>
        <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700">
            <textarea required minlength="5" maxlength="100" id="chat_area" rows="1" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your message..."></textarea>
            <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                </svg>
                <span class="sr-only">Send message</span>
            </button>
        </div>
    </form>
</div>
<script src="{{asset("build/assets/app.js")}}"></script>
<script>
    document.getElementById("form").addEventListener("submit",(e)=>{
        document.getElementById("nmessage").style.display="none"
        e.preventDefault(false)
        if (document.getElementById("chat_area").value.trim() !== "") {
        axios.post("/send",{
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Socket-ID' :Echo.socketId(),
            },
            message: document.getElementById("chat_area").value

        }).then((e)=>{
            const input = document.getElementById("chat_area").value;
            const chatContainer = document.getElementById("chat_container");

            if (input.trim() !== "") {
                const wrapper = document.createElement("div");
                wrapper.className = "chat chat-end mt-2 text-pretty";
                wrapper.style = "display: flex; align-items: end; justify-content: end;";

                const bubble = document.createElement("div");
                bubble.className = "chat-bubble";
                bubble.textContent = input;

                const avatar = document.createElement("div");
                avatar.className = "inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600";

                const span = document.createElement("span");
                span.className = "font-medium text-gray-600 dark:text-gray-300";
                span.textContent = "{{ substr(\App\Models\User::find(auth()->id())->name, 0, 1) }}";

                avatar.appendChild(span);
                wrapper.appendChild(bubble);
                wrapper.appendChild(avatar);

                chatContainer.appendChild(wrapper);
            }
            document.getElementById("chat_area").value = ""
        })
    }})
    Echo.private(`chat.{{auth()->id()}}`)
        .listen('.chat.support', (e) => {
            const message = Object(e)
            console.log(message)
            if(message.user){
                document.getElementById("n_count").className ="bg-red-600 h-4 w-4  rounded-full flex justify-center items-center text-white text-sm z-50 top-[-3px] absolute left-2.5 border-[2px] box-content border-white"
                const chatContainer = document.getElementById("chat_container");
                const count = document.getElementById("n_count")?.textContent == null ? 0 : document.getElementById("n_count").textContent
                document.getElementById("n_count").textContent = parseInt(count) + 1

                const wrapper = document.createElement("div");
                wrapper.className = "text-pretty chat chat-start mb-2 flex items-center";
                wrapper.style = "display: flex; align-items: end;";

                const bubble = document.createElement("div");
                bubble.className = "chat-bubble  text-wrap";
                bubble.textContent = e.message;

                const avatar = document.createElement("div");
                avatar.className = "inline-flex  items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600";

                const span = document.createElement("span");
                span.className = "font-medium text-gray-600 dark:text-gray-300";
                span.textContent = "S";

                avatar.appendChild(span);
                wrapper.appendChild(avatar);
                wrapper.appendChild(bubble);

                chatContainer.appendChild(wrapper);
            }
        });

    document.getElementById("chat_button").addEventListener("click",()=>{
        document.getElementById("n_count").className ="hidden"
        axios.post("/update_read",{
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Socket-ID' :Echo.socketId(),
            },
            id: {{Auth()->id()}}
        })
    })



</script>
