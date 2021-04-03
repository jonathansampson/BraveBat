@extends('layouts.app-no-search')

@section('content')
<div class="container px-4 py-6 mx-auto sm:px-6 md:px-8">
    <advanced-search initial-term="{{$initialTerm}}"></advanced-search>
</div>
@endsection