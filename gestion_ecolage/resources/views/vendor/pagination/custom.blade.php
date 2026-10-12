@if ($paginator->hasPages())
    <div class="custom-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-item pagination-disabled">
                ← Précédent
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-item pagination-link">
                ← Précédent
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="pagination-item pagination-dots">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination-item pagination-active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-item pagination-link">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-item pagination-link">
                Suivant →
            </a>
        @else
            <span class="pagination-item pagination-disabled">
                Suivant →
            </span>
        @endif
    </div>

    <style>
        .custom-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 24px 0;
            flex-wrap: wrap;
        }

        .pagination-item {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .pagination-link {
            color: #667eea;
            background: #f3f4f6;
            text-decoration: none;
            border: 2px solid transparent;
        }

        .pagination-link:hover {
            background: #e5e7eb;
            color: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }

        .pagination-active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .pagination-disabled {
            color: #d1d5db;
            background: #f3f4f6;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .pagination-dots {
            color: #9ca3af;
            background: transparent;
            cursor: default;
        }

        @media (max-width: 640px) {
            .custom-pagination {
                gap: 4px;
            }

            .pagination-item {
                min-width: 36px;
                height: 36px;
                padding: 0 8px;
                font-size: 12px;
            }
        }
    </style>
@endif
