@extends('admin.layouts.master-soyuz')
@section('title',__('Commission List Per Category'))
@section('body')

<?php
  $data['heading'] = 'Commission List Per Category';
  $data['title0'] = 'Product Management';
  $data['title1'] = 'Commission List Per Category';
?>
@include('admin.layouts.topbar',$data)

<div class="contentbar bardashboard-card"> 
  <div class="row">

    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
         
          <div class="row">
            <div class="col-lg-10">
              <h5 class="box-title"> {{ __('Commission') }}</h5>
            </div>
            <div class="col-md-2">
              <div class="widgetbar">
                <div class="wrapper-tooltip">
                  <button type="button" class="btn btn-primary-rgba"><i class="fa fa-info-circle float-right"></i></button>
                  <div class="tooltip">{{__("If you enable commission by per category than in side menu you can see a new commission menu where you can create commission for each category and define rates too.")}}  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
       
        
          <div class="table-responsive">
            <table id="full_detail_table" class="table table-hover table-bordered">
              <thead>
                <tr class="table-heading-row">
                  <th>{{ __("ID") }}</th>
                  <th>{{ __("Rate") }}</th>
                  <th>{{ __('Type') }}</th>
                  <th>{{ __("Action") }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($commission_settings as $key=> $commission)

                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>@if($commission->type != 'c') {{$commission->rate}}
                    {{ $commission->p_type == 'f' ? __("Fix Amount") : "%" }} @else {{__("Linked to category (check rate under commision menu for each category)")}} @endif </td>
                  <td>
                    @if($commission->type == 'c')
                    {{__('Category')}}
                    @elseif($commission->type == 'flat')
                    {{__('Flat For All')}}
                    @endif
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-round btn-primary-rgba" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                      <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                    <a title="Edit Commission setting" class="dropdown-item" href="{{url('admin/commission_setting/'.$commission->id.'/edit')}}"><i class="feather icon-edit mr-2"></i>{{ __("Edit") }}</a>
                    </div>
                  </div>
                </td>
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
 