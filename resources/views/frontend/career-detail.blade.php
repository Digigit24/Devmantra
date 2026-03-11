@extends('layouts.frontend')
@section('title', $career->title . ' - Careers - DevMantra')
@section('meta_description', $career->meta_description ?? Str::limit(strip_tags($career->description), 160))

@push('styles')
<style>
    .dm-career-hero { background-color: #001d30; padding: 200px 0 100px; }
    @media (max-width: 767px) { .dm-career-hero { padding: 150px 0 70px; } }
    .dm-career-hero-title {
        font-size: 44px; font-weight: 600; color: #fff; line-height: 1.2;
        font-family: var(--tp-ff-onest);
    }
    @media (max-width: 991px) { .dm-career-hero-title { font-size: 32px; } }
    @media (max-width: 767px) { .dm-career-hero-title { font-size: 26px; } }
    .dm-career-hero-meta {
        display: flex; gap: 24px; flex-wrap: wrap; margin-top: 24px;
    }
    .dm-career-hero-meta span {
        font-size: 15px; color: rgba(255,255,255,0.6);
        display: inline-flex; align-items: center; gap: 8px;
        font-family: var(--tp-ff-onest);
    }
    .dm-career-body { padding: 80px 0 100px; }
    @media (max-width: 767px) { .dm-career-body { padding: 40px 0 60px; } }
    .dm-career-content {
        font-size: 16px; color: #333; line-height: 1.8;
        font-family: var(--tp-ff-onest);
    }
    .dm-career-content h2, .dm-career-content h3 { margin-top: 32px; margin-bottom: 16px; color: #111; }
    .dm-career-content ul, .dm-career-content ol { padding-left: 24px; margin-bottom: 20px; }
    .dm-career-content li { margin-bottom: 8px; }

    /* Apply Form */
    .dm-apply-wrap {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.06);
        border-radius: 16px;
        padding: 36px;
        position: sticky;
        top: 120px;
    }
    .dm-apply-title {
        font-size: 22px; font-weight: 600; color: #111;
        margin-bottom: 8px; font-family: var(--tp-ff-onest);
    }
    .dm-apply-desc {
        font-size: 14px; color: rgba(0,0,0,0.5);
        margin-bottom: 24px; font-family: var(--tp-ff-onest);
    }
    .dm-apply-group { margin-bottom: 20px; }
    .dm-apply-label {
        display: block; font-size: 14px; font-weight: 600; color: #111;
        margin-bottom: 6px; font-family: var(--tp-ff-onest);
    }
    .dm-apply-input {
        width: 100%; padding: 12px 16px;
        border: 1px solid rgba(0,0,0,0.1); border-radius: 10px;
        font-size: 15px; color: #111; background: #fafafa;
        font-family: var(--tp-ff-onest); outline: none;
        transition: border-color 0.3s ease;
    }
    .dm-apply-input:focus { border-color: #111; background: #fff; }
    .dm-apply-error { font-size: 13px; color: #dc2626; margin-top: 6px; font-family: var(--tp-ff-onest); }
    .dm-apply-submit {
        display: inline-flex; align-items: center; gap: 10px;
        padding: 14px 32px; background: #001d30; color: #fff;
        border: none; border-radius: 10px; font-size: 16px;
        font-weight: 600; cursor: pointer; width: 100%;
        justify-content: center; transition: all 0.3s ease;
        font-family: var(--tp-ff-onest);
    }
    .dm-apply-submit:hover { background: #222; transform: translateY(-2px); }
    .dm-apply-success {
        background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.2);
        color: #16a34a; padding: 16px 20px; border-radius: 10px;
        font-size: 15px; font-weight: 500; margin-bottom: 20px;
        font-family: var(--tp-ff-onest); display: flex; align-items: center; gap: 10px;
    }
    .dm-apply-hint { font-size: 12px; color: rgba(0,0,0,0.4); margin-top: 4px; font-family: var(--tp-ff-onest); }
</style>
@endpush

@section('content')
<!-- Hero -->
<div class="dm-career-hero">
    <div class="container container-1230">
        <div class="row">
            <div class="col-lg-8">
                <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">
                    <a href="{{ route('careers') }}" style="color:inherit;text-decoration:none;">Careers</a>
                </div>
                <h1 class="dm-career-hero-title tp-text-revel-anim" data-delay=".5">{{ $career->title }}</h1>
                <div class="dm-career-hero-meta tp_fade_anim" data-delay=".7">
                    @if($career->location)
                    <span><i class="fa-solid fa-location-dot"></i> {{ $career->location }}</span>
                    @endif
                    <span><i class="fa-solid fa-briefcase"></i> {{ $career->type }}</span>
                    <span><i class="fa-solid fa-calendar"></i> {{ $career->published_at?->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Body -->
<div class="dm-career-body">
    <div class="container container-1230">
        <div class="row g-5">
            <!-- Content -->
            <div class="col-lg-7">
                <div class="dm-career-content tp_fade_anim" data-delay=".3">
                    {!! $career->description !!}
                </div>
            </div>

            <!-- Apply Sidebar -->
            <div class="col-lg-5">
                <div class="dm-apply-wrap tp_fade_anim" data-delay=".5">
                    <h3 class="dm-apply-title">Apply for this Role</h3>
                    <p class="dm-apply-desc">Fill in the details below and upload your resume.</p>

                    @if(session('success'))
                    <div class="dm-apply-success">
                        <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('career.apply', $career->slug) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="dm-apply-group">
                            <label class="dm-apply-label">Full Name *</label>
                            <input type="text" name="name" class="dm-apply-input" placeholder="Your full name" value="{{ old('name') }}" required>
                            @error('name') <div class="dm-apply-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="dm-apply-group">
                            <label class="dm-apply-label">Email *</label>
                            <input type="email" name="email" class="dm-apply-input" placeholder="your@email.com" value="{{ old('email') }}" required>
                            @error('email') <div class="dm-apply-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="dm-apply-group">
                            <label class="dm-apply-label">Phone</label>
                            <input type="text" name="phone" class="dm-apply-input" placeholder="+91 XXXXX XXXXX" value="{{ old('phone') }}">
                            @error('phone') <div class="dm-apply-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="dm-apply-group">
                            <label class="dm-apply-label">Resume *</label>
                            <input type="file" name="resume" class="dm-apply-input" accept=".pdf,.doc,.docx" required>
                            <div class="dm-apply-hint">PDF, DOC, DOCX. Max 5MB.</div>
                            @error('resume') <div class="dm-apply-error">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="dm-apply-submit">
                            Submit Application
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
                                <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
