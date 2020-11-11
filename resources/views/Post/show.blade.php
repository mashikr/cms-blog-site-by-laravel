@extends('base')
    @section('title')
        <title>Blogguru | Post</title>
    @endsection
    @section('content')
        <div class="row my-4" id="h-95">
            <div class="col-md-9 mb-4">   
                @if ($post)
                    @if ($post->photo_id)
                    <img style="max-height: 300px" src="/cms-blog/public/image/{{ $post->photo->file_name }}" class="img-fluid mx-auto" alt="{{ $post->title }}">
                    @endif
                    <h5 class="mt-2 mb-0">{{ $post->title }}</h5>
                    <div class="d-flex justify-content-between">
                        <p class="text-muted">by <a href="{{ route('userpost', $post->author->id) }}">{{ $post->author->name }}</a></p>
                        <p class="text-muted">{{ $post->created_at->diffForHumans() }}</p>                                  
                    </div>

                    {!! $post->content !!}

                        <form action="{{ route('commentbox') }}" method="post">
                            <fieldset class="border p-2 rounded">
                                <legend class="w-auto lead">Comment</legend>
                                @csrf
                                <input type="hidden" name="post_id" id="" value="{{ $post->id }}">
                                <div class="form-group d-flex">
                                    <textarea name="comment" id="" cols="" placeholder="Leave your comment" rows="1" class="form-control mr-2" required></textarea>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </fieldset>
                        </form>

                        <div class="p-2 mt-4">
                            @if (!$comments->isEmpty())
                                @foreach ($comments as $comment)
                                    <div class="media mb-2">
                                        <img class="mr-3" style="max-height: 64px; max-width: 64px;" src="/cms-blog/public/image/{{ $comment->author->photo->file_name }}" alt="Generic placeholder image">
                                        <div class="media-body">
                                        <h5 class="my-0">{{ $comment->author->name }}</h5>
                                       {{ $comment->comment }}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                @else
                    <div class="display-4 mt-4 text-center">No Post available</div>
                @endif
            </div>
            <div class="col-md-3 border-left">
                @include('sidebar')
            </div>
        </div>
    @endsection