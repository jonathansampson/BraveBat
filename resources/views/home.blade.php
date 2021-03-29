@extends('layouts.app-dev')

@section('content')
@if (session('status'))
<div class="px-3 py-4 text-sm text-center text-green-700 bg-green-100 border-b border-green-200" role="alert">
    {!! session('status') !!}
</div>

@endif
<div class="flex items-center">
    <div class="container px-4 py-4 mx-auto sm:px-6 md:px-8">
        <div class="flex flex-col my-16 break-words bg-white border rounded shadow-md">
            <div class="px-6 py-3 mb-0 font-semibold text-gray-700 bg-gray-200">
                Developer Dashboard
            </div>
            <div class="w-full p-6">
                <p class="text-gray-700">
                    @if (!auth()->user()->email_verified_at)
                    Your email has not been verified yet. Click the button below to resend the verification email.
                    <form id="resend-verification-email-form" action="{{ route('resend_verification_email') }}"
                        method="POST" class="mt-4">
                        {{ csrf_field() }}
                        <button type="submit"
                            class="inline-block px-4 py-2 text-base font-bold leading-normal text-center text-gray-100 no-underline whitespace-no-wrap align-middle bg-blue-500 border rounded select-none hover:bg-blue-700">
                            Resend
                        </button>
                    </form>
                    @else
                    @if (auth()->user()->tokens->count())
                    @foreach (auth()->user()->tokens as $token)
                    <table class="w-full">
                        <tbody>
                            <tr>
                                <td class="px-2 py-2 font-bold border">Project</td>
                                <td class="px-2 py-2 border">{{$token->project}}</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 font-bold border">URL</td>
                                <td class="px-2 py-2 border">{{$token->url}}</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 font-bold border">Description</td>
                                <td class="px-2 py-2 border">{{$token->description}}</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 font-bold border">Created At</td>
                                <td class="px-2 py-2 border">{{$token->created_at->diffForHumans()}}</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 font-bold border">Last Used At</td>
                                <td class="px-2 py-2 border">
                                    @if ($token->last_used_at)
                                    {{$token->last_used_at->diffForHumans()}}
                                    @else
                                    Not used yet
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex mt-4">
                        <form id="update-token" action="{{ route('tokens.update') }}" method="POST" class="">
                            @csrf
                            @method('patch')
                            <button type="submit"
                                class="inline-block px-4 py-2 text-base font-bold leading-normal text-center text-gray-100 no-underline whitespace-no-wrap align-middle bg-green-500 border rounded select-none hover:bg-green-700"
                                onclick="return confirm('Are you sure? This will make your current API token invalid and then generate a new one')">
                                Regenarate
                            </button>
                        </form>
                        <form id="update-token" action="{{ route('tokens.destroy') }}" method="POST" class="ml-2 ">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class="inline-block px-4 py-2 text-base font-bold leading-normal text-center text-gray-100 no-underline whitespace-no-wrap align-middle bg-red-500 border rounded select-none hover:bg-red-700"
                                onclick="return confirm('Are you sure? This will make your current API token invalid')">
                                Delete
                            </button>
                        </form>
                    </div>

                    @endforeach
                    @else
                    <div class="text-lg">Genarate an API token</div>
                    <form id="create-token" action="{{ route('tokens.store') }}" method="POST" class="mt-4">
                        {{ csrf_field() }}
                        <div class="flex flex-wrap mb-6">
                            <label for="project" class="block mb-2 text-sm font-bold text-gray-700">
                                Project Name
                            </label>

                            <input id="project" type="text"
                                class="form-input w-full @error('project') border-red-500 @enderror" name="project"
                                value="{{ old('project') }}" required>

                            @error('project')
                            <p class="mt-4 text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <label for="url" class="block mb-2 text-sm font-bold text-gray-700">
                                Project URL
                            </label>

                            <input id="url" type="text" class="form-input w-full @error('url') border-red-500 @enderror"
                                name="url" value="{{ old('url') }}" required>

                            @error('url')
                            <p class="mt-4 text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <label for="description" class="block mb-2 text-sm font-bold text-gray-700">
                                Project Description (optional)
                            </label>
                            <textarea id="description"
                                class="form-textarea w-full @error('description') border-red-500 @enderror"
                                name="description" value="{{ old('description') }}" rows="3"
                                autocomplete="off"></textarea>
                            @error('description')
                            <p class="mt-4 text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="flex flex-col flex-wrap mb-6">
                            <div>
                                <label class="@error('accept') text-red-500 @enderror">
                                    <input type="checkbox" class="form-checkbox" name='accept'>
                                    <span class="ml-2">I accept the <a target='_blank'
                                            href="{{route('terms_of_service')}}" class="text-blue-700">Terms of
                                            Service</a> of BraveBat</span>
                                </label>
                            </div>
                            @error('accept')
                            <p class="mt-4 text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <button type="submit"
                            class="inline-block px-4 py-2 text-base font-bold leading-normal text-center text-gray-100 no-underline whitespace-no-wrap align-middle bg-blue-500 border rounded select-none hover:bg-blue-700">
                            Get API Token
                        </button>
                    </form>
                    @endif
                    @endif
                </p>
            </div>
        </div>


    </div>
</div>
@endsection