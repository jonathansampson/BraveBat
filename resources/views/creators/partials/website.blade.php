<div class="max-w-md overflow-hidden rounded shadow-lg">
    <img class="w-full" src="https://bravebat-prod.s3.us-west-2.amazonaws.com/website_screenshots/0ut3r_space.png" alt="{{$creator->name}}">
    <div class="flex items-center justify-between px-4 pt-6">
        <div class="w-1/2 text-left">
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
        <div class="flex-shrink-0 w-1/2 text-right">
            <x-verified-badge />
        </div>
    </div>
    <div class="flex justify-between px-4 py-6">
        <div class="text-md">Alexa Rank</div>    
        <div class="text-gray-600">
            @if ($creatable->alexa_ranking)
                {{number_format($creatable->alexa_ranking)}}
            @else
                Unranked
            @endif
        </div>    
    </div>
</div>