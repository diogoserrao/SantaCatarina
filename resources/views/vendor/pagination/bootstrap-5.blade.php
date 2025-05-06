<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

@if ($paginator->hasPages())
    <style>
        .custom-pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .custom-pagination {
            list-style: none;
            display: flex;
            gap: 0.5rem;
            padding: 0;
            margin: 0;
        }

        .custom-pagination li {
            display: inline;
        }

        .custom-pagination .page-link {
            display: inline-block;
            padding: 0.45rem 0.8rem;
            border-radius: 8px;
            background-color: #f1f3f5;
            color: #343a40;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .custom-pagination .page-link:hover {
            background-color: #dee2e6;
            transform: translateY(-1px);
        }

        .custom-pagination .active .page-link {
            background-color: #007bff;
            color: #fff;
            font-weight: 600;
            box-shadow: 0 2px 6px rgba(0,123,255,0.2);
        }

        .custom-pagination .disabled .page-link {
            color: #adb5bd;
            pointer-events: none;
            background-color: #e9ecef;
        }
    </style>

    <nav class="custom-pagination-wrapper">
        <ul class="custom-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @else
                <li class="disabled"><span class="page-link">&raquo;</span></li>
            @endif
        </ul>
    </nav>
@endif