<div class="flex items-center justify-center pt-16 text-2xl">
    <div class="w-8 h-8 mr-2">
        @includeIf('partials.icons.'.$channel)
    </div>
    <div>
        @if ($channel == 'reddit')
        {{round($creator_count[$channel] / 1000, 1) }}K
        Brave Creators
        @else
        <a href="{{route('creators.index', ['channel' => $channel])}}">
            {{round($creator_count[$channel] / 1000, 1) }}K
            Brave Creators
        </a>
        @endif

    </div>
</div>