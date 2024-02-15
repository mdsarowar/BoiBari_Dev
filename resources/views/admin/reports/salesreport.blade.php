@extends('admin.layouts.master-soyuz')
@section('title',__('Sales reports all products'))
@section('body')

<?php
  $data['heading'] = 'Sales reports all products';
  $data['title0'] = 'Report';
  $data['title1'] = 'Sales Reports';
?>
@include('admin.layouts.topbar',$data)

<div class="contentbar bardashboard-card"> 
  <div class="row">
    
    <div class="col-lg-12">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
            @foreach($errors->all() as $error)
            <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></p>
            @endforeach
            </div>
        @endif
      <div class="card m-b-30">
        <div class="card-header">
          <h5 class="box-title">{{ __('Sales Report') }}</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('filter.sales-report')}}">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Date Range</label>
                            <input type="date" name="to_date" class="form-control to_date">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for=""> </label>
                            <input type="date" name="from_date" class="form-control mt-2">
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
                <table id="sales_report" class="table table-striped table-bordered">
                    <thead>
                        <th>#</th>
                        <th>{{ __("Date") }}</th>
                        <th>{{ __("Order ID") }}</th>
                        <th>{{ __("Total Qty.") }}</th>
                        <th>{{ __("Paid Currency") }}</th>
                        <th>{{ __("Subtotal") }}</th>
                        <th>{{ __("Total Shipping") }}</th>
                        <th>{{ __("Handling Charges") }}</th>
                        <th>{{ __("Total Gift charges.") }}</th>
                        <th>{{ __("Total Tax") }}</th>
                        <th>{{ __("Grand total") }}</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>                  
            </div>
        </div>
    </div>
</div>
        
​
                  
       
   
                       
     
@endsection
@section('custom-script')
<script>
    $(function () {
        "use strict";
        var table = $('#sales_report').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 50,
            ajax: '{{ route("admin.sales.report") }}',
            language: {
                searchPlaceholder: "Search in sales reports..."
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'date',
                    name: 'orders.created_at'
                },
                {
                    data: 'order_id',
                    name: 'orders.order_id'
                },
                {
                    data: 'qty_total',
                    name: 'orders.qty_total'
                },
                {
                    data: 'paid_in_currency',
                    name: 'orders.paid_in_currency'
                },
                {
                    data: 'subtotal',
                    name: 'orders.order_total'
                },
                {
                    data: 'shipping',
                    name: 'orders.shipping'
                },
                {
                    data: 'handlingcharge',
                    name: 'orders.handlingcharge'
                },
                {
                    data: 'gift_charge',
                    name: 'orders.gift_charge'
                },
                {
                    data: 'tax_amount',
                    name: 'orders.tax_amount'
                },
                {
                    data: 'grand_total',
                    name: 'grand_total',
                    searchable: false,
                    orderable: false
                }
            ],
            dom: 'lBfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ],
            order: [
                [0, 'DESC']
            ]
        });

    });
</script>
@endsection
