@extends('admin.layouts.master-soyuz')
@section('title',__('Edit directory :dir | ',['dir' => $dir->city]))
@section('body')

<?php
  $data['heading'] = 'Edit SEO Directories';
  $data['title0'] = 'Site Setting';
  $data['title1'] = 'SEO Directories';
  $data['title2'] = 'Edit SEO Directories';
?>
@include('admin.layouts.topbar',$data)

<div class="contentbar bardashboard-card">
  <div class="row">

    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
          
          <div class="row">
            <div class="col-lg-8">
              <h5 class="box-title">{{ __('Edit SEO Directories') }}</h5>
            </div>
            <div class="col-md-4">
              <div class="widgetbar">
                <a href="{{route('seo-directory.index')}}" class="btn btn-primary-rgba mr-2"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back") }}</a>
              </div>
            </div>
          </div>

        </div>
        <div class="card-body">
            <form class="form" novalidate action="{{ route('seo-directory.update',$dir->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>{{ __("Enter city name:") }} <span class="text-danger">*</span> </label>
                    <input value="{{ filter_var($dir->city) }}" type="text" class="form-control" required name="city">
                </div>

                <div class="form-group">

                    <label>{{ __("Enter details:") }} <span class="text-danger">*</span> </label>
                    <textarea class="editor form-control" name="detail" rows="10" cols="30">{!! $dir->detail !!}</textarea>
                    
                </div>

                <div class="form-group">
                    <label>{{ __("Status") }}</label>
                    <br>
                    <label class="switch">
                        <input type="checkbox" name="status"
                          {{ $dir->status == 1 ? "checked" : "" }}>
                        <span class="knob"></span>
                    </label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary-rgba">
                       <i class="feather icon-save"></i>  {{__("Update")}}
                    </button>
                </div>


            </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection