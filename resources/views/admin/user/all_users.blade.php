@extends('admin.layouts.master-soyuz')
@section('title',__('All Users | '))
@section('body')

<?php
  $data['heading'] = 'All Users';
  $data['title0'] = 'All Users';
?>
@include('admin.layouts.topbar',$data)

<div class="contentbar bardashboard-card">    
  
  <div class="row card">
  
      <div class="col-lg-12">
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          @foreach($errors->all() as $error)
          <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span></button></p>
          @endforeach
        </div>
        @endif

        <ul class="nav nav-pills mt-4" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="true">Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Sellers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Customer</a>
            </li>
        </ul>
        <div class="tab-content mt-2" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <select data-placeholder="Filter by role" name="roles" id="roles" class="form-control select2">
                                    <option value="">{{ __("Filter by role") }}</option>
                                    <option value="all">{{ __("All") }}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                            </div>
                            <div class="col-md-3">
                                <div class="widgetbar">
                                @can('users.create')
                                <a href="{{ route('users.create',['type' => app('request')->input('filter')]) }}" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>  {{ __('Create a new user') }}</a>
                                @endcan
                                
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="card-body">
                    
                        <div class="table-responsive">
                            <table id="userstable" class="table table-bordered table-striped">
                                <thead>
                                    <th>
                                    #
                                    </th>
                                    <th>
                                    {{__("Image")}}
                                    </th>
                                    <th>
                                    {{__("Name")}}
                                    </th>
                                    <th>
                                    {{ __("Email") }}
                                    </th>
                                    <th>
                                    {{ __("Contact No.") }}
                                    </th>
                                    <th>
                                    {{ __("Role") }}
                                    </th>
                                    <th>
                                    {{ __("Login as user") }}
                                    </th>
                                    <th>
                                    {{ __("Action") }}
                                    </th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="widgetbar text-right">

                            @can('users.create')
                            <a href="{{ route('add.seller.user') }}" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>  {{ __('Create a new seller') }}</a>
                            @endcan
                        
                        </div>
                    </div>                    
                    <div class="card-body">
                    
                        <div class="table-responsive">
                            <table id="sellerTable" class="table table-bordered table-striped">
                                <thead>
                                    <th>
                                    #
                                    </th>
                                    <th>
                                    {{__("Image")}}
                                    </th>
                                    <th>
                                    {{__("Name")}}
                                    </th>
                                    <th>
                                    {{ __("Email") }}
                                    </th>
                                    <th>
                                    {{ __("Contact No.") }}
                                    </th>
                                    <th>
                                    {{ __("Role") }}
                                    </th>
                                    <th>
                                    {{ __("Login as user") }}
                                    </th>
                                    <!-- <th>
                                    {{ __("Registerd at") }}
                                    </th> -->
                                    <th>
                                    {{ __("Action") }}
                                    </th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="widgetbar text-right">

                            @can('users.create')
                            <a href="{{ route('add.customer.user') }}" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>  {{ __('Create a new customer') }}</a>
                            @endcan
                        
                        </div>
                    </div>                    
                    <div class="card-body">
                    
                        <div class="table-responsive">
                            <table id="customerTable" class="table table-bordered table-striped">
                                <thead>
                                    <th>
                                    #
                                    </th>
                                    <th>
                                    {{__("Image")}}
                                    </th>
                                    <th>
                                    {{__("Name")}}
                                    </th>
                                    <th>
                                    {{ __("Email") }}
                                    </th>
                                    <th>
                                    {{ __("Contact No.") }}
                                    </th>
                                    <th>
                                    {{ __("Role") }}
                                    </th>
                                    <th>
                                    {{ __("Login as user") }}
                                    </th>
                                    <!-- <th>
                                    {{ __("Registerd at") }}
                                    </th> -->
                                    <th>
                                    {{ __("Action") }}
                                    </th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="widgetbar text-right">

                            @can('users.create')
                            <a href="{{ route('add.admin.user') }}" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>  {{ __('Create a new admin') }}</a>
                            @endcan
                        
                        </div>
                    </div>                    
                    <div class="card-body">
                    
                        <div class="table-responsive">
                            <table id="adminTable" class="table table-bordered table-striped">
                                <thead>
                                    <th>
                                    #
                                    </th>
                                    <th>
                                    {{__("Image")}}
                                    </th>
                                    <th>
                                    {{__("Name")}}
                                    </th>
                                    <th>
                                    {{ __("Email") }}
                                    </th>
                                    <th>
                                    {{ __("Contact No.") }}
                                    </th>
                                    <th>
                                    {{ __("Role") }}
                                    </th>
                                    <th>
                                    {{ __("Login as user") }}
                                    </th>
                                    <!-- <th>
                                    {{ __("Registerd at") }}
                                    </th> -->
                                    <th>
                                    {{ __("Action") }}
                                    </th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          
    </div>
    <!-- End col -->
