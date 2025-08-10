@extends("main.head")
<x-nav></x-nav>
@section("root")
<div class="w-full h-full" onload="fa()">
    <x-email-alert></x-email-alert>
    <x-settings></x-settings>
</div>
@endsection
