@extends('panelbase')
    @section('title')
        <title>Blogguru | Trash Post</title>
    @endsection
    
    @section('content')
        @if(!$posts->isEmpty())
            <div class="table-responsive">
                <table class="table  table-striped text-center mt-4">
                    <caption>List of Trashed Posts</caption>
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        @if(session()->get('role') == 'admin')
                            <th scope="col">Author</th>
                        @endif
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Image</th>
                        <th scope="col">Delete Date</th>
                        <th scope="col">Restore</th>
                        <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <th>{{ $post->id }}</th>
                                @if(session()->get('role') == 'admin')
                                    <td>{{ $post->author->name }}</td>
                                @endif
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category->category }}</td>
                                <td><img class="mx-auto" width="150px" src="/cms-blog/public/image/{{ $post->photo_id ? $post->photo->file_name : 'Null' }}" alt=""></td>
                                <td>{{ date_format(date_create($post->deleted_at),"d M, Y | h:iA") }}</td>
                                <td><a href="{{ route('restorepost', $post->id)}}"><i class="fas fa-trash-restore"></i></a></td>
                                <td><a onclick="javascript: return confirm('Are sure want to delete?')" href="{{ route('removepost', $post->id) }}"><i class="fas fa-trash-alt text-danger"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $posts->links() }}
        @else
            <div class="display-4 mt-4 text-center">No Trash available</div>
        @endif
    @endsection