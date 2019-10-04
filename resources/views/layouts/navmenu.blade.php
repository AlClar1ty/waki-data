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
<!-- pop up modal -->
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
<!-- end pop up modal -->

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