@extends('site.app')
@section('title', $category->name)
@section('content')
    @livewire('collection', ['category' => $category, 'brands' => $brands])
@endsection
