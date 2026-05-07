<?php extract((new \Illuminate\Support\Collection($attributes->getAttributes()))->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
@props(['data'])
<x-service-sections.engagement-models :data="$data" >

{{ $slot ?? "" }}
</x-service-sections.engagement-models>