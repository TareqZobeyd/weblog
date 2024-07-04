@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">Create Post</h1>

            <form action="{{ route('home.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="text" class="form-label">Text</label>
                    <textarea name="text" id="text" class="form-control" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="tags" class="form-label">Tags</label>
                    <select name="tags[]" id="tags" class="form-control" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Post</button>
            </form>
        </div>
    </div>
</div>
@endsection
