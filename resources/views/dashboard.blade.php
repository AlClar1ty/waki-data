@extends('layouts.template')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/chart/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
@endsection
@section('navmenu')
    @if(Gate::check('dashboard'))
    <li class="list-selected">Dashboard</li>
    @endif

    @if(Gate::check('master-data'))
    <li> <a href="{{route('data')}}">Master Data</a></li>
    @endif

    @if(Gate::check('master-data-type'))
    <li> <a href="{{route('type_cust')}}">Master Data Type</a></li>
    @endif

    @if(Gate::check('master-branch'))
    <li> <a href="{{route('branch')}}">Master Branch</a></li>
    @endif

    @if(Gate::check('master-cso'))
    <li> <a href="{{route('cso')}}">Master CSO</a></li>
    @endif

    @if(Gate::check('master-user'))
    <li> <a href="{{route('user')}}">Master User</a></li>
    @endif

    @if(Gate::check('report'))
    <li>
        <a href="javascript:void(0)" class="dropdown-btn" style="display:block">Report<i class="fa fa-caret-down" 
            style="float:right;margin-top:15px;margin-right:20px;"></i></a>
        <div class="dropdown-container" style="display:none;">
            <ul>
                <li data-target="#modal-report-undangan" data-toggle="modal">
                    <a href="#">Data Undangan</a>
                </li>
                <li data-target="#modal-report-outsites" data-toggle="modal">
                    <a href="#">Data Outsites</a>
                </li>
                <li data-target="#modal-report-theraphy" data-toggle="modal">
                    <a href="#">Data Theraphy</a>
                </li>
            </ul>
        </div>
    </li>
    @endif
<script type="text/javascript">
    $(document).ready(function(){
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
          dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
              dropdownContent.style.display = "none";
            } else {
              dropdownContent.style.display = "block";
            }
          });
        }
    });
</script>
@endsection
@section('content')


<div class="container">
    <div class="col-sm-offset-3 col-lg-offset-2 main">
        
        
        <div class="row">
            <div class="col-xs-12 .col-sm-12 col-md-12 col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div><!--/.row-->
        
        <div class="panel-container">
            <div class="row">
                <div class="col-xs-6 col-md-4 col-lg-4 no-padding">
                    <div class="panel panel-teal panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-users color-blue"></em>
                            <div class="large">{{$dataUndangans}}</div>
                            <div class="text-muted">Data Undangan</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-4 col-lg-4 no-padding">
                    <div class="panel panel-blue panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-arrow-up color-orange"></em>
                            <div class="large">{{$dataOutsites}}</div>
                            <div class="text-muted">Data Out-site</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-4 col-lg-4 no-padding">
                    <div class="panel panel-orange panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-arrow-down color-teal"></em>
                            <div class="large">{{$dataTherapies}}</div>
                            <div class="text-muted">Data Therapy</div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-red panel-widget ">
                        <div class="row no-padding"><em class="fa fa-xl fa-credit-card color-red"></em>
                            <div class="large">{{$mpcs}}</div>
                            <div class="text-muted">MPC</div>
                        </div>
                    </div>
                </div> -->
            </div><!--/.row-->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Graphic Data (6 Months Interval)
                        
                        <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
        
        <!-- <div class="row">
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>Data Undangan</h4>
                        <div class="easypiechart" id="easypiechart-blue" data-percent="100" ><span class="percent">&#x25B2;100%</span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>Data Outsite</h4>
                        <div class="easypiechart" id="easypiechart-orange" data-percent="50" ><span class="percent">&#x25BC;50%</span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>Data Therapy</h4>
                        <div class="easypiechart" id="easypiechart-teal" data-percent="60" ><span class="percent">&#x25B2;60%</span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <h4>MPC</h4>
                        <div class="easypiechart" id="easypiechart-red" data-percent="40" ><span class="percent">&#x25BC;40%</span></div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>
</div>

<div class="modal fade" id="modal-report-undangan" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="top: 30vh;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                    <p style="text-align: center; color: black;">
                        <strong id="model-change-status-questions">Report Data Undangan</strong>
                    </p>
                
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button id="btn-export-dataundangan-excel" type="submit" class="btn btn-primary">Export to Excel</button>
                <button id="btn-export-dataundangan-csv" type="button" class="btn btn-secondary">Export to CSV</button>
            </div>
        </div>
        <!-- //Modal content-->
    </div>
</div>

