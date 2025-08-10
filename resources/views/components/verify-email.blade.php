<div class=" w-1/3  bg-white border border-gray-200 rounded-lg shadow-sm  dark:bg-gray-800 dark:border-gray-700 max-xl:w-1/2 max-md:w-full max-md:mx-6">
    <div class="dark:bg-gray-800 bg-gray-100 w-full mb-4 p-4">
        <h5 class="text-base font-medium text-gray-900 dark:text-white text-center dark:text-gray-700">Verify your email via the link we sent. Check spam if missing. Need another? We’ll resend.</h5>
    </div>
    <form class="space-y-6 sm:px-6 md:px-6 mb-6 " method="POST" action="{{ route('verification.send') }}">
        @error('g-recaptcha-response')
        <div id="err" class="p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-600 dark:text-red-400" role="alert">
            <span class="font-medium">CAPTCHA field is required.</span>
        </div>
        @enderror
        @if (session('status') == 'verification-link-sent')
            <div class="p-4  text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-600 dark:text-green-400" role="alert">
                A <span class="inline font-medium">new verification link</span> has been sent to <span class=" inline font-medium">{{auth()->user()->email}}</span>
            </div>
        @endif

        @csrf
            <div>
                {!! NoCaptcha::display() !!}

            </div>
        <button type="submit" class="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Resend Verification Email</button>
{{--        <div class="text-sm font-medium text-gray-500 dark:text-gray-300 ">--}}
{{--            <a  href="{{ route('settings') }}" class="text-indigo-700 hover:underline dark:text-indigo-500 pl-4--}}
{{--            pr-6">Edit Profile</a>--}}
{{--            <a href="/logout" class="text-red-600 hover:underline ">--}}
{{--                {{ __('Sign out') }}--}}
{{--            </a>--}}
{{--        </div>--}}
    </form>
    </div>
</div>




