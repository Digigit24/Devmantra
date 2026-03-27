@props(['data' => []])
@php
    use App\Models\Blog;
    $sectionTitle    = $data['title']             ?? 'Explore our latest insights & updates';
    $sectionSubtitle = $data['subtitle']          ?? 'Insights';
    $exploreText     = $data['explore_link_text'] ?? 'Explore more insights from Dev Mantra';
    $exploreUrl      = $data['explore_link_url']  ?? '/blog';
    $count           = (int) ($data['count']      ?? 3);

    $blogs = Blog::published()->latest('published_at')->take($count)->get();
@endphp

@once
@push('styles')
<style>
.cr-blog-area-dark { background: #001d30; }
.cr-blog-area-dark .tp-section-subtitle-gradient.ct { color: #fff; }
.cr-blog-area-dark .tp-section-title-onest { color: #fff !important; }
.cr-blog-area-dark .cr-blog-item-category { color: #fff; }
.cr-blog-area-dark .cr-blog-item-title { color: #fff; }
.cr-blog-area-dark .cr-blog-item-title a { color: #fff; }
.cr-blog-area-dark .cr-blog-item-meta { color: rgba(255,255,255,0.5); }
.cr-blog-area-dark .cr-blog-bottom-text { color: #fff; }
.cr-blog-area-dark .cr-blog-bottom-border { border-bottom-color: rgba(255,255,255,0.07); }
.cr-blog-area-dark .cr-multi-border { border-color: rgba(255,255,255,0.07); }
.cr-blog-area-dark .cr-multi-border::after,
.cr-blog-area-dark .cr-multi-border::before { background-color: rgba(255,255,255,0.07); }
</style>
@endpush
@endonce

<!-- blog area start -->
<div class="cr-blog-area cr-blog-area-dark">
    <div class="container container-1230">
        <div class="cr-multi-border pt-120">
            <div class="cr-blog-bottom-border">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-blog-heading text-center pb-60">
                            <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">{{ $sectionSubtitle }}</div>
                            <h4 class="tp-section-title-onest fs-72 tp-text-revel-anim">{!! nl2br(e($sectionTitle)) !!}</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="cr-blog-item mb-30">
                            <div class="cr-blog-item-thumb">
                                <a href="{{ route('blog.show', $blog->slug) }}">
                                    @if($blog->featured_image)
                                        <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" loading="lazy">
                                    @else
                                        <img src="{{ asset('assets/img/home-13/blog/blog-thumb-'.(($loop->index % 3)+1).'.jpg') }}" alt="{{ $blog->title }}" loading="lazy">
                                    @endif
                                </a>
                            </div>
                            <div class="cr-blog-item-content">
                                <span class="cr-blog-item-category">{{ $blog->category ?? 'Blog' }}</span>
                                <h4 class="cr-blog-item-title">
                                    <a class="tp-line-white" href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                                </h4>
                                <p class="cr-blog-item-meta">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="cr-blog-bottom text-center tp_fade_anim" data-delay=".7" data-fade-from="top" data-ease="bounce">
                            <a href="{{ $exploreUrl }}" class="cr-blog-bottom-text">{{ $exploreText }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- blog area end -->
