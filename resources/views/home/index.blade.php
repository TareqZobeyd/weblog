@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">Weblog</h1>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('home.create') }}" class="btn btn-primary mb-4">Add New Post</a>
                <a href="{{ route('tags.create') }}" class="btn btn-primary mb-4">Add New Tag</a>

                <hr>

                <h2>Posts</h2>
                @forelse($posts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->text }}</p>
                            <p class="card-text">
                                <small class="text-muted">
                                    Posted by {{ $post->user->name }} on {{ $post->created_at->format('d M Y') }}
                                </small>
                            </p>

                            <!-- Display Tags -->
                            <div>
                                <strong>Tags:</strong>
                                @foreach($post->tags as $tag)
                                    <span class="badge badge-info">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                            <br>
                            <a href="{{ route('home.edit', $post) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('home.destroy', $post) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                            <!-- Comment Form -->
                            <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-3">
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control" name="content" rows="3" placeholder="Add a comment..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Comment</button>
                            </form>

                            <!-- List Comments -->
                            <div class="mt-3">
                                @forelse($post->comments as $comment)
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-text">{{ $comment->content }}</p>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    Comment by {{ $comment->user->name }} on {{ $comment->created_at->format('d M Y') }}
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <p>No comments yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning" role="alert">
                        No posts available.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
