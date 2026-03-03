{{--
  Primary CTA Button  — uses global SiteSetting defaults, overridable via props.
  Usage:
    <x-btn-primary />                          — uses global text + URL
    <x-btn-primary url="/contact" text="..." /> — override either or both
    <x-btn-primary class="my-extra-class" />    — extra CSS class
--}}
@props(['url' => null, 'text' => null, 'class' => ''])
@php
    $btnUrl    = $url  ?? \App\Models\SiteSetting::get('primary_button_url',  '/contact');
    $btnText   = $text ?? \App\Models\SiteSetting::get('primary_button_text', 'Book a Free Consultation');
    $btnTarget = \App\Models\SiteSetting::get('button_new_tab', '1') ? '_blank' : '_self';
    $btnRel    = $btnTarget === '_blank' ? 'noopener noreferrer' : '';
@endphp
<a href="{{ $btnUrl }}" class="dm-btn-primary {{ $class }}" target="{{ $btnTarget }}" @if($btnRel) rel="{{ $btnRel }}" @endif>
    {{ $btnText }}
    <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
        <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
    </svg></span>
</a>
