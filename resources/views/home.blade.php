@extends('base')
    @section('title')
        <title>Blogguru | Home</title>
    @endsection
    @section('content')
           
        @if (!$posts->isEmpty())
                <div class="card-columns">
                        @foreach ($posts as $post)
                            <div class="card">
                               @if ($post->photo_id)
                               <img src="/cms-blog/public/image/{{ $post->photo->file_name }}" class="card-img-top" alt="{{ $post->title }}">
                               @endif
                                <div class="card-body">
                                  <h5 style="font-weight: 600;" class="card-title mb-0">{{ $post->title }}</h5>
                                  <div class="d-flex justify-content-between">
                                      <small class="text-muted">by <a href="#">{{ $post->author->name }}</a></small>
                                      <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>                                  
                                  </div>
                                  <p class="card-text">
                                          {!! $post->content_limit !!}
                                  </p>
                                  <a href="{{ route('showpost', $post->slug) }}" class="btn btn-sm btn-primary btn-block">Read more</a>
                                </div>
                            </div>      
                        @endforeach     
                    </div>
                 {{ $posts->links() }}
        @else
            <div class="display-4 mt-4 text-center">No Post available</div>
        @endif

    @endsection