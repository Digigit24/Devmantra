@extends('layouts.frontend')
@section('title', 'DevMantra - Strategic Financial & Advisory Services')

@section('content')

{{-- Dynamic page sections managed via admin --}}
@foreach($pageSections as $section)
    <x-dynamic-component :component="'service-sections.' . $section->section_type" :data="$section->section_data ?? []" />
@endforeach

@endsection
