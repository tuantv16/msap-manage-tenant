<div class="title-content">
    <div class="row">
        <div class="col-12 d-flex flex-column">
            <div class="p-1 flex-fill m-1">
                <p class="breadcrumb-text">
                    @if(isset($breadcrumb))
                        @php
                            $parts = explode(' / ', $breadcrumb);
                        @endphp
                        @foreach($parts as $key => $part)
                            <span class="{{ $key === count($parts) - 1 ? 'breadcrumb-current' : 'breadcrumb-previous' }}">
                                {{ $part }}
                            </span>
                            @if($key !== count($parts) - 1)
                                <span> / </span>
                            @endif
                        @endforeach
                    @endif
                </p>
            </div>
            <div class="p-1 flex-fill m-1 title-primary">
                <h1>{{ $title ?? 'Group List' }}</h1>
            </div>
        </div>
    </div>
</div>
