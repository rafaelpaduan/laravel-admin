<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item active"><a href="{{ Route('home') }}">Home</a></li>
        
        @if (isset($breadcrumb))
            @foreach ($breadcrumb as $item)
                @if ($item['route'] == "")
                    <li class="breadcrumb-item active">{{$item['nome']}}</li>
                @else
                    <li class="breadcrumb-item"><a href="{{ Route($item['route']) }}">{{$item['nome']}}</a></li>
                @endif
            @endforeach
        @endif
    </ol>
</div>