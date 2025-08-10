<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <title>Admin Page</title>
</head>
<body>
    <div class="mx-12 my-4">
        <ul class="list bg-base-100 rounded-box shadow-md">
            @foreach($users as $user)
                <li class="list-row">
                    <div id="User_Id_{{$user->id}}" class="text-4xl font-thin opacity-30 tabular-nums">{{$user->id}}</div>
                    <div class="list-col-grow" id="User_Container">
                        <div>{{$user->name}}</div>
                        <div class="text-xs uppercase font-semibold opacity-60 text-red-600">

                        </div>
                    </div>
                    <a href="{{"/admin/messages/" . $user->id}}" class="btn ">
                        see Messages
                    </a>
                </li>
            @endforeach
        </ul>

    </div>
</body>
<script src="{{asset("build/assets/app.js")}}"></script>

<script>
    @foreach($users as $user)
        Echo.private(`chat.{{$user->id}}`)
        .listen('.chat.support', (e) => {
            const message = Object(e)
            document.getElementById("User_Id_{{$user->id}}").innerHTML+= `<div class="text-xs uppercase font-semibold opacity-60 text-red-600">${message.message}</div>`
        });
    @endforeach
</script>
</html>
