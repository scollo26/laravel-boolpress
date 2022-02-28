@extends('layouts.app')



@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <a  class="btn btn-danger"  aria-current="page" href="{{ route('admin.posts.create') }}">Back</a>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <h1>Titolo: {{ $post->title }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2>Autore: {{ $post->author }}</h2>
                <div><h2>Text: {{  $post->content }} </h2>
                    <div>{{ $post->slug }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection