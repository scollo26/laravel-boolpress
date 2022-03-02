@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('admin.posts.store') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <select class="form-select" name="category_id">
                            {{-- se la categoria scelta dall'utente precedentemente e' 
                            identica a quella su cui sto girando inserisco
                            l'attributo selected --}}
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                {{-- <option {{ old('category_id') == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}"> --}}
                                <option @if (old('category_id') == $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <h3>Author: {{Auth::user()->name }}</h3>
                        {{-- <label for="author" class="form-label">author</label>
                        <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}"> --}}
                        @error('author')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" rows="3"
                            name="content">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">

                    <input class="btn btn-primary" type="submit" value="Salva">
                    <a  class="btn btn-danger"  aria-current="page" href="{{ route('admin.posts.index') }}">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection