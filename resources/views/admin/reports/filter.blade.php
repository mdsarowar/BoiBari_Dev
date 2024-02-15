@extends('admin.layouts.master-soyuz')
@section('title',__('Device History'))
@section('body')

<?php
  $data['heading'] = 'Device History';
  $data['title0'] = 'Report';
  $data['title1'] = 'Device History';
?>
@include('admin.layouts.topbar',$data)

<div class="contentbar bardashboard-card"> 
   
    <div class="row">
       
        <div class="col-md-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">{{ __('Device History') }}</h5>
                </div>
                
                <div class="card-body">
                <form method="post" action="{{route('filter.device.logs')}}">
                  @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Date Range</label>
                                <input type="date" name="to_date" value="{{Session::get('to_date')}}" class="form-control to_date">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for=""> </label>
                                <input type="date" name="from_date" value="{{Session::get('from_date')}}" class="form-control mt-2">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for=""> </label>
                                <input type="submit" value="Filter" class="form-control btn btn-info mt-2">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <th>{{ __("#") }}</th>
                            <th>{{ __("User name")}}</th>
                            <th>{{ __("IP Address") }}</th>
                            <th>{{ __("Platform") }}</th>
                            <th>{{ __("Browser") }}</th>
                            <th>{{ __("Logged in at") }}</th>
                            <th>{{ __("Logged out at") }}</th>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    <b> <span class="text-dark">{{__('Name:')}}</span> </b> {{$user->username}}
                                    <br>
                                    <b> <span class="text-dark">{{__('Email:')}}</span> </b> {{$user->useremail}}
                                </td>
                                <td>{{ $user->ip_address }}</td>
                                <td>{{ $user->platform }}</td>
                                <td>{{ $user->browser }}</td>
                                <td>{{ $user->login_at ? date('d-m-Y | h:i A',strtotime($user->login_at)) : '-' ; }}</td>
                                <td>{{ $user->logout_at ? date('d-m-Y | h:i A',strtotime($user->logout_at)) : '-' ; }}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('custom-script')

@endsection