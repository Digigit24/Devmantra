@extends('layouts.frontend')
@section('title', 'DevMantra - Strategic Financial & Advisory Services')
@section('meta_description', 'On-demand Virtual CFO services for Indian & cross-border businesses, backed by M&A, India-entry and GCC-setup expertise. ₹5,000 Cr+ advised. Book a free consult.')

@push('schema')
{!! \App\Services\SchemaService::organization() !!}
{!! \App\Services\SchemaService::localBusiness() !!}
{!! \App\Services\SchemaService::breadcrumb([['name' => 'Home', 'url' => '/']]) !!}
@endpush

@section('content')

{{-- Dynamic page sections managed via admin --}}
@foreach($pageSections as $section)
    <x-dynamic-component :component="'service-sections.' . $section->section_type" :data="$section->section_data ?? []" />
@endforeach

@endsection
