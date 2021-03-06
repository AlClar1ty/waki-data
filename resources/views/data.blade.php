<?php use App\Http\Controllers\DataController; ?>
@extends('layouts.template')
@section('css')
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
@endsection
@section('js')
    <script src="{{ asset('js/jquery.tabledit.js') }}"></script>
@endsection
@section('navmenu')
    @if(Gate::check('dashboard'))
    <li> <a href="{{route('dashboard')}}">Dashboard</a></li>
    @endif

    @if(Gate::check('master-data'))
    <li class="list-selected">Master Data</li>
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

<div class="container contact-clean" id="form-addMember">
    <div class="tab-content">
        <ul class="nav nav-tabs">
            @if(Gate::check('find-data-undangan') || Gate::check('browse-data-undangan') || Gate::check('add-data-undangan'))
            <li class="nav-item">
                <a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1" aria-selected="true" onclick="ShowList('1')">Data Undangan</a>
            </li>
            @endif
            @if(Gate::check('find-data-outsite') || Gate::check('browse-data-outsite') || Gate::check('add-data-outsite'))
            <li class="nav-item">
                <a class="nav-link" role="tab" data-toggle="tab" href="#tab-2" aria-selected="true" onclick="ShowList('2')">Data Out-Site</a>
            </li>
            @endif
            @if(Gate::check('find-data-therapy') || Gate::check('browse-data-therapy') || Gate::check('add-data-therapy'))
            <li class="nav-item">
                <a class="nav-link" role="tab" data-toggle="tab" href="#tab-3" aria-selected="true"onclick="ShowList('3')">Data Therapy</a>
            </li>
            @endif
            <!-- @if(Gate::check('find-mpc') || Gate::check('browse-mpc') || Gate::check('add-mpc'))
            <li class="nav-item">
                <a class="nav-link" role="tab" data-toggle="tab" href="#tab-4" aria-selected="true"onclick="ShowList('4')">MPC</a>
            </li>
            @endif -->
        </ul>
        <div class="tab-pane active" role="tabpanel" id="tab-1">
            @if(Gate::check('find-data-undangan'))
            <form action="{{ url()->current() }}" style="display: block;float: inherit;">
                <h1 style="text-align: center;color: rgb(80, 94, 108);">Find Data Undangan</h1>
                <br>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                    <input class="form-control" type="number" placeholder="Search by Phone Number..." style="height: 46.8px;" name="numberDataUndangan" id="txt-numberDataUndangan" value="{{ app('request')->input('numberDataUndangan') }}">
                    <div class="input-group-append">
                        <button class="btn btn-light border" type="submit">Search</button>
                    </div>
                    
                    <span class="invalid-feedback">
                        <strong style="margin-left: 40px; font-size: 12pt;"></strong>
                    </span>
                </div>
            </form>
            @endif

            <!-- FORM untuk add/store data undangan -->
            @if(Gate::check('add-data-undangan'))
            <form id="actionAddDataUndangan" name="frmAddDataUndangan" method="POST" action="{{ route('store_dataundangan') }}">
                {{ csrf_field() }}

                <h1 class="text-center" style="margin-bottom: .5rem;">Add Data Undangan</h1>
                <br>
                <div class="form-group">
                    <span>TIPE UNDANGAN</span>
                    <select id="txttype-cust-dataundangan" class="text-uppercase form-control" name="type_cust" value="" required>
                        <optgroup label="TIPE UNDANGAN"> 
                            <option value="" disabled selected>SELECT TIPE UNDANGAN</option>
                            @foreach ($type_custs as $type_cust)
                                @if($type_cust->type_input == "UNDANGAN")
                                    <option value="{{$type_cust->id}}">{{$type_cust->name}}</option>
                                @endif
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <div id="input-DataUndangan" class="d-none">
                    <div class="form-group">
                        <span>REGISTRATION DATE</span>
                        <div id="div_test" class="col-md-12 center-block" style="padding: 0;">
                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                            <select class="text-uppercase form-control reg_day_und" name="registration_day">
                                <option value="" selected="selected" disabled="disabled" required>
                                    HARI
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{$i}}" id="{{$i}}">{{$i}}</option>
                                    @endfor
                                </option>
                            </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <select class="text-uppercase form-control reg_month_und" name="registration_month">
                                    <option value="" selected="selected" disabled="disabled" required>
                                        BULAN
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{$i}}" id="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </option>
                                </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <input type="number" name="registration_year" class="form-control text-uppercase reg_year_und" placeholder="TAHUN" required>
                            </div>
                        </div>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>NAME</span>
                        <input type="text" name="name" class="text-uppercase form-control" placeholder="NAME" required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                     <div class="form-group">
                        <span>BIRTH DATE</span>
                        <div class="col-md-12 center-block" style="padding: 0;">
                            <div id="div_test2" class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                            <select class="text-uppercase form-control birth_day_und" name="birth_day">
                                <option value="" selected="selected" disabled="disabled" required>
                                    HARI
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{$i}}" id="{{$i . 'u'}}">{{$i}}</option>
                                    @endfor
                                </option>
                            </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <select class="text-uppercase form-control birth_month_und" name="birth_month">
                                    <option value="" selected="selected" disabled="disabled" required>
                                        BULAN
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{$i}}" id="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </option>
                                </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <input type="number" name="birth_year" class="form-control text-uppercase birth_year_und" placeholder="TAHUN" required>
                            </div>
                        </div>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>

                    <div class="form-group">
                        <span>ADDRESS</span>
                        <textarea name="address" class="text-uppercase form-control form-control-sm" placeholder="Address" required></textarea>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <!-- <div id="Undangan-Bank" class="form-group">
                        
                    </div> -->
                    <div class="form-group frm-group-select">
                        <span>COUNTRY</span>
                        <select id="txtcountry-dataundangan" class="text-uppercase form-control" name="country" required>
                            <optgroup label="Country">
                                @include('etc.select-country')
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select select-right">
                        <span>BRANCH</span>
                        <select id="txtbranch-dataundangan" class="text-uppercase form-control" name="branch" required>
                            <optgroup label="Branch">
                                @can('all-branch-data-undangan')
                                    @can('all-country-data-undangan')
                                        <option value="" disabled selected>SELECT COUNTRY FIRSTz</option>
                                    @endcan
                                    @cannot('all-country-data-undangan')
                                        <option value="" selected disabled>SELECT YOUR OPTION</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{$branch->id}}" {{($branch->id == Auth::user()->branch_id ? "selected" : "")}}>{{$branch->code}} - {{$branch->name}}</option>
                                        @endforeach
                                    @endcan
                                @endcan
                                @cannot('all-branch-data-undangan')
                                    <option value="{{Auth::user()->branch_id}}">{{Auth::user()->branch['name']}}</option>
                                @endcan
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>


                    <!-- CSO -->
                    <!-- <div class="form-group">
                        <span>CSO</span>
                        <select id="txtcso-dataundangan" class="text-uppercase form-control" name="cso" required>
                            <optgroup label="Cso">
                                <option value="" selected disabled>SELECT YOUR OPTION</option>
                                @can('all-country-cso')
                                    @foreach ($csos as $cso)
                                        <option value="{{$cso->id}}">{{$cso->name}} - {{$cso->code}}</option>
                                    @endforeach
                                @endcan
                                @cannot('all-country-cso')
                                    @foreach ($csos as $cso)
                                        @if($cso->branch['country'] == Auth::user()->branch['country'])
                                            <option value="{{$cso->id}}">{{$cso->name}} - {{$cso->code}}</option>
                                        @endif
                                    @endforeach
                                @endcan
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div> -->

                    <!-- Khusus untuk Indo untuk sementara -->
                    <!-- <div class="form-group frm-group-select">
                        <span>PROVINCE</span>
                        <select id="txtprovince-dataundangan" class="text-uppercase form-control" name="province" required>
                            <optgroup label="Province">
                                @include('etc.select-province')
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div> -->
                    <!-- <div class="form-group frm-group-select select-right">
                        <span>DISTRICT</span>
                        <select id="txtdistrict-dataundangan" class="form-control text-uppercase" name="district"required>
                            <optgroup label="District">
                                <option disabled selected>SELECT PROVINCE FIRST</option>
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div> -->

                    <div class="form-group">
                        <span>PHONE</span>
                        <input type="number" name="phone" class="form-control" placeholder="0XXXXXXXXXXX" required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <button id="btn-actionAddDataUndangan" class="btn btn-primary" type="submit" name="submit">SAVE</button>
                    </div>
                </div>
            </form>
            @endif

        </div>
        <div class="tab-pane" role="tabpanel" id="tab-2">
            @if(Gate::check('find-data-outsite'))
            <form action="{{ url()->current() }}" style="display: block;float: inherit;">
                <h1 style="text-align: center;color: rgb(80, 94, 108);">Find Data Out-Site</h1>
                <br>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                    <input class="form-control" type="text" name="numberDataOutsites" id="txt-numberDataOutsites" value="{{ app('request')->input('numberDataOutsites') }}" placeholder="Search by Phone Number..." style="height: 46.8px;">
                    <div class="input-group-append">
                        <button class="btn btn-light border" type="submit">Search</button>
                    </div>
                </div>
            </form>
            @endif

            <!-- FORM untuk add/store data Outsite -->
            @if(Gate::check('add-data-outsite'))
            <form id="actionAddDataOutsite" name="frmAddDataOutsite" method="POST" action="{{ route('store_dataoutsite') }}">
                {{ csrf_field() }}

                <h1 class="text-center" style="margin-bottom: .5rem;">Add Data Out-Site</h1>
                <br>
                <div class="form-group">
                    <span>TIPE OUT-SITE</span>
                    <select id="txttype-cust-dataoutsite" class="text-uppercase form-control" name="type_cust" value="" required>
                        <optgroup label="TIPE OUT-SITE"> 
                            <option value="" disabled selected>SELECT TIPE OUT-SITE</option>
                            @foreach ($type_custs as $type_cust)
                                @if($type_cust->type_input == "OUT-SITE")
                                    <option value="{{$type_cust->id}}">{{$type_cust->name}}</option>
                                @endif
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <div id="input-DataOutsite" class="d-none">
                    <div class="form-group">
                        <span>REGISTRATION DATE</span> <br>
                        <div class="col-md-12 center-block" style="padding: 0;">
                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                            <select class="text-uppercase form-control reg_day_out" name="registration_day">
                                <option value="" selected="selected" disabled="disabled" required>
                                    HARI
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{$i}}" id="{{$i . 'o'}}">{{$i}}</option>
                                    @endfor
                                </option>
                            </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <select class="text-uppercase form-control reg_month_out" name="registration_month">
                                    <option value="" selected="selected" disabled="disabled" required>
                                        BULAN
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{$i}}" id="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </option>
                                </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <input type="number" name="registration_year" class="form-control text-uppercase reg_year_out" placeholder="TAHUN" required>
                            </div>
                            <span class="invalid-feedback">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <span>NAME</span>
                        <input type="text" name="name" class="text-uppercase form-control" placeholder="NAME" required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div id="Outsite-Location" class="form-group">
                        
                    </div>
                    <div class="form-group frm-group-select">
                        <span>COUNTRY</span>
                        <select id="txtcountry-dataoutsite" class="text-uppercase form-control" name="country" required>
                            <optgroup label="Country">
                                @include('etc.select-country')
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select select-right">
                        <span>BRANCH</span>
                        <select id="txtbranch-dataoutsite" class="text-uppercase form-control" name="branch" required>
                            <optgroup label="Branch">
                                @can('all-branch-data-outsite')
                                    @can('all-country-data-outsite')
                                        <option value="" disabled selected>SELECT COUNTRY FIRST</option>
                                    @endcan
                                    @cannot('all-country-data-outsite')
                                        <option value="" selected disabled>SELECT YOUR OPTION</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{$branch->id}}" {{($branch->id == Auth::user()->branch_id ? "selected" : "")}}>{{$branch->code}} - {{$branch->name}}</option>
                                        @endforeach
                                    @endcan
                                @endcan
                                @cannot('all-branch-data-outsite')
                                    <option value="{{Auth::user()->branch_id}}">{{Auth::user()->branch['name']}}</option>
                                @endcan
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>


                    <!-- CSO -->
                    <!-- <div class="form-group">
                        <span>CSO</span>
                        <select id="txtcso-dataoutsite" class="text-uppercase form-control" name="cso" required>
                            <optgroup label="Cso">
                                <option value="" selected disabled>SELECT YOUR OPTION</option>
                                @can('all-country-cso')
                                    @foreach ($csos as $cso)
                                        <option value="{{$cso->id}}">{{$cso->name}} - {{$cso->code}}</option>
                                    @endforeach
                                @endcan
                                @cannot('all-country-cso')
                                    @foreach ($csos as $cso)
                                        @if($cso->branch['country'] == Auth::user()->branch['country'])
                                            <option value="{{$cso->id}}">{{$cso->name}} - {{$cso->code}}</option>
                                        @endif
                                    @endforeach
                                @endcan
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div> -->

                    <!-- Khusus untuk Indo untuk sementara -->
                    <!-- <div class="form-group frm-group-select">
                        <span>PROVINCE</span>
                        <select id="txtprovince-dataoutsite" class="text-uppercase form-control" name="province">
                            <optgroup label="Province">
                                @include('etc.select-province')
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select select-right">
                        <span>DISTRICT</span>
                        <select id="txtdistrict-dataoutsite" class="form-control text-uppercase" name="district">
                            <optgroup label="District">
                                <option disabled selected>SELECT PROVINCE FIRST</option>
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div> -->

                    <div class="form-group">
                        <span>PHONE</span>
                        <input type="number" name="phone" class="form-control" placeholder="0XXXXXXXXXXX" required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <button id="btn-actionAddDataOutsite" class="btn btn-primary" type="submit" name="submit">SAVE</button>
                    </div>
                </div>
            </form>
            @endif            

        </div>
        <div class="tab-pane" role="tabpanel" id="tab-3">
            @if(Gate::check('find-data-therapy'))
            <form action="{{ url()->current() }}" style="display: block;float: inherit;">
                <h1 style="text-align: center;color: rgb(80, 94, 108);">Find Data Therapy</h1>
                <br>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                    <input class="form-control" type="text" name="numberDataTherapy" id="txt-numberDataTherapy" value="{{ app('request')->input('numberDataTherapy') }}" placeholder="Search by Phone Number..." style="height: 46.8px;">
                    <div class="input-group-append">
                        <button class="btn btn-light border" type="submit">Search</button>
                    </div>
                </div>
            </form>
            @endif

            <!-- FORM untuk add/store data Therapy -->
            @if(Gate::check('add-data-therapy'))
            <form id="actionAddDataTherapy" name="frmAddDataTherapy" method="POST" action="{{ route('store_datatherapy') }}">
                {{ csrf_field() }}

                <h1 class="text-center" style="margin-bottom: .5rem;">Add Data Therapy</h1>
                <br>
                <div class="form-group">
                    <span>TIPE THERAPY</span>
                    <select id="txttype-cust-datatherapy" class="text-uppercase form-control" name="type_cust" value="" required>
                        <optgroup label="TIPE THERAPY"> 
                            <option value="" disabled selected>SELECT TIPE THERAPY</option>
                            @foreach ($type_custs as $type_cust)
                                @if($type_cust->type_input == "THERAPY")
                                    <option value="{{$type_cust->id}}">{{$type_cust->name}}</option>
                                @endif
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <span>REGISTRATION DATE</span>
                    <div class="col-md-12 center-block" style="padding: 0;">
                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                            <select class="text-uppercase form-control reg_day_the" name="registration_day">
                                <option value="" selected="selected" disabled="disabled" required>
                                    HARI
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{$i}}" id="{{$i . 't'}}">{{$i}}</option>
                                    @endfor
                                </option>
                            </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <select class="text-uppercase form-control reg_month_the" name="registration_month">
                                    <option value="" selected="selected" disabled="disabled" required>
                                        BULAN
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{$i}}" id="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </option>
                                </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <input type="number" name="registration_year" class="form-control text-uppercase reg_year_the" placeholder="TAHUN" required>
                            </div>
                        </div>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group">
                    <span>NAME</span>
                    <input type="text" name="name" class="text-uppercase form-control" placeholder="NAME" required>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group">
                    <span>ADDRESS</span>
                    <textarea name="address" class="text-uppercase form-control form-control-sm" placeholder="Address" required></textarea>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group frm-group-select">
                    <span>COUNTRY</span>
                    <select id="txtcountry-datatherapy" class="text-uppercase form-control" name="country" required>
                        <optgroup label="Country">
                            @include('etc.select-country')
                        </optgroup>
                    </select>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group frm-group-select select-right">
                    <span>BRANCH</span>
                    <select id="txtbranch-datatherapy" class="text-uppercase form-control" name="branch" required>
                        <optgroup label="Branch">
                            @can('all-branch-data-therapy')
                                @can('all-country-data-therapy')
                                    <option value="" disabled selected>SELECT COUNTRY FIRST</option>
                                @endcan
                                @cannot('all-country-data-therapy')
                                    <option value="" selected disabled>SELECT YOUR OPTION</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{$branch->id}}" {{($branch->id == Auth::user()->branch_id ? "selected" : "")}}>{{$branch->code}} - {{$branch->name}}</option>
                                    @endforeach
                                @endcan
                            @endcan
                            @cannot('all-branch-data-therapy')
                                <option value="{{Auth::user()->branch_id}}">{{Auth::user()->branch['name']}}</option>
                            @endcan
                        </optgroup>
                    </select>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>


                <!-- CSO -->
                <!-- <div class="form-group">
                    <span>CSO</span>
                    <select id="txtcso-datatherapy" class="text-uppercase form-control" name="cso" required>
                        <optgroup label="Cso">
                            <option value="" selected disabled>SELECT YOUR OPTION</option>
                                @can('all-country-cso')
                                    @foreach ($csos as $cso)
                                        <option value="{{$cso->id}}">{{$cso->name}} - {{$cso->code}}</option>
                                    @endforeach
                                @endcan
                                @cannot('all-country-cso')
                                    @foreach ($csos as $cso)
                                        @if($cso->branch['country'] == Auth::user()->branch['country'])
                                            <option value="{{$cso->id}}">{{$cso->name}} - {{$cso->code}}</option>
                                        @endif
                                    @endforeach
                                @endcan
                        </optgroup>
                    </select>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div> -->

                <!-- Khusus untuk Indo untuk sementara -->
                <!-- <div class="form-group frm-group-select">
                    <span>PROVINCE</span>
                    <select id="txtprovince-datatherapy" class="text-uppercase form-control" name="province" required>
                        <optgroup label="Province">
                            @include('etc.select-province')
                        </optgroup>
                    </select>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group frm-group-select select-right">
                    <span>DISTRICT</span>
                    <select id="txtdistrict-datatherapy" class="form-control text-uppercase" name="district"required>
                        <optgroup label="District">
                            <option disabled selected>SELECT PROVINCE FIRST</option>
                        </optgroup>
                    </select>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div> -->

                <div class="form-group">
                    <span>PHONE</span>
                    <input type="number" name="phone" class="form-control" placeholder="0XXXXXXXXXXX" required>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group">
                    <button id="btn-actionAddDataTherapy" class="btn btn-primary" type="submit" name="submit">SAVE</button>
                </div>
            </form>
            

        </div>
        @endif
        <div class="tab-pane" role="tabpanel" id="tab-4">
            @if(Gate::check('find-mpc'))
            <form id="actionFindMpc" name="FindMpc" action="{{ route('find_mpc') }}" style="display: block;float: inherit;">
                <h1 style="text-align: center;color: rgb(80, 94, 108);">Find MPC</h1>
                <br>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                    <input class="form-control" type="text" name="find" placeholder="Search by Phone Number..." style="height: 46.8px;">
                    <div class="input-group-append">
                        <button class="btn btn-light border" type="submit">Search</button>
                    </div>
                </div>
            </form>
            @endif

            <!-- FORM untuk add/store MPC -->
            @if(Gate::check('add-mpc'))
            <form id="actionAddMpc" name="frmAddMpc" method="POST" action="{{ route('store_mpc') }}">
                {{ csrf_field() }}

                <h1 class="text-center" style="margin-bottom: .5rem;">Add MPC</h1>
                <br>
                <div class="form-group">
                    <span>REGISTRATION DATE</span>
                    <input type="date" name="registration_date" class="text-uppercase form-control" required>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group frm-group-select">
                    <span>MPC CODE</span>
                    <input type="text" id="txtcode-mpc" class="text-uppercase form-control" name="code" placeholder="MPC CODE" required>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group frm-group-select select-right">
                    <span>KTP</span>
                    <input type="number" id="txtktp-mpc" class="form-control text-uppercase" name="ktp"  placeholder="KTP" required>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group">
                    <span>NAME</span>
                    <input type="text" name="name" class="text-uppercase form-control" placeholder="NAME" required>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group frm-group-select">
                    <span>BIRTH DATE</span>
                    <input type="date" name="birth_date" class="text-uppercase form-control"required>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group frm-group-select select-right">
                    <span>GENDER</span>
                    <select class="text-uppercase form-control" name="gender" required>
                        <optgroup label="Gender">
                            <option value="" disabled selected>SELECT GENDER</option>
                            <option value="PRIA">PRIA</option>
                            <option value="WANITA">WANITA</option>
                        </optgroup>
                    </select>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group">
                    <span>ADDRESS</span>
                    <textarea name="address" class="text-uppercase form-control form-control-sm" placeholder="Address" required></textarea>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group frm-group-select">
                    <span>COUNTRY</span>
                    <select id="txtcountry-mpc" class="text-uppercase form-control" name="country" required>
                        <optgroup label="Country">
                            @include('etc.select-country')
                        </optgroup>
                    </select>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group frm-group-select select-right">
                    <span>BRANCH</span>
                    <select id="txtbranch-mpc" class="text-uppercase form-control" name="branch" required>
                        <optgroup label="Branch">
                            @can('all-branch-mpc')
                                @can('all-country-mpc')
                                    <option value="" disabled selected>SELECT COUNTRY FIRST</option>
                                @endcan
                                @cannot('all-country-mpc')
                                    <option value="" selected disabled>SELECT YOUR OPTION</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{$branch->id}}" {{($branch->id == Auth::user()->branch_id ? "selected" : "")}}>{{$branch->code}} - {{$branch->name}}</option>
                                    @endforeach
                                @endcan
                            @endcan
                            @cannot('all-branch-mpc')
                                <option value="{{Auth::user()->branch_id}}">{{Auth::user()->branch['name']}}</option>
                            @endcan
                        </optgroup>
                    </select>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>


                <!-- CSO -->
                <!-- <div class="form-group">
                    <span>CSO</span>
                    <select id="txtcso-mpc" class="text-uppercase form-control" name="cso" required>
                        <optgroup label="Cso">
                            <option value="" selected disabled>SELECT YOUR OPTION</option>
                                @can('all-country-cso')
                                    @foreach ($csos as $cso)
                                        <option value="{{$cso->id}}">{{$cso->name}} - {{$cso->code}}</option>
                                    @endforeach
                                @endcan
                                @cannot('all-country-cso')
                                    @foreach ($csos as $cso)
                                        @if($cso->branch['country'] == Auth::user()->branch['country'])
                                            <option value="{{$cso->id}}">{{$cso->name}} - {{$cso->code}}</option>
                                        @endif
                                    @endforeach
                                @endcan
                        </optgroup>
                    </select>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div> -->

                <!-- Khusus untuk Indo untuk sementara -->
                <!-- <div class="form-group frm-group-select">
                    <span>PROVINCE</span>
                    <select id="txtprovince-mpc" class="text-uppercase form-control" name="province" required>
                        <optgroup label="Province">
                            @include('etc.select-province')
                        </optgroup>
                    </select>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group frm-group-select select-right">
                    <span>DISTRICT</span>
                    <select id="txtdistrict-mpc" class="form-control text-uppercase" name="district"required>
                        <optgroup label="District">
                            <option disabled selected>SELECT PROVINCE FIRST</option>
                        </optgroup>
                    </select>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div> -->

                <div class="form-group">
                    <span>PHONE</span>
                    <input type="number" name="phone" class="form-control" placeholder="0XXXXXXXXXXX" required>
                    <span class="invalid-feedback">
                        <strong></strong>
                    </span>
                </div>
                <div class="form-group">
                    <button id="btn-actionAddMpc" class="btn btn-primary" type="submit" name="submit">SAVE</button>
                </div>
            </form>
            @endif

        </div>
    </div>
