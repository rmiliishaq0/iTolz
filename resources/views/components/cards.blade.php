<div class="dark:bg-gray-700 card bg-base-100 shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-700 delay-50 ease-in-out

" @if($marginT!="none") style="margin-top: 120px" @endif >
    <figure>
        <img style="width: 100%; object-fit: fill;object-position: center;" src="{{$src}}"
            alt="" />
    </figure>
    <div class="card-body flex justify-center items-center">
        {{ $slot }}
    </div>
</div>
