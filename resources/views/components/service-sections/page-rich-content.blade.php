@props(['data' => []])
@php $content = $data['content'] ?? ''; @endphp

@if($content)
<section class="dm-rich-content-section">
    <div class="container">
        <div class="dm-rich-content-body">
            {!! $content !!}
        </div>
    </div>
</section>
@endif
