<div class="col-sm-6">
    @if (isset($page_header))
    <h1 class="m-0">{{ $page_header }}</h1>
        @if (isset($page_header_small))
        <small>{{ $page_header_small }}</small>
        @endif
    @else
    <h1 class="m-0">Indefinido</h1>
    @endif
</div>