</div>

<!---------------- KHUSUS UNTUK LIST DATA ---------------->
@if(Gate::check('browse-data-outsite'))
<div class="container d-none" id="ListTab-2" style="overflow-x:auto;">
    <h1 style="text-align:center;color:#505e6c;">List Data Out-Site</h1>

    <!-- KHUSUS BWAT UI SEARCH -->
    <form class="search-form" action="{{ url()->current() }}">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-search"></i>
                </span>
            </div>
            <input class="form-control" type="text" name="keywordDataOutsite" value="{{ app('request')->input('keywordDataOutsite') }}" placeholder="Search...">
            <div class="input-group-append">
                <button class="btn btn-light border" type="submit">Search</button>
            </div>
        </div>
    </form>
    <!-- KHUSUS BWAT UI SEARCH -->

    <!-- untuk table data -->
    <div class="table-responsive table table-striped table-indesktop">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>REG DATE</th>
                    <th>CODE</th>
                    <th>NAME</th>
                    <th>LOCATION</th>
                    <th>PHONE</th>
                    <th>TYPE CUST</th>
                    <!-- <th style="display: none;">PROVINCE</th> -->
                    <!-- <th style="display: none;">DISTRICT</th> -->
                    <th style="display: none;">COUNTRY</th>
                    <th style="display: none;">BRANCH</th>
                    <!-- <th style="display: none;">CSO</th> -->
                    <th style="display: none;">TYPE CUST ID</th>
                    <th style="text-align: center;" colspan="2">@if(Gate::check('edit-data-outsite'))EDIT @endif @if(Gate::check('delete-data-outsite'))/ DELETE @endif</th>
                </tr>
            </thead>
            <tbody name="ListDataOutsite">
                @php
                $i = 0
                @endphp
                @foreach($dataOutsites as $dataOutsite)
                <tr>
                    <td>{{$dataOutsite->registration_date}}</td>
                    <td>{{$dataOutsite->code}}</td>
                    <td>{{$dataOutsite->name}}</td>
                    <td>{{$dataOutsite->location['name']}} @if($dataOutsite->location == null)- @endif</td>
                        @if($dataOutsite->phone == "")
                            <td>-</td>
                        @else
                            <td>{{DataController::Decr($dataOutsite->phone)}}</td>
                        @endif
                    <td>{{$dataOutsite->type_cust['name']}}</td>
                    <!-- <td style="display: none;">{{$dataOutsite->province}}</td> -->
                    <!-- <td style="display: none;">{{$dataOutsite->district}}</td> -->
                    <td style="display: none;">{{$dataOutsite->branch['country']}}</td>
                    <td style="display: none;">{{$dataOutsite->branch['id']}}</td>
                    <!-- <td style="display: none;">{{$dataOutsite->cso['id']}}</td> -->
                    <td style="display: none;">{{$dataOutsite->type_cust['id']}}</td>
                    @if(Gate::check('edit-data-outsite'))
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-editDataOutsite-list" type="button" style="padding:0px 5px;" name="{{$i}}" value="{{$dataOutsite->id}}">
                            <i class="material-icons">mode_edit</i>
                        </button>
                    </td>
                    @endif
                    @if(Gate::check('delete-data-outsite'))
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-deleteDataOutsite-list" id="outside_del" type="button" style="padding:0px 5px;" name="{{$i}}"  data-target="#modal-DeleteConfirm" data-toggle="modal"
                            value="{{route('delete_dataoutsite', ['id' => $dataOutsite->id])}}">
                            <i class="material-icons">delete</i>
                        </button>
                    </td>
                    @endif
                </tr>
                @php
                $i++
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- untuk card data -->
    @php
    $i = 0
    @endphp
    @foreach($dataOutsites as $dataOutsite)
    <div class="card-inmobile">
        <div class="card" style="margin-bottom:10px;">
            <div class="card-body">
                <h6 class="card-title" style="border-bottom:solid 0.2px black;text-align:center;">{{$dataOutsite->code}} - {{$dataOutsite->name}}<br></h6>
                <h6 class="text-muted card-subtitle mb-2" style="font-size:12px;">{{$dataOutsite->branch['country']}} - {{$dataOutsite->branch['code']}}<br></h6>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Registration Date :</b> {{$dataOutsite->registration_date}}<br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Location :</b> {{$dataOutsite->location['name']}}<br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Phone :</b>
                    @if($dataOutsite->phone == "")
                        -
                    @else
                        {{DataController::Decr($dataOutsite->phone)}}
                    @endif
                    <br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:10px;"><b>CSO :</b> {{$dataOutsite->cso['name']}}<br></p>
                @if(Gate::check('edit-data-outsite'))
                <button class="btn btn-primary btn-edithapus-card btn-editDataOutsite" type="button" style="padding:0px 5px;" name="{{$i}}" value="{{$dataOutsite->id}}">
                    <i class="material-icons">mode_edit</i>
                </button>
                @endif
                @if(Gate::check('delete-data-outsite'))
                <button class="btn btn-primary btn-edithapus-card btn-deleteDataOutsite" type="button" style="padding:0px 5px;margin-right:10px;" name="{{$i}}" value="{{$dataOutsite->id}}">
                    <i class="material-icons">delete</i>
                </button>
                @endif
            </div>
        </div>
    </div>
    @php
    $i++
    @endphp
    @endforeach

    <!-- untuk pagination -->
    <div class="pagination-wrapper" style="float:right;">
        {{ $dataOutsites->links() }}
    </div>
</div>
@endif

@if(Gate::check('browse-data-therapy'))
<div class="container d-none" id="ListTab-3" style="overflow-x:auto;">
    <h1 style="text-align:center;color:#505e6c;">List Data Therapy</h1>

    <!-- KHUSUS BWAT UI SEARCH -->
    <form class="search-form" action="{{ url()->current() }}">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-search"></i>
                </span>
            </div>
            <input class="form-control" type="text" name="keywordDataTherapy" value="{{ app('request')->input('keywordDataTherapy') }}" placeholder="Search...">
            <div class="input-group-append">
                <button class="btn btn-light border" type="submit">Search</button>
            </div>
        </div>
    </form>
    <!-- KHUSUS BWAT UI SEARCH -->

    <!-- untuk table data -->
    <div class="table-responsive table table-striped table-indesktop">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>REG DATE</th>
                    <th>CODE</th>
                    <th>NAME</th>
                    <th>PHONE</th>
                    <th>BRANCH</th>
                    <th>TYPE CUST</th>
                    <th style="display: none;">ADDRESS</th>
                    <th style="display: none;">PROVINCE</th>
                    <th style="display: none;">DISTRICT</th>
                    <th style="display: none;">COUNTRY</th>
                    <th style="display: none;">CSO</th>
                    <th style="display: none;">TYPE CUST ID</th>
                    <th style="text-align: center;" colspan="2">@if(Gate::check('edit-data-therapy'))EDIT @endif @if(Gate::check('delete-data-therapy'))/ DELETE @endif</th>
                </tr>
            </thead>
            <tbody name="ListDataTherapy">
                @php
                $i = 0
                @endphp

                @foreach($dataTherapies as $dataTherapy)
                <tr>
                    <td>{{$dataTherapy->registration_date}}</td>
                    <td>{{$dataTherapy->code}}</td>
                    <td>{{$dataTherapy->name}}</td>
                    @if($dataTherapy->phone == "")
                        <td>-</td>
                    @else
                        <td>{{DataController::Decr($dataTherapy->phone)}}</td>
                    @endif
                    <td>{{$dataTherapy->branch['code']}}</td>
                    <td>{{$dataTherapy->type_cust['name']}}</td>
                    <td style="display: none;">{{$dataTherapy->address}}</td>
                    <td style="display: none;">{{$dataTherapy->province}}</td>
                    <td style="display: none;">{{$dataTherapy->district}}</td>
                    <td style="display: none;">{{$dataTherapy->branch['country']}}</td>
                    <td style="display: none;">{{$dataTherapy->cso['id']}}</td>
                    <td style="display: none;">{{$dataTherapy->type_cust['id']}}</td>
                    <td style="display: none;">{{$dataTherapy->branch['id']}}</td>
                    @if(Gate::check('edit-data-therapy'))
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-editDataTherapy-list" type="button" style="padding:0px 5px;" name="{{$i}}" value="{{$dataTherapy->id}}">
                            <i class="material-icons">mode_edit</i>
                        </button>
                    </td>
                    @endif
                    @if(Gate::check('delete-data-therapy'))
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-deleteDataTherapy-list" type="button" style="padding:0px 5px;" name="{{$i}}" 
                            data-target="#modal-DeleteConfirm" data-toggle="modal"
                            value="{{route('delete_datatherapy', ['id' => $dataTherapy->id])}}">
                            <i class="material-icons">delete</i>
                        </button>
                    </td>
                    @endif
                </tr>
                @php
                $i++
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- untuk card data -->
    @php
    $i = 0
    @endphp
    @foreach($dataTherapies as $dataTherapy)
    <div class="card-inmobile">
        <div class="card" style="margin-bottom:10px;">
            <div class="card-body">
                <h6 class="card-title" style="border-bottom:solid 0.2px black;text-align:center;">{{$dataTherapy->code}} - {{$dataTherapy->name}}<br></h6>
                <h6 class="text-muted card-subtitle mb-2" style="font-size:12px;">{{$dataTherapy->branch['country']}} - {{$dataTherapy->branch['code']}}<br></h6>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Registration Date :</b> {{$dataTherapy->registration_date}}<br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Address :</b> {{$dataTherapy->address}}<br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Phone :</b>
                    @if($dataTherapy->phone == "")
                        <td>-</td>
                    @else
                        <td>{{DataController::Decr($dataTherapy->phone)}}</td>
                    @endif
                    <br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:10px;"><b>CSO :</b> {{$dataTherapy->cso['name']}}<br></p>
                @if(Gate::check('edit-data-therapy'))
                <button class="btn btn-primary btn-editDataTherapy" type="button" 
                style="padding:0px 5px;" name="{{$i}}" value="{{$dataTherapy->id}}">
                    <i class="material-icons">mode_edit</i>
                </button>
                @endif
                @if(Gate::check('delete-data-therapy'))
                <button class="btn btn-primary btn-edithapus-card btn-deleteDataTherapy" type="button" style="padding:0px 5px;margin-right:10px;" name="{{$i}}" value="{{$dataTherapy->id}}">
                    <i class="material-icons">delete</i>
                </button>
                @endif
            </div>
        </div>
    </div>
    @php
    $i++
    @endphp
    @endforeach

    <!-- untuk pagination -->
    <div class="pagination-wrapper" style="float:right;">
        {{ $dataTherapies->links() }}
    </div>
</div>
@endif

@if(Gate::check('browse-mpc'))
<div class="container d-none" id="ListTab-4" style="overflow-x:auto;">
    <h1 style="text-align:center;color:#505e6c;">List MPC</h1>

    <!-- KHUSUS BWAT UI SEARCH -->
    <form class="search-form" action="{{ url()->current() }}">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-search"></i>
                </span>
            </div>
            <input class="form-control" type="text" name="keywordMpc" value="{{ app('request')->input('keywordMpc') }}" placeholder="Search...">
            <div class="input-group-append">
                <button class="btn btn-light border" type="submit">Search</button>
            </div>
        </div>
    </form>
    <!-- KHUSUS BWAT UI SEARCH -->

    <!-- untuk table data -->
    <div class="table-responsive table table-striped table-indesktop">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>REG DATE</th>
                    <th>CODE</th>
                    <th>NAME</th>
                    <th>PHONE</th>
                    <th>BRANCH</th>
                    <th>CSO</th>
                    <th style="display: none;">ADDRESS</th>
                    <th style="display: none;">PROVINCE</th>
                    <th style="display: none;">DISTRICT</th>
                    <th style="display: none;">COUNTRY</th>
                    <th style="display: none;">BIRTH DATE</th>
                    <th style="display: none;">KTP</th>
                    <th style="display: none;">GENDER</th>
                    <th style="display: none;">USER NAME</th>
                    <th style="display: none;">CSO ID</th>
                    <th style="display: none;">BRANCH ID</th>
                    <th style="text-align: center;" colspan="2">@if(Gate::check('edit-mpc'))EDIT @endif @if(Gate::check('delete-mpc'))/ DELETE @endif</th>
                </tr>
            </thead>
            <tbody name="ListMpc">
                @php
                $i = 0
                @endphp
                @foreach($dataMpcs as $mpc)
                <tr>
                    <td>{{$mpc->registration_date}}</td>
                    <td>{{$mpc->code}}</td>
                    <td>{{$mpc->name}}</td>
                    @if($mpc->phone == "")
                        <td>-</td>
                    @else
                        <td>{{DataController::Decr($mpc->phone)}}</td>
                    @endif
                    <td>{{$mpc->branch['code']}}</td>
                    <td>{{$mpc->cso['name']}}</td>
                    <td style="display: none;">{{$mpc->address}}</td>
                    <td style="display: none;">{{$mpc->province}}</td>
                    <td style="display: none;">{{$mpc->district}}</td>
                    <td style="display: none;">{{$mpc->branch['country']}}</td>
                    <td style="display: none;">{{$mpc->birth_date}}</td>
                    <td style="display: none;">{{$mpc->ktp}}</td>
                    <td style="display: none;">{{$mpc->gender}}</td>
                    <td style="display: none;">{{$mpc->user['id']}}</td>
                    <td style="display: none;">{{$mpc->cso['id']}}</td>
                    <td style="display: none;">{{$mpc->branch['id']}}</td>
                    @if(Gate::check('edit-mpc'))
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-editMpc" type="button" style="padding:0px 5px;" name="{{$i}}" value="{{$mpc->id}}">
                            <i class="material-icons">mode_edit</i>
                        </button>
                    </td>
                    @endif
                    @if(Gate::check('delete-mpc'))
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-deleteMpc" type="button" style="padding:0px 5px;" name="{{$i}}" value="{{$mpc->id}}">
                            <i class="material-icons">delete</i>
                        </button>
                    </td>
                    @endif
                </tr>
                @php
                $i++
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- untuk card data -->
    @php
    $i = 0
    @endphp
    @foreach($dataMpcs as $mpc)
    <div class="card-inmobile">
        <div class="card" style="margin-bottom:10px;">
            <div class="card-body">
                <h6 class="card-title" style="border-bottom:solid 0.2px black;text-align:center;">{{$mpc->code}} - {{$mpc->name}}<br></h6>
                <h6 class="text-muted card-subtitle mb-2" style="font-size:12px;">{{$mpc->branch['country']}} - {{$mpc->branch['code']}}<br></h6>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Registration Date :</b> {{$mpc->registration_date}}<br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>No. KTP :</b> {{$mpc->ktp}}<br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Birth Date :</b> {{$mpc->birth_date}}<br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Gender :</b> {{$mpc->gender}}<br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Address :</b> {{$mpc->address}}<br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Phone :</b>
                    @if($mpc->phone == "")
                        <td>-</td>
                    @else
                        <td>{{DataController::Decr($mpc->phone)}}</td>
                    @endif
                    <br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>CSO :</b> {{$mpc->cso['name']}}<br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:10px;"><b>User Keyin :</b> {{$mpc->user['name']}}<br></p>
                @if(Gate::check('edit-mpc'))
                <button class="btn btn-primary btn-edithapus-card btn-editMpc" type="button" style="padding:0px 5px;" name="{{$i}}" value="{{$mpc->id}}">
                    <i class="material-icons">mode_edit</i>
                </button>
                @endif
                @if(Gate::check('delete-mpc'))
                <button class="btn btn-primary btn-edithapus-card btn-deleteMpc" type="button" style="padding:0px 5px;margin-right:10px;" name="{{$i}}" value="{{$mpc->id}}">
                    <i class="material-icons">delete</i>
                </button>
                @endif
            </div>
        </div>
    </div>
    @php
    $i++
    @endphp
    @endforeach

    <!-- untuk pagination -->
    <div class="pagination-wrapper" style="float:right;">
        {{ $dataMpcs->links() }}
    </div>
</div>
@endif

@if(Gate::check('browse-data-undangan'))
<div class="container" id="ListTab-1" style="overflow-x:auto;">
    <h1 style="text-align:center;color:#505e6c;">List Data Undangan</h1>

    <!-- KHUSUS BWAT UI SEARCH -->
    <form class="search-form" action="{{ url()->current() }}">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-search"></i>
                </span>
            </div>
            <input class="form-control" type="text" name="keywordDataUndangan" value="{{ app('request')->input('keywordDataUndangan') }}" placeholder="Search...">
            <div class="input-group-append">
                <button class="btn btn-light border" type="submit">Search</button>
            </div>
        </div>
    </form>
    <!-- KHUSUS BWAT UI SEARCH -->

    <!-- untuk table data -->
    <div class="table-responsive table table-striped table-indesktop">
        <table id="table-data-undangan" class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>REG DATE</th>
                    <th>CODE</th>
                    <th>NAME</th>
                    <th>PHONE</th>
                    <th style="display: none;">ADDRESS</th>
                    <th style="display: none;">BIRTH DATE</th>
                    <th style="text-align: center;" colspan="2">@if(Gate::check('edit-data-undangan'))EDIT @endif @if(Gate::check('delete-data-undangan'))/ DELETE @endif</th>
                </tr>
            </thead>
            <tbody name="ListDataUndangan">
                @php
                $i = 0
                @endphp
                @foreach($dataUndangans as $dataUndangan)
                <tr id="tr-table-undangan">
                    <td>{{$dataUndangan->registration_date}}</td>
                    <td>{{$dataUndangan->code}}</td>
                    <td>{{$dataUndangan->name}}</td>
                    @if($dataUndangan->phone == "")
                        <td>-</td>
                    @else
                        <td id="td-phone-undangan">{{DataController::Decr($dataUndangan->phone)}}</td>
                    @endif
                    <td style="display: none;">{{$dataUndangan->address}}</td>
                    <td style="display: none;">{{$dataUndangan->birth_date}}</td>
                    @if(Gate::check('edit-data-undangan'))
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-editDataUndangan-list" type="button" style="padding:0px 5px;" name="{{$i}}" value="{{$dataUndangan->id}}">
                            <i class="material-icons">mode_edit</i>
                        </button>
                    </td>
                    @endif
                    @if(Gate::check('delete-data-undangan'))
                    <td style="text-align: center;">
                        <button class="btn btn-primary btn-deleteDataUndangan-list" type="button" style="padding:0px 5px;" name="{{$i}}" data-target="#modal-DeleteConfirm" data-toggle="modal"
                    value="{{route('delete_undangan', ['id' => $dataUndangan->id])}}">
                            <i class="material-icons">delete</i>
                        </button>
                    </td>
                    @endif
                </tr>
                @php
                $i++
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- untuk card data -->
    @php
    $i = 0
    @endphp
    @foreach($dataUndangans as $dataUndangan)
    <div class="card-inmobile">
        <div class="card" style="margin-bottom:10px;">
            <div class="card-body">
                <h6 class="card-title" style="border-bottom:solid 0.2px black;text-align:center;">{{$dataUndangan->code}} - {{$dataUndangan->name}}<br></h6>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Registration Date :</b> {{$dataUndangan->registration_date}}<br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Birth Date :</b> {{$dataUndangan->birth_date}}<br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Address :</b> {{$dataUndangan->address}}<br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Phone :</b>
                    @if($dataUndangan->phone == "")
                        <td>-</td>
                    @else
                        <td>{{DataController::Decr($dataUndangan->phone)}}</td>
                    @endif
                    <br></p>
                @if(Gate::check('edit-data-undangan'))
                <button class="btn btn-primary btn-edithapus-card btn-editDataUndangan" type="button" style="padding:0px 5px;" name="{{$i}}" value="{{$dataUndangan->id}}">
                    <i class="material-icons">mode_edit</i>
                </button>
                @endif
                @if(Gate::check('delete-data-undangan'))
                <button class="btn btn-primary btn-edithapus-card btn-deleteDataUndangan" type="button" style="padding:0px 5px;margin-right:10px;" name="{{$i}}" 
                    data-target="#modal-DeleteConfirm" data-toggle="modal"
                    value="{{route('delete_undangan', ['id' => $dataUndangan->id])}}">
                    <i class="material-icons">delete</i>
                </button>
                @endif
            </div>
        </div>
    </div>
    @php
    $i++
    @endphp
    @endforeach

    <!-- untuk pagination -->
    <div class="pagination-wrapper" style="float:right;">
        {{ $dataUndangans->links() }}
    </div>
</div>
@endif

<!-- asdzxc -->

<!--===========================================================-->


<!---------------- KHUSUS UNTUK EDIT DATA ---------------->

@if(Gate::check('edit-data-outsite'))
<div class="modal fade" role="dialog" tabindex="-1" id="modal-EditDataOutsite">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-center">Edit Data Out-Site</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <!-- FORM UNTUK UPDATE DATA -->
            <form id="actionEditDataOutsite" name="frmEditDataOutsite" method="POST" action="{{ route('update_dataoutsite') }}">
                {{ csrf_field() }}

                <div class="modal-body">
                    <div class="form-group">
                        <span>CODE</span>
                        <input id="edit-txtcode-dataoutsite" type="text" name="code" class="text-uppercase form-control" readonly>
                    </div>
                    <div class="form-group">
                        <span>TIPE OUT-SITE</span>
                        <select id="edit-txttype-cust-dataoutsite" class="text-uppercase form-control" name="type_cust" value="" required>
                            <optgroup label="TIPE OUT-SITE"> 
                                <option value="" disabled selected>SELECT TIPE OUT-SITE</option>
                                @foreach ($type_custs as $type_cust)
                                    @if($type_cust->type_input == "OUT-SITE")
                                        <option value="{{$type_cust->id}}">{{$type_cust->name}}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>REGISTRATION DATE (DD/MM/YYYY)</span>
                        <div class="col-md-12 center-block" style="padding: 0;">
                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                            <select id="edit-txtreg-day-dataoutsite" class="text-uppercase form-control upreg_day_out" name="registration_day">
                                <option value="" disabled selected>
                                    HARI
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{$i}}" id="{{$i . 'uo'}}">{{$i}}</option>
                                    @endfor
                                </option>
                            </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <select id="edit-txtreg-month-dataoutsite" class="text-uppercase form-control upreg_month_out" name="registration_month">
                                    <option value="" selected="selected" disabled="disabled" required>
                                        BULAN
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{$i}}" id="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </option>
                                </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <input id="edit-txtreg-year-dataoutsite" type="number" name="registration_year" class="form-control text-uppercase upreg_year_out" placeholder="TAHUN" required>
                            </div>
                        </div>
                        <!-- <input id="edit-txtreg-date-dataoutsite" type="date" name="registration_date" class="text-uppercase form-control" required> -->
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>NAME</span>
                        <input id="edit-txtname-dataoutsite" type="text" name="name" class="text-uppercase form-control" placeholder="NAME" required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div id="edit-Outsite-Location" class="form-group">
                        
                    </div>
                    <div class="form-group frm-group-select">
                        <span>COUNTRY</span>
                        <select id="edit-txtcountry-dataoutsite" class="text-uppercase form-control" name="country" required>
                            <optgroup label="Country">
                                @include('etc.select-country')
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select select-right">
                        <span>BRANCH</span>
                        <select id="edit-txtbranch-dataoutsite" class="text-uppercase form-control" name="branch" required>
                            <optgroup label="Branch">
                                @can('all-branch-data-outsite')
                                    @can('all-country-data-outsite')
                                        <option value="" disabled selected>SELECT COUNTRY FIRST</option>
                                    @endcan
                                    @cannot('all-country-data-outsite')
                                        <option value="" selected disabled>SELECT YOUR OPTION</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{$branch->id}}" {{($branch->id == Auth::user()->branch_id ? "selected" : "")}}>{{$branch->code}} - {{$branch->name}}</option>
                                        @endforeach
                                    @endcan
                                @endcan
                                @cannot('all-branch-data-outsite')
                                    <option value="{{Auth::user()->branch_id}}">{{Auth::user()->branch['name']}}</option>
                                @endcan
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>


                    <!-- CSO -->
                    <!-- <div class="form-group">
                        <span>CSO</span>
                        <select id="edit-txtcso-dataoutsite" class="text-uppercase form-control" name="cso" required>
                            <optgroup label="Cso">
                                @can('all-country-cso')
                                    @foreach ($csos as $cso)
                                        <option value="{{$cso->id}}">{{$cso->code}} - {{$cso->name}}</option>
                                    @endforeach
                                @endcan
                                @cannot('all-country-cso')
                                    @foreach ($csos as $cso)
                                        @if($cso->branch['country'] == Auth::user()->branch['country'])
                                            <option value="{{$cso->id}}">{{$cso->code}} - {{$cso->name}}</option>
                                        @endif
                                    @endforeach
                                @endcan
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div> -->

                    <!-- Khusus untuk Indo untuk sementara -->
                    <!-- <div class="form-group frm-group-select">
                        <span>PROVINCE</span>
                        <select id="edit-txtprovince-dataoutsite" class="text-uppercase form-control" name="province" required>
                            <optgroup label="Province">
                                @include('etc.select-province')
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select select-right">
                        <span>DISTRICT</span>
                        <select id="edit-txtdistrict-dataoutsite" class="form-control text-uppercase" name="district"required>
                            <optgroup label="District">
                                <option disabled selected>SELECT PROVINCE FIRST</option>
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div> -->

                    <div class="form-group">
                        <span>PHONE</span>
                        <input id="edit-txtphone-dataoutsite" type="number" name="phone" class="form-control" placeholder="0XXXXXXXXXXX" required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-confirmUpdateDataOutsite" value="-">SAVE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if(Gate::check('edit-data-undangan'))
<div class="modal fade" role="dialog" tabindex="-1" id="modal-EditDataUndangan">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-center">Edit Data Undangan</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <!-- FORM UNTUK UPDATE DATA -->
            <form id="actionEditDataUndangan" name="frmEditDataUndangan" method="POST" action="{{ route('update_dataundangan') }}">
                {{ csrf_field() }}

                <div class="modal-body">
                    <div class="form-group">
                        <span>CODE</span>
                        <input id="edit-txtcode-dataundangan" type="text" name="code" class="text-uppercase form-control" readonly>
                    </div>
                    <div class="form-group">
                        <span>TIPE UNDANGAN</span>
                        <select id="edit-txttype-cust-dataundangan" class="text-uppercase form-control" name="type_cust" value="" required>
                            <optgroup label="TIPE UNDANGAN"> 
                                <option value="" disabled selected>SELECT TIPE UNDANGAN</option>
                                @foreach ($type_custs as $type_cust)
                                    @if($type_cust->type_input == "UNDANGAN")
                                        <option value="{{$type_cust->id}}">{{$type_cust->name}}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>REGISTRATION DATE (DD/MM/YYYY)</span>
                        <div class="col-md-12 center-block" style="padding: 0;">
                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                            <select id="edit-txtreg-day-dataundangan" class="text-uppercase form-control upreg_day_und" name="registration_day">
                                <option value="" disabled selected>
                                    HARI
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{$i}}" id="{{$i . 'ur'}}">{{$i}}</option>
                                    @endfor
                                </option>
                            </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <select id="edit-txtreg-month-dataundangan" class="text-uppercase form-control upreg_month_und" name="registration_month">
                                    <option value="" selected="selected" disabled="disabled" required>
                                        BULAN
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{$i}}" id="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </option>
                                </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <input id="edit-txtreg-year-dataundangan" type="number" name="registration_year" class="form-control text-uppercase upreg_year_und" placeholder="TAHUN" required>
                            </div>
                        </div>

                        <!-- <input id="edit-txtreg-date-dataundangan" type="date" name="registration_date" class="text-uppercase form-control" required> -->
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>NAME</span>
                        <input id="edit-txtname-dataundangan" type="text" name="name" class="text-uppercase form-control" placeholder="NAME" required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>BIRTH DATE (DD/MM/YYYY)</span>
                        <div class="col-md-12 center-block" style="padding: 0;">
                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                            <select id="edit-txtbirth-day-dataundangan" class="text-uppercase form-control upbirth_day_und" name="birth_day">
                                <option value="" disabled selected>
                                    HARI
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{$i}}" id="{{$i . 'ub'}}">{{$i}}</option>
                                    @endfor
                                </option>
                            </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <select id="edit-txtbirth-month-dataundangan" class="text-uppercase form-control upbirth_month_und" name="birth_month">
                                    <option value="" selected="selected" disabled="disabled" required>
                                        BULAN
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{$i}}" id="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </option>
                                </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <input id="edit-txtbirth-year-dataundangan" type="number" name="birth_year" class="form-control text-uppercase upbirth_year_und" placeholder="TAHUN" required>
                            </div>
                        </div>
                        <!-- <input id="edit-txtbirt-date-dataundangan" type="date" name="birth_date" class="text-uppercase form-control"required> -->
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>ADDRESS</span>
                        <textarea id="edit-txtaddress-dataundangan" name="address" class="text-uppercase form-control form-control-sm" placeholder="Address" required></textarea>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div id="edit-Undangan-Location" class="form-group">
                        
                    </div>
                    <div class="form-group frm-group-select">
                        <span>COUNTRY</span>
                        <select id="edit-txtcountry-dataundangan" class="text-uppercase form-control" name="country" required>
                            <optgroup label="Country">
                                @include('etc.select-country')
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select select-right">
                        <span>BRANCH</span>
                        <select id="edit-txtbranch-dataundangan" class="text-uppercase form-control" name="branch" required>
                            <optgroup label="Branch">
                                @can('all-branch-data-undangan')
                                    @can('all-country-data-undangan')
                                        <option value="" disabled >SELECT COUNTRY FIRST</option>
                                    @endcan
                                    @cannot('all-country-data-undangan')
                                        <option value=""  disabled>SELECT YOUR OPTION</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{$branch->id}}" {{($branch->id == Auth::user()->branch_id ? "selected" : "")}}>{{$branch->code}} - {{$branch->name}}</option>
                                        @endforeach
                                    @endcan
                                @endcan
                                @cannot('all-branch-data-undangan')
                                    <option value="{{Auth::user()->branch_id}}">{{Auth::user()->branch['name']}}</option>
                                @endcan
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>


                    <!-- CSO -->
                    <!-- <div class="form-group">
                        <span>CSO</span>
                        <select id="edit-txtcso-dataundangan" class="text-uppercase form-control" name="cso" required>
                            <optgroup label="Cso">
                                @can('all-branch-data-outsite')
                                    <option value="" disabled selected>SELECT BRANCH FIRST</option>
                                @endcan
                                @cannot('all-branch-data-outsite')
                                <option value="" selected disabled>SELECT YOUR OPTION</option>
                                    @foreach ($csos as $cso)
                                        @if($cso->branch_id == Auth::user()->branch_id)
                                            <option value="{{$cso->id}}">{{$cso->name}}</option>
                                        @endif
                                    @endforeach
                                @endcan
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div> -->

                    <!-- Khusus untuk Indo untuk sementara -->
                    <!-- <div class="form-group frm-group-select">
                        <span>PROVINCE</span>
                        <select id="edit-txtprovince-dataundangan" class="text-uppercase form-control" name="province" required>
                            <optgroup label="Province">
                                @include('etc.select-province')
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select select-right">
                        <span>DISTRICT</span>
                        <select id="edit-txtdistrict-dataundangan" class="form-control text-uppercase" name="district"required>
                            <optgroup label="District">
                                <option disabled selected>SELECT PROVINCE FIRST</option>
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div> -->

                    <div class="form-group">
                        <span>PHONE</span>
                        <input id="edit-txtphone-dataundangan" type="number" name="phone" class="form-control" placeholder="0XXXXXXXXXXX" required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-confirmUpdateDataUndangan" value="-">SAVE</button>
                    </div>
                </div>

            <div class="modal-header" style="margin-bottom: 20px;">
                <h2 class="text-center" style="margin-bottom: 0;">History Undangan</h2>
            </div>
    <div class="table-responsive table table-striped table-indesktop">
        <table class="table table-sm table-bordered" style="width: 95%; margin: auto;">
            <thead>
                <tr>
                    <th>REG DATE</th>
                    <th>TYPE</th>
                    <th>BRANCH</th>
                    <th colspan="2">EDIT / DELETE</th>
                </tr>
            </thead>
            <tbody name="ListDataOutsite">
                
            </tbody>
        </table>
        <div class="modal-footer" style="margin-right: 2%;">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-confirmUpdateDataOutsite" value="-">SAVE</button>
        </div>
    </div>

                
            </form>
        </div>
    </div>
</div>
@endif

@if(Gate::check('edit-data-therapy'))
<div class="modal fade" role="dialog" tabindex="-1" id="modal-EditDataTherapy">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-center">Edit Data Therapy</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <!-- FORM UNTUK UPDATE DATA -->
            <form id="actionEditDataTherapy" name="frmEditDataTherapy" method="POST" action="{{ route('update_datatherapy') }}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <span>CODE</span>
                        <input id="edit-txtcode-datatherapy" type="text" name="code" class="text-uppercase form-control" readonly>
                    </div>
                    <div class="form-group">
                        <span>TIPE THERAPY</span>
                        <select id="edit-txttype-cust-datatherapy" class="text-uppercase form-control" name="type_cust" value="" required>
                            <optgroup label="TIPE THERAPY"> 
                                <option value="" disabled selected>SELECT TIPE THERAPY</option>
                                @foreach ($type_custs as $type_cust)
                                    @if($type_cust->type_input == "THERAPY")
                                        <option value="{{$type_cust->id}}">{{$type_cust->name}}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>REGISTRATION DATE (DD/MM/YYYY)</span>
                        <div class="col-md-12 center-block" style="padding: 0;">
                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                            <select id="edit-txtreg-day-datatherapy" class="text-uppercase form-control upreg_day_the" name="registration_day">
                                <option value="" disabled selected>
                                    HARI
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{$i}}" id="{{$i . 'ut'}}">{{$i}}</option>
                                    @endfor
                                </option>
                            </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <select id="edit-txtreg-month-datatherapy" class="text-uppercase form-control upreg_month_the" name="registration_month">
                                    <option value="" selected="selected" disabled="disabled" required>
                                        BULAN
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{$i}}" id="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </option>
                                </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <input id="edit-txtreg-year-datatherapy" type="number" name="registration_year" class="form-control text-uppercase upreg_year_the" placeholder="TAHUN" required>
                            </div>
                        </div>
                        <!-- <input id="edit-txtreg-date-datatherapy" type="date" name="registration_date" class="text-uppercase form-control" required> -->
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>NAME</span>
                        <input id="edit-txtname-datatherapy" type="text" name="name" class="text-uppercase form-control" placeholder="NAME" required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>ADDRESS</span>
                        <textarea id="edit-txtaddress-datatherapy" name="address" class="text-uppercase form-control form-control-sm" placeholder="Address" required></textarea>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select">
                        <span>COUNTRY</span>
                        <select id="edit-txtcountry-datatherapy" class="text-uppercase form-control" name="country" required>
                            <optgroup label="Country">
                                @include('etc.select-country')
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select select-right">
                        <span>BRANCH</span>
                        <select id="edit-txtbranch-datatherapy" class="text-uppercase form-control" name="branch" required>
                            <optgroup label="Branch">
                                @can('all-branch-data-therapy')
                                    @can('all-country-data-therapy')
                                        <option value="" disabled selected>SELECT COUNTRY FIRST</option>
                                    @endcan
                                    @cannot('all-country-data-therapy')
                                        <option value="" selected disabled>SELECT YOUR OPTION</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{$branch->id}}" {{($branch->id == Auth::user()->branch_id ? "selected" : "")}}>{{$branch->code}} - {{$branch->name}}</option>
                                        @endforeach
                                    @endcan
                                @endcan
                                @cannot('all-branch-data-therapy')
                                    <option value="{{Auth::user()->branch_id}}">{{Auth::user()->branch['name']}}</option>
                                @endcan
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>


                    <!-- CSO -->
                    <!-- <div class="form-group">
                        <span>CSO</span>
                        <select id="edit-txtcso-datatherapy" class="text-uppercase form-control" name="cso" required>
                            <optgroup label="Cso">
                                @can('all-country-cso')
                                    @foreach ($csos as $cso)
                                        <option value="{{$cso->id}}">{{$cso->code}} - {{$cso->name}}</option>
                                    @endforeach
                                @endcan
                                @cannot('all-country-cso')
                                    @foreach ($csos as $cso)
                                        @if($cso->branch['country'] == Auth::user()->branch['country'])
                                            <option value="{{$cso->id}}">{{$cso->code}} - {{$cso->name}}</option>
                                        @endif
                                    @endforeach
                                @endcan
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div> -->

                    <!-- Khusus untuk Indo untuk sementara -->
                    <!-- <div class="form-group frm-group-select">
                        <span>PROVINCE</span>
                        <select id="edit-txtprovince-datatherapy" class="text-uppercase form-control" name="province" required>
                            <optgroup label="Province">
                                @include('etc.select-province')
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select select-right">
                        <span>DISTRICT</span>
                        <select id="edit-txtdistrict-datatherapy" class="form-control text-uppercase" name="district"required>
                            <optgroup label="District">
                                <option disabled selected>SELECT PROVINCE FIRST</option>
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div> -->

                    <div class="form-group">
                        <span>PHONE</span>
                        <input id="edit-txtphone-datatherapy" type="number" name="phone" class="form-control" placeholder="0XXXXXXXXXXX" required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-confirmUpdateDataTherapy" value="-">SAVE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if(Gate::check('edit-mpc'))
<div class="modal fade" role="dialog" tabindex="-1" id="modal-EditMpc">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-center">Edit MPC</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <!-- FORM UNTUK UPDATE DATA -->
            <form id="actionEditMpc" name="frmEditMpc" method="POST" action="{{ route('update_mpc') }}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <span>REGISTRATION DATE</span>
                        <input id="edit-txtreg-date-mpc" type="date" name="registration_date" class="text-uppercase form-control" required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select">
                        <span>MPC CODE</span>
                        <input id="edit-txtcode-mpc" type="text" id="txtcode-mpc" class="text-uppercase form-control" name="code" placeholder="MPC CODE" required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select select-right">
                        <span>KTP</span>
                        <input type="number" id="edit-txtktp-mpc" class="form-control text-uppercase" name="ktp"  placeholder="KTP" required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>NAME</span>
                        <input id="edit-txtname-mpc" type="text" name="name" class="text-uppercase form-control" placeholder="NAME" required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select">
                        <span>BIRTH DATE</span>
                        <input id="edit-txtbirth-date-mpc" type="date" name="birth_date" class="text-uppercase form-control"required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select select-right">
                        <span>GENDER</span>
                        <select id="edit-txtgender-mpc" class="text-uppercase form-control" name="gender" required>
                            <optgroup label="Gender">
                                <option value="" disabled selected>SELECT GENDER</option>
                                <option value="PRIA">PRIA</option>
                                <option value="WANITA">WANITA</option>
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>ADDRESS</span>
                        <textarea id="edit-txtaddress-mpc" name="address" class="text-uppercase form-control form-control-sm" placeholder="Address" required></textarea>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select">
                        <span>COUNTRY</span>
                        <select id="edit-txtcountry-mpc" class="text-uppercase form-control" name="country" required>
                            <optgroup label="Country">
                                @include('etc.select-country')
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select select-right">
                        <span>BRANCH</span>
                        <select id="edit-txtbranch-mpc" class="text-uppercase form-control" name="branch" required>
                            <optgroup label="Branch">
                                @can('all-branch-mpc')
                                    @can('all-country-mpc')
                                        <option value="" disabled selected>SELECT COUNTRY FIRST</option>
                                    @endcan
                                    <!-- @cannot('all-country-mpc') -->
                                        <option value="" selected disabled>SELECT YOUR OPTION</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{$branch->id}}" {{($branch->id == Auth::user()->branch_id ? "selected" : "")}}>{{$branch->code}} - {{$branch->name}}</option>
                                        @endforeach
                                    <!-- @endcan -->
                                @endcan
                                @cannot('all-branch-mpc')
                                    <option value="{{Auth::user()->branch_id}}">{{Auth::user()->branch['name']}}</option>
                                @endcan
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>


                    <!-- CSO -->
                    <!-- <div class="form-group">
                        <span>CSO</span>
                        <select id="edit-txtcso-mpc" class="text-uppercase form-control" name="cso" required>
                            <optgroup label="Cso">
                                <option value="" selected disabled>SELECT YOUR OPTION</option>
                                    @can('all-country-cso')
                                        @foreach ($csos as $cso)
                                            <option value="{{$cso->id}}">{{$cso->code}} - {{$cso->name}}</option>
                                        @endforeach
                                    @endcan
                                    @cannot('all-country-cso')
                                        @foreach ($csos as $cso)
                                            @if($cso->branch['country'] == Auth::user()->branch['country'])
                                                <option value="{{$cso->id}}">{{$cso->code}} - {{$cso->name}}</option>
                                            @endif
                                        @endforeach
                                    @endcan
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div> -->

                    <!-- Khusus untuk Indo untuk sementara -->
                    <!-- <div class="form-group frm-group-select">
                        <span>PROVINCE</span>
                        <select id="edit-txtprovince-mpc" class="text-uppercase form-control" name="province" required>
                            <optgroup label="Province">
                                @include('etc.select-province')
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select select-right">
                        <span>DISTRICT</span>
                        <select id="edit-txtdistrict-mpc" class="form-control text-uppercase" name="district"required>
                            <optgroup label="District">
                                <option disabled selected>SELECT PROVINCE FIRST</option>
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div> -->

                    <div class="form-group">
                        <span>PHONE</span>
                        <input id="edit-txtphone-mpc" type="number" name="phone" class="form-control" placeholder="0XXXXXXXXXXX" required>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-confirmUpdateMpc" value="-">SAVE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<!--=======================================================================-->

<!----------------------- KHUSUS UNTUK DELETE DATA -------------------------->

<div class="modal fade" role="dialog" tabindex="-1" id="modal-DeleteConfirm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="txt-delete-dataoutsite">Are You Sure to Delete it ?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">No</button>
                <form id="actionDelete" action="" method="post">
                    {{csrf_field()}}
                    <button class="btn btn-danger" type="submit" id="btn-confirmDeleteData" value="-">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!--=======================================================================-->


@if(Gate::check('find-mpc'))
<!-- modal Find Data Undangan -->
<div class="modal fade" role="dialog" tabindex="-1" id="modal-FindMpc">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="txt-FindMpc" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="card-text" style="font-weight: normal;font-size: 18px;margin-bottom: 3px;"><b>Code</b> : <span class="txt-Kode">-</span></p>
                <p class="card-text" style="font-weight: normal;font-size: 18px;margin-bottom: 3px;"><b>KTP</b> : <span class="txt-Ktp">-</span></p>
                <p class="card-text" style="font-weight: normal;font-size: 18px;margin-bottom: 3px;"><b>Name</b> : <span class="txt-Name">-</span></p>
                <p class="card-text" style="font-weight: normal;font-size: 18px;margin-bottom: 3px;"><b>Gender</b> : <span class="txt-Gender">-</span></p>
                <p class="card-text" style="font-weight: normal;font-size: 18px;margin-bottom: 3px;"><b>Phone</b> : <span class="txt-Phone">-</span></p>
                <p class="card-text" style="font-weight: normal;font-size: 18px;margin-bottom: 3px;"><b>Birth Date</b> : <span class="txt-BirthDate">-</span></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif

@if(Gate::check('find-data-outsite'))
<!-- modal Find Data Undangan -->
<div class="modal fade" role="dialog" tabindex="-1" id="modal-FindDataOutsite">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="txt-FindDataOutsite" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="card-text" style="font-weight: normal;font-size: 18px;margin-bottom: 3px;"><b>Code</b> : <span class="txt-Kode">-</span></p>
                <p class="card-text" style="font-weight: normal;font-size: 18px;margin-bottom: 3px;"><b>Name</b> : <span class="txt-Name">-</span></p>
                <p class="card-text" style="font-weight: normal;font-size: 18px;margin-bottom: 3px;"><b>Phone</b> : <span class="txt-Phone">-</span></p>
                <p class="card-text" style="font-weight: normal;font-size: 18px;margin-bottom: 3px;"><b>Location</b> : <span class="txt-Location">-</span></p>
                <p class="card-text" style="font-weight: normal;font-size: 18px;margin-bottom: 3px;"><b>Type Customer</b> : <span class="txt-TypeCust">-</span></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif

@if(Gate::check('find-data-undangan'))
<!-- modal Find Data Undangan -->
<!-- <div class="modal fade" role="dialog" tabindex="-1" id="modal-FindMpc">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="txtFind" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="card-text" style="font-weight: normal;font-size: 18px;margin-bottom: 3px;"><b>Name</b> : Budi Santoso</p>
                <p class="card-text" style="font-weight: normal;font-size: 18px;margin-bottom: 3px;"><b>Address</b> : Jl. Kelapa Muda 12</p>
                <p class="card-text" style="font-weight: normal;font-size: 18px;margin-bottom: 3px;"><b>Phone</b> : 081544468999</p>
                <p class="card-text" style="font-weight: normal;font-size: 18px;margin-bottom: 3px;"><b>Birth Date</b> : 6-June-1966</p> -->

                <!-- untuk table data -->
                <!-- <div class="table-responsive table table-striped">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Exchange Date</th>
                                <th>Branch</th>
                            </tr>
                        </thead>
                        <tbody name="collection">
                            <tr>
                                <td>16-July-2018</td>
                                <td>(F02) Tim Basori</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="

                ">Close</button>
            </div>
        </div>
    </div>
</div> -->
@endif

<!--=======================================================================-->
@endsection

<!-- SCRIPT SECTION -->
@section('script')
@if(Session::has('insert_success'))
    <script type="text/javascript">
        $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-success\">The Data has been DELETED successfully</div>");
        $("#modal-Notification").modal("show");
    </script>
    @php
        Session::forget('insert_success');
    @endphp
