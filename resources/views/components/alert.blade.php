<div class="be-toast" style="top: {{ ($no * 95) }}px;">
    <div class="be-toast-div" style="border-left-color: {{ $color }};">
        <div class="be-toast-header">
            <img src="{{ asset("images/alert/{$type}.svg") }}" alt="{{ $type }}" width="24px" height="24px">
            <strong>{{ $title }}</strong>
        </div>
        <div class="be-toast-body">
            <p>
                {{ $text }}
            </p>
        </div>
    </div>
</div>
