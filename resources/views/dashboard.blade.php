@extends('layouts.app')

@section('content')
<div class="container px-4 py-6 mx-auto sm:px-6 md:px-8">
    <div class="grid grid-cols-3 gap-4">
        <div>Total Indexed Creators: {{number_format($searchable)}}</div>
        <div>
            <p>
                Indexable Creators: {{number_format($indexStats["numberOfDocuments"])}}
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
        <div>Daily Verified</div>
        <div>Daily Confirmed</div>
        <div>Daily Processed</div>
        <div>1</div>
        <div>1</div>
        <div>1</div>
        <div>1</div>
        <div>1</div>
    </div>
</div>
@endsection