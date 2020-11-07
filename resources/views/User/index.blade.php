@extends('panelbase')
    @section('title')
        @if(session()->get('role') == 'admin')
            <title>Blogguru | Admin</title>
        @else
            <title>Blogguru | User</title>
        @endif 
    @endsection
    
    @section('content')
       {{ session()->get('role') }}
       
    @endsection