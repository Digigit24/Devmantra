@extends('layouts.frontend')
@section('title', 'Privacy Policy - DevMantra')
@section('meta_description', 'Privacy Policy for AOne Dev Mantra Financial Services Pvt Ltd. Learn how we collect, use, and protect your personal information.')

@section('content')

{{-- Dynamic page sections managed via admin --}}
@foreach($pageSections as $section)
    <x-dynamic-component :component="'service-sections.' . $section->section_type" :data="$section->section_data ?? []" />
@endforeach

@endsection
