@if($previousUrl || $nextUrl)
    <div class="pagination">
        <div class="pagination_buttons">
            @if($previousUrl)
                <a class="pagination_button -previous" href="{{ url($previousUrl) }}"></a>
            @endif

            @if($nextUrl)
                <a class="pagination_button -next" href="{{ url($nextUrl) }}"></a>
            @endif
        </div>
    </div>
@endif