@extends('admin.layouts.master-soyuz')
@section('title',__('Create Template | '))
@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{ url('admin_new/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css') }}">
@endsection
@section('body')

<?php
  $data['heading'] = 'Add Size chart';
  $data['title0'] = 'Product Management';
  $data['title1'] = 'Size chart';
  $data['title2'] = 'Add Size chart';
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
                    <h5 class="box-title">{{ __('Add Size chart') }}</h5>
                </div>
                <div class="col-md-2">
                    <div class="widgetbar">
                        <a href="{{ route('sizechart.index') }}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body">
            <form action="{{ route('sizechart.store') }}" method="POST" class="form">
                @csrf
                
                <div class="row">
                    <div class="form-group text-dark col-md-6">
                        <label>{{ __('Template name:') }} <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" required name="template_name" placeholder="{{ __('Enter template name') }}" value="{{ old('template_name') }}">
                    </div>

                    <div class="form-group text-dark col-md-6">
                        <label>{{ __('Template code:') }} <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" required name="template_code" placeholder="{{ __('Enter template code') }}" value="{{ old('template_code') }}">
                    </div>

                    <div class="form-group text-dark col-md-6">
                        <label>{{ __('Template options:') }} <span class="text-danger">*</span> </label>
                        <input class="form-control" type="text" id="tagsinput-typehead" name="options" placeholder="{{ __('Enter template options') }}" value="@if(old('options')) @foreach(old('options') as $opt) {{ $opt }} @endforeach @endif">
                        <small class="text-muted">
                            <i class="feather icon-help-circle"></i> {{__("Enter option seprate it by comma (',')")}}
                        </small>
                    </div>
                    
                    <div class="form-group text-dark col-md-6 mt-4">
                        <label class="mr-2">{{ __('Status:') }} </label>
                       
                        <label class="switch">
                            <input type="checkbox" name="status" checked>
                            <span class="knob"></span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-primary-rgba">
                       <i class="feather icon-plus"></i> {{__("Create")}}
                    </button>
                </div>

            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom-script')
<!-- Tagsinput js -->
<script src="{{ url('admin_new/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
<script>
    $('#tagsinput-typehead').tagsinput();
</script>
@endsection