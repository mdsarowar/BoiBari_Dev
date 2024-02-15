@extends('admin.layouts.master-soyuz')
@section('title',__('Edit Return Policy | '))
@section('body')

<?php
  $data['heading'] = 'Edit Return Policy';
  $data['title0'] = 'Product Management';
  $data['title1'] = 'Return Policy';
  $data['title2'] = 'Edit Return Policy';
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
          <div class="row">
            <div class="col-lg-10">
              <h5 class="box-title">{{ __('Edit Return Policy') }}</h5>
            </div>
            <div class="col-md-2">
              <div class="widgetbar">
                <a href="{{url('admin/return-policy')}}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
        
         <form action="{{url('admin/return_policy/update/'.$policy->id)}}" class="form" method="POST" novalidate enctype="multipart/form-data">
            {{csrf_field()}}
            {{ method_field('PUT') }}
                      
              <div class="row">
                
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="text-dark">{{ __('Policy Name :') }} <span class="text-danger">*</span></label>
                        <input placeholder="{{ __("Enter Policy Name") }}" type="text" id="first-name" name="name" class="form-control" value="{{$policy->name ?? ''}}">
                    </div>
                </div>

                <!-- Amount -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="text-dark">{{ __('Amount :') }} <span class="text-danger">*</span></label>
                        <input placeholder="%" type="text" id="first-name" name="amount" class="form-control" value="{{$policy->amount ?? ''}}">
                        <small>({{__("Please enter amount in Percentage")}})</small>
                    </div>
                </div>

                <!-- Return days -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="text-dark">{{ __('Return days :') }} <span class="text-danger">*</span></label>
                        <input placeholder="Please enter product return days" type="text" value="{{$policy->days ?? ''}}" id="first-name" name="days" class="form-control">
                    </div>
                </div>

                <div class="form-group col-md-6">
                  <label class="control-label text-dark" for="first-name">{{__("Return Accept By:")}}</label>
                  <select class=" form-control select2" name="return_acp" id="">
                    <option>{{ __('Please choose') }}</option>
                    <option value="auto" {{ $policy->return_acp=='auto'?'selected':'' }}>{{__('Automatic')}}</option>
                    <option value="admin" {{ $policy->return_acp=='admin'?'selected':'' }}>{{__("Admin")}}</option>
                    <option value="vender" {{ $policy->return_acp=='vender'?'selected':'' }}>{{__("Vender")}}</option>
                  </select>
                  <small class="txt-desc">({{__("Please Choose an option to select who can accept return")}})</small>
                </div>

                  <!-- Description -->
                <div class="col-md-12">
                  <div class="form-group">
                      <label class="text-dark">{{ __('Description') }} <span class="text-danger">*</span></label>
                      <textarea id="editor1" name="des" class="@error('des') is-invalid @enderror" placeholder="Please Enter Description" value="{{$policy->des ?? ''}}" required="">{{$policy->des ?? ''}}</textarea>
                      <small class="txt-desc">({{__("Please Enter Return Description")}})</small>
                  </div>
                </div>
                        
                <div class="form-group col-md-6">
                  <label class="text-dark" for="exampleInputDetails">{{ __('Status') }} </label><br>
                  <label class="switch">
                    <input class="slider" type="checkbox" name="status" checked />
                    <span class="knob"></span>
                    
                  </label><br>
                  <small>({{__("Please Choose Status")}})</small>
              </div>
                <!-- create and close button -->
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                        {{ __("Update")}}</button>
                    </div>
                </div>

                
              </div><!-- row end -->
                                             
          </form>
              <!-- form end -->
        
         <!-- main content end -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

