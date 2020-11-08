@extends('panelbase')
    @section('title')
        <title>Blogguru | Categories</title>
    @endsection
    
    @section('content')
      
        <div class="row mt-3">
            <div class="col-sm-8 col-md-6">
                {!! Form::open(['url' => route('addcategory')]) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Category</span>
                        </div>
                        {{ Form::text('category',"", ['class' => 'form-control', 'required']) }}
                        <div class="input-group-append">
                            {{ Form::submit('Add', ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                    @error('category')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                {!! Form::close() !!}

                <div class="table-responsive mt-4">
                    <table class="table">
                        <caption>List of Categories</caption>
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            @if(session()->get('role') == 'admin')
                                <th scope="col">Delete</th>
                            @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $categorie)
                                <tr>
                                    <th>{{ $categorie->id }}</th>
                                    <td>{{ $categorie->category }}</td>
                                    @if(session()->get('role') == 'admin')
                                        <td><a onclick="javascript: return confirm('Are sure want to delete?')" href="{{ route('deletecategory', $categorie->id ) }}"><i class="fas fa-trash-alt text-danger"></i></a></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        

    @endsection