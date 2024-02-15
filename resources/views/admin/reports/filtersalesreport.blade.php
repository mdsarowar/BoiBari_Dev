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
                        @foreach($orders as $key => $row)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ date('d-m-Y',strtotime($row->created_at)) }}</td>
                            <td>{{ $row->order_id }}</td>
                            <td>{{ $row->qty_total }}</td>
                            <td>{{ $row->paid_in_currency }}</td>
                            <td>{{ sprintf('%.2f',$row->order_total - $row->tax_amount - $row->shipping) }}</td>
                            <td>{{ $row->shipping }}</td>
                            <td>{{ $row->handlingcharge }}</td>
                            <td>{{ $row->gift_charge }}</td>
                            <td>{{ $row->tax_amount }}</td>
                            <td>{{ $row->order_total + $row->handlingcharge + $row->gift_charge }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>                  
            </div>
        </div>
    </div>
</div>
     
@endsection

