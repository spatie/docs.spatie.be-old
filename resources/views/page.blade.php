@extends("_layouts.{$layout}")

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    {!! $content !!}
@endsection
