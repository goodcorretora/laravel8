@extends('admin.layouts.app')

@section('title', 'Cadastrar Novo Post')

@section('content')
    <h1>Cadastrar Novo Post</h1>


    <form action="{{ route('posts.store') }}" method="post">
        @include('admin.posts._partials.form')
    </form>
@endsection