<div class="modal fade" id="modal-report-outsites" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="top: 30vh;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                    <p style="text-align: center; color: black;">
                        <strong id="model-change-status-questions">Report Data Outsites</strong>
                    </p>
                
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button id="btn-export-dataoutsites-excel" type="submit" class="btn btn-primary">Export to Excel</button>
                <button id="btn-export-dataoutsites-csv" type="button" class="btn btn-secondary">Export to CSV</button>
            </div>
        </div>
        <!-- //Modal content-->
    </div>
</div>

<div class="modal fade" id="modal-report-theraphy" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="top: 30vh;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                    <p style="text-align: center; color: black;">
                        <strong id="model-change-status-questions">Report Data Theraphy</strong>
                    </p>
                
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button id="btn-export-datatheraphy-excel" type="submit" class="btn btn-primary">Export to Excel</button>
                <button id="btn-export-datatheraphy-csv" type="button" class="btn btn-secondary">Export to CSV</button>
            </div>
        </div>
        <!-- //Modal content-->
    </div>
</div>
@endsection

@section('script')
<script>
    window.onload = function () {
        var chart1 = document.getElementById("line-chart").getContext("2d");

        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var d = new Date();
        var m = d.getMonth(); //0 = January, 1 = February, etc.
        var mLabels = [];

        for(i=6; i>=0; i--)
        {
            if(m-i < 0)
            {
                mLabels.push(months[11-(m+1)]);
            }
            else
            {
                mLabels.push(months[m-i]);
            }

        }

        var lineChartData = {
            labels : mLabels,
            datasets : [
                {
                    label: "My First dataset",
                    fillColor : "rgba(48, 164, 255, 0)",
                    strokeColor : "rgba(48, 164, 255, 1)",
                    pointColor : "rgba(48, 164, 255, 1)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(220,220,220,1)",
                    data : [5000,4000,5000,4000,5000,4000,5000]
                },
                {
                    label: "My Second dataset",
                    fillColor : "rgba(255, 181, 62, 0)",
                    strokeColor : "rgba(255, 181, 62, 1)",
                    pointColor : "rgba(255, 181, 62, 1)",
                    pointStrokeColor : "#fff",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(48, 164, 255, 1)",
                    data : [4000,5000,4000,5000,4000,5000,4000]
                },
                {
                    label: "My Third dataset",
                    fillColor : "rgba(30,191,174,0)",           
                    strokeColor : "rgba(30,191,174,1)",
                    pointColor : "rgba(30,191,174,1)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(48, 164, 255, 1)",
                    data : [3000,3000,3000,3000,3000,3000,3000]
                },
                {
                    label: "My Fourth dataset",
                    fillColor : "rgba(239, 64, 64, 0)",
                    strokeColor : "rgba(239, 64, 64, 1",
                    pointColor : "rgba(239, 64, 64, 1)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(48, 164, 255, 1)",
                    data : [2000,2000,2000,2000,2000,2000,2000]
                }
            ]
        }

        var pieData = [
            {
                value: 300,
                color:"#30a5ff",
                highlight: "#62b9fb",
                label: "Blue"
            },
            {
                value: 50,
                color: "#ffb53e",
                highlight: "#fac878",
                label: "Orange"
            },
            {
                value: 100,
                color: "#1ebfae",
                highlight: "#3cdfce",
                label: "Teal"
            },
            {
                value: 120,
                color: "#f9243f",
                highlight: "#f6495f",
                label: "Red"
            }
        ];

        window.myLine = new Chart(chart1).Line(lineChartData, {
            responsive: true,
            scaleLineColor: "rgba(0,0,0,.2)",
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleFontColor: "#c5c7cc",
        });
    };
</script>
<script type="text/javascript">
    $("#btn-export-dataundangan-excel").click(function(e){
        // console.log('zxvzvxc');
        window.location.href = "{{ route('dataundangan-export-to-excel') }}";
    });
    $("#btn-export-dataundangan-csv").click(function(e){
        // console.log('zxvzvxc');
        window.location.href = "{{ route('dataundangan-export-to-csv') }}";
    });

    $("#btn-export-dataoutsites-excel").click(function(e){
        // console.log('zxvzvxc');
        window.location.href = "{{ route('dataoutsites-export-to-excel') }}";
    });
    $("#btn-export-dataoutsites-csv").click(function(e){
        // console.log('zxvzvxc');
        window.location.href = "{{ route('dataoutsites-export-to-csv') }}";
    });

    $("#btn-export-datatheraphy-excel").click(function(e){
        // console.log('zxvzvxc');
        window.location.href = "{{ route('datatherapy-export-to-excel') }}";
    });
    $("#btn-export-datatheraphy-csv").click(function(e){
        // console.log('zxvzvxc');
        window.location.href = "{{ route('datatherapy-export-to-csv') }}";
    });
</script>
@endsection