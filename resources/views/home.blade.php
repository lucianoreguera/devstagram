@extends('layouts.app')

@section('title')
    Página Principal
@endsection

@section('content')
    <x-list-post :posts="$posts" />
@endsection
