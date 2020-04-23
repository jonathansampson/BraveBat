<div class="w-full max-w-md overflow-hidden bg-white border rounded shadow-lg sm:w-2/3 md:w-1/2">
    <div class="flex items-center justify-between px-4 pt-6">
        <div>
            <img class="w-16 h-16 rounded-full" src="{{$creatable->thumbnail}}" alt="{{$creator->name}}">
        </div>
        <div class="flex-shrink-0">
            <x-verified-badge />
        </div>
    </div>
    <div class="px-4 pt-6">
        <div class="flex items-center mb-2">
            <div class="w-4 h-4">
                @include('partials.icons.'.$creator->channel)
            </div>
            <h1 class="ml-2 text-lg">
                <a href="{{$creatable->link()}}" target='_blank' class="text-blue-500">{{$creator->name}}</a>
            </h1>
        </div>    
        <div class="mb-2 text-sm text-gray-500 capitalize">{{$creator->channel}}</div>    
    </div>
    <div class="pb-4">
        <div class="flex justify-between px-4 py-2">
            <div class="text-md">Followers</div>    
            <div class="text-gray-600">
                {{number_format($creatable->follower_count)}}
            </div>    
        </div>
        <div class="flex justify-between px-4 py-2">
            <div class="text-md">Views</div>    
            <div class="text-gray-600">
                {{number_format($creatable->view_count)}}
            </div>    
        </div>
    </div>
</div>