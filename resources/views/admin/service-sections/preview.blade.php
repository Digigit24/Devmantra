@extends('layouts.section-preview')

@section('content')
@php
    use App\Models\ServiceSection;
    $allowedTypes = array_keys(ServiceSection::sectionTypes());
@endphp

@if(isset($type) && $type && in_array($type, $allowedTypes))
    <x-dynamic-component
        :component="'service-sections.' . $type"
        :data="$data ?? []"
    />
@else
    <div style="padding:60px;text-align:center;color:#94a3b8;font-family:sans-serif;">
        <i class="fa-solid fa-eye-slash" style="font-size:32px;margin-bottom:16px;display:block;opacity:.3;"></i>
        <p>Select a section type and fill in fields to see a live preview here.</p>
    </div>
@endif
@endsection
