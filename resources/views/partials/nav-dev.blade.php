<div class="bg-brand-dark" id='search'>
    <nav class="container px-4 py-4 mx-auto sm:px-6 md:px-8">
        <div class="flex flex-col items-center justify-between sm:flex-row">
            <div class="mb-4 sm:mb-0">
                <a href="{{ url('/home') }}" class="flex items-center font-semibold no-underline text-brand-orange">
                    <div class="w-6 h-6">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="fill-current">
                            <path
                                d="M5.262 26.41A14.967 14.967 0 010 15c0-4.142 1.679-7.892 4.393-10.607A14.953 14.953 0 0115 0c8.284 0 15 6.716 15 15 0 8.284-6.716 15-15 15a14.94 14.94 0 01-9.738-3.59zM4.038 15.921C5.701 14.457 6.872 12.5 10 12.5c5 0 5 5 10 5 3.128 0 4.3-1.957 5.962-3.422C25.493 8.434 20.765 4 15 4 8.925 4 4 8.925 4 15c0 .31.013.618.038.922z" />
                        </svg>
                    </div>
                    <div class="ml-2 text-2xl font-bold text-brand-light">
                        BraveBat
                    </div>
                    <div class="pt-2 ml-1 text-sm"> 
                        dev
                    </div>
                </a>
            </div>
            <div class="flex items-center text-brand-light">
                <div class="flex-1 text-right">
                    <a class="p-3 text-sm text-gray-300 no-underline hover:underline" href="/docs/index.html">Docs</a>
                    @guest
                        <a class="p-3 text-sm text-gray-300 no-underline hover:underline" href="{{ route('login') }}">Login</a>
                        @if (Route::has('register'))
                            <a class="p-3 text-sm text-gray-300 no-underline hover:underline" href="{{ route('register') }}">Register</a>
                        @endif
                    @else
                        <a href="{{ route('logout') }}"
                           class="p-3 text-sm text-gray-300 no-underline hover:underline"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
</div> 