@extends('layout.base')



@section('content')
    <div class="container">
        <div class="row  justify-content-center">
            <div class="col-5 ">
                <form action="{{ route('post.update', $post->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                        <div class="mb-3">
                            <label for="title" class="form-label">title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">author</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{$post->author}}">
                            @error('author')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">content</label>
                            <textarea class="form-control" id="content" name="content" rows="3" >{{$post->content}}</textarea>
                            @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-danger" value="save">Save</button>
                        <a  class="btn btn-danger"  aria-current="page" href="{{ route('comics.index') }}">Back</a>
                    </form>

            </div>
            
        </div>
    </div>

@endsection