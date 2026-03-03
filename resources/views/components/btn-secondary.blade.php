{{--
  Secondary CTA Button — "Get a Free Financial Review"
  Renders nothing if secondary_button_link is blank.
  Usage:  <x-btn-secondary />
          <x-btn-secondary class="my-class" />
--}}
@props(['class' => ''])
@php
    $link = \App\Models\SiteSetting::get('secondary_button_link', '');
    $text = \App\Models\SiteSetting::get('secondary_button_text', 'Get a Free Financial Review');
@endphp
@if($link)
<a href="{{ $link }}" class="dm-btn-secondary {{ $class }}">
    {{ $text }}
    <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
        <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
    </svg></span>
</a>
@endif
