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
            <div class="col-8 col-sm-6 col-md-4 p-2">
                <div class="card bg-primary text-light">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <i class="fas fa-columns fa-5x"></i>
                            </div>
                            <div class="col-4 offset-5 text-center">
                                <div class="display-4">8</div>
                                <div class='lead'>Posts</div>
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
                <div class="col-8 col-sm-6 col-md-4 p-2">
                    <div class="card bg-secondary text-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <i class="far fa-file-alt fa-5x"></i>
                                </div>
                                <div class="col-6 offset-3 text-center">
                                    <div class="display-4">8</div>
                                    <div class='lead'>Own Posts</div>
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

            <div class="col-8 col-sm-6 col-md-4 p-2">
                <div class="card bg-success text-light">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <i class="far fa-comments fa-5x"></i>
                            </div>
                            <div class="col-6 offset-3 text-center">
                                <div class="display-4">8</div>
                                <div class='lead'>Comments</div>
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

            <div class="col-8 col-sm-6 col-md-4 p-2">
                <div class="card bg-warning text-light">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <i class="fas fa-list-ul fa-5x"></i>
                            </div>
                            <div class="col-6 offset-3 text-center">
                                <div class="display-4">8</div>
                                <div class='lead'>Categories</div>
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
                <div class="col-8 col-sm-6 col-md-4 p-2">
                    <div class="card bg-danger text-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fas fa-user fa-5x"></i>
                                </div>
                                <div class="col-6 offset-3 text-center">
                                    <div class="display-4">8</div>
                                    <div class='lead'>Users</div>
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
                            ["Element", "Density", { role: "style" } ],
                            ["Copper", 8.94, "#b87333"],
                            ["Silver", 10.49, "silver"],
                            ["Gold", 19.30, "gold"],
                            ["Platinum", 21.45, "color: #e5e4e2"],
                            ["Platinum", 21.45, "color: #e5e4e2"]
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