@extends('layouts.app')

@section('content')
<div class="container px-4 py-6 mx-auto sm:px-6 md:px-8">
    <div class="grid grid-cols-2 gap-4">
        <div>
            @foreach ($vitalStats as $key=> $item)
            <p>{{$key }}: {{number_format($item)}}</p>
            @endforeach
        </div>
        <div>
            <p>
                Total Indexable Creators: {{number_format($searchable)}}
            </p>
            <p>
                Indexed Creators: {{number_format($indexStats["numberOfDocuments"])}}
            </p>
            <p>
                Indexing?:
                @if ($indexStats["isIndexing"])
                Yes
                @else
                No
                @endif
            </p>
            @foreach ($indexStats['fieldsDistribution'] as $key=> $item)
            <p>{{$key }}: {{number_format($item)}}</p>
            @endforeach
        </div>
        <div>
            <toggleable-line-chart url="/charts/dashboard/daily_verified" title="Daily Verified Creators"
                :toggleable="false">
            </toggleable-line-chart>
        </div>
        <div>
            <toggleable-line-chart url="/charts/dashboard/daily_confirmed" title="Daily Confirmed Creators"
                :toggleable="false">
            </toggleable-line-chart>
        </div>
        <div>
            <toggleable-line-chart url="/charts/dashboard/daily_processed" title="Daily Processed Creators"
                :toggleable="false">
            </toggleable-line-chart>
        </div>
        <div>1</div>
        <div>1</div>
        <div>1</div>
        <div>1</div>
        <div>1</div>

    </div>
</div>
@endsection