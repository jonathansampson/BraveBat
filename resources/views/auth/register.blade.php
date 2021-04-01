@extends('layouts.app-dev')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-sm">
            <div class="flex flex-col my-16 break-words bg-white border rounded shadow-md">

                <div class="px-6 py-3 mb-0 font-semibold text-gray-700 bg-gray-200">
                    Register
                </div>

                <form class="w-full p-6" method="POST" action="{{ route('register') }}">
                    @csrf
                    <input type="hidden" name="recaptcha" id="recaptcha">

                    <div class="flex flex-wrap mb-6">
                        <label for="name" class="block mb-2 text-sm font-bold text-gray-700">
                            Name
                        </label>

                        <input id="name" type="text" class="form-input w-full @error('name')  border-red-500 @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <p class="mt-4 text-xs italic text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="email" class="block mb-2 text-sm font-bold text-gray-700">
                            Email Address
                        </label>

                        <input id="email" type="email"
                            class="form-input w-full @error('email') border-red-500 @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <p class="mt-4 text-xs italic text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="password" class="block mb-2 text-sm font-bold text-gray-700">
                            Password
                        </label>

                        <input id="password" type="password"
                            class="form-input w-full @error('password') border-red-500 @enderror" name="password"
                            required autocomplete="new-password">

                        @error('password')
                        <p class="mt-4 text-xs italic text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="password-confirm" class="block mb-2 text-sm font-bold text-gray-700">
                            Confirm Password
                        </label>

                        <input id="password-confirm" type="password" class="w-full form-input"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit"
                            class="inline-block px-4 py-2 text-base font-bold leading-normal text-center text-gray-100 no-underline whitespace-no-wrap align-middle bg-blue-500 border rounded select-none hover:bg-blue-700">
                            Register
                        </button>

                        <p class="w-full mt-8 -mb-4 text-xs text-center text-gray-700">
                            Already have an account?
                            <a class="text-blue-500 no-underline hover:text-blue-700" href="{{ route('login') }}">
                                Login
                            </a>
                        </p>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.key') }}"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('{{ config('services.recaptcha.key') }}', {action: 'register'}).then(function(token) {
            if (token) {
                document.getElementById('recaptcha').value = token;
            }
        });
    });
</script>
@endpush

@push('styles')
<style>
    .grecaptcha-badge {
        visibility: hidden;
    }
</style>
@endpush