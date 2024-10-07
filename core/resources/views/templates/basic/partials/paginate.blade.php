<nav aria-label="...">
    <ul class="pagination justify-content-center mb-0">
        @if ($paginator->onFirstPage())

        @else
            <li class="page-item ">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">
                    <i class="fa fa-angle-left"></i>
                    <span class="sr-only" >@lang('Previous')</span>
                </a>
            </li>
        @endif


        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled">
                    <a class="page-link" href="javascript:void(0)">
                        {{ $element }}
                    </a>
                </li>
            @endif
            @if (is_array($element))
                @if(count($element) < 2)
                    @foreach ($element as $page => $url)

                    @endforeach
                @else
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link" href="javascript:void(0)">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item ">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                    <i class="fa fa-angle-right"></i>
                    <span class="sr-only">@lang('Next')</span>
                </a>
            </li>
        @else
            <li>
            </li>
        @endif
    </ul>
</nav>

@push('style')
    <style>
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color:mediumseagreen;
            border: 1px solid mediumseagreen;
        }

        .page-item .page-link{
            
            color: black;
           
            border: 1px solid #18365A;
        }
        .page-item .page-link:hover{
            
            color: #fff;
            background-color:#18365A;
            border: 1px solid #18365A;
        }
    </style>
@endpush