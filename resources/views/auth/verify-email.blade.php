@extends("main.head")
<x-nav></x-nav>
@section("root")
    <div class="w-full h-full flex justify-center items-center" >
        <x-verify-email></x-verify-email>
    </div>
@endsection
