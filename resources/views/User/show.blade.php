@extends('panelbase')
    @section('title')
        <title>Blogguru | Users</title>
    @endsection
    
    @section('content')
        @if(!$users->isEmpty())
            <div class="table-responsive">
                <table class="table  table-striped text-center mt-4">
                    <caption>List of Own Posts</caption>
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Image</th>
                        <th scope="col">Join Date</th>
                        <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th>{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><img class="mx-auto" width="100px" src="/cms-blog/public/image/{{ $user->photo_id ? $user->photo->file_name : 'Null' }}" alt=""></td>
                                <td>{{ date_format(date_create($user->created_at),"d M, Y | h:iA") }}</td>
                                <td><a onclick="javascript: return confirm('Are sure want to delete user?')" href="#"><i class="fas fa-trash-alt text-danger"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        @else
            <div class="display-4 mt-4 text-center">No User available</div>
        @endif
    @endsection