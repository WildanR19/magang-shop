@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-center">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">
                            <i class="bi bi-arrow-left"></i>
                            <span class="d-none d-sm-inline">@lang('pagination.previous')</span>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                            <i class="bi bi-arrow-left"></i>
                            <span class="d-none d-sm-inline">@lang('pagination.previous')</span>
                        </a>
                    </li>
                @endif
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                            <span class="d-none d-sm-inline">@lang('pagination.next')</span>
                            <i class="bi bi-arrow-right"></i></a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">
                            <span class="d-none d-sm-inline">@lang('pagination.next')</span>
                            <i class="bi bi-arrow-right"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
@endif