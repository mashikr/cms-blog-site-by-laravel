<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        @yield('title')
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <link href="/cms-blog/public/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            img {
                max-height: 50px;
                max-width: 150px;
            }

            #card-link:hover {
                text-decoration: none;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('user') }}">Blogguru</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i> {{ session()->get('name') }} </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user fa-fw"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a onclick="javascript: return confirm('Are you sure want to logout?');" class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-power-off fa-fw"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ route('user') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Options</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Post
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('allpost') }}">All Post</a>
                                    @if(session()->get('role') == 'admin')
                                    <a class="nav-link" href="{{ route('ownpost') }}">Own Post</a>
                                    @endif
                                <a class="nav-link" href="{{ route('addpost') }}">Add Post</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="{{ route('categories') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-list-ul"></i></div>
                                Categories
                            </a>
                            <a class="nav-link" href="{{ route('usercomments') }}">
                                <div class="sb-nav-link-icon"><i class="far fa-comments"></i></div>
                                Comments
                            </a>
                            @if(session()->get('role') == 'admin')
                            <a class="nav-link" href="{{ route('usershow') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Users
                            </a>
                            @endif
                            <a class="nav-link" href="{{ route('trash') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-trash-alt"></i></div>
                                Trash
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="text-muted small">Copyright &copy; Blogguru {{ date("Y") }}</div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/cms-blog/public/js/scripts.js"></script>
    </body>
</html>
