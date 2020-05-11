<div class="max-w-md overflow-hidden border rounded shadow-lg">
    @if ($creator->screenshot)
    <img class="w-full" src="https://bravebat-prod.s3.us-west-2.amazonaws.com/{{$creator->screenshot}}"
        alt="{{$creator->name}}">
    @endif
    <div class="flex items-center justify-between px-4 pt-6">
        <div class="text-left">
            <div class="flex items-center mb-2">
                <div class="w-4 h-4">
                    @include('partials.icons.'.$creator->channel)
                </div>
                <h1 class="ml-2 text-lg">
                    <a href="{{$creator->link}}" target='_blank' class="text-blue-500">{{$creator->name}}</a>
                </h1>
            </div>
            <div class="mb-2 text-sm text-gray-500 capitalize">{{$creator->channel}}</div>
        </div>
        <div class="text-right">
            <h1 class="mb-2 text-lg">
                {{number_format($creator->alexa_ranking)}}
            </h1>
            <div class="mb-2 text-sm text-gray-500 capitalize">Alexa Rank</div>
        </div>
    </div>
    <div class="px-4 pt-4 pb-6">
        <x-verified-badge />
    </div>
    @include('creators.partials.cta')

</div>