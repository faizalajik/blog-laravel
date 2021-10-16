    @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-3">
    <a href="{{ url('/post/create') }}" class="btn btn-primary">Create new post</a>

</div>
             @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message') }}
                </div>
            @endif

            @foreach ($posts as $post)
        <div class="card mb-3">
            <div class="card-header">
                <h2>{{ $post->title }}</h2></div>
            <div class="card-body">{{ str_limit($post->content,200,'...') }}</div>

             <div class="card-footer">

                        <form action="{{ url('post/' . $post->id) }}" method="post" style="display: inline-block">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!}
                            <button class="btn btn-danger">Delete</button>
                        </form>
                <a href="{{ url('/post/detail/'.$post->id) }}" class="btn btn-primary">
                Detail</a>
                <a href="{{ url('/post/edit/'.$post->id) }}" class="btn btn-primary">
                Edit</a>
                <a href="{{ url('/post/getBlog/'.$post->id) }}" class="btn btn-warning">
                Suka ({{$post->like}})</a>
                    </div>
        </div>

    @endforeach


        </div>
    </div>
</div>
@endsection
