@extends('layouts.app-dev')

@section('content')
    @if (session('status'))
    <div class="px-3 py-4 text-sm text-center text-green-700 bg-green-100 border-b border-green-200" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-sm">

                <div class="flex flex-col my-16 break-words bg-white border border-2 rounded shadow-md ">

                    <div class="px-6 py-3 mb-0 font-semibold text-gray-700 bg-gray-200">
                        Reset Password
                    </div>

                    <form class="w-full p-6" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="block mb-2 text-sm font-bold text-gray-700">
                                Email Address:
                            </label>

                            <input id="email" type="email" class="form-input w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <p class="mt-4 text-xs italic text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap">
                            <button type="submit" class="px-4 py-2 font-bold text-gray-100 bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                                Send Password Reset Link
                            </button>

                            <p class="w-full mt-8 -mb-4 text-xs text-center text-grey-dark">
                                <a class="text-blue-500 no-underline hover:text-blue-700" href="{{ route('login') }}">
                                    Back to login
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
