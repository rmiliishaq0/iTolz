@extends("main.head")
@section("description")@endsection
@section("root")
    <div id="main">
        @seo('title') // Echoes the title
        <x-Nav></x-Nav>
        <x-hero ></x-hero>
        <x-body></x-body>
        <x-before-foter></x-before-foter>
        <x-foter></x-foter>
    </div>
@endsection
