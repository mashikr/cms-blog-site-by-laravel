@extends('panelbase')
    @section('title')
        <title>Blogguru | Own Post</title>
    @endsection
    
    @section('content')
        @if(!$posts->isEmpty())
            <div class="mb-4">
                <div class="table-responsive">
                    <table class="table  table-striped text-center mt-4">
                        <caption>List of Own Posts</caption>
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Image</th>
                            <th scope="col">Create Date</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Trash</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th>{{ $post->id }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->category->category }}</td>
                                    <td><img class="mx-auto" src="/cms-blog/public/image/{{ $post->photo_id ? $post->photo->file_name : 'image-error.png' }}" alt=""></td>
                                    <td>{{ date_format(date_create($post->created_at),"d M, Y | h:iA") }}</td>
                                    <td><a href="{{ route('editpost', $post->slug) }}"><i class="fas fa-edit"></i></a></td>
                                    <td><a onclick="javascript: return confirm('Are sure want to send trash?')" href="{{ route('deletepost', $post->id) }}"><i class="fas fa-trash-alt text-danger"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $posts->links() }}
            </div>
        @else
            <div class="display-4 mt-4 text-center">No Post available</div>
        @endif
    @endsection