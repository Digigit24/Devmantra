@extends('layouts.frontend')
@section('title', 'About Us - DevMantra')
@section('meta_description', 'Dev Mantra is a strategic partner in progress for businesses operating in a global and digital economy. Founded in 2008 in Bengaluru.')

@section('content')

{{-- Dynamic page sections managed via admin --}}
@foreach($pageSections as $section)
    <x-dynamic-component :component="'service-sections.' . $section->section_type" :data="$section->section_data ?? []" />
@endforeach

@endsection
