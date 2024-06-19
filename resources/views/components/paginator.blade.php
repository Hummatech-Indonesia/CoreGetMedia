@props(['paginator'])

@if ($paginator->hasPages())
    <ul class="page-nav list-style text-center mt-5">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <li class="disabled"><span><i class="flaticon-arrow-left"></i></span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="flaticon-arrow-left"></i></a></li>
        @endif

        <!-- Pagination Elements -->
        @if ($paginator->lastPage() > 5 && $paginator->currentPage() > 3)
            <li><a href="{{ $paginator->url(1) }}" class="btn btn-black {{ $paginator->currentPage() == 1 ? 'active' : '' }}">1</a></li>
            <li><span>...</span></li>
        @endif

        @for ($i = max(1, $paginator->currentPage() - 2); $i <= min($paginator->lastPage(), $paginator->currentPage() + 2); $i++)
            <li><a href="{{ $paginator->url($i) }}" class="btn btn-black {{ $paginator->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a></li>
        @endfor

        @if ($paginator->lastPage() > 5 && $paginator->currentPage() < $paginator->lastPage() - 2)
            <li><span>...</span></li>
            <li><a href="{{ $paginator->url($paginator->lastPage()) }}" class="btn btn-black {{ $paginator->currentPage() == $paginator->lastPage() ? 'active' : '' }}">{{ $paginator->lastPage() }}</a></li>
        @endif

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="flaticon-arrow-right"></i></a></li>
        @else
            <li class="disabled"><span><i class="flaticon-arrow-right"></i></span></li>
        @endif
    </ul>
@endif
