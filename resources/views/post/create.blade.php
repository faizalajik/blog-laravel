  @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
               @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              <form method="post" action="{{ url('/post/store') }}">

                  {{ csrf_field() }}

                  <div class="form-group">
                      <label>Title</label>
                      <input class="form-control" name="title" value="@if($errors->any()){{ old('title')}}@endif"></input>
                  </div>

                  <div class="form-group">
                      <label>Content</label>
                      <textarea class="form-control" name="content" >
                        @if($errors->any()){{ old('content') }}@endif
                      </textarea>
                  </div>

                  <div class="form-group">
                      <button type="submit" class="btn btn-primary">Save</button>
                  </div>
              </form>

            </div>
        </div>
    </div>
@endsection