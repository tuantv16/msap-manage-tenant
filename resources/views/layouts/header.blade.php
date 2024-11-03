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
               
                <h1>
                    @if(isset($backLink))
                    <a href="{{ $backLink }}">
                        <svg style="display: inline" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.6572 7.32115H4.04378L10.3962 1.89258C10.4978 1.80508 10.4361 1.64258 10.3019 1.64258H8.69655C8.62581 1.64258 8.55869 1.66758 8.50609 1.71222L1.65118 7.56758C1.5884 7.62115 1.53805 7.68739 1.50354 7.76179C1.46903 7.8362 1.45117 7.91704 1.45117 7.99883C1.45117 8.08062 1.46903 8.16146 1.50354 8.23587C1.53805 8.31027 1.5884 8.3765 1.65118 8.43008L8.54599 14.3211C8.5732 14.3444 8.60585 14.3569 8.64032 14.3569H10.3001C10.4343 14.3569 10.496 14.1926 10.3944 14.1069L4.04378 8.67829H14.6572C14.737 8.67829 14.8023 8.61401 14.8023 8.53544V7.46401C14.8023 7.38544 14.737 7.32115 14.6572 7.32115Z" fill="black" fill-opacity="0.85"/>
                        </svg>
                    </a>
                    @endif
                {{ $title ?? 'Group List' }}
                </h1>
            </div>
        </div>
    </div>
</div>
