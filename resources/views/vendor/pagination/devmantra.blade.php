{{-- DevMantra custom pagination — matches the site's dark/clean theme --}}
@if ($paginator->hasPages())
<nav class="dm-pagination" aria-label="Page navigation">
    <ul>
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true">
                <span><i class="fa-solid fa-chevron-left"></i></span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </li>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="dots disabled" aria-disabled="true"><span>&hellip;</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="disabled" aria-disabled="true">
                <span><i class="fa-solid fa-chevron-right"></i></span>
            </li>
        @endif
    </ul>
</nav>
@endif
