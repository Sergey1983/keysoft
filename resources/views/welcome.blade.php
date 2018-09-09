@extends('master')

@section ('content')


<div class="container-fluid">

    @include('search')
{{--     @include('table')
 --}}
</div>

<script type="text/javascript" src="{{ URL::asset('js/search.js') }}"></script>
{{-- <script type="text/javascript" src="{{ URL::asset('js/load_tours/tooltip.js') }}"></script>
 --}}

@endsection