@endif
<script type="text/javascript">
    //tgl kabisat
    //register undangan
    $('.reg_month_und, .reg_year_und').on("change paste keyup", function() {
            if ($('.reg_month_und').val()==2) {
                if($('.reg_year_und').val()%4==0){
                    $("#29").show();
                    if($('.reg_day_und').val() > 29){
                        $('.reg_day_und').val(29);
                    }
                }
                else{
                    $("#29").hide();
                    if($('.reg_day_und').val() > 28){
                        $('.reg_day_und').val(28);
                    }
                }
                $("#30").hide();
                $("#31").hide();

                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("masuk kabisat " + test + " " + test2);
            }
            else if ($('.reg_month_und').val()==1||$('.reg_month_und').val()==3||$('.reg_month_und').val()==5||$('.reg_month_und').val()==7||
                $('.reg_month_und').val()==8||$('.reg_month_und').val()==10||$('.reg_month_und').val()==12){
                $("#30").show();
                $("#31").show();
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("tidak kabisat " + test + " " + test2);
            }
            else
            {
                $("#30").show();
                $("#31").hide();
                if($('.reg_day_und').val() > 30){
                    $('.reg_day_und').val(30);
                }
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("kabisat " + test + " " + test2);
            }
            console.log($('.reg_year_und').val().length);
            if(parseInt($('.reg_year_und').val()) > parseInt($('.reg_year_und').attr('max')) && $('.reg_year_und').val().length > 3){
                $('.reg_year_und').val($('.reg_year_und').attr('max'));
            }
            if(parseInt($('.reg_year_und').val()) < parseInt($('.reg_year_und').attr('min')) && $('.reg_year_und').val().length > 3){
                $('.reg_year_und').val($('.reg_year_und').attr('min'));
            }  
        });
    //end register undangan
    
    //update register undangan
    $('.upreg_month_und, .upreg_year_und').on("change paste keyup", function() {
        if ($('.upreg_month_und').val()==2) {
                if($('.upreg_year_und').val()%4==0){
                    $("#29ur").show();
                    if($('.upreg_day_und').val() > 29){
                        $('.upreg_day_und').val(29);
                    }
                }
                else{
                    $("#29ur").hide();
                    if($('.upreg_day_und').val() > 28){
                        $('.upreg_day_und').val(28);
                    }
                }
                $("#30ur").hide();
                $("#31ur").hide();

                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("masuk kabisat " + test + " " + test2);
            }
            else if ($('.upreg_month_und').val()==1||$('.upreg_month_und').val()==3||$('.upreg_month_und').val()==5||$('.upreg_month_und').val()==7||
                $('.upreg_month_und').val()==8||$('.upreg_month_und').val()==10||$('.upreg_month_und').val()==12){
                $("#30ur").show();
                $("#31ur").show();
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("tidak kabisat " + test + " " + test2);
            }
            else
            {
                $("#30ur").show();
                $("#31ur").hide();
                if($('.upreg_day_und').val() > 30){
                    $('.upreg_day_und').val(30);
                }
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("kabisat " + test + " " + test2);
            }
            console.log($('.upreg_year_und').val().length);
            if(parseInt($('.upreg_year_und').val()) > parseInt($('.upreg_year_und').attr('max')) && $('.upreg_year_und').val().length > 3){
                $('.upreg_year_und').val($('.upreg_year_und').attr('max'));
            }
            if(parseInt($('.upreg_year_und').val()) < parseInt($('.upreg_year_und').attr('min')) && $('.upreg_year_und').val().length > 3){
                $('.upreg_year_und').val($('.upreg_year_und').attr('min'));
            }  
        });
    //end update register undangan    

    //birth date undangan
    $('.birth_month_und, .birth_year_und').on("change paste keyup", function() {
            if ($('.birth_month_und').val()==2) {
                if($('.birth_year_und').val()%4==0){
                    $("#29u").show();
                    if($('.birth_day_und').val() > 29){
                        $('.birth_day_und').val(29);
                    }
                }
                else{
                    $("#29u").hide();
                    if($('.birth_day_und').val() > 28){
                        $('.birth_day_und').val(28);
                    }
                }
                $("#30u").hide();
                $("#31u").hide();
                // var test = $('.birth_month2').val();
                // var test2 = $('.birth_day2').val();
                // console.log("masuk kabisat2 " + test + " " + test2);
            }
            else if ($('.birth_month_und').val()==1||$('.birth_month_und').val()==3||$('.birth_month_und').val()==5||$('.birth_month_und').val()==7||
                $('.birth_month_und').val()==8||$('.birth_month_und').val()==10||$('.birth_month_und').val()==12){
                $("#30u").show();
                $("#31u").show();
                // var test = $('.birth_month2').val();
                // var test2 = $('.birth_day2').val();
                // console.log("tidak kabisat2 " + test + " " + test2);
            }
            else
            {
                $("#30u").show();
                $("#31u").hide();
                if($('.birth_day_und').val() > 30){
                    $('.birth_day_und').val(30);
                }
                // var test = $('.birth_month2').val();
                // var test2 = $('.birth_day2').val();
                // console.log("kabisat2 " + test + " " + test2);
            }
            console.log($('.birth_year_und').val().length);
            if(parseInt($('.birth_year_und').val()) > parseInt($('.birth_year_und').attr('max')) && $('.birth_year_und').val().length > 3){
                $('.birth_year_und').val($('.birth_year_und').attr('max'));
                //console.log("aaaaa");
            }
            if(parseInt($('.birth_year_und').val()) < parseInt($('.birth_year_und').attr('min')) && $('.birth_year_und').val().length > 3){
                $('.birth_year_und').val($('.birth_year_und').attr('min'));
                //console.log("bbbb");
            }  
        });
    //end birth date undangan

    //update birth date undangan
    $('.upbirth_month_und, .upbirth_year_und').on("change paste keyup", function() {
            if ($('.upbirth_month_und').val()==2) {
                if($('.upbirth_year_und').val()%4==0){
                    $("#29ub").show();
                    if($('.upbirth_day_und').val() > 29){
                        $('.upbirth_day_und').val(29);
                    }
                }
                else{
                    $("#29ub").hide();
                    if($('.upbirth_day_und').val() > 28){
                        $('.upbirth_day_und').val(28);
                    }
                }
                $("#30ub").hide();
                $("#31ub").hide();
                // var test = $('.birth_month2').val();
                // var test2 = $('.birth_day2').val();
                // console.log("masuk kabisat2 " + test + " " + test2);
            }
            else if ($('.upbirth_month_und').val()==1||$('.upbirth_month_und').val()==3||$('.upbirth_month_und').val()==5||$('.upbirth_month_und').val()==7||
                $('.upbirth_month_und').val()==8||$('.upbirth_month_und').val()==10||$('.upbirth_month_und').val()==12){
                $("#30ub").show();
                $("#31ub").show();
                // var test = $('.birth_month2').val();
                // var test2 = $('.birth_day2').val();
                // console.log("tidak kabisat2 " + test + " " + test2);
            }
            else
            {
                $("#30ub").show();
                $("#31ub").hide();
                if($('.upbirth_day_und').val() > 30){
                    $('.upbirth_day_und').val(30);
                }
                // var test = $('.birth_month2').val();
                // var test2 = $('.birth_day2').val();
                // console.log("kabisat2 " + test + " " + test2);
            }
            console.log($('.upbirth_year_und').val().length);
            if(parseInt($('.upbirth_year_und').val()) > parseInt($('.upbirth_year_und').attr('max')) && $('.upbirth_year_und').val().length > 3){
                $('.upbirth_year_und').val($('.upbirth_year_und').attr('max'));
                //console.log("aaaaa");
            }
            if(parseInt($('.upbirth_year_und').val()) < parseInt($('.upbirth_year_und').attr('min')) && $('.upbirth_year_und').val().length > 3){
                $('.upbirth_year_und').val($('.upbirth_year_und').attr('min'));
                //console.log("bbbb");
            }  
        });
    //end update birth date undangan

    //register outsite
    $('.reg_month_out, .reg_year_out').on("change paste keyup", function() {
            if ($('.reg_month_out').val()==2) {
                if($('.reg_year_out').val()%4==0){
                    $("#29o").show();
                    if($('.reg_day_out').val() > 29){
                        $('.reg_day_out').val(29);
                    }
                }
                else{
                    $("#29o").hide();
                    if($('.reg_day_out').val() > 28){
                        $('.reg_day_out').val(28);
                    }
                }
                $("#30o").hide();
                $("#31o").hide();

                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("masuk kabisat " + test + " " + test2);
            }
            else if ($('.reg_month_out').val()==1||$('.reg_month_out').val()==3||$('.reg_month_out').val()==5||$('.reg_month_out').val()==7||
                $('.reg_month_out').val()==8||$('.reg_month_out').val()==10||$('.reg_month_out').val()==12){
                $("#30o").show();
                $("#31o").show();
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("tidak kabisat " + test + " " + test2);
            }
            else
            {
                $("#30o").show();
                $("#31o").hide();
                if($('.reg_day_out').val() > 30){
                    $('.reg_day_out').val(30);
                }
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("kabisat " + test + " " + test2);
            }
            console.log($('.reg_year_out').val().length);
            if(parseInt($('.reg_year_out').val()) > parseInt($('.reg_year_out').attr('max')) && $('.reg_year_out').val().length > 3){
                $('.reg_year_out').val($('.reg_year_out').attr('max'));
            }
            if(parseInt($('.reg_year_out').val()) < parseInt($('.reg_year_out').attr('min')) && $('.reg_year_out').val().length > 3){
                $('.reg_year_out').val($('.reg_year_out').attr('min'));
            }  
        });
    //end register outsite

    //update register outsite
    $('.upreg_month_out, .upreg_year_out').on("change paste keyup", function() {
            if ($('.upreg_month_out').val()==2) {
                if($('.upreg_year_out').val()%4==0){
                    $("#29uo").show();
                    if($('.upreg_day_out').val() > 29){
                        $('.upreg_day_out').val(29);
                    }
                }
                else{
                    $("#29uo").hide();
                    if($('.upreg_day_out').val() > 28){
                        $('.upreg_day_out').val(28);
                    }
                }
                $("#30uo").hide();
                $("#31uo").hide();

                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("masuk kabisat " + test + " " + test2);
            }
            else if ($('.upreg_month_out').val()==1||$('.upreg_month_out').val()==3||$('.upreg_month_out').val()==5||$('.upreg_month_out').val()==7||
                $('.upreg_month_out').val()==8||$('.upreg_month_out').val()==10||$('.upreg_month_out').val()==12){
                $("#30uo").show();
                $("#31uo").show();
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("tidak kabisat " + test + " " + test2);
            }
            else
            {
                $("#30uo").show();
                $("#31uo").hide();
                if($('.upreg_day_out').val() > 30){
                    $('.upreg_day_out').val(30);
                }
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("kabisat " + test + " " + test2);
            }
            console.log($('.upreg_year_out').val().length);
            if(parseInt($('.upreg_year_out').val()) > parseInt($('.upreg_year_out').attr('max')) && $('.upreg_year_out').val().length > 3){
                $('.upreg_year_out').val($('.upreg_year_out').attr('max'));
            }
            if(parseInt($('.upreg_year_out').val()) < parseInt($('.upreg_year_out').attr('min')) && $('.upreg_year_out').val().length > 3){
                $('.upreg_year_out').val($('.upreg_year_out').attr('min'));
            }  
        });
    //update register outsite

    //register therapy
    $('.reg_month_the, .reg_year_the').on("change paste keyup", function() {
            if ($('.reg_month_the').val()==2) {
                if($('.reg_year_the').val()%4==0){
                    $("#29t").show();
                    if($('.reg_day_the').val() > 29){
                        $('.reg_day_the').val(29);
                    }
                }
                else{
                    $("#29t").hide();
                    if($('.reg_day_the').val() > 28){
                        $('.reg_day_the').val(28);
                    }
                }
                $("#30t").hide();
                $("#31t").hide();

                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("masuk kabisat " + test + " " + test2);
            }
            else if ($('.reg_month_the').val()==1||$('.reg_month_the').val()==3||$('.reg_month_the').val()==5||$('.reg_month_the').val()==7||
                $('.reg_month_the').val()==8||$('.reg_month_the').val()==10||$('.reg_month_the').val()==12){
                $("#30t").show();
                $("#31t").show();
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("tidak kabisat " + test + " " + test2);
            }
            else
            {
                $("#30t").show();
                $("#31t").hide();
                if($('.reg_day_the').val() > 30){
                    $('.reg_day_the').val(30);
                }
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("kabisat " + test + " " + test2);
            }
            console.log($('.reg_year_the').val().length);
            if(parseInt($('.reg_year_the').val()) > parseInt($('.reg_year_the').attr('max')) && $('.reg_year_the').val().length > 3){
                $('.reg_year_the').val($('.reg_year_the').attr('max'));
            }
            if(parseInt($('.reg_year_the').val()) < parseInt($('.reg_year_the').attr('min')) && $('.reg_year_the').val().length > 3){
                $('.reg_year_the').val($('.reg_year_the').attr('min'));
            }  
        });
    //end register therapy

    //update reg therapy
    $('.upreg_month_the, .upreg_year_the').on("change paste keyup", function() {
            if ($('.upreg_month_the').val()==2) {
                if($('.upreg_year_the').val()%4==0){
                    $("#29ut").show();
                    if($('.upreg_day_the').val() > 29){
                        $('.upreg_day_the').val(29);
                    }
                }
                else{
                    $("#29ut").hide();
                    if($('.upreg_day_the').val() > 28){
                        $('.upreg_day_the').val(28);
                    }
                }
                $("#30ut").hide();
                $("#31ut").hide();

                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("masuk kabisat " + test + " " + test2);
            }
            else if ($('.upreg_month_the').val()==1||$('.upreg_month_the').val()==3||$('.upreg_month_the').val()==5||$('.upreg_month_the').val()==7||
                $('.upreg_month_the').val()==8||$('.upreg_month_the').val()==10||$('.upreg_month_the').val()==12){
                $("#30ut").show();
                $("#31ut").show();
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("tidak kabisat " + test + " " + test2);
            }
            else
            {
                $("#30ut").show();
                $("#31ut").hide();
                if($('.upreg_day_the').val() > 30){
                    $('.upreg_day_the').val(30);
                }
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("kabisat " + test + " " + test2);
            }
            console.log($('.upreg_year_the').val().length);
            if(parseInt($('.upreg_year_the').val()) > parseInt($('.upreg_year_the').attr('max')) && $('.upreg_year_the').val().length > 3){
                $('.upreg_year_the').val($('.upreg_year_the').attr('max'));
            }
            if(parseInt($('.upreg_year_the').val()) < parseInt($('.upreg_year_the').attr('min')) && $('.upreg_year_the').val().length > 3){
                $('.upreg_year_the').val($('.upreg_year_the').attr('min'));
            }  
        });
    //end update reg therapy
</script>

<script type="text/javascript">

    // $(".btn-deleteDataOutsite-list").click(function(){
    //     id=($(this).val());
    //     $.ajax({
    //         headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //         type: 'post',
    //         url: "{{route('delete_dataoutsite')}}",
    //         data: {
    //             'id': id
    //         },
    //         success: function(data){
    //             window.location.reload()
    //         },
    //     });
    // });
    $(".btn-deleteDataOutsite-list").click(function(e) {
        $("#actionDelete").attr("action",  $(this).val());
    });
    $(".btn-deleteDataUndangan-list").click(function(e) {
        $("#actionDelete").attr("action",  $(this).val());
    });
    $(".btn-deleteDataTherapy-list").click(function(e) {
        $("#actionDelete").attr("action",  $(this).val());
    });
    // $("#btn-confirmDeleteData").click(function()
    // {
    //     $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-success\">The Data has been DELETED successfully</div>");
    //     $("#modal-Notification").modal("show");
    // });

    // $(".btn-deleteDataTherapy-list").click(function(){
    //     id=($(this).val());
    //     $.ajax({
    //         headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //         type: 'post',
    //         url: "{{route('delete_datatherapy')}}",
    //         data: {
    //             'id': id
    //         },
    //         success: function(data){
    //             window.location.reload()
    //         },
    //     });
    // });
    // $(".btn-deleteDataUndangan-list").click(function(){
    //     id=($(this).val());
    //     $.ajax({
    //         headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //         type: 'post',
    //         url: "{{route('delete_undangan')}}",
    //         data: {
    //             'id': id
    //         },
    //         success: function(data){
    //             window.location.reload()
    //         },
    //     });
    // });
    var countryVal = "INDONESIA";
    var branches = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";
    $.ajax({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        type: 'post',
        url: "{{route('select-country')}}",
        data: {
            'country': countryVal
        },
        success: function(data){
            if(data.length > 0)
            {
                data.forEach(function(key, value){
                    branches += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                });
                $("#txtbranch-dataundangan").html("");
                $("#txtbranch-dataundangan").append(branches);
                $("#txtbranch-dataoutsite").html("");
                $("#txtbranch-dataoutsite").append(branches);
                $("#txtbranch-datatherapy").html("");
                $("#txtbranch-datatherapy").append(branches);
                $("#txtbranch-mpc").html("");
                $("#txtbranch-mpc").append(branches);
            }
            else
            {
                $("#txtbranch-dataundangan").html("");
                $("#txtbranch-dataundangan").append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
                $("#txtbranch-dataoutsite").html("");
                $("#txtbranch-dataoutsite").append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
                $("#txtbranch-datatherapy").html("");
                $("#txtbranch-datatherapy").append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
                $("#txtbranch-mpc").html("");
                $("#txtbranch-mpc").append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
            }
        },
    });
</script>
@cannot('all-country-data-undangan')
<script type="text/javascript">
    $("#txtcountry-dataundangan > optgroup > option").each(function() {
        var $thisOption = $(this);
        if(this.value != "{{ Auth::user()->branch['country'] }}"){
            $thisOption.attr("disabled","disabled");
        }
        else{
            $thisOption.attr("selected","selected");
            
            var countryVal = "{{ Auth::user()->branch['country'] }}";
            var branches = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('select-country')}}",
                data: {
                    'country': countryVal
                },
                success: function(data){
                    if(data.length > 0)
                    {
                        data.forEach(function(key, value){
                            branches += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                        });
                        $("#txtbranch-dataundangan").html("");
                        $("#txtbranch-dataundangan").append(branches);
                    }
                    else
                    {
                        $("#txtbranch-dataundangan").html("");
                        $("#txtbranch-dataundangan").append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
                    }
                },
            });
        }
    });
</script>
@endcan

@cannot('all-country-data-outsite')
<script type="text/javascript">
    $("#txtcountry-dataoutsite > optgroup > option").each(function() {
        var $thisOption = $(this);
        if(this.value != "{{ Auth::user()->branch['country'] }}"){
            $thisOption.attr("disabled","disabled");
        }
        else{
            $thisOption.attr("selected","selected");
            
            var countryVal = "{{ Auth::user()->branch['country'] }}";
            var branches = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('select-country')}}",
                data: {
                    'country': countryVal
                },
                success: function(data){
                    if(data.length > 0)
                    {
                        data.forEach(function(key, value){
                            branches += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                        });
                        $("#txtbranch-dataoutsite").html("");
                        $("#txtbranch-dataoutsite").append(branches);
                    }
                    else
                    {
                        $("#txtbranch-dataoutsite").html("");
                        $("#txtbranch-dataoutsite").append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
                    }
                },
            });
        }
    });
</script>
@endcan

@cannot('all-country-data-therapy')
<script type="text/javascript">
    $("#txtcountry-datatherapy > optgroup > option").each(function() {
        var $thisOption = $(this);
        if(this.value != "{{ Auth::user()->branch['country'] }}"){
            $thisOption.attr("disabled","disabled");
        }
        else{
            $thisOption.attr("selected","selected");
            
            var countryVal = "{{ Auth::user()->branch['country'] }}";
            var branches = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('select-country')}}",
                data: {
                    'country': countryVal
                },
                success: function(data){
                    if(data.length > 0)
                    {
                        data.forEach(function(key, value){
                            branches += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                        });
                        $("#txtbranch-datatherapy").html("");
                        $("#txtbranch-datatherapy").append(branches);
                    }
                    else
                    {
                        $("#txtbranch-datatherapy").html("");
                        $("#txtbranch-datatherapy").append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
                    }
                },
            });
        }
    });
</script>
@endcan

@cannot('all-country-mpc')
<script type="text/javascript">
    $("#txtcountry-mpc > optgroup > option").each(function() {
        var $thisOption = $(this);
        if(this.value != "{{ Auth::user()->branch['country'] }}"){
            $thisOption.attr("disabled","disabled");
        }
        else{
            $thisOption.attr("selected","selected");
            
            var countryVal = "{{ Auth::user()->branch['country'] }}";
            var branches = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('select-country')}}",
                data: {
                    'country': countryVal
                },
                success: function(data){
                    if(data.length > 0)
                    {
                        data.forEach(function(key, value){
                            branches += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                        });
                        $("#txtbranch-mpc").html("");
                        $("#txtbranch-mpc").append(branches);
                    }
                    else
                    {
                        $("#txtbranch-mpc").html("");
                        $("#txtbranch-mpc").append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
                    }
                },
            });
        }
    });
