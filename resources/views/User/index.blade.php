@extends('panelbase')
    @section('title')
        @if(session()->get('role') == 'admin')
            <title>Blogguru | Admin</title>
        @else
            <title>Blogguru | User</title>
        @endif 
    @endsection
    
    @section('content')
        <div class="row mt-4 justify-content-center">
            <div class="col-8 col-sm-6 col-md-4 col-xl-3 p-2">
                <div class="card bg-primary text-light">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <i class="fas fa-columns fa-3x"></i>
                            </div>
                            <div class="col-5 offset-4 text-center">
                                <div class="h3 mb-0">{{ $stat['posts_count'] }}</div>
                                <p class=''>Posts</p>
                            </div>
                        </div>
                    </div>
                
                    <a id="card-link" href="{{ route('allpost') }}">
                        <div class="card-footer bg-light text-primary">
                            <span style="text-decoration: none" class="">View Details</span>
                            <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                        </div>
                    </a>
                </div>
            </div>

            @if (session()->get('role') == 'admin')
                <div class="col-8 col-sm-6 col-md-4 col-xl-3 p-2">
                    <div class="card bg-secondary text-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <i class="far fa-file-alt fa-3x"></i>
                                </div>
                                <div class="col-7 offset-2 text-center">
                                    <div class="h3 mb-0">{{ $stat['own_posts_count'] }}</div>
                                    <p>Own Posts</p>
                                </div>
                            </div>
                        </div>
                    
                        <a id="card-link" href="{{ route('ownpost') }}">
                            <div class="card-footer bg-light text-secondary">
                                <span style="text-decoration: none" class="">View Details</span>
                                <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

            <div class="col-8 col-sm-6 col-md-4 col-xl-3 p-2">
                <div class="card bg-success text-light">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <i class="far fa-comments fa-3x"></i>
                            </div>
                            <div class="col-7 offset-2 text-center">
                                <div class="h3 mb-0">{{ $stat['comments_count'] }}</div>
                                    <p>Comments</p>
                            </div>
                        </div>
                    </div>
                
                    <a id="card-link" href="{{ route('usercomments') }}">
                        <div class="card-footer bg-light text-success">
                            <span style="text-decoration: none" class="">View Details</span>
                            <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-8 col-sm-6 col-md-4 col-xl-3 p-2">
                <div class="card bg-warning text-light">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <i class="fas fa-list-ul fa-3x"></i>
                            </div>
                            <div class="col-7 offset-2 text-center">
                                <div class="h3 mb-0">{{ $stat['categories_count'] }}</div>
                                <p>Categories</p>
                            </div>
                        </div>
                    </div>
                
                    <a id="card-link" href="{{ route('categories') }}">
                        <div class="card-footer bg-light text-warning">
                            <span style="text-decoration: none" class="">View Details</span>
                            <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                        </div>
                    </a>
                </div>
            </div>

            @if (session()->get('role') == 'admin')
                <div class="col-8 col-sm-6 col-md-4 col-xl-3 p-2">
                    <div class="card bg-danger text-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fas fa-user fa-3x"></i>
                                </div>
                                <div class="col-6 offset-3 text-center">
                                    <div class="h3 mb-0">{{ $stat['users_count'] }}</div>
                                    <p>Users</p>
                                </div>
                            </div>
                        </div>
                    
                        <a id="card-link" href="{{ route('usershow') }}">
                            <div class="card-footer bg-light text-danger">
                                <span style="text-decoration: none" class="">View Details</span>
                                <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load("current", {packages:['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ["Element", "Amount", { role: "style" } ],
                            ["Posts", {{ $stat['posts_count'] }}, "#007bff"],
                            @if (session()->get('role') == 'admin')
                                ["Own Posts", {{ $stat['own_posts_count'] }}, "#6c757d"],
                            @endif
                            
                            ["Comments", {{ $stat['comments_count'] }}, "#28a745"],
                            ["Categories", {{ $stat['categories_count'] }}, "#ffc107"],
                            @if (session()->get('role') == 'admin')
                                ["Users", {{ $stat['users_count'] }}, "dc3545"]
                            @endif
                           
                        ]);

                        var view = new google.visualization.DataView(data);
                        view.setColumns([0, 1,
                                        { calc: "stringify",
                                            sourceColumn: 1,
                                            type: "string",
                                            role: "annotation" },
                                        2]);

                        var options = {
                            title: "",
                            width: '100%',
                            height: 400,
                            bar: {groupWidth: "80%"},
                            legend: { position: "none" },
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                        chart.draw(view, options);
                    }
                    </script>
                    <div id="columnchart_values" style="width: 100%; height: 300px;"></div>
            </div>
        </div>
       
    @endsection