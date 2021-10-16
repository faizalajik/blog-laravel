@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
        <div class="card mb-3">
            <div class="form-group">
                <div class="card-header">
                    <h1>{{ $post->title }}</h1>
                </div>
                <div class="card-body">{{$post->content}}</div>
            </div>

        </div>
         <a href="{{ url('post/getBlog/'.$post->id) }}" class="btn btn-warning">
                Suka ({{$post->like}})</a><br><br>
           
           <h2>Kolom Komentar</h2>
                @foreach ($koment as $data)
                 <div class="card mb-3">
        
                <div class="form-group">
                <div class="card-header" >
                    
                    <h3 style="display: inline-block">{{$data->name}} </h3>
                    <h6 style="display: inline-block">- {{$data->created_at}}</h6>
                </div>
                <div class="card-body">{{$data->koment}}</div>
                </div></div>
                @endforeach
            

            
        
       <div class="card mb-3">   
        <form method="post" action="{{ url('post/addComment') }}">
            <div class="card-header">Komentar</div>
            <div class="card-body">
                <div class="form-group">
                {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{$post->id}}"></input>
                    <div class="card-body">
                        <label>Komen</label>
                          <textarea class="form-control" name="comment" >
                            @if($errors->any()){{ old('content') }}@endif
                          </textarea>
                          <br>
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">Koment</button>
                      </div>
                      </div>
                    </div>
            </div>
           
       </div>
    </form>

        </div>
    </div>
</div>
@endsection
