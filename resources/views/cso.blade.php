<?php use App\Http\Controllers\CsoController; ?>

@extends('layouts.template')
@section('css')
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
@endsection
@section('navmenu')
    @if(Gate::check('dashboard'))
    <li> <a href="{{route('dashboard')}}">Dashboard</a></li>
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
    <li class="list-selected">Master CSO</li>
    @endif

    @if(Gate::check('master-user'))
    <li> <a href="{{route('user')}}">Master User</a></li>
    @endif

    @if(Gate::check('report'))
    <li> <a href="">Report</a></li>
    @endif
@endsection
@section('content')
<div class="container contact-clean" id="form-addMember">
    <!-- FORM UNTUK DATA BARU -->
    <form id="actionAdd" method="POST" action="{{ route('store_cso') }}">
        {{ csrf_field() }}

        <h1 class="text-center">Add CSO</h1>
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <span>REGISTRATION DATE
            </span>
            <div class="col-md-12 center-block" style="padding: 0;">
                <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                    <select class="text-uppercase form-control {{ $errors->has('registration_day') ? ' is-invalid' : '' }}" name="registration_day" value="{{ old('registration_day') }} reg_day_cso">
                        <option value="" selected="selected" disabled="disabled" required>
                            HARI
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{$i}}" id="{{$i . 'c'}}">{{$i}}</option>
                            @endfor
                        </option>
                    </select>
                </div>

                <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                    <select class="text-uppercase form-control {{ $errors->has('registration_month') ? ' is-invalid' : '' }} reg_month_cso" name="registration_month" value="{{ old('registration_month') }}">
                        <option value="" selected="selected" disabled="disabled" required>
                            BULAN
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{$i}}" id="{{$i}}">{{$i}}</option>
                            @endfor
                        </option>
                    </select>
                </div>

                <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                    <input type="number" name="registration_year" class="form-control text-uppercase {{ $errors->has('registration_year') ? ' is-invalid' : '' }} reg_year_cso" placeholder="TAHUN" value="{{ old('registration_year') }}" required>
                </div>
            </div>
            <!-- <input type="date" name="registration_date" class="text-uppercase form-control {{ $errors->has('registration_date') ? ' is-invalid' : '' }}" value="{{ old('registration_date') }}" required> -->

            <span class="invalid-feedback">
                <strong>{{ $errors->first('registration_date') }}</strong>
            </span>
        </div>
        <div class="form-group {{ $errors->has('unregistration_date') ? ' has-error' : '' }}">
            <span>UNREGISTRATION DATE</span>
            <div class="col-md-12 center-block" style="padding: 0;">
                <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                    <select class="text-uppercase form-control {{ $errors->has('unregistration_day') ? ' is-invalid' : '' }} unreg_day_cso" name="unregistration_day" value="{{ old('unregistration_day') }}">
                        <option value="" selected="selected" disabled="disabled" required>
                            HARI
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{$i}}" id="{{$i . 'unc'}}">{{$i}}</option>
                            @endfor
                        </option>
                    </select>
                </div>

                <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                    <select class="text-uppercase form-control {{ $errors->has('unregistration_month') ? ' is-invalid' : '' }} unreg_month_cso" name="unregistration_month" value="{{ old('unregistration_month') }}">
                        <option value="" selected="selected" disabled="disabled" required>
                            BULAN
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{$i}}" id="{{$i}}">{{$i}}</option>
                            @endfor
                        </option>
                    </select>
                </div>

                <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                    <input type="number" name="unregistration_year" class="form-control text-uppercase {{ $errors->has('unregistration_year') ? ' is-invalid' : '' }} unreg_year_cso" placeholder="TAHUN" value="{{ old('unregistration_year') }}" required>
                </div>
            </div>
            <!-- <input type="date" name="unregistration_date" class="text-uppercase form-control {{ $errors->has('unregistration_date') ? ' is-invalid' : '' }}" value="{{ old('unregistration_date') }}" > -->
            <span class="invalid-feedback">
                <strong>{{ $errors->first('unregistration_date') }}</strong>
            </span>
        </div>
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <span>NAME</span>
            <input type="text" name="name" class="text-uppercase form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Full Name"  value="{{ old('name') }}" required>
            <span class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        </div>
        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
            <span>ADDRESS</span>
            <textarea name="address" class="text-uppercase form-control {{ $errors->has('address') ? ' is-invalid' : '' }} form-control-sm" placeholder="Address" required>{{ old('address') }}</textarea>
            @if ($errors->has('address'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group frm-group-select {{ $errors->has('country') ? ' has-error' : '' }}">
            <span>COUNTRY</span>
            <select id="country" class="text-uppercase form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{ old('country') }}" required>
                <optgroup label="Country">
                    @can('all-country-cso')
                    @include('etc.select-country')
                    @endcan
                    @cannot('all-country-cso')
                    <option value="{{Auth::user()->country}}">{{Auth::user()->country}}</option>
                    @endcan
                </optgroup>
            </select>
            <span class="invalid-feedback">
                <strong>{{ $errors->first('country') }}</strong>
            </span>
        </div>
        <div class="form-group frm-group-select select-right {{ $errors->has('branch') ? ' has-error' : '' }}" style="/*float:right;*/">
            <span>BRANCH</span>
            <select id="branch" class="form-control{{ $errors->has('branch') ? ' is-invalid' : '' }}" name="branch" value="{{old('branch')}}" required>
                <optgroup label="Branch">
                    <option value="" readonly selected>SELECT COUNTRY FIRST</option>
                </optgroup>
            </select>
            <span class="invalid-feedback">
                <strong>{{ $errors->first('branch') }}</strong>
            </span>
        </div>
        <div class="form-group frm-group-select {{ $errors->has('province') ? ' has-error' : '' }}">
            <span>PROVINCE</span>
            <select id="province" class="text-uppercase form-control{{ $errors->has('province') ? ' is-invalid' : '' }}" name="province" value="{{ old('province') }}" required>
                <optgroup label="Province">
                    @include('etc.select-province')
                </optgroup>
            </select>
            <span class="invalid-feedback">
                <strong>{{ $errors->first('province') }}</strong>
            </span>
        </div>
        <div class="form-group frm-group-select select-right {{ $errors->has('district') ? ' has-error' : '' }}" style="/*float:right;*/">
            <span>DISTRICT</span>
            <select id="district" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }} text-uppercase" name="district" value="{{old('district')}}" required>
                <optgroup label="District">
                    <option value="" disabled selected>SELECT PROVINCE FIRST</option>
                </optgroup>
            </select>
            <span class="invalid-feedback">
                <strong>{{ $errors->first('district') }}</strong>
            </span>
        </div>
        <div class="form-group frm-group-select {{ $errors->has('phone') ? ' has-error' : '' }}">
            <span>PHONE</span>
            <input type="number" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="0XXXXXXXXXXXX" value="{{ old('phone') }}" onkeypress="return isNumberKey(event)" required>
            <span class="invalid-feedback">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        </div>
        <div class="form-group frm-group-select select-right {{ $errors->has('komisi') ? ' has-error' : '' }}">
            <span>COMMISSION</span>
            <input type="number" step="0.01" name="komisi" class="form-control {{ $errors->has('komisi') ? ' is-invalid' : '' }}" placeholder="0.00" value="{{ old('komisi') }}" onkeypress="return isNumberKey(event)">
            <span class="invalid-feedback">
                <strong>{{ $errors->first('komisi') }}</strong>
            </span>
        </div>
        <div class="form-group {{ $errors->has('no_rekening') ? ' has-error' : '' }}">
            <span>BANK ACCOUNT</span>
            <input type="number" name="no_rekening" class="text-uppercase form-control {{ $errors->has('no_rekening') ? ' is-invalid' : '' }}" value="{{ old('no_rekening') }}" placeholder="Bank Account">
            <span class="invalid-feedback">
                <strong>{{ $errors->first('no_rekening') }}</strong>
            </span>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit" id="btn-confirmAddCso">SAVE</button>
        </div>
    </form>
</div>
@can('browse-cso')
<div class="container" id="list-member" style="overflow-x:auto;">
    <h1 style="text-align:center;color:#505e6c;">List CSO</h1>

    <!-- KHUSUS BWAT UI SEARCH -->
    <form class="search-form" action="{{ url()->current() }}">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-search"></i>
                </span>
            </div>
            <input class="form-control" type="text" name="keyword" value="{{ app('request')->input('keyword') }}" placeholder="Search...">
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
                    <th style="display: none;">ADDRESS</th>
                    <th style="display: none;">PROVINCE</th>
                    <th>DISTRICT</th>
                    <th style="display: none;">COUNTRY</th>
                    <th>BRANCH</th>
                    <th>PHONE</th>
                    <th>COMMISSION</th>
                    <th>BANK ACCOUNT</th>
                    <th style="display: none;">UNREG DATE</th>
                    @if(Gate::check('edit-cso') || Gate::check('delete-cso'))
                    <th colspan="2">EDIT/DELETE</th>
                    @endif
                </tr>
            </thead>
            <tbody name="collection">
                @php
                $i = 0
                @endphp
                @foreach($csos as $cso)
                <tr>
                    <td>{{$cso->registration_date}}</td>
                    <td>{{$cso->code}}</td>
                    <td>{{$cso->name}}</td>
                    <td style="display: none;">{{$cso->address}}</td>
                    <td style="display: none;">{{$cso->province}}</td>
                    <td>{{$cso->district}}</td>
                    <td style="display: none;">{{$cso->branch['country']}}</td>
                    <td>{{$cso->branch['name']}}</td>
                    @if($cso->phone == "")
                        <td>-</td>
                    @else
                        <td>{{CsoController::Decr($cso->phone)}}</td>
                    @endif
                    <td>{{$cso->komisi}}</td>
                    <td>{{$cso->no_rekening}}</td>
                    <td style="display: none;">{{$cso->unregistration_date}}</td>
                    @if(Gate::check('edit-cso'))
                    <td>
                        <button class="btn btn-primary btn-editCso" type="button" style="padding:0px 5px;" name="{{$i}}" value="{{$cso->id}}">
                            <i class="material-icons">mode_edit</i>
                        </button>
                    </td>
                    @endif
                    @if(Gate::check('delete-cso'))
                    <td>
                        <button class="btn btn-primary btn-deleteCso" type="button" style="padding:0px 5px;" name="{{$i}}" value="{{$cso->id}}">
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
    @foreach($csos as $cso)
    <div class="card-inmobile">
        <div class="card" style="margin-bottom:10px;">
            <div class="card-body">
                <h6 class="card-title" style="border-bottom:solid 0.2px black;text-align:center;">{{$cso->code}} - {{$cso->name}}<br></h6>
                <h6 class="text-muted card-subtitle mb-2" style="font-size:12px;">{{$cso->branch['country']}} - {{$cso->branch['name']}}<br></h6>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Registration Date :</b> {{$cso->registration_date}}<br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Phone :</b>
                    @if($cso->phone == "")
                        -
                    @else
                        {{CsoController::Decr($cso->phone)}}
                    @endif
                    <br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:3px;"><b>Commission :</b> {{$cso->komisi}}<br></p>
                <p class="card-text" style="font-weight:normal;font-size:14px;margin-bottom:10px;"><b>Bank Account :</b> {{$cso->no_rekening}}<br></p>
                @if(Gate::check('edit-cso'))
                <button class="btn btn-primary btn-edithapus-card btn-editCso" type="button" style="padding:0px 5px;" name="{{$i}}" value="{{$cso->id}}">
                    <i class="material-icons">mode_edit</i>
                </button>
                @endif
                @if(Gate::check('delete-cso'))
                <button class="btn btn-primary btn-edithapus-card btn-deleteCso" type="button" style="padding:0px 5px;margin-right:10px;" name="{{$i}}" value="{{$cso->id}}">
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
        {{ $csos->links() }}
    </div>
    
</div>
@endcan
@endsection

@section('modal')
<!-- modal hapus data -->
<div class="modal fade" role="dialog" tabindex="-1" id="modal-DeleteConfirm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete&nbsp;</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="txt-delete-cso"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
                <form id="actionDelete" action="{{route('delete_cso', ['id' => ''])}}" method="post">
                    {{csrf_field()}}
                    <button class="btn btn-danger" type="submit" id="btn-confirmDeleteCso" value="-">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal update data -->
<div class="modal fade" role="dialog" tabindex="-1" id="modal-UpdateForm">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-center">Edit CSO</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <!-- FORM UNTUK UPDATE DATA -->
            <form id="actionEdit" method="post" action="{{ route('update_user') }}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <span>CODE</span>
                        <input class="text-uppercase form-control" type="text" name="code" readonly placeholder="CODE" id="txtkode-cso">
                    </div>
                    <div class="form-group">
                        <span>REGISTRATION DATE (DD/MM/YYYY)</span>
                        <div class="col-md-12 center-block" style="padding: 0;">
                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                            <select id="txtregday-cso" class="text-uppercase form-control upreg_day_cso" name="registration_day">
                                <option value="" disabled selected>
                                    HARI
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{$i}}" id="{{$i . 'uc'}}">{{$i}}</option>
                                    @endfor
                                </option>
                            </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <select id="txtregmonth-cso" class="text-uppercase form-control upreg_month_cso" name="registration_month">
                                    <option value="" selected="selected" disabled="disabled" required>
                                        BULAN
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{$i}}" id="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </option>
                                </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <input id="txtregyear-cso" type="number" name="registration_year" class="form-control text-uppercase upreg_year_cso" placeholder="TAHUN" required>
                            </div>
                        </div>
                        <input class="text-uppercase form-control" type="hidden" name="registration_date" id="txtregdate-cso">
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>UNREGISTRATION DATE (DD/MM/YYYY)</span>
                        <div class="col-md-12 center-block" style="padding: 0;">
                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                            <select id="txtunregday-cso" class="text-uppercase form-control upunreg_day_cso" name="registration_day">
                                <option value="" disabled selected>
                                    HARI
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{$i}}" id="{{$i . 'ur'}}">{{$i}}</option>
                                    @endfor
                                </option>
                            </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <select id="txtunregmonth-cso" class="text-uppercase form-control upunreg_month_cso" name="registration_month">
                                    <option value="" selected="selected" disabled="disabled" required>
                                        BULAN
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{$i}}" id="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </option>
                                </select>
                            </div>

                            <div class="form-group frm-group-select col-sm-4 bd" style="padding-left:0px;padding-right:0px;width:190px;">
                                <input id="txtunregyear-cso" type="number" name="registration_year" class="form-control text-uppercase upunreg_year_cso" placeholder="TAHUN" required>
                            </div>
                        </div>
                        <input class="text-uppercase form-control" type="hidden" name="unregistration_date" id="txtunregdate-cso">
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>NAME</span>
                        <input class="text-uppercase form-control" type="text" name="name" placeholder="Full Name" id="txtnama-cso">
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>ADDRESS</span>
                        <textarea name="address" class="text-uppercase form-control form-control-sm" id="txtaddress-cso"></textarea>
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select">
                        <span>COUNTRY</span>
                        <select class="text-uppercase form-control" value="-" id="txtcountry-cso" name="country">
                            <optgroup label="Country">
                                @include('etc.select-country')
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('country') }}</strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select select-right" style="/*float:right;*/">
                        <span>BRANCH</span>
                        <select class="text-uppercase form-control" id="txtbranch-cso" name="branch">
                            <optgroup label="Branch">
                                <option value="" disabled="disabled" selected="selected">Select COUNTRY first1</option>
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('branch') }}</strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select">
                        <span>PROVINCE</span>
                        <select class="text-uppercase form-control" id="txtprovince-cso" name="province">
                            <optgroup label="Province">
                                @include('etc.select-province')
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('province') }}</strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select select-right" style="/*float:right;*/">
                        <span>DISTRICT</span>
                        <select class="text-uppercase form-control" id="txtdistrict-cso" name="district">
                            <optgroup label="District">
                            </optgroup>
                        </select>
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('district') }}</strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select">
                        <span>PHONE</span>
                        <input class="form-control" type="number" id="txtphone-cso" name="phone" onkeypress="return isNumberKey(event)">
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group frm-group-select">
                        <span>COMMISSION</span>
                        <input class="form-control" type="number" step="0.01" id="txtkomisi-cso" name="komisi" onkeypress="return isNumberKey(event)">
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>BANK ACCOUNT</span>
                        <input class="form-control text-uppercase" type="number" id="txtnorekening-cso" name="no_rekening" placeholder="Bank Account">
                        <span class="invalid-feedback">
                            <strong></strong>
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" id="btn-confirmUpdateCso" value="-">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    //tanggal kabisat

    //reg cso
    $('.reg_month_cso, .reg_year_cso').on("change paste keyup", function() {
            if ($('.reg_month_cso').val()==2) {
                if($('.reg_year_cso').val()%4==0){
                    $("#29c").show();
                    if($('.reg_day_cso').val() > 29){
                        $('.reg_day_cso').val(29);
                    }
                }
                else{
                    $("#29c").hide();
                    if($('.reg_day_cso').val() > 28){
                        $('.reg_day_cso').val(28);
                    }
                }
                $("#30c").hide();
                $("#31c").hide();

                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("masuk kabisat " + test + " " + test2);
            }
            else if ($('.reg_month_cso').val()==1||$('.reg_month_cso').val()==3||$('.reg_month_cso').val()==5||$('.reg_month_cso').val()==7||
                $('.reg_month_cso').val()==8||$('.reg_month_cso').val()==10||$('.reg_month_cso').val()==12){
                $("#30c").show();
                $("#31c").show();
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("tidak kabisat " + test + " " + test2);
            }
            else
            {
                $("#30c").show();
                $("#31c").hide();
                if($('.reg_day_cso').val() > 30){
                    $('.reg_day_cso').val(30);
                }
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("kabisat " + test + " " + test2);
            }
            console.log($('.reg_year_cso').val().length);
            if(parseInt($('.reg_year_cso').val()) > parseInt($('.reg_year_cso').attr('max')) && $('.reg_year_cso').val().length > 3){
                $('.reg_year_cso').val($('.reg_year_cso').attr('max'));
            }
            if(parseInt($('.reg_year_cso').val()) < parseInt($('.reg_year_cso').attr('min')) && $('.reg_year_cso').val().length > 3){
                $('.reg_year_cso').val($('.reg_year_cso').attr('min'));
            }  
        });
    //end reg cso

    //update reg cso
    $('.upreg_month_cso, .upreg_year_cso').on("change paste keyup", function() {
        if ($('.upreg_month_cso').val()==2) {
                if($('.upreg_year_cso').val()%4==0){
                    $("#29uc").show();
                    if($('.upreg_day_cso').val() > 29){
                        $('.upreg_day_cso').val(29);
                    }
                }
                else{
                    $("#29uc").hide();
                    if($('.upreg_day_cso').val() > 28){
                        $('.upreg_day_cso').val(28);
                    }
                }
                $("#30uc").hide();
                $("#31uc").hide();

                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("masuk kabisat " + test + " " + test2);
            }
            else if ($('.upreg_month_cso').val()==1||$('.upreg_month_cso').val()==3||$('.upreg_month_cso').val()==5||$('.upreg_month_cso').val()==7||
                $('.upreg_month_cso').val()==8||$('.upreg_month_cso').val()==10||$('.upreg_month_cso').val()==12){
                $("#30uc").show();
                $("#31uc").show();
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("tidak kabisat " + test + " " + test2);
            }
            else
            {
                $("#30uc").show();
                $("#31uc").hide();
                if($('.upreg_day_cso').val() > 30){
                    $('.upreg_day_cso').val(30);
                }
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("kabisat " + test + " " + test2);
            }
            console.log($('.upreg_year_cso').val().length);
            if(parseInt($('.upreg_year_cso').val()) > parseInt($('.upreg_year_cso').attr('max')) && $('.upreg_year_cso').val().length > 3){
                $('.upreg_year_cso').val($('.upreg_year_cso').attr('max'));
            }
            if(parseInt($('.upreg_year_cso').val()) < parseInt($('.upreg_year_cso').attr('min')) && $('.upreg_year_cso').val().length > 3){
                $('.upreg_year_cso').val($('.upreg_year_cso').attr('min'));
            }  
        });
    //end update cso

    //unreg cso
    $('.unreg_month_cso, .unreg_year_cso').on("change paste keyup", function() {
            if ($('.unreg_month_cso').val()==2) {
                if($('.unreg_year_cso').val()%4==0){
                    $("#29unc").show();
                    if($('.unreg_day_cso').val() > 29){
                        $('.unreg_day_cso').val(29);
                    }
                }
                else{
                    $("#29unc").hide();
                    if($('.unreg_day_cso').val() > 28){
                        $('.unreg_day_cso').val(28);
                    }
                }
                $("#30unc").hide();
                $("#31unc").hide();

                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("masuk kabisat " + test + " " + test2);
            }
            else if ($('.unreg_month_cso').val()==1||$('.unreg_month_cso').val()==3||$('.unreg_month_cso').val()==5||$('.unreg_month_cso').val()==7||
                $('.unreg_month_cso').val()==8||$('.unreg_month_cso').val()==10||$('.unreg_month_cso').val()==12){
                $("#30unc").show();
                $("#31unc").show();
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("tidak kabisat " + test + " " + test2);
            }
            else
            {
                $("#30unc").show();
                $("#31unc").hide();
                if($('.unreg_day_cso').val() > 30){
                    $('.unreg_day_cso').val(30);
                }
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("kabisat " + test + " " + test2);
            }
            console.log($('.unreg_year_cso').val().length);
            if(parseInt($('.unreg_year_cso').val()) > parseInt($('.unreg_year_cso').attr('max')) && $('.unreg_year_cso').val().length > 3){
                $('.unreg_year_cso').val($('.unreg_year_cso').attr('max'));
            }
            if(parseInt($('.unreg_year_cso').val()) < parseInt($('.unreg_year_cso').attr('min')) && $('.unreg_year_cso').val().length > 3){
                $('.unreg_year_cso').val($('.unreg_year_cso').attr('min'));
            }  
        });
    //end unreg cso

    //update unreg cso
    $('.upunreg_month_cso, .upunreg_year_cso').on("change paste keyup", function() {
        if ($('.upunreg_month_cso').val()==2) {
                if($('.upunreg_year_cso').val()%4==0){
                    $("#29ur").show();
                    if($('.upunreg_day_cso').val() > 29){
                        $('.upunreg_day_cso').val(29);
                    }
                }
                else{
                    $("#29ur").hide();
                    if($('.upunreg_day_cso').val() > 28){
                        $('.upunreg_day_cso').val(28);
                    }
                }
                $("#30ur").hide();
                $("#31ur").hide();

                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("masuk kabisat " + test + " " + test2);
            }
            else if ($('.upunreg_month_cso').val()==1||$('.upunreg_month_cso').val()==3||$('.upunreg_month_cso').val()==5||$('.upunreg_month_cso').val()==7||
                $('.upunreg_month_cso').val()==8||$('.upunreg_month_cso').val()==10||$('.upunreg_month_cso').val()==12){
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
                if($('.upunreg_day_cso').val() > 30){
                    $('.upunreg_day_cso').val(30);
                }
                // var test = $('.birth_month').val();
                // var test2 = $('.birth_day').val();
                // console.log("kabisat " + test + " " + test2);
            }
            console.log($('.upunreg_year_cso').val().length);
            if(parseInt($('.upunreg_year_cso').val()) > parseInt($('.upunreg_year_cso').attr('max')) && $('.upunreg_year_cso').val().length > 3){
                $('.upunreg_year_cso').val($('.upunreg_year_cso').attr('max'));
            }
            if(parseInt($('.upunreg_year_cso').val()) < parseInt($('.upunreg_year_cso').attr('min')) && $('.upunreg_year_cso').val().length > 3){
                $('.upunreg_year_cso').val($('.upunreg_year_cso').attr('min'));
            }  
        });
    //end update unreg cso


</script>
<script type="text/javascript">
    $(document).ready(function () {
        function _(el){
            return document.getElementById(el);
        }

        //untuk refresh halaman ketika modal [SUCCESS Update] ditutup 
        $('#modal-NotificationUpdate').on('hidden.bs.modal', function() { 
            location.reload(); 
        });

        //untuk refresh halaman ketika modal [SUCCESS Add] ditutup 
        $('#modal-Notification').on('hidden.bs.modal', function() { 
            location.reload(); 
        });

        //-- Add CSO --//
            var formAdd;
            $('#btn-confirmAddCso').click(function(e){
                e.preventDefault();

                formAdd = _("actionAdd");
                formAdd = new FormData(formAdd);

                var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandlerAdd, false);
                ajax.addEventListener("load", completeHandlerAdd, false);
                ajax.addEventListener("error", errorHandlerAdd, false);
                ajax.addEventListener("abort", abortHandlerAdd, false);
                ajax.open("POST", "{{ route('store_cso') }}");
                ajax.setRequestHeader("X-CSRF-TOKEN",$('meta[name="csrf-token"]').attr('content'));
                ajax.send(formAdd);
            });
            function progressHandlerAdd(event){
                document.getElementById("btn-confirmAddCso").innerHTML = "Uploading...";
            }
            function completeHandlerAdd(event){
                var hasil = JSON.parse(event.target.responseText);
                var formDOM = _("actionAdd");
                //console.log(hasil);
                for (var key of formAdd.keys()) {
                    $("#actionAdd").find("input[name="+key+"]").removeClass("is-invalid");
                    $("#actionAdd").find("select[name="+key+"]").removeClass("is-invalid");
                    $("#actionEdit").find("textarea[name="+key+"]").removeClass("is-invalid");

                    $("#actionAdd").find("input[name="+key+"]").next().find("strong").text("");
                    $("#actionAdd").find("select[name="+key+"]").next().find("strong").text("");
                    $("#actionEdit").find("textarea[name="+key+"]").next().find("strong").text("");
                }

                if(hasil['errors'] != null){
                    for (var key of formAdd.keys()) {
                        // console.log(key);
                        if(typeof hasil['errors'][key] === 'undefined') {
                        }
                        else
                        {
                            $("#actionAdd").find("input[name="+key+"]").addClass("is-invalid");
                            $("#actionAdd").find("select[name="+key+"]").addClass("is-invalid");

                            $("#actionAdd").find("input[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                            $("#actionAdd").find("select[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                        }
                    }
                }
                else{
                    $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-success\">Data has been ADDED successfully</div>");
                    $("#modal-Notification").modal("show");
                }

                document.getElementById("btn-confirmAddCso").innerHTML = "SAVE";
            }
            function errorHandlerAdd(event){
                document.getElementById("btn-confirmAddCso").innerHTML = "SAVE";
                $("#modal-Notification").find("p#txt-notification").html(event.target.responseText);
                $("#modal-Notification").modal("show");
            }
            function abortHandlerAdd(event){
            }

        //-- Edit CSO --//
            var formEdit;
            $('#btn-confirmUpdateCso').click(function(e){
                e.preventDefault();

                formEdit = _("actionEdit");
                formEdit = new FormData(formEdit);
                formEdit.append("id", this.value);

                var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandlerEdit, false);
                ajax.addEventListener("load", completeHandlerEdit, false);
                ajax.addEventListener("error", errorHandlerEdit, false);
                ajax.addEventListener("abort", abortHandlerEdit, false);
                ajax.open("POST", "{{ route('update_cso') }}");
                ajax.setRequestHeader("X-CSRF-TOKEN",$('meta[name="csrf-token"]').attr('content'));
                ajax.send(formEdit);
            });
            function progressHandlerEdit(event){
                document.getElementById("btn-confirmUpdateCso").innerHTML = "Uploading...";
            }
            function completeHandlerEdit(event){
                var hasil = JSON.parse(event.target.responseText);
                var formDOM = _("actionEdit");

                for (var key of formEdit.keys()) {
                    $("#actionEdit").find("input[name^='"+key+"']").removeClass("is-invalid");
                    $("#actionEdit").find("select[name^='"+key+"']").removeClass("is-invalid");
                    $("#actionEdit").find("textarea[name="+key+"]").removeClass("is-invalid");

                    $("#actionEdit").find("input[name^='"+key+"']").next().find("strong").text("");
                    $("#actionEdit").find("select[name^='"+key+"']").next().find("strong").text("");
                    $("#actionEdit").find("textarea[name="+key+"]").next().find("strong").text("");
                }

                if(hasil['errors'] != null){
                    for (var key of formEdit.keys()) {
                        if(typeof hasil['errors'][key] === 'undefined') {

                        }
                        else
                        {
                            $("#actionEdit").find("input[name^='"+key+"']").addClass("is-invalid");
                            $("#actionEdit").find("select[name^='"+key+"']").addClass("is-invalid");
                            $("#actionEdit").find("textarea[name="+key+"]").addClass("is-invalid");

                            $("#actionEdit").find("input[name^='"+key+"']").next().find("strong").text(hasil['errors'][key]);
                            $("#actionEdit").find("select[name^='"+key+"']").next().find("strong").text(hasil['errors'][key]);
                            $("#actionEdit").find("textarea[name="+key+"]").next().find("strong").text(hasil['errors'][key]);
                        }
                    }
                    //Jika ada error, scroll langsung menuju error
                    var elmnt = document.getElementsByClassName("is-invalid");
                    elmnt[0].scrollIntoView();
                }
                else{
                    $('#modal-UpdateForm').modal('hide');
                    // $("#modal-NotificationUpdate").modal("show");
                    $("#modal-Notification").find("p#txt-notification").html("<div class=\"alert alert-success\">Data has been CHANGED successfully</div>");
                    $("#modal-Notification").modal("show");
                }

                document.getElementById("btn-confirmUpdateCso").innerHTML = "SAVE";
            }
            function errorHandlerEdit(event){
                document.getElementById("btn-confirmUpdateCso").innerHTML = "SAVE";
                $("#txt-notification > div").html(event.target.responseText);
                $('#modal-UpdateForm').modal('hide');
                // $("#modal-Notification").find("p#txt-notification").html(event.target.responseText);
                $("#modal-NotificationUpdate").modal("show");
            }
            function abortHandlerEdit(event){
            }

        //-- Reset Form Update --//
        $("#modal-UpdateForm").on("hidden.bs.modal", function() {
            var formUpdate = _("actionEdit");
            formUpdate = new FormData(formUpdate);
            formUpdate.append("id", this.value);

            for (var key of formUpdate.keys()) {
                $("#actionEdit").find("input[name="+key+"]").removeClass("is-invalid");
                $("#actionEdit").find("select[name="+key+"]").removeClass("is-invalid");
                $("#actionEdit").find("textarea[name="+key+"]").removeClass("is-invalid");

                $("#actionEdit").find("input[name="+key+"]").next().find("strong").text("");
                $("#actionEdit").find("select[name="+key+"]").next().find("strong").text("");
                $("#actionEdit").find("textarea[name="+key+"]").next().find("strong").text("");
            }
        })
    });

    //The Branch changed when Country is selected
    $("#country").change(function () {
        var countryName = $(this).val().toUpperCase();
        var branches = "";

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: 'post',
            url: "{{route('select-country')}}",
            data: {
                'country': countryName
            },
            success: function(data){
                if(data.length > 0)
                {
                    data.forEach(function(key, value){
                        branches += '<option value="'+data[value].id+'">'+data[value].code + " - " + data[value].name+'</option>';
                    });
                    $("#branch").html("");
                    $("#branch").append(branches);
                }
                else
                {
                    $("#branch").html("");
                    $("#branch").append("<option value=\"\" readonly selected>BRANCH NOT FOUND</option>");
                }
            },
        });
    });

    //The Branch (in Edit Form) changed when Country is selected
    $("#txtcountry-cso").change(function () {
        var countryName = $(this).val().toUpperCase();
        var branches = "";

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: 'post',
            url: "{{route('select-country')}}",
            data: {
                'country': countryName
            },
            success: function(data){
                console.log("masuk change country");
                if(data.length > 0)
                {
                    data.forEach(function(key, value){
                        branches += '<option value="'+data[value].id+'">'+data[value].code + " - " + data[value].name+'</option>';
                    });
                    $("#txtbranch-cso").html("");
                    $("#txtbranch-cso").append(branches);
                }
                else
                {
                    $("#txtbranch-user").html("");
                    $("#txtbranch-user").append("<option value=\"\" readonly selected>BRANCH NOT FOUND</option>");
                }
            },
        });
    });

    //The Branch field is selected based on what CSO has, when Edit Button clicked
    $(".btn-editCso").click(function(e) {
        
        var dataCso = GetListCsoData(this.name);
        var countryName = dataCso.country;
        var branches = "";

        var cso_reg_date = dataCso.reg_date;
        var cso_splitregdate = cso_reg_date.split('-');
        var cso_reg_year = cso_splitregdate[0];
        $('#txtregyear-cso').val(cso_reg_year);
        
        var cso_reg_month = cso_splitregdate[1];
        if(cso_reg_month[0].includes("0")){
            var hasil_cso_reg_month = cso_reg_month[1];
            $('#txtregmonth-cso').val(hasil_cso_reg_month);
        }else{
            var hasil_cso_reg_month2 = cso_reg_month;
            $('#txtregmonth-cso').val(hasil_cso_reg_month2);
        }

        var cso_reg_day = cso_splitregdate[2];
        if(cso_reg_day[0].includes("0")){
            var hasil_cso_reg_day = cso_reg_day[1];
            $('#txtregday-cso').val(hasil_cso_reg_day);
        }else{
            var hasil_cso_reg_day2 = cso_reg_day;
            $('#txtregday-cso').val(hasil_cso_reg_day2);
        }

        var cso_unreg_date = dataCso.unreg_date;
        //alert(cso_unreg_date);
        if(cso_unreg_date){
            //alert("unreg tidak null");
            var cso_splitunregdate = cso_unreg_date.split('-');
            var cso_unreg_year = cso_splitunregdate[0];
            $('#txtunregyear-cso').val(cso_unreg_year);

            var cso_unreg_month = cso_splitunregdate[1];
            if(cso_unreg_month[0].includes("0")){
                var hasil_cso_unreg_month = cso_unreg_month[1];
                $('#txtunregmonth-cso').val(hasil_cso_unreg_month);
            }else{
                var hasil_cso_unreg_month2 = cso_unreg_month;
                $('#txtunregmonth-cso').val(hasil_cso_unreg_month2);
            }

            var cso_unreg_day = cso_splitunregdate[2];
            if(cso_unreg_day[0].includes("0")){
                var hasil_cso_unreg_day = cso_unreg_day[1];
                $('#txtunregday-cso').val(hasil_cso_unreg_day);
            }else{
                var hasil_cso_unreg_day2 = cso_unreg_day;
                $('#txtunregday-cso').val(hasil_cso_unreg_day2);
            }
        }else{
            var cso_splitunregdate = cso_unreg_date.split('-');
            var cso_unreg_year = cso_splitunregdate[0];
            var cso_unreg_month = cso_splitunregdate[1];
            var cso_unreg_day = cso_splitunregdate[2];

            $('#txtunregyear-cso').val(cso_unreg_year);
            $('#txtunregmonth-cso').val(cso_unreg_month);
            $('#txtunregday-cso').val(cso_unreg_day);
            //alert("unreg kosong");
        }
        

        //alert(cso_unreg_date);

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: 'post',
            url: "{{route('select-country')}}",
            data: {
                'country': countryName
            },
            success: function(data){
                data.forEach(function(key, value){
                    branches += '<option value="'+data[value].id+'">'+data[value].code+' - '+data[value].name+'</option>';
                });
                $("#txtbranch-cso").children("optgroup").eq(0).html("");
                $("#txtbranch-cso").children("optgroup").eq(0).append(branches);
                $("#txtbranch-cso").children("optgroup").eq(0).children("option:contains('"+dataCso.branch+"')").attr("selected", "selected");

                var idSelectedBranch = $("#txtbranch-cso").val();
            },
        });
    });

    // Scrollbar fix 
    // If you have a modal on your page that exceeds the browser height, 
    // then you can't scroll in it when closing an second modal. 
    // Ketika tutup modal pertama, trus scroll, yang ter-scroll malah page nya -> Salah 
    $(document).on('hidden.bs.modal', '.modal', function () { 
        $('.modal:visible').length && $(document.body).addClass('modal-open'); 
    });
</script>
@endsection