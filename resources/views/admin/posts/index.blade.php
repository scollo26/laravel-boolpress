@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="row">
            <div class="col">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-danger">Add new Comic</a>
            </div>
            
        </div>
        <div class="col-7">
            <ul class="list-group">
            @foreach ($posts as $post)
                <li class="list-group-item mt-4 mb-4">
                    <h2>Title: {{$post->title}}</h2>
                    <h2>Author: {{$post->author}}</h2>
                    <h2>Content: {{$post->content}}</h2>
                    <h2>{{$post->slug}}</h2>
                    <a class="btn btn-danger" href="{{ route('admin.posts.show', $post->id) }}">View</a>
                </li>
                
            @endforeach
            </ul>
        </div>

    </div>

</div>
    
@endsection
{{-- @dd($posts) --}}