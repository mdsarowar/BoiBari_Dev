@extends('admin.layouts.master-soyuz')
@section('title',__('All Flashdeals'))
@section('body')

<?php
  $data['heading'] = 'All Flashdeals';
  $data['title0'] = 'Marketing Tools';
  $data['title1'] = 'All Flashdeals';
?>
@include('admin.layouts.topbar',$data)

<div class="contentbar bardashboard-card">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="card-title">{{__("All flashdeals")}}</h3>
                        </div>
                        <div class="col-md-4">
                            <div class="widgetbar">
                                <a  href=" {{ route('flash-sales.create') }} " class="btn btn-primary-rgba mr-2">
                                    <i class="feather icon-plus mr-2"></i> {{__("Add new flash sale")}}
                                </a>
                            </div>
                        </div>
                    </div>
                        
                </div>

                <div class="card-body">
                    <table id="flashdeals" class="table table-striped">
                        <thead>
                            <th>
                                #
                            </th>
                            <th>
                                {{__("Deal title")}}
                            </th>
                            <th>
                                {{__("Start date")}}
                            </th>
                            <th>
                                {{__("End date")}}
                            </th>
                            <th>
                                {{__("Banner")}}
                            </th>
                            <th>
                                {{__("Action")}}
                            </th>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('custom-script')
    <script>
            $(function () {
                "use strict";
                var table = $('#flashdeals').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: @json(route("flash-sales.index")),
                    language: {
                        searchPlaceholder: "Search deals..."
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'flashsales.id', searchable : false},
                        {data : 'title', name : 'flashsales.title'},
                        {data : 'start_date', name : 'flashsales.start_date'},
                        {data : 'end_date', name : 'flashsales.end_date'},
                        {data : 'background_image', name : 'background_image',searchable : false, orderable : false},
                        {data : 'action', name : 'action',searchable : false, orderable : false},
                    ],
                    dom : 'lBfrtip',
                    buttons : [
                        'csv','excel','pdf','print'
                    ],
                    order : [[0,'DESC']]
                });
                
            });
    </script>
@endsection