</div>

@endsection     
                        
@section('custom-script')
  <script>
      $(function() {
           var table = $('#userstable').DataTable({
                lengthChange: true,
                responsive: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                url: "{{ route("users.index") }}",
                    data: function (d) {
                        d.roles = $('#roles').val();
                    }
                },
                language: {
                  searchPlaceholder: "Search users"
                },
                columns: [
                  {data : 'DT_RowIndex', name: 'DT_RowIndex', orderable : false, searchable : false},
                  {data : 'image', name: 'image', orderable : false, searchable : false},
                  {data : 'name', name : 'users.name'},
                  {data : 'email', name : 'users.email'},
                  {data : 'mobile', name : 'mobile'},
                  {data : 'role', name : 'role'},
                  {data : 'loginas', name: 'loginas', orderable : false, searchable : false},
                //   {data : 'created_at', name : 'users.created_at'},
                  {data : 'action', name : 'action',searchable : false}
                ],
                dom : 'lBfrtip',
                buttons : [
                    'csv','excel','pdf','print'
                ]
            });

            table.buttons().container().appendTo('#userstable .col-md-3:eq(0)');

            $('#roles').on('change',function(){
                table.draw();
            });
        });
</script>
<script>
      $(function() {
           var table = $('#sellerTable').DataTable({
                lengthChange: true,
                responsive: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                url: "{{ route("all.sellers") }}",
                    data: function (d) {
                        d.roles = $('#roles').val();
                    }
                },
                language: {
                  searchPlaceholder: "Search users"
                },
                columns: [
                  {data : 'DT_RowIndex', name: 'DT_RowIndex', orderable : false, searchable : false},
                  {data : 'image', name: 'image', orderable : false, searchable : false},
                  {data : 'name', name : 'users.name'},
                  {data : 'email', name : 'users.email'},
                  {data : 'mobile', name : 'mobile'},
                  {data : 'role', name : 'role'},
                  {data : 'loginas', name: 'loginas', orderable : false, searchable : false},
                //   {data : 'created_at', name : 'users.created_at'},
                  {data : 'action', name : 'action',searchable : false}
                ],
                dom : 'lBfrtip',
                buttons : [
                    'csv','excel','pdf','print'
                ]
            });

            table.buttons().container().appendTo('#userstable .col-md-3:eq(0)');

            $('#roles').on('change',function(){
                table.draw();
            });
        });
  </script>
  <script>
      $(function() {
           var table = $('#customerTable').DataTable({
                lengthChange: true,
                responsive: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                url: "{{ route("all.customers") }}",
                    data: function (d) {
                        d.roles = $('#roles').val();
                    }
                },
                language: {
                  searchPlaceholder: "Search users"
                },
                columns: [
                  {data : 'DT_RowIndex', name: 'DT_RowIndex', orderable : false, searchable : false},
                  {data : 'image', name: 'image', orderable : false, searchable : false},
                  {data : 'name', name : 'users.name'},
                  {data : 'email', name : 'users.email'},
                  {data : 'mobile', name : 'mobile'},
                  {data : 'role', name : 'role'},
                  {data : 'loginas', name: 'loginas', orderable : false, searchable : false},
                //   {data : 'created_at', name : 'users.created_at'},
                  {data : 'action', name : 'action',searchable : false}
                ],
                dom : 'lBfrtip',
                buttons : [
                    'csv','excel','pdf','print'
                ]
            });

            table.buttons().container().appendTo('#userstable .col-md-3:eq(0)');

            $('#roles').on('change',function(){
                table.draw();
            });
        });
  </script>
  <script>
      $(function() {
           var table = $('#adminTable').DataTable({
                lengthChange: true,
                responsive: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                url: "{{ route("all.admins") }}",
                    data: function (d) {
                        d.roles = $('#roles').val();
                    }
                },
                language: {
                  searchPlaceholder: "Search users"
                },
                columns: [
                  {data : 'DT_RowIndex', name: 'DT_RowIndex', orderable : false, searchable : false},
                  {data : 'image', name: 'image', orderable : false, searchable : false},
                  {data : 'name', name : 'users.name'},
                  {data : 'email', name : 'users.email'},
                  {data : 'mobile', name : 'mobile'},
                  {data : 'role', name : 'role'},
                  {data : 'loginas', name: 'loginas', orderable : false, searchable : false},
                //   {data : 'created_at', name : 'users.created_at'},
                  {data : 'action', name : 'action',searchable : false}
                ],
                dom : 'lBfrtip',
                buttons : [
                    'csv','excel','pdf','print'
                ]
            });

            table.buttons().container().appendTo('#userstable .col-md-3:eq(0)');

            $('#roles').on('change',function(){
                table.draw();
            });
        });
  </script>
@endsection    