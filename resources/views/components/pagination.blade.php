<div class="pagination-container">
    <div class="pagination-info">
        {{ $items->firstItem() }}-{{ $items->lastItem() }} of {{ $items->total() }} items
    </div>
    <div class="pagination-wrapper">
        <ul class="pagination">
            <!-- Button "Previous" -->
            @if ($items->onFirstPage())
                <li class="pagination-item disabled"><span><</span></li>
            @else
                <li class="pagination-item">
                    <a href="{{ $items->appends(request()->except('page'))->previousPageUrl() }}"><</a>
                </li>
            @endif

            <!-- Show number pages -->
            @foreach(range(1, $items->lastPage()) as $page)
                @if ($page == 1 || $page == $items->lastPage() || abs($page - $items->currentPage()) <= 2)
                    @if ($page == $items->currentPage())
                        <li class="pagination-item active"><span>{{ $page }}</span></li>
                    @else
                        <li class="pagination-item">
                            <a href="{{ $items->appends(request()->except('page'))->url($page) }}">{{ $page }}</a>
                        </li>
                    @endif
                @elseif ($page == 2 || $page == $items->lastPage() - 1)
                    <li class="pagination-item"><a href="#">...</a></li>
                @endif
            @endforeach

            <!-- Button "Next" -->
            @if ($items->hasMorePages())
                <li class="pagination-item">
                    <a href="{{ $items->appends(request()->except('page'))->nextPageUrl() }}">></a>
                </li>
            @else
                <li class="pagination-item disabled"><span>></span></li>
            @endif
        </ul>
        <div class="pagination-limit">
            <select class="w-120" onchange="window.location.href = this.value;">
                <option value="{{ request()->fullUrlWithQuery(['per_page' => 10]) }}" {{ request('per_page') == 10 ? 'selected' : '' }}>10/page</option>
                <option value="{{ request()->fullUrlWithQuery(['per_page' => 20]) }}" {{ request('per_page') == 20 ? 'selected' : '' }}>20/page</option>
                <option value="{{ request()->fullUrlWithQuery(['per_page' => 30]) }}" {{ request('per_page') == 30 ? 'selected' : '' }}>30/page</option>
            </select>
        </div>
    </div>
</div>
