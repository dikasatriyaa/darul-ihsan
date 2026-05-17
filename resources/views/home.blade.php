@extends('layouts.app')

@section('content')
    <x-section-title />
    <x-feature-card />
    <x-blog-card :blogs="$blogs" />
    <x-faq-item />
@endsection
