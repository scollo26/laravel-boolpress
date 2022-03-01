{{-- @extends('layouts.app')

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
    
@endsection --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-danger">Add new Comic</a>
                <h1>
                    Posts
                </h1>
            </div>
        </div>
        <div class="row">
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th colspan="3" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->updated_at }}</td>
                            <td><a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                            </td>
                            <td><a class="btn btn-info" href="{{ route('admin.posts.edit', $post->slug) }}">Modify</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger" type="submit" value="Delete">
                                </form>

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection