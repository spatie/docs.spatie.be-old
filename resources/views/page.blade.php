@extends("_layouts.{$layout}")

@section('title', $title)

@section('content')
    <h1 id="{{ str_slug($title) }}">
        {{ $title }} <a href="#{{ str_slug($title) }}" class="anchor-link"></a>
    </h1>
    {!! $content !!}
@endsection
