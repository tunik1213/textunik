@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            @php(
                $previousPageUrl = preg_replace('/\?page=1$/','',$paginator->previousPageUrl())
            )
            <li class="page-item">
                <a class="page-link" href="{{ $previousPageUrl }}" rel="prev">← назад</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">дальше →</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">@lang('pagination.next')</span>
            </li>
        @endif
    </ul>
@endif
