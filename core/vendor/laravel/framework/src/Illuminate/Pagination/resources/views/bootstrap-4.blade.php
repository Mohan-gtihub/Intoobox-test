@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item ms-3 disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link rounded-0" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
            </li>
        @else
            <li class="page-item ms-3">
                <a class="page-link rounded-0" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item ms-3 disabled" aria-disabled="true"><span class="page-link rounded-0">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active ms-3" aria-current="page"><span class="page-link rounded-0">{{ $page }}</span></li>
                    @else
                        <li class="page-item ms-3"><a class="page-link rounded-0" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item ms-3">
                <a class="page-link rounded-0" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="page-item ms-3 disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link rounded-0" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
            </li>
        @endif
    </ul>
</nav>
@endif