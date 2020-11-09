<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @yield('title')

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

        <style>
            body {
                font-family: 'Nunito';
            }
          
            @media (min-width: 576px) {
                .card-columns {
                    -webkit-column-count: 2;
                    -moz-column-count: 2;
                    column-count: 2;
                }
            }

            @media (min-width: 1200px) {
                .card-columns {
                    -webkit-column-count: 3;
                    -moz-column-count: 3;
                    column-count: 3;
                }
            }
 
        </style>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <a class="navbar-brand" href="{{ route('home') }}">Blogguru</a>
                  
                  <ul class="navbar-nav flex-row ml-auto">
                        @if(session()->has('user_email'))
                            <li class="nav-item">
                                <a href="{{ route('user') }}" class="nav-link">Dashboard</a>
                            </li>
                        @else 
                            <li class="nav-item mr-2">
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                            </li>
                        
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                            </li>
                        @endif          
                      
                  </ul>
            </nav>

            <div class="row my-4">
                <div class="col-md-9 mb-4">
                    @yield('content')
                </div>
                <div class="col-md-3 border-left">
                    <form action="">
                        <div class="input-group">
                            {{ Form::text('search',"", ['placeholder' => 'Search..', 'class' => 'form-control', 'required']) }}
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>                            
                        </div>
                    </form>

                    <div class="jumbotron mt-3">
                        <h5 class="text-center border-bottom mb-2 pb-1">Categories</h5>

                        @if(!$categories->isEmpty())
                            @foreach ($categories as $category)
                                <a href="#" class="btn btn-sm btn-light mb-2">{{ $category->category }}</a>   
                            @endforeach
                        @else
                            <div class="text-center">No category available</div>
                        @endif
                    </div>
                </div>
            </div>

            <footer>
                <div class="py-2 text-center lead bg-light">Copyright &copy; Blogguru {{ date("Y") }}</div>
            </footer>
        </div>            

    </div>
</body>
</html>