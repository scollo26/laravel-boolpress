@extends('layouts.admin')



@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <h1>Titolo: </h1>
                <h4>{{ $post->title }}</h4> 
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2>Autore:</h2>
                <h4>{{ $post->author }}</h4> 
                <div><h2>Text:  </h2>
                    <h4>{{  $post->content }}</h4> 
                    <h2>Category: {{ $post->category()->first()->name }} </h2>
                    {{-- <div>{{ $post->slug }}</div> --}}
                </div>
                <div>
                    <h2>Tags:
                        @foreach ($post->tags()->get() as $tag)
                            {{ $tag->name }},
                        @endforeach 
                    </h2>
                    
                </div>
            </div>
            
        </div>
        <a  class="btn btn-danger"  aria-current="page" href="{{ route('admin.posts.index') }}">Back</a>
    </div>
@endsection