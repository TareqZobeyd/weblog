@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">Edit Post</h1>

            <form action="{{ route('home.update', $post) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
                </div>
                <div class="form-group">
                    <label for="text" class="form-label">Text</label>
                    <textarea name="text" id="text" class="form-control" rows="5" required>{{ $post->text }}</textarea>
                </div>
                <div class="form-group">
                    <label for="tags" class="form-label">Tags</label>
                    <select name="tags[]" id="tags" class="form-control" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
        </div>
    </div>
</div>
@endsection
