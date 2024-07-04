@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Tag</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tags.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Tag</button>
                    </form>
                </div>
            </div>

            <hr>

            <div class="card mt-4">
                <div class="card-header">All Tags</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($tags as $tag)
                            <li class="list-group-item">{{ $tag->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
