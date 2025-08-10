@extends("main.head")
<x-nav></x-nav>
@section("root")
    <div class="w-full h-full flex justify-center items-center" >
        <x-reset>
            {{$request->route('token')}}
        </x-reset>
    </div>
@endsection
