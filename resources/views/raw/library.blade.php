<div class="col-6">
    <div class="card">
        <img width="48" height="54" src="{{ asset("images/stacks/{$lib->stack}.svg") }}">
        <div class="card-body">
            <h2 class="card-title">{!! $lib->title !!} ({{ Str::ucfirst($lib->stack) }})</h2>
            <p class="card-text">
                {!! $lib->description !!}
            </p>
        </div>
        <div class="card-footer">
            <div class="download">
                <i class="fa fa-download" aria-hidden="true"></i>
                <span>{{ number_format($lib->downloads) }}</span>
            </div>
            <div class="star-rating">
                <div class="back-stars">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <div class="front-stars" style="width: {!! $lib->stars !!}%;">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