</script>
@endcan
<script type="text/javascript">
    //////////// KHUSUS UNTUK SCRIPT ONCLICK TAB//////
    function ShowList(id) {
        $("#ListTab-1").addClass("d-none");
        $("#ListTab-2").addClass("d-none");
        $("#ListTab-3").addClass("d-none");
        $("#ListTab-4").addClass("d-none");
        $("#ListTab-"+id).removeClass("d-none");
    }
    ///////////////////////////////////////////////////
    

    $(document).ready(function () {
        var url = window.location.href;

        //Jika ada search (submit), ketika refresh langsung menuju tab tertentu
        //Default akan ke tab Undangan
        if(url.includes("keywordDataOutsite"))
        {

            $("a[href='#tab-1']").removeClass("active");
            $("a[href='#tab-2']").addClass("active");
            $("#tab-1").removeClass("active");
            $("#tab-2").addClass("active");
            ShowList(2);
        }
        else if(url.includes("keywordDataTherapy"))
        {
            $("a[href='#tab-1']").removeClass("active");
            $("a[href='#tab-3']").addClass("active");
            $("#tab-1").removeClass("active");
            $("#tab-3").addClass("active");
            ShowList(3);
        }
        else if(url.includes("keywordMpc"))
        {
            $("a[href='#tab-1']").removeClass("active");
            $("a[href='#tab-4']").addClass("active");
            $("#tab-1").removeClass("active");
            $("#tab-4").addClass("active");
            ShowList(4);
        }

        //$('#modal-DataUndangan').modal('show');
        /*METHOD - METHOD UMUM ATAU KESELURUHAN
        * Khusus method" PENOPANG PADA HALAMAN INI
        */
        function _(el){
            return document.getElementById(el);
        };

        function addToDistrict(id, data, callback) {
            id.append(data);
            callback();
        };

        function RetriveSelectedBranch(var_country, var_branch, id_branch){
            id_branch = $(id_branch).children("optgroup").eq(0);
            branches = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";

            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('select-country')}}",
                data: {
                    'country': var_country
                },
                success: function(data){
                    if(data.length > 0)
                    {
                        data.forEach(function(key, value){
                            if(data[value].id == var_branch){
                                branches += '<option value="'+data[value].id+'" selected>'+data[value].code+' - '+data[value].name+'</option>';
                            }
                            else{
                                branches += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                            }
                        });
                        id_branch.html("");
                        id_branch.append(branches);
                    }
                    else
                    {
                        id_branch.html("");
                        id_branch.append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
                    }
                },
            });
        }

        function RetriveSelectedCso(var_branch, var_cso, id_cso){
            id_cso = $(id_cso).children("optgroup").eq(0);
            csos = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('select-branch')}}",
                data: {
                    'branch_id': var_branch
                },
                success: function(data){
                    if(data.length > 0)
                    {
                        data.forEach(function(key, value){
                            if(data[value].id == var_cso){
                                csos += '<option value="'+data[value].id+'" selected>'+data[value].code+' - '+data[value].name+'</option>';
                            }
                            else{
                                csos += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                            }
                        });
                        id_cso.html("");
                        id_cso.append(csos);
                    }
                    else
                    {
                        id_cso.html("");
                        id_cso.append("<option value=\"\" selected>CSO NOT FOUND</option>");
                    }
                },
            });
        }


        //untuk refresh halaman ketika modal [SUCCESS Add] ditutup 
        $('#modal-Notification').on('hidden.bs.modal', function() { 
            //location.reload();
            window.location.href = $URL_GLOBAL;
            
            //console.log("URL_GLOBAL");
            
        });

        // COUNTRY METHOD
        $('#txtcountry-dataundangan').change(function (e){
            var countryVal = $('#txtcountry-dataundangan').val();
            var branches = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";

            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('select-country')}}",
                data: {
                    'country': countryVal
                },
                success: function(data){
                    if(data.length > 0)
                    {
                        data.forEach(function(key, value){
                            branches += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                        });
                        $("#txtbranch-dataundangan").html("");
                        $("#txtbranch-dataundangan").append(branches);
                    }
                    else
                    {
                        $("#txtbranch-dataundangan").html("");
                        $("#txtbranch-dataundangan").append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
                    }
                },
            });
        });
        $('#txtcountry-dataoutsite').change(function (e){
            var countryVal = $('#txtcountry-dataoutsite').val();
            var branches = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";

            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('select-country')}}",
                data: {
                    'country': countryVal
                },
                success: function(data){
                    if(data.length > 0)
                    {
                        data.forEach(function(key, value){
                            branches += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                        });
                        $("#txtbranch-dataoutsite").html("");
                        $("#txtbranch-dataoutsite").append(branches);
                    }
                    else
                    {
                        $("#txtbranch-dataoutsite").html("");
                        $("#txtbranch-dataoutsite").append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
                    }
                },
            });
        });
        $('#txtcountry-datatherapy').change(function (e){
            var countryVal = $('#txtcountry-datatherapy').val();
            var branches = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";

            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('select-country')}}",
                data: {
                    'country': countryVal
                },
                success: function(data){
                    if(data.length > 0)
                    {
                        data.forEach(function(key, value){
                            branches += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                        });
                        $("#txtbranch-datatherapy").html("");
                        $("#txtbranch-datatherapy").append(branches);
                    }
                    else
                    {
                        $("#txtbranch-datatherapy").html("");
                        $("#txtbranch-datatherapy").append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
                    }
                },
            });
        });
        $('#txtcountry-mpc').change(function (e){
            var countryVal = $('#txtcountry-mpc').val();
            var branches = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";

            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('select-country')}}",
                data: {
                    'country': countryVal
                },
                success: function(data){
                    if(data.length > 0)
                    {
                        data.forEach(function(key, value){
                            branches += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                        });
                        $("#txtbranch-mpc").html("");
                        $("#txtbranch-mpc").append(branches);
                    }
                    else
                    {
                        $("#txtbranch-mpc").html("");
                        $("#txtbranch-mpc").append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
                    }
                },
            });
        });

        // BRANCH METHOD
        /*$('#txtbranch-dataundangan').change(function (e){
            var branchVal = $('#txtbranch-dataundangan').val();
            var csos = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";

            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('select-branch')}}",
                data: {
                    'branch_id': branchVal
                },
                success: function(data){
                    if(data.length > 0)
                    {
                        data.forEach(function(key, value){
                            csos += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                        });
                        $("#txtcso-dataundangan").html("");
                        $("#txtcso-dataundangan").append(csos);
                    }
                    else
                    {
                        $("#txtcso-dataundangan").html("");
                        $("#txtcso-dataundangan").append("<option value=\"\" selected>CSO NOT FOUND</option>");
                    }
                },
            });
        });
        $('#txtbranch-dataoutsite').change(function (e){
            var branchVal = $('#txtbranch-dataoutsite').val();
            var csos = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";

            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('select-branch')}}",
                data: {
                    'branch_id': branchVal
                },
                success: function(data){
                    if(data.length > 0)
                    {
                        data.forEach(function(key, value){
                            csos += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                        });
                        $("#txtcso-dataoutsite").html("");
                        $("#txtcso-dataoutsite").append(csos);
                    }
                    else
                    {
                        $("#txtcso-dataoutsite").html("");
                        $("#txtcso-dataoutsite").append("<option value=\"\" selected>CSO NOT FOUND</option>");
                    }
                },
            });
        });
        $('#txtbranch-datatherapy').change(function (e){
            var branchVal = $('#txtbranch-datatherapy').val();
            var csos = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";

            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('select-branch')}}",
                data: {
                    'branch_id': branchVal
                },
                success: function(data){
                    if(data.length > 0)
                    {
                        data.forEach(function(key, value){
                            csos += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                        });
                        $("#txtcso-datatherapy").html("");
                        $("#txtcso-datatherapy").append(csos);
                    }
                    else
                    {
                        $("#txtcso-datatherapy").html("");
                        $("#txtcso-datatherapy").append("<option value=\"\" selected>CSO NOT FOUND</option>");
                    }
                },
            });
        });
        $('#txtbranch-mpc').change(function (e){
            var branchVal = $('#txtbranch-mpc').val();
            var csos = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";

            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('select-branch')}}",
                data: {
                    'branch_id': branchVal
                },
                success: function(data){
                    if(data.length > 0)
                    {
                        data.forEach(function(key, value){
                            csos += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                        });
                        $("#txtcso-mpc").html("");
                        $("#txtcso-mpc").append(csos);
                    }
                    else
                    {
                        $("#txtcso-mpc").html("");
                        $("#txtcso-mpc").append("<option value=\"\" selected>CSO NOT FOUND</option>");
                    }
                },
            });
        });*/

        // PROVINCE METHOD
        $('#txtprovince-dataundangan').change(function (e) {
            $("#txtdistrict-dataundangan > optgroup").html("");
            var provinceVal = $('#txtprovince-dataundangan').val();
            $.get( "etc/select-"+unescape(provinceVal)+".php", function( data ) {
                $("#txtdistrict-dataundangan > optgroup").append(data);
            });
        });
        $('#txtprovince-dataoutsite').change(function (e) {
            $("#txtdistrict-dataoutsite > optgroup").html("");
            var provinceVal = $('#txtprovince-dataoutsite').val();
            $.get( "etc/select-"+unescape(provinceVal)+".php", function( data ) {
                $("#txtdistrict-dataoutsite > optgroup").append(data);
            });
        });
        $('#txtprovince-datatherapy').change(function (e) {
            $("#txtdistrict-datatherapy > optgroup").html("");
            var provinceVal = $('#txtprovince-datatherapy').val();
            $.get( "etc/select-"+unescape(provinceVal)+".php", function( data ) {
                $("#txtdistrict-datatherapy > optgroup").append(data);
            });
        });
        $('#txtprovince-mpc').change(function (e) {
            $("#txtdistrict-mpc > optgroup").html("");
            var provinceVal = $('#txtprovince-mpc').val();
            $.get( "etc/select-"+unescape(provinceVal)+".php", function( data ) {
                $("#txtdistrict-mpc > optgroup").append(data);
            });
        });
        /*===================================================*/


        /*METHOD - METHOD DATA UNDANGAN
        * Khusus method" undangan dari awal sampai akhir
        */
        var frmAddUndangan;

        // $('#btnFind-data-undangan').click(function(e){
        //     e.preventDefault();
        // });

        $("#txttype-cust-dataundangan").change(function (e) {
            $("#input-DataUndangan").removeClass("d-none");
            if($('#txttype-cust-dataundangan option:selected').val() == 13){//undangan id 13
                $("#Undangan-Bank").html(
                    "<span>BANK NAME</span><input list=\"bank_list\" name=\"bank_name\" class=\"text-uppercase form-control\" placeholder=\"example. BCA, CIMB, etc.\" required=\"\"><datalist id=\"bank_list\"><span class=\"invalid-feedback\"><strong></strong></span>@foreach ($banks as $bank)<option value=\"{{$bank->name}}\">@endforeach</datalist>"
                );
            }
            else{
                $("#Undangan-Bank").html("");
            }
        });
        $(".btn-editDataTherapy-list").click(function(e) {
            id=($(this).val());
            // var URLNya = $("#actionFindDataOutsite").attr('action');
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('find_therapy')}}",
                data: {
                    'id': id
                },
                success: function(data){
                    console.log(data['Branch']['id']);
                    var brcn=data['Branch']['id'];
                    var countryVal = "INDONESIA";
                    var branches = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";
                    $.ajax({
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        type: 'post',
                        url: "{{route('select-country')}}",
                        data: {
                            'country': countryVal
                        },
                        success: function(data){
                            if(data.length > 0)
                            {
                                data.forEach(function(key, value){
                                    branches += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                                });
                                $("#edit-txtbranch-datatherapy").html("");
                                $("#edit-txtbranch-datatherapy").append(branches);
                            }
                            else
                            {
                                $("#edit-txtbranch-datatherapy").html("");
                                $("#edit-txtbranch-datatherapy").append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
                            }
                            
                        },
                    });
                    setTimeout(function(){ 
                        $('#edit-txtbranch-datatherapy').val(brcn);
                    }, 500);
                    $('#edit-txtphone-datatherapy').val(data['DataTherapy']['phone']);
                    $('#edit-txtaddress-datatherapy').val(data['DataTherapy']['address']);
                    $('#edit-txtbirt-date-datatherapy').val(data['DataTherapy']['birth_date']);
                    $('#edit-txtname-datatherapy').val(data['DataTherapy']['name']);

                    var regis_date = data['DataTherapy']['registration_date'];
                    var split_regis = regis_date.split('-');
                    var regis_year = split_regis[0];

                    var regis_month = split_regis[1];
                    if (regis_month[0].includes("0")) {
                        //alert("ada 0 nya");
                        var hasil_splitM1 = regis_month[1];
                        //alert(hasilsplit);
                        $('#edit-txtreg-month-datatherapy').val(hasil_splitM1);
                    }else{
                        var hasil_splitM2 = regis_month;
                        //alert("tidak ada");
                        $('#edit-txtreg-month-datatherapy').val(hasil_splitM2);
                    };
                    //console.log("ini bulan " + regis_month);                    

                    var regis_day = split_regis[2];
                    if (regis_day[0].includes("0")) {
                        //alert("ada 0 nya");
                        var hasil_splitD1 = regis_day[1];
                        //alert(hasilsplit);
                        $('#edit-txtreg-day-datatherapy').val(hasil_splitD1);
                    }else{
                        var hasil_splitD2 = regis_day;
                        //alert("tidak ada");
                        $('#edit-txtreg-day-datatherapy').val(hasil_splitD2);
                    };
                    $('#edit-txtreg-year-datatherapy').val(split_regis[0]);
                    // $('#edit-txtreg-date-datatherapy').val(data['DataTherapy']['registration_date']);

                    
                    $('#edit-txttype-cust-datatherapy').val(data['TypeCust']['id']);
                    $('#edit-txtcode-datatherapy').val(data['DataTherapy']['code']);
                    $("#modal-EditDataTherapy").modal("show");
                    
                },
            });
            
        });
        $(".btn-editDataOutsite-list").click(function(e) {
            //console.log('asd');
            id=($(this).val());
            // var URLNya = $("#actionFindDataOutsite").attr('action');
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('find_dataoutsite')}}",
                data: {
                    'id': id
                },
                success: function(data){
                    console.log(data['Branch']['id']);
                    var brcn=data['Branch']['id'];
                    var countryVal = "INDONESIA";
                    var branches = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";
                    $.ajax({
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        type: 'post',
                        url: "{{route('select-country')}}",
                        data: {
                            'country': countryVal
                        },
                        success: function(data){
                            if(data.length > 0)
                            {
                                data.forEach(function(key, value){
                                    branches += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                                });
                                $("#edit-txtbranch-dataoutsite").html("");
                                $("#edit-txtbranch-dataoutsite").append(branches);
                            }
                            else
                            {
                                $("#edit-txtbranch-dataoutsite").html("");
                                $("#edit-txtbranch-dataoutsite").append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
                            }
                        },
                    });
                    setTimeout(function(){ 
                        $('#edit-txtbranch-dataoutsite').val(brcn);
                    }, 500);
                    $('#edit-txtphone-dataoutsite').val(data['DataOutside']['phone']);
                    $('#edit-txtaddress-dataoutsite').val(data['DataOutside']['address']);
                    $('#edit-txtbirt-date-dataoutsite').val(data['DataOutside']['birth_date']);
                    $('#edit-txtname-dataoutsite').val(data['DataOutside']['name']);

                    var regis_date = data['DataOutside']['registration_date'];
                    var split_regis = regis_date.split('-');
                    var regis_year = split_regis[0];

                    var regis_month = split_regis[1];
                    if (regis_month[0].includes("0")) {
                        //alert("ada 0 nya");
                        var hasil_splitM1 = regis_month[1];
                        //alert(hasilsplit);
                        $('#edit-txtreg-month-dataoutsite').val(hasil_splitM1);
                    }else{
                        var hasil_splitM2 = regis_month;
                        //alert("tidak ada");
                        $('#edit-txtreg-month-dataoutsite').val(hasil_splitM2);
                    };
                    //console.log("ini bulan " + regis_month);                    

                    var regis_day = split_regis[2];
                    if (regis_day[0].includes("0")) {
                        //alert("ada 0 nya");
                        var hasil_splitD1 = regis_day[1];
                        //alert(hasilsplit);
                        $('#edit-txtreg-day-dataoutsite').val(hasil_splitD1);
                    }else{
                        var hasil_splitD2 = regis_day;
                        //alert("tidak ada");
                        $('#edit-txtreg-day-dataoutsite').val(hasil_splitD2);
                    };
                    $('#edit-txtreg-year-dataoutsite').val(split_regis[0]);
                    // $('#edit-txtreg-date-dataoutsite').val(data['DataOutside']['registration_date']);


                    $('#edit-txttype-cust-dataoutsite').val(data['TypeCust']['id']);
                    $('#edit-txtcode-dataoutsite').val(data['DataOutside']['code']);
                    $("#modal-EditDataOutsite").modal("show");
                    
                },
            });
            
        });
        $(".btn-editDataUndangan-list").click(function(e) {
            id=($(this).val());
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('find_historyUndangan')}}",
                data: {
                    'id': id
                },
                success: function(data){
                    console.log(data);
                    
                },
            });

            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: "{{route('find_undangan')}}",
                data: {
                    'id': id
                },
                success: function(data){
                    var brcn=data['Branch']['id'];
                    console.log(brcn);
                    var countryVal = "INDONESIA";
                    var branches = "<option value=\"\" selected disabled>SELECT YOUR OPTION</option>";
                    $.ajax({
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        type: 'post',
                        url: "{{route('select-country')}}",
                        data: {
                            'country': countryVal
                        },
                        success: function(data){
                            if(data.length > 0)
                            {
                                data.forEach(function(key, value){
                                    branches += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                                });
                                $("#edit-txtbranch-dataundangan").html("");
                                $("#edit-txtbranch-dataundangan").append(branches);
                            }
                            else
                            {
                                $("#edit-txtbranch-dataundangan").html("");
                                $("#edit-txtbranch-dataundangan").append("<option value=\"\" selected>BRANCH NOT FOUND</option>");
                            }
                            
                        },
                    });
                    setTimeout(function(){ 
                        $('#edit-txtbranch-dataundangan').val(brcn);
                    }, 500);
                    $('#edit-txtphone-dataundangan').val(data['DataUndangan']['phone']);
                    $('#edit-txtaddress-dataundangan').val(data['DataUndangan']['address']);

                    var b_date = data['DataUndangan']['birth_date'];
                    var split_bdate = b_date.split('-');
                    var bdate_year = split_bdate[0];

                    var bdate_month = split_bdate[1];
                    if (bdate_month[0].includes("0")) {
                        //alert("ada 0 nya");
                        var hasil_splitM1 = bdate_month[1];
                        //alert(hasilsplit);
                        $('#edit-txtbirth-month-dataundangan').val(hasil_splitM1);
                    }else{
                        var hasil_splitM2 = bdate_month;
                        //alert("tidak ada");
                        $('#edit-txtbirth-month-dataundangan').val(hasil_splitM2);
                    };

                    var bdate_day = split_bdate[2];
                    if (bdate_day[0].includes("0")) {
                        //alert("ada 0 nya");
                        var hasil_splitD1 = bdate_day[1];
                        //alert(hasilsplit);
                        $('#edit-txtbirth-day-dataundangan').val(hasil_splitD1);
                    }else{
                        var hasil_splitD2 = bdate_day;
                        //alert("tidak ada");
                        $('#edit-txtbirth-day-dataundangan').val(hasil_splitD2);
                    };

                    $('#edit-txtbirth-year-dataundangan').val(split_bdate[0]);
                    //$('#edit-txtbirt-date-dataundangan').val(data['DataUndangan']['birth_date']);

                    $('#edit-txtname-dataundangan').val(data['DataUndangan']['name']);
                    
                    //disini mecah tanggalnya
                    var regis_date = data['DataUndangan']['registration_date'];
                    var split_regis = regis_date.split('-');
                    var regis_year = split_regis[0];

                    var regis_month = split_regis[1];
                    if (regis_month[0].includes("0")) {
                        //alert("ada 0 nya");
                        var hasil_splitM1 = regis_month[1];
                        //alert(hasilsplit);
                        $('#edit-txtreg-month-dataundangan').val(hasil_splitM1);
                    }else{
                        var hasil_splitM2 = regis_month;
                        //alert("tidak ada");
                        $('#edit-txtreg-month-dataundangan').val(hasil_splitM2);
                    };
                    //console.log("ini bulan " + regis_month);                    

                    var regis_day = split_regis[2];
                    if (regis_day[0].includes("0")) {
                        //alert("ada 0 nya");
                        var hasil_splitD1 = regis_day[1];
                        //alert(hasilsplit);
                        $('#edit-txtreg-day-dataundangan').val(hasil_splitD1);
                    }else{
                        var hasil_splitD2 = regis_day;
                        //alert("tidak ada");
                        $('#edit-txtreg-day-dataundangan').val(hasil_splitD2);
                    };
                    $('#edit-txtreg-year-dataundangan').val(split_regis[0]);

                    //console.log("ini tahun: " + regis_year + "ini bulan " + regis_day);
                    //console.log(data['DataUndangan']['registration_date']);
                    // $('#edit-txtreg-date-dataundangan').val(data['DataUndangan']['registration_date']);

                    $('#edit-txttype-cust-dataundangan').val(data['TypeCust']['id']);
                    $('#edit-txtcode-dataundangan').val(data['DataUndangan']['code']);
                    $("#modal-EditDataUndangan").modal("show");
                    
                },
            });
            
        });
        function getSelectedText(elementId) {
            var elt = document.getElementById(elementId);

            if (elt.selectedIndex == -1)
                return null;

            return elt.options[elt.selectedIndex].text;
        }
        // $("#actionAddDataUndangan").on("submit", function (e) {
        //     e.preventDefault();
        //     console.log('zzzzz');
        //     frmAddUndangan = _("actionAddDataUndangan");
        //     frmAddUndangan = new FormData(frmAddUndangan);
        //     var URLNya = $("#actionAddDataUndangan").attr('action');

        //     var ajax = new XMLHttpRequest();
        //     ajax.upload.addEventListener("progress", progressHandlerUndangan, false);
        //     ajax.addEventListener("load", completeHandlerUndangan, false);
        //     ajax.addEventListener("error", errorHandlerUndangan, false);
        //     ajax.open("POST", URLNya);
        //     ajax.setRequestHeader("X-CSRF-TOKEN",$('meta[name="csrf-token"]').attr('content'));
        //     ajax.send(frmAddUndangan);
        // });

        function progressHandlerUndangan(event){
            document.getElementById("btn-actionAddDataUndangan").innerHTML = "UPLOADING...";
        }
        function completeHandlerUndangan(event){
            var hasil = JSON.parse(event.target.responseText);

            for (var key of frmAddUndangan.keys()) {
                $("#actionAddDataUndangan").find("input[name="+key+"]").removeClass("is-invalid");
                $("#actionAddDataUndangan").find("select[name="+key+"]").removeClass("is-invalid");
                $("#actionAddDataUndangan").find("textarea[name="+key+"]").removeClass("is-invalid");

                $("#actionAddDataUndangan").find("input[name="+key+"]").next().find("strong").text("");
                $("#actionAddDataUndangan").find("select[name="+key+"]").next().find("strong").text("");
                $("#actionAddDataUndangan").find("textarea[name="+key+"]").next().find("strong").text("");
            }

            if(hasil['errors'] != null){
                for (var key of frmAddUndangan.keys()) {
                    if(typeof hasil['errors'][key] === 'undefined') {
                        
                    }
                    else {
                        $("#actionAddDataUndangan").find("input[name="+key+"]").addClass("is-invalid");
                        $("#actionAddDataUndangan").find("select[name="+key+"]").addClass("is-invalid");
                        $("#actionAddDataUndangan").find("textarea[name="+key+"]").addClass("is-invalid");

                        $("#actionAddDataUndangan").find("input[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                        $("#actionAddDataUndangan").find("select[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                        $("#actionAddDataUndangan").find("textarea[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                    }
                }
            }
            else{
                $('#modal-UpdateForm').modal('hide')
                $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-success\">New Data Undangan has been ADDED successfully</div>");
                $("#modal-Notification").modal("show");
            }

            document.getElementById("btn-actionAddDataUndangan").innerHTML = "SAVE";
        }
        function errorHandlerUndangan(event){
            document.getElementById("btn-actionAddDataUndangan").innerHTML = "SAVE";
            $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-error\">"+event.target.responseText+"</div>");
            $("#modal-Notification").modal("show");
            // $("#txt-notification > div").html(event.target.responseText);
            // $('#modal-UpdateForm').modal('hide')
            // $("#modal-NotificationUpdate").modal("show");
        }
        /*===================================================*/


        /*METHOD - METHOD DATA OUTSITE
        * Khusus method" outsite dari awal sampai akhir
        */
        var actionDeleteDataOutsite = $("#actionEditDataOutsite").prop('action');
        var actionEditDataOutsite = $("#actionEditDataOutsite").prop('action');
        var frmAddOutsite;
        var frmEditOutsite;
        var isAddDataOutsite = true;
        var tempLocation = "";

        $('#actionFindDataOutsite').on("submit", function (e) {
            // console.log('zxv');
            e.preventDefault();
            var URLNya = $("#actionFindDataOutsite").attr('action');
            var PhoneNya = $("#actionFindDataOutsite").find("input[name=find]").val();

            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: URLNya,
                data: {
                    'phone': PhoneNya
                },
                success: function(data){
                    if(data['success'] != null && data['success'] != "")
                    {
                        console.log(data['success']);
                        $("#modal-FindDataOutsite").modal("show");
                        $("#modal-FindDataOutsite").find("span.txt-Kode").html(data['success']['code']);
                        $("#modal-FindDataOutsite").find("span.txt-Name").html(data['success']['name']);
                        if(data['success']['location'] != null && data['success']['location'] != "")
                        {
                            $("#modal-FindDataOutsite").find("span.txt-Location").html(data['success']['location']['name']);
                        }
                        $("#modal-FindDataOutsite").find("span.txt-Phone").html(data['success']['phone']);
                        $("#modal-FindDataOutsite").find("span.txt-TypeCust").html(data['success']['type_cust']['name']);
                        $("#modal-FindDataOutsite").find("h4#txt-FindDataOutsite").html("DATA IS FOUND");
                    }
                    else
                    {
                        $("#modal-FindDataOutsite").modal("show");
                        $("#modal-FindDataOutsite").find("span.txt-Kode").html("-");
                        $("#modal-FindDataOutsite").find("span.txt-Name").html("-");
                        $("#modal-FindDataOutsite").find("span.txt-Location").html("-");
                        $("#modal-FindDataOutsite").find("span.txt-Phone").html("-");
                        $("#modal-FindDataOutsite").find("span.txt-TypeCust").html("-");

                        $("#modal-FindDataOutsite").find("h4#txt-FindDataOutsite").html("DATA ISN'T FOUND");
                    }
                },
            });
        });

        $("#txttype-cust-dataoutsite, #edit-txttype-cust-dataoutsite").change(function (e) {
            var LocationDOM = "edit-Outsite-Location";
            var LocationNya = tempLocation;
            if(this.id == "txttype-cust-dataoutsite"){
                $("#input-DataOutsite").removeClass("d-none");
                LocationDOM = "Outsite-Location";
                LocationNya = "";
            }
            if($('#'+this.id+' option:selected').val() == 2 || $('#'+this.id+' option:selected').val() == 4){//Ms. Rumah id 2 dan CFD id 4
                $("#"+LocationDOM).html(
                    "<span>LOCATION NAME</span><input list=\"location_list\" name=\"location_name\" class=\"text-uppercase form-control\" placeholder=\"example. CITRALAND, PAKUWON, etc.\" required=\"\"><datalist id=\"location_list\"><span class=\"invalid-feedback\"><strong></strong></span>@foreach ($locations as $location)<option value=\"{{$location->name}}\">@endforeach</datalist>"
                );
                $("#"+LocationDOM+" > input").val(LocationNya);
            }
            else{
                $("#"+LocationDOM).html("");
            }
        });

        //untuk menampilkan modal edit data OUTSITE dan menampilkan data mana yg mau di edit
        // $(".btn-editDataOutsite").click(function(e) {
        //     var dataOutsite = GetListDataOutsite(this.name);
        //     document.getElementById("edit-txtreg-date-dataoutsite").value = dataOutsite.reg_date;
        //     document.getElementById("edit-txtcode-dataoutsite").value = dataOutsite.kode;
        //     document.getElementById("edit-txtname-dataoutsite").value = dataOutsite.nama;
        //     document.getElementById("edit-txtcountry-dataoutsite").value = dataOutsite.country;
        //     document.getElementById("edit-txtprovince-dataoutsite").value = dataOutsite.province;
        //     document.getElementById("edit-txtphone-dataoutsite").value = dataOutsite.phone;
        //     document.getElementById("edit-txttype-cust-dataoutsite").value = dataOutsite.typecust;
        //     document.getElementById("edit-txtcso-dataoutsite").value = dataOutsite.cso;
        //     document.getElementById("btn-confirmUpdateDataOutsite").value = this.value;
        //     tempLocation = dataOutsite.location;

        //     var pilihanProvinsi = dataOutsite.province;
        //     var pilihanCso = dataOutsite.cso;
        //     var pilihanBranch = dataOutsite.branch;
        //     var isiOption = "";

        //     //UPDATE DISTRICT
        //     var districtTemp = $("#edit-txtdistrict-dataoutsite").children("optgroup").eq(0);
        //     districtTemp.empty();
        //     $.get( "etc/select-"+unescape(pilihanProvinsi)+".php", function( data ) {
        //         addToDistrict(districtTemp, data, function(){
        //             document.getElementById("edit-txtdistrict-dataoutsite").value = dataOutsite.district;
        //         });
        //     });

        //     //UPDATE BRANCH
        //     RetriveSelectedBranch(dataOutsite.country, dataOutsite.branch, "#edit-txtbranch-dataoutsite");

        //     //CEK ADA LOKASI APA TIDAK
        //     $("#edit-Outsite-Location").html("");
        //     if(dataOutsite.location != " - "){
        //         $("#edit-Outsite-Location").html(
        //             "<span>LOCATION NAME</span><input list=\"location_list\" name=\"location_name\" class=\"text-uppercase form-control\" placeholder=\"example. CITRALAND, PAKUWON, etc.\" required=\"\"><datalist id=\"edit-location_list\"><span class=\"invalid-feedback\"><strong></strong></span>@foreach ($locations as $location)<option value=\"{{$location->name}}\">@endforeach</datalist>"
        //         );
        //         $("#edit-Outsite-Location > input").val(dataOutsite.location);
        //     }

        //     $("#modal-EditDataOutsite").modal("show");
        // });

        // $("#actionAddDataOutsite").on("submit", function (e) {
        //     e.preventDefault();
        //     frmAddOutsite = _("actionAddDataOutsite");
        //     frmAddOutsite = new FormData(frmAddOutsite);
        //     var URLNya = $("#actionAddDataOutsite").attr('action');

        //     var ajax = new XMLHttpRequest();
        //     ajax.upload.addEventListener("progress", progressHandlerOutsite, false);
        //     ajax.addEventListener("load", completeHandlerOutsite, false);
        //     ajax.addEventListener("error", errorHandlerOutsite, false);
        //     ajax.open("POST", URLNya);
        //     ajax.setRequestHeader("X-CSRF-TOKEN",$('meta[name="csrf-token"]').attr('content'));
        //     ajax.send(frmAddOutsite);
        // });

        $("#actionEditDataOutsite").on("submit", function (e) {
            // console.log('asfd');
            e.preventDefault();
            isAddDataOutsite = false;
            frmEditOutsite = _("actionEditDataOutsite");
            frmEditOutsite = new FormData(frmEditOutsite);
            frmEditOutsite.append("id",$(this).find("button").eq(1).val());
            var URLNya = $("#actionEditDataOutsite").attr('action');

            var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", progressHandlerOutsite, false);
            ajax.addEventListener("load", completeHandlerOutsite, false);
            ajax.addEventListener("error", errorHandlerOutsite, false);
            ajax.open("POST", URLNya);
            ajax.setRequestHeader("X-CSRF-TOKEN",$('meta[name="csrf-token"]').attr('content'));
            ajax.send(frmEditOutsite);
        });
        
        function progressHandlerOutsite(event){
            if(isAddDataOutsite){
                document.getElementById("btn-actionAddDataOutsite").innerHTML = "UPLOADING...";
            }
            else{
                document.getElementById("btn-confirmUpdateDataOutsite").innerHTML = "UPLOADING...";
            }
        }
        function completeHandlerOutsite(event){
            var hasil = JSON.parse(event.target.responseText);

            if(isAddDataOutsite){
                for (var key of frmAddOutsite.keys()) {
                    $("#actionAddDataOutsite").find("input[name="+key+"]").removeClass("is-invalid");
                    $("#actionAddDataOutsite").find("select[name="+key+"]").removeClass("is-invalid");
                    $("#actionAddDataOutsite").find("textarea[name="+key+"]").removeClass("is-invalid");

                    $("#actionAddDataOutsite").find("input[name="+key+"]").next().find("strong").text("");
                    $("#actionAddDataOutsite").find("select[name="+key+"]").next().find("strong").text("");
                    $("#actionAddDataOutsite").find("textarea[name="+key+"]").next().find("strong").text("");
                }

                if(hasil['errors'] != null){
                    for (var key of frmAddOutsite.keys()) {
                        if(typeof hasil['errors'][key] === 'undefined') {
                            
                        }
                        else {
                            $("#actionAddDataOutsite").find("input[name="+key+"]").addClass("is-invalid");
                            $("#actionAddDataOutsite").find("select[name="+key+"]").addClass("is-invalid");
                            $("#actionAddDataOutsite").find("textarea[name="+key+"]").addClass("is-invalid");

                            $("#actionAddDataOutsite").find("input[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                            $("#actionAddDataOutsite").find("select[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                            $("#actionAddDataOutsite").find("textarea[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                        }
                    }
                }
                else{
                    // $('#modal-UpdateForm').modal('hide')
                    // $("#modal-NotificationUpdate").modal("show");
                    $('#modal-UpdateForm').modal('hide')
                    $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-success\">New Data Out-Site has been ADDED successfully</div>");
                    $("#modal-Notification").modal("show");
                    $URL_GLOBAL = "{{route('data')}}"+"?addDataOutsite=true";
                    
                }

                document.getElementById("btn-actionAddDataOutsite").innerHTML = "SAVE";
            }
            else{
                for (var key of frmEditOutsite.keys()) {
                    $("#actionEditDataOutsite").find("input[name="+key+"]").removeClass("is-invalid");
                    $("#actionEditDataOutsite").find("select[name="+key+"]").removeClass("is-invalid");
                    $("#actionEditDataOutsite").find("textarea[name="+key+"]").removeClass("is-invalid");

                    $("#actionEditDataOutsite").find("input[name="+key+"]").next().find("strong").text("");
                    $("#actionEditDataOutsite").find("select[name="+key+"]").next().find("strong").text("");
                    $("#actionEditDataOutsite").find("textarea[name="+key+"]").next().find("strong").text("");
                }

                if(hasil['errors'] != null){
                    for (var key of frmEditOutsite.keys()) {
                        if(typeof hasil['errors'][key] === 'undefined') {
                            
                        }
                        else {
                            $("#actionEditDataOutsite").find("input[name="+key+"]").addClass("is-invalid");
                            $("#actionEditDataOutsite").find("select[name="+key+"]").addClass("is-invalid");
                            $("#actionEditDataOutsite").find("textarea[name="+key+"]").addClass("is-invalid");

                            $("#actionEditDataOutsite").find("input[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                            $("#actionEditDataOutsite").find("select[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                            $("#actionEditDataOutsite").find("textarea[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                        }
                    }
                }
                else{
                    // $('#modal-UpdateForm').modal('hide')
                    // $("#modal-NotificationUpdate").modal("show");
                    $('#modal-EditDataOutsite').modal('hide')
                    $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-success\">The Data Out-Site has been CHANGED successfully</div>");
                    $("#modal-Notification").modal("show");
                    $URL_GLOBAL = "{{route('data')}}"+"?editDataOutsite=true";
                }

                document.getElementById("btn-confirmUpdateDataOutsite").innerHTML = "SAVE";
            }
        }
        function errorHandlerOutsite(event){
            if(isAddDataOutsite){
                document.getElementById("btn-actionAddDataOutsite").innerHTML = "SAVE";
                $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-error\">"+event.target.responseText+"</div>");
                $("#modal-Notification").modal("show");
            }
            else{
                document.getElementById("btn-confirmUpdateDataOutsite").innerHTML = "SAVE";
                $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-error\">"+event.target.responseText+"</div>");
                $("#modal-Notification").modal("show");
            }
        }
        /*===================================================*/


        /*METHOD - METHOD DATA THERAPY
        * Khusus method" therapy dari awal sampai akhir
        */
        var actionDeleteDataTherapy = $("#actionEditDataTherapy").prop('action');
        var actionEditDataTherapy = $("#actionEditDataTherapy").prop('action');
        var frmAddTherapy;
        var frmEditTherapy;
        var isAddDataTherapy = true;

        $('#btnFind-data-therapy').click(function(e){
            e.preventDefault();
        });

        // $(".btn-editDataTherapy").click(function(e) {
        //     var dataTherapy = GetListDataTherapy(this.name);
        //     document.getElementById("edit-txtreg-date-datatherapy").value = dataTherapy.reg_date;
        //     document.getElementById("edit-txtcode-datatherapy").value = dataTherapy.kode;
        //     document.getElementById("edit-txtname-datatherapy").value = dataTherapy.nama;
        //     document.getElementById("edit-txtaddress-datatherapy").value = dataTherapy.address;
        //     document.getElementById("edit-txtcountry-datatherapy").value = dataTherapy.country;
        //     document.getElementById("edit-txtprovince-datatherapy").value = dataTherapy.province;
        //     document.getElementById("edit-txtphone-datatherapy").value = dataTherapy.phone;
        //     document.getElementById("edit-txttype-cust-datatherapy").value = dataTherapy.typecust;
        //     document.getElementById("edit-txtcso-datatherapy").value = dataTherapy.cso;
        //     document.getElementById("btn-confirmUpdateDataTherapy").value = this.value;

        //     var pilihanProvinsi = dataTherapy.province;
        //     var pilihanCso = dataTherapy.cso;
        //     var pilihanBranch = dataTherapy.branch;
        //     var isiOption = "";

        //     //UPDATE DISTRICT
        //     var districtTemp = $("#edit-txtdistrict-datatherapy").children("optgroup").eq(0);
        //     districtTemp.empty();
        //     $.get( "etc/select-"+unescape(pilihanProvinsi)+".php", function( data ) {
        //         addToDistrict(districtTemp, data, function(){
        //             document.getElementById("edit-txtdistrict-datatherapy").value = dataTherapy.district;
        //         });
        //     });

        //     //UPDATE BRANCH
        //     RetriveSelectedBranch(dataTherapy.country, dataTherapy.branch, "#edit-txtbranch-datatherapy");

        //     $("#modal-EditDataTherapy").modal("show");
        // });

        // $("#actionAddDataTherapy").on("submit", function (e) {
        //     e.preventDefault();
        //     frmAddTherapy = _("actionAddDataTherapy");
        //     frmAddTherapy = new FormData(frmAddTherapy);
        //     var URLNya = $("#actionAddDataTherapy").attr('action');

        //     var ajax = new XMLHttpRequest();
        //     ajax.upload.addEventListener("progress", progressHandlerTherapy, false);
        //     ajax.addEventListener("load", completeHandlerTherapy, false);
        //     ajax.addEventListener("error", errorHandlerTherapy, false);
        //     ajax.open("POST", URLNya);
        //     ajax.setRequestHeader("X-CSRF-TOKEN",$('meta[name="csrf-token"]').attr('content'));
        //     ajax.send(frmAddTherapy);
        // });

        $("#actionEditDataTherapy").on("submit", function (e) {
            e.preventDefault();
            isAddDataTherapy = false;
            frmEditTherapy = _("actionEditDataTherapy");
            frmEditTherapy = new FormData(frmEditTherapy);
            frmEditTherapy.append("id",$(this).find("button").eq(1).val());
            var URLNya = $("#actionEditDataTherapy").attr('action');

            var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", progressHandlerTherapy, false);
            ajax.addEventListener("load", completeHandlerTherapy, false);
            ajax.addEventListener("error", errorHandlerTherapy, false);
            ajax.open("POST", URLNya);
            ajax.setRequestHeader("X-CSRF-TOKEN",$('meta[name="csrf-token"]').attr('content'));
            ajax.send(frmEditTherapy);
        });

        function progressHandlerTherapy(event){
            if(isAddDataTherapy){
                document.getElementById("btn-actionAddDataTherapy").innerHTML = "UPLOADING...";
            }
            else{
                document.getElementById("btn-confirmUpdateDataTherapy").innerHTML = "UPLOADING...";
            }
        }
        function completeHandlerTherapy(event){
            var hasil = JSON.parse(event.target.responseText);

            if(isAddDataTherapy){
                for (var key of frmAddTherapy.keys()) {
                    $("#actionAddDataTherapy").find("input[name="+key+"]").removeClass("is-invalid");
                    $("#actionAddDataTherapy").find("select[name="+key+"]").removeClass("is-invalid");
                    $("#actionAddDataTherapy").find("textarea[name="+key+"]").removeClass("is-invalid");

                    $("#actionAddDataTherapy").find("input[name="+key+"]").next().find("strong").text("");
                    $("#actionAddDataTherapy").find("select[name="+key+"]").next().find("strong").text("");
                    $("#actionAddDataTherapy").find("textarea[name="+key+"]").next().find("strong").text("");
                }

                if(hasil['errors'] != null){
                    for (var key of frmAddTherapy.keys()) {
                        if(typeof hasil['errors'][key] === 'undefined') {
                            
                        }
                        else {
                            $("#actionAddDataTherapy").find("input[name="+key+"]").addClass("is-invalid");
                            $("#actionAddDataTherapy").find("select[name="+key+"]").addClass("is-invalid");
                            $("#actionAddDataTherapy").find("textarea[name="+key+"]").addClass("is-invalid");

                            $("#actionAddDataTherapy").find("input[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                            $("#actionAddDataTherapy").find("select[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                            $("#actionAddDataTherapy").find("textarea[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                        }
                    }
                }
                else{
                    $('#modal-UpdateForm').modal('hide')
                    $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-success\">New Data Therapy has been ADDED successfully</div>");
                    $("#modal-Notification").modal("show");
                    $URL_GLOBAL = "{{route('data')}}"+"?addDataTheraphy=true";
                }

                document.getElementById("btn-actionAddDataTherapy").innerHTML = "SAVE";
            }
            else{
                for (var key of frmEditTherapy.keys()) {
                    $("#actionEditDataTherapy").find("input[name="+key+"]").removeClass("is-invalid");
                    $("#actionEditDataTherapy").find("select[name="+key+"]").removeClass("is-invalid");
                    $("#actionEditDataTherapy").find("textarea[name="+key+"]").removeClass("is-invalid");

                    $("#actionEditDataTherapy").find("input[name="+key+"]").next().find("strong").text("");
                    $("#actionEditDataTherapy").find("select[name="+key+"]").next().find("strong").text("");
                    $("#actionEditDataTherapy").find("textarea[name="+key+"]").next().find("strong").text("");
                }

                if(hasil['errors'] != null){
                    for (var key of frmEditTherapy.keys()) {
                        if(typeof hasil['errors'][key] === 'undefined') {
                            
                        }
                        else {
                            $("#actionEditDataTherapy").find("input[name="+key+"]").addClass("is-invalid");
                            $("#actionEditDataTherapy").find("select[name="+key+"]").addClass("is-invalid");
                            $("#actionEditDataTherapy").find("textarea[name="+key+"]").addClass("is-invalid");

                            $("#actionEditDataTherapy").find("input[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                            $("#actionEditDataTherapy").find("select[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                            $("#actionEditDataTherapy").find("textarea[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                        }
                    }
                }
                else{
                    $('#modal-EditDataTherapy').modal('hide')
                    $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-success\">The Data Therapy has been CHANGED successfully</div>");
                    $("#modal-Notification").modal("show");
                    $URL_GLOBAL = "{{route('data')}}"+"?editDataTheraphy=true";
                }

                document.getElementById("btn-confirmUpdateDataTherapy").innerHTML = "SAVE";
            }

            
        }
        function errorHandlerTherapy(event){
            document.getElementById("btn-confirmUpdateDataTherapy").innerHTML = "SAVE";
            $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-error\">"+event.target.responseText+"</div>");
            $("#modal-Notification").modal("show");
        }
        /*===================================================*/


        /*METHOD - METHOD MPC
        * Khusus method" mpc dari awal sampai akhir
        */
        var actionDeleteMpc = $("#actionEditMpc").prop('action');
        var actionEditMpc = $("#actionEditMpc").prop('action');
        var frmAddMpc;
        var frmEditMpc;
        var isAddMpc= true;

        $('#actionFindMpc').on("submit", function (e) {
            e.preventDefault();
            var URLNya = $("#actionFindMpc").attr('action');
            var PhoneNya = $("#actionFindMpc").find("input[name=find]").val();

            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'post',
                url: URLNya,
                data: {
                    'phone': PhoneNya
                },
                success: function(data){
                    if(data['success'] != null)
                    {
                        $("#modal-FindMpc").modal("show");
                        $("#modal-FindMpc").find("span.txt-Kode").html(data['success']['code']);
                        $("#modal-FindMpc").find("span.txt-Ktp").html(data['success']['ktp']);
                        $("#modal-FindMpc").find("span.txt-Name").html(data['success']['name']);
                        $("#modal-FindMpc").find("span.txt-Gender").html(data['success']['gender']);
                        $("#modal-FindMpc").find("span.txt-Phone").html(data['success']['phone']);
                        $("#modal-FindMpc").find("span.txt-BirthDate").html(data['success']['birth_date']);
                        $("#modal-FindMpc").find("h4#txt-FindMpc").html("DATA IS FOUND");
                    }
                    else
                    {
                        $("#modal-FindMpc").modal("show");
                        $("#modal-FindMpc").find("h4#txt-FindMpc").html("DATA ISN'T FOUND");
                    }
                },
            });
        });

        $(".btn-editMpc").click(function(e) {
            var mpc = GetListMpc(this.name);
            document.getElementById("edit-txtreg-date-mpc").value = mpc.reg_date;
            document.getElementById("edit-txtcode-mpc").value = mpc.kode;
            document.getElementById("edit-txtname-mpc").value = mpc.nama;
            document.getElementById("edit-txtphone-mpc").value = mpc.phone;
            document.getElementById("edit-txtaddress-mpc").value = mpc.address;
            document.getElementById("edit-txtprovince-mpc").value = mpc.province;
            document.getElementById("edit-txtcountry-mpc").value = mpc.country;
            document.getElementById("edit-txtbirth-date-mpc").value = mpc.birth_date;
            document.getElementById("edit-txtktp-mpc").value = mpc.ktp;
            document.getElementById("edit-txtgender-mpc").value = mpc.gender;
            document.getElementById("edit-txtcso-mpc").value = mpc.cso;
            document.getElementById("edit-txtbranch-mpc").value = mpc.branch;
            document.getElementById("btn-confirmUpdateMpc").value = this.value;

            var pilihanProvinsi = mpc.province;
            var pilihanCso = mpc.cso;
            var pilihanBranch = mpc.branch;
            var isiOption = "";

            //UPDATE DISTRICT
            var districtTemp = $("#edit-txtdistrict-mpc").children("optgroup").eq(0);
            districtTemp.empty();
            $.get( "etc/select-"+unescape(pilihanProvinsi)+".php", function( data ) {
                addToDistrict(districtTemp, data, function(){
                    document.getElementById("edit-txtdistrict-mpc").value = mpc.district;
                });
            });

            //UPDATE BRANCH
            RetriveSelectedBranch(mpc.country, mpc.branch, "#edit-txtbranch-mpc");

            $("#modal-EditMpc").modal("show");
        });

        $("#actionAddMpc").on("submit", function (e) {
            e.preventDefault();
            frmAddMpc = _("actionAddMpc");
            frmAddMpc = new FormData(frmAddMpc);
            var URLNya = $("#actionAddMpc").attr('action');

            var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", progressHandlerMpc, false);
            ajax.addEventListener("load", completeHandlerMpc, false);
            ajax.addEventListener("error", errorHandlerMpc, false);
            ajax.open("POST", URLNya);
            ajax.setRequestHeader("X-CSRF-TOKEN",$('meta[name="csrf-token"]').attr('content'));
            ajax.send(frmAddMpc);
        });

        $("#actionEditMpc").on("submit", function (e) {
            e.preventDefault();
            isAddMpc = false;
            frmEditMpc = _("actionEditMpc");
            frmEditMpc = new FormData(frmEditMpc);
            frmEditMpc.append("id",$(this).find("button").eq(1).val());
            var URLNya = $("#actionEditMpc").attr('action');

            var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", progressHandlerMpc, false);
            ajax.addEventListener("load", completeHandlerMpc, false);
            ajax.addEventListener("error", errorHandlerMpc, false);
            ajax.open("POST", URLNya);
            ajax.setRequestHeader("X-CSRF-TOKEN",$('meta[name="csrf-token"]').attr('content'));
            ajax.send(frmEditMpc);
        });

        function progressHandlerMpc(event){
            if(isAddMpc){
                document.getElementById("btn-actionAddMpc").innerHTML = "UPLOADING...";
            }
            else{
                document.getElementById("btn-confirmUpdateMpc").innerHTML = "UPLOADING...";
            }
        }
        function completeHandlerMpc(event){
            var hasil = JSON.parse(event.target.responseText);

            if(isAddMpc){
                for (var key of frmAddMpc.keys()) {
                    $("#actionAddMpc").find("input[name="+key+"]").removeClass("is-invalid");
                    $("#actionAddMpc").find("select[name="+key+"]").removeClass("is-invalid");
                    $("#actionAddMpc").find("textarea[name="+key+"]").removeClass("is-invalid");

                    $("#actionAddMpc").find("input[name="+key+"]").next().find("strong").text("");
                    $("#actionAddMpc").find("select[name="+key+"]").next().find("strong").text("");
                    $("#actionAddMpc").find("textarea[name="+key+"]").next().find("strong").text("");
                }

                if(hasil['errors'] != null){
                    for (var key of frmAddMpc.keys()) {
                        if(typeof hasil['errors'][key] === 'undefined') {
                            
                        }
                        else {
                            $("#actionAddMpc").find("input[name="+key+"]").addClass("is-invalid");
                            $("#actionAddMpc").find("select[name="+key+"]").addClass("is-invalid");
                            $("#actionAddMpc").find("textarea[name="+key+"]").addClass("is-invalid");

                            $("#actionAddMpc").find("input[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                            $("#actionAddMpc").find("select[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                            $("#actionAddMpc").find("textarea[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                        }
                    }
                }
                else{
                    $('#modal-UpdateForm').modal('hide')
                    $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-success\">New MPC has been ADDED successfully</div>");
                    $("#modal-Notification").modal("show");
                }

                document.getElementById("btn-actionAddMpc").innerHTML = "SAVE";
            }
            else{
                for (var key of frmEditMpc.keys()) {
                    $("#actionEditMpc").find("input[name="+key+"]").removeClass("is-invalid");
                    $("#actionEditMpc").find("select[name="+key+"]").removeClass("is-invalid");
                    $("#actionEditMpc").find("textarea[name="+key+"]").removeClass("is-invalid");

                    $("#actionEditMpc").find("input[name="+key+"]").next().find("strong").text("");
                    $("#actionEditMpc").find("select[name="+key+"]").next().find("strong").text("");
                    $("#actionEditMpc").find("textarea[name="+key+"]").next().find("strong").text("");
                }

                if(hasil['errors'] != null){
                    for (var key of frmEditMpc.keys()) {
                        if(typeof hasil['errors'][key] === 'undefined') {
                            
                        }
                        else {
                            $("#actionEditMpc").find("input[name="+key+"]").addClass("is-invalid");
                            $("#actionEditMpc").find("select[name="+key+"]").addClass("is-invalid");
                            $("#actionEditMpc").find("textarea[name="+key+"]").addClass("is-invalid");

                            $("#actionEditMpc").find("input[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                            $("#actionEditMpc").find("select[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                            $("#actionEditMpc").find("textarea[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                        }
                    }
                }
                else{
                    $('#modal-EditMpc').modal('hide')
                    $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-success\">The MPC has been CHANGED successfully</div>");
                    $("#modal-Notification").modal("show");
                }

                document.getElementById("btn-confirmUpdateMpc").innerHTML = "SAVE";
            }

            
        }
        function errorHandlerMpc(event){
            if(isAddMpc){
                document.getElementById("btn-actionAddMpc").innerHTML = "SAVE";
            }
            else{
                document.getElementById("btn-confirmUpdateMpc").innerHTML = "SAVE";
            }
            $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-error\">"+event.target.responseText+"</div>");
            $("#modal-Notification").modal("show");
        }
        /*===================================================*/
    });

    //update undangan
    // $("#actionEditDataUndangan").on("submit", function (e) {
    //         e.preventDefault();
    //         isAddDataTherapy = false;
    //         frmEditTherapy = _("actionEditDataUndangan");
    //         frmEditTherapy = new FormData(frmEditTherapy);
    //         frmEditTherapy.append("id",$(this).find("button").eq(1).val());
    //         var URLNya = $("#actionEditDataUndangan").attr('action');

    //         var ajax = new XMLHttpRequest();
    //         ajax.upload.addEventListener("progress", progressHandlerTherapy, false);
    //         ajax.addEventListener("load", completeHandlerTherapy, false);
    //         ajax.addEventListener("error", errorHandlerTherapy, false);
    //         ajax.open("POST", URLNya);
    //         ajax.setRequestHeader("X-CSRF-TOKEN",$('meta[name="csrf-token"]').attr('content'));
    //         ajax.send(frmEditTherapy);
    //     });

    //     function progressHandlerTherapy(event){
    //         if(isAddDataTherapy){
    //             document.getElementById("btn-actionAddDataUndangan").innerHTML = "UPLOADING...";
    //         }
    //         else{
    //             document.getElementById("btn-confirmUpdateDataUndangan").innerHTML = "UPLOADING...";
    //         }
    //     }
    //     function completeHandlerTherapy(event){
    //         var hasil = JSON.parse(event.target.responseText);

    //         if(isAddDataTherapy){
    //             for (var key of frmAddTherapy.keys()) {
    //                 $("#actionAddDataUndangan").find("input[name="+key+"]").removeClass("is-invalid");
    //                 $("#actionAddDataUndangan").find("select[name="+key+"]").removeClass("is-invalid");
    //                 $("#actionAddDataUndangan").find("textarea[name="+key+"]").removeClass("is-invalid");

    //                 $("#actionAddDataUndangan").find("input[name="+key+"]").next().find("strong").text("");
    //                 $("#actionAddDataUndangan").find("select[name="+key+"]").next().find("strong").text("");
    //                 $("#actionAddDataUndangan").find("textarea[name="+key+"]").next().find("strong").text("");
    //             }

    //             if(hasil['errors'] != null){
    //                 for (var key of frmAddTherapy.keys()) {
    //                     if(typeof hasil['errors'][key] === 'undefined') {
                            
    //                     }
    //                     else {
    //                         $("#actionAddDataUndangan").find("input[name="+key+"]").addClass("is-invalid");
    //                         $("#actionAddDataUndangan").find("select[name="+key+"]").addClass("is-invalid");
    //                         $("#actionAddDataUndangan").find("textarea[name="+key+"]").addClass("is-invalid");

    //                         $("#actionAddDataUndangan").find("input[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
    //                         $("#actionAddDataUndangan").find("select[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
    //                         $("#actionAddDataUndangan").find("textarea[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
    //                     }
    //                 }
    //             }
    //             else{
    //                 $('#modal-UpdateForm').modal('hide')
    //                 $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-success\">New Data Therapy has been ADDED successfully</div>");
    //                 $("#modal-Notification").modal("show");
    //             }

    //             document.getElementById("btn-actionAddDataTherapy").innerHTML = "SAVE";
    //         }
    //         else{
    //             for (var key of frmEditTherapy.keys()) {
    //                 $("#actionEditDataUndangan").find("input[name="+key+"]").removeClass("is-invalid");
    //                 $("#actionEditDataUndangan").find("select[name="+key+"]").removeClass("is-invalid");
    //                 $("#actionEditDataUndangan").find("textarea[name="+key+"]").removeClass("is-invalid");

    //                 $("#actionEditDataUndangan").find("input[name="+key+"]").next().find("strong").text("");
    //                 $("#actionEditDataUndangan").find("select[name="+key+"]").next().find("strong").text("");
    //                 $("#actionEditDataUndangan").find("textarea[name="+key+"]").next().find("strong").text("");
    //             }

    //             if(hasil['errors'] != null){
    //                 for (var key of frmEditTherapy.keys()) {
    //                     if(typeof hasil['errors'][key] === 'undefined') {
                            
    //                     }
    //                     else {
    //                         $("#actionEditDataUndangan").find("input[name="+key+"]").addClass("is-invalid");
    //                         $("#actionEditDataUndangan").find("select[name="+key+"]").addClass("is-invalid");
    //                         $("#actionEditDataUndangan").find("textarea[name="+key+"]").addClass("is-invalid");

    //                         $("#actionEditDataUndangan").find("input[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
    //                         $("#actionEditDataUndangan").find("select[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
    //                         $("#actionEditDataUndangan").find("textarea[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
    //                     }
    //                 }
    //             }
    //             else{
    //                 $('#modal-EditDataUndangan').modal('hide')
    //                 $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-success\">The Data Therapy has been CHANGED successfully</div>");
    //                 $("#modal-Notification").modal("show");
    //             }

    //             document.getElementById("btn-confirmUpdateDataUndangan").innerHTML = "SAVE";
    //         }

            
    //     }
    //     function errorHandlerTherapy(event){
    //         document.getElementById("btn-confirmUpdateDataUndangan").innerHTML = "SAVE";
    //         $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-error\">"+event.target.responseText+"</div>");
    //         $("#modal-Notification").modal("show");
    //     }
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
@if(isset($_GET['addDataOutsite']))
    <script type="text/javascript">
    //console.log("masuk");
    $("a[href='#tab-1']").removeClass("active");
    $("a[href='#tab-2']").addClass("active");
    $("#tab-1").removeClass("active");
    $("#tab-2").addClass("active");
    ShowList(2);
    </script>
@elseif(isset($_GET['editDataOutsite']))
    <script type="text/javascript">
    //console.log("masuk");
    $("a[href='#tab-1']").removeClass("active");
    $("a[href='#tab-2']").addClass("active");
    $("#tab-1").removeClass("active");
    $("#tab-2").addClass("active");
    ShowList(2);
    </script>
@elseif(isset($_GET['addDataTheraphy']))
    <script type="text/javascript">
    $("a[href='#tab-1']").removeClass("active");
    $("a[href='#tab-3']").addClass("active");
    $("#tab-1").removeClass("active");
    $("#tab-3").addClass("active");
    ShowList(3);
    </script>
@elseif(isset($_GET['editDataTheraphy']))
    <script type="text/javascript">
    $("a[href='#tab-1']").removeClass("active");
    $("a[href='#tab-3']").addClass("active");
    $("#tab-1").removeClass("active");
    $("#tab-3").addClass("active");
    ShowList(3);
    </script>
@endif
@endsection
