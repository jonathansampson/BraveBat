<div>
    <div class="relative z-30">
        <input
            wire:model.debounce.500ms="search"
            type="text"
            class="w-64 px-8 py-2 text-sm bg-gray-300 rounded-full focus:outline-none focus:shadow-outline text-brand-dark" 
            placeholder="Search Verified Creators"
            wire:keydown.escape="clear"
            wire:keydown.tab="clear"
        >
        <div class="absolute inset-y-0">
            <svg class="w-4 py-2 ml-2 text-gray-500 fill-current" viewBox="0 0 24 24">
                <path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/>
            </svg>
        </div>
    
        <div wire:loading class="absolute inset-y-0 right-0 mr-4 spinner"></div>
    
        @if (strlen($search) >= 2)
            <div
                class="absolute w-64 mt-4 text-sm bg-gray-200"
            >
    
                @if ($searchResults->count())
    
                    <ul class="divide-y divide-gray-400">
                        @foreach ($searchResults as $index => $result)
                            <li>
                                <a href="{{route('creators.show', $result->id) }}" 
                                    class="flex items-center block py-4 transition duration-150 ease-in-out text-brand-dark hover:bg-gray-700 hover:text-brand-light"
                                >
                                    <div class="w-4 h-4 ml-2">
                                        @include('partials.icons.' . $result->channel)
                                    </div>
                                    <span class="ml-2">{{ $result->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else 
                    <div class="px-3 py-3 text-brand-dark">No results!</div>
                @endif
            </div>
        @endif
    </div>
    @if (strlen($search) >= 2)
        <button class="fixed inset-0 z-20 w-full h-full cursor-default" wire:click="clear"></button>
    @endif
</div>


