@extends('panelbase')
    @section('title')
        <title>Blogguru | Comments</title> 
    @endsection
    
    @section('content')
        @if(!$comments->isEmpty())
            <div class="mb-4">
                <div class="table-responsive">
                    <table class="table  table-striped text-center mt-4">
                        <caption>List of Comments</caption>
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Post Title</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Create Date</th>
                            <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <th>{{ $comment->id }}</th>
                                    <td><a href="{{ route('showpost', $comment->post->slug) }}">{{ $comment->post->title }}</a></td>
                                    <td>{{ $comment->comment}}</td>
                                    <td>{{ date_format(date_create($comment->created_at),"d M, Y | h:iA") }}</td>
                                    <td><a onclick="javascript: return confirm('Are sure want to send trash?')" href="{{ route('deletecomment', $comment->id) }}"><i class="fas fa-trash-alt text-danger"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               
                    {{-- {{ $posts->links() }} --}}
            </div>
            
        @else
            <div class="display-4 mt-4 text-center">No comment available</div>
        @endif
       
    @endsection