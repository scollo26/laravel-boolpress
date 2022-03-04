

@extends('layouts.admin')

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
            <div class="col text-center">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-danger">Add new Comic</a>
                
            </div>
            <h1>
                Posts
            </h1>
        </div>
        <div class="row">
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Category</th>
                        <th scope="col">Tags</th>
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
                            <td>{{ $post->category()->first()->name }}</td>
                            <td>
                                @foreach ($post->tags()->get() as $tag)
                                    {{ $tag->name }}
                                @endforeach
                            </td>
                            <td><a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                            </td>
                            <td>
                                @if (Auth::user()->id === $post->user_id)
                                    <a class="btn btn-info" href="{{ route('admin.posts.edit', $post->slug) }}">Modify</a>
                                @endif
                            </td>
                            <td>
                                @if (Auth::user()->id === $post->user_id)
                                    <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-danger" type="submit" value="Delete">
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            <div class="row ">
                <div class="col d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection