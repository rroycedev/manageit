@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger" style="width: 80%;margin: auto;" id="alertwindow">
        <div style="float: left;">
          <ul style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;">
               @foreach ($errors->all() as $error)
                 <li style="list-style: none;">{{ $error }}</li>
             @endforeach
            </ul>
        </div>
        <div style="float: right;"><i class="fa fa-times" aria-hidden="true" style="cursor: pointer;color: white;" onclick="$('#alertwindow').hide()"></i></div>
        <div style="clear: both;"></div>
    </div>
@endif

@if(session()->has('message'))
    <div class="alert alert-success" style="width: 80%;margin: auto;" id="alertwindow">
        <div style="float: left;">{{ session()->get('message') }}</div>
        <div style="float: right;"><i class="fa fa-times" aria-hidden="true" style="cursor: pointer;color: white;" onclick="$('#alertwindow').hide()"></i></div>
        <div style="clear: both;"></div>
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">

            <div class="card" style="width: 444px;">
                <div class="card-header">Change Database Connection</div>
                <div class="card-body">
                {{ Form::open(array('url' => 'dbconnections/update')) }}
                <input type="hidden" id="server_group_id" name="server_group_id" value="{{ $profile->server_group_id }}" />
                    <div>
                        <label>Group</label>
                        <input  type="text" class="form-control" style="width: 300px;" value="{{ $profile->server_group_name }}" readonly />
                    </div>
                     <div style="margin-top: 20px;">
                        <label for="username">Username</label>
                        <input id="username" name="username" type="text" class="form-control" style="width: 300px;" value="{{ $profile->username }}" />
                    </div>
                    <div style="margin-top: 20px;">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" class="form-control" style="width: 300px;" value="" />
                    </div>
                    <div style="margin-top: 20px;">
                        <label for="port">Port</label>
                        <input id="port" name="port" type="text" class="form-control" style="width: 100px;" value="{{ $profile->port }}" />&nbsp;(Default is 3306)
                    </div>
                       <div class="form-group" style="width: 165px;margin:auto;margin-top: 20px;">
                            <button id="changebtn" name="changebtn" type="submit" class="btn btn-primary">Change</button>
                            <button id="cancelbtn" name="cancelbtn" type="submit" class="btn btn-info">Cancel</button>
                        </div>
                        {{ Form::close() }}
                </div>
                <div class="card-footer">&nbsp;
                </div>
            </div>

    </div>
</div>
@endsection
