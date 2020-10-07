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
{{-- <div class="flex flex-wrap">
    <div class="w-full lg:w-1/2">
        <h2 class="py-8 text-xl font-semibold text-center">Total</h2>
        @include('charts.line', ['id' => 'creator_daily_total_stats/'.$channel, 'brand_color' => $channel, 'unit' =>
        'day'])
    </div>
    <div class="w-full lg:w-1/2">
        <h2 class="py-8 text-xl font-semibold text-center">Daily Addition</h2>
        @include('charts.line', ['id' => 'creator_daily_addition_stats/'.$channel, 'brand_color' => $channel, 'unit' =>
        'day'])
    </div>
</div> --}}