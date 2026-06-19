@extends('layouts.frontend')
@section('title', 'About Us - DevMantra')
@section('meta_description', 'Dev Mantra is an audit-grade, CA-led India execution partner for cross-border M&A, India entry, Virtual CFO and GCC setup. Founded in 2008 in Bengaluru.')

@php
    // Single source of truth: drives BOTH the visible FAQ section and FAQ schema
    // so structured data always matches on-page content (Google requirement).
    $dmFaqs = [
        ['question' => 'What does Dev Mantra Financial Services do?',
         'answer'   => 'Dev Mantra is a Bengaluru-based, CA-led corporate finance and advisory firm founded in 2008. It helps companies — especially foreign and cross-border clients — enter, acquire, and scale in India through M&A advisory, India entry / FDI structuring, Virtual CFO services, GCC setup, IPO advisory, and corporate governance.'],
        ['question' => 'Where is Dev Mantra located?',
         'answer'   => 'Dev Mantra is headquartered in Bengaluru, Karnataka, India, close to India\'s GCC ecosystem. You can reach the team on +91 99001 92697 or at info@devmantra.com.'],
        ['question' => 'What makes Dev Mantra different from a Big 4 firm?',
         'answer'   => 'Dev Mantra offers audit-grade depth through its knowledge partner N Tatia & Associates (ICAI FRN 011067S, Peer Reviewed, ISO Certified) with senior-partner attention, typically at 30–50% below Big 4 fees. It sits in the gap between Big 4 pricing and generic discount consultants.'],
        ['question' => 'What is a Virtual CFO and when do I need one?',
         'answer'   => 'A Virtual CFO provides on-demand financial leadership — monthly close, MIS, cash flow, budgeting, fundraising support, and board reporting — without the cost of a full-time hire. It suits startups, SMEs, and foreign subsidiaries that need senior finance oversight while scaling.'],
        ['question' => 'How should a foreign company enter the Indian market?',
         'answer'   => 'The main options are a Wholly Owned Subsidiary (WOS), LLP, Branch Office, or Liaison Office. The right choice depends on control, tax, compliance load, and profit repatriation. A WOS suits serious long-term operations; lighter structures suit representative or specific-purpose needs. Dev Mantra structures the entity and FDI route end to end.'],
        ['question' => 'How much transaction experience does Dev Mantra have?',
         'answer'   => 'Dev Mantra has advised on ₹5,000 Cr+ of transactions, with 20+ years of cross-border execution and 150+ years of combined leadership experience across its team and knowledge partner.'],
    ];
@endphp

@push('schema')
{!! \App\Services\SchemaService::organization() !!}
{!! \App\Services\SchemaService::faqSchema($dmFaqs) !!}
{!! \App\Services\SchemaService::breadcrumb([
    ['name' => 'Home',     'url' => '/'],
    ['name' => 'About Us', 'url' => '/about'],
]) !!}
@endpush

@section('content')

{{-- Dynamic page sections managed via admin --}}
@foreach($pageSections as $section)
    <x-dynamic-component :component="'service-sections.' . $section->section_type" :data="$section->section_data ?? []" />
@endforeach

{{-- Frequently Asked Questions (visible content mirrors FAQPage schema above) --}}
<section class="dm-faq-section" style="background:#f6f8fb; padding:80px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-xl-9 col-lg-10">
                <div style="text-align:center; margin-bottom:48px;">
                    <span style="display:inline-block; font-size:13px; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; color:#4a73c4; margin-bottom:12px;">FAQs</span>
                    <h2 style="color:#001d30; font-size:34px; line-height:1.25; margin:0;">Frequently Asked Questions</h2>
                </div>
                <div class="dm-faq-list">
                    @foreach($dmFaqs as $i => $faq)
                    <details class="dm-faq-item" style="background:#fff; border:1px solid #e6ebf2; border-radius:14px; padding:22px 26px; margin-bottom:16px; box-shadow:0 2px 14px rgba(0,29,48,.04);" {{ $i === 0 ? 'open' : '' }}>
                        <summary style="cursor:pointer; list-style:none; font-size:18px; font-weight:600; color:#001d30; display:flex; justify-content:space-between; align-items:center; gap:16px;">
                            <span>{{ $faq['question'] }}</span>
                            <span class="dm-faq-icon" aria-hidden="true" style="flex:0 0 auto; color:#4a73c4; font-size:22px; line-height:1;">+</span>
                        </summary>
                        <div style="margin-top:14px; color:#3a4a5a; font-size:16px; line-height:1.7;">
                            {{ $faq['answer'] }}
                        </div>
                    </details>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .dm-faq-item summary::-webkit-details-marker { display:none; }
    .dm-faq-item[open] .dm-faq-icon { transform:rotate(45deg); }
    .dm-faq-icon { transition:transform .2s ease; }
</style>

@endsection
