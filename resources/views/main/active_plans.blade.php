@extends("main.head")

@section("root")
    <?php
    $user_data = \App\Models\User::find(Auth()->id())->plans()->wherePivot('expire_at', '>', now())->get()->toArray();
    ?>
    <x-nav></x-nav>
    <div class=" min-h-screen flex flex-col">
        <div class="mt-[120px] mx-6 lg:mx-16">
            @if(empty($user_data))
            <div class="p-6 lg:p-12 shadow-lg rounded-lg flex gap-4 items-center justify-center">
                <div class="badge badge-primary">Free</div>
                <h1 class="text-shadow-lg tracking-wide font-bold  text-xl lg:text-2xl text-gray-600">You're currently on the Free Plan. Upgrade to unlock premium features!</h1>
            </div>
             @else
                <div class=" grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="p-6 lg:p-12 shadow-lg rounded-lg flex gap-4 items-center justify-center">
                    <div class="badge badge-primary">Free</div>
                    <h1 class="dark:text-gray-300 text-shadow-lg tracking-wide font-bold  text-xl lg:text-2xl text-gray-600">Free Plan</h1>
                </div>
             @foreach($user_data as $plan)
                        <div class="p-6 lg:p-12 shadow-lg rounded-lg ">
                            <div class="flex gap-4 items-center justify-center">
                            <h1 class="dark:text-gray-300 text-shadow-lg tracking-wide font-bold  text-xl lg:text-2xl text-gray-600">{{ $plan['Product_Name'] }}</h1>
                            </div>
                            <div class="flex justify-between items-center">
                                <h1 class="dark:text-gray-400 mt-6 font-normal text-base lg:text-lg">Expire_At : </h1>
                                 <h1 class="dark:text-gray-400 mt-6 font-medium text-base lg:text-lg">{{ (new DateTime($plan['pivot']['expire_at']))->format('d/m/Y') }}</h1>
                            </div>
                        </div>
                @endforeach
              </div>
            @endif
        </div>

    </div>
    <div class="">
        <x-foter></x-foter>
    </div>
@endsection
