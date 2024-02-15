@extends('admin.layouts.master-soyuz')
@section('title',__('General Settings | '))
@section('body')

<?php
  $data['heading'] = 'General Settings';
  $data['title0'] = 'Site Setting';
  $data['title1'] = 'General Settings';
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
          <a href="{{ url()->previous() }}" class="float-right btn btn-md btn-primary-rgba"><i
              class="feather icon-arrow-left"></i> {{ __("Back") }}</a>
          <h4 class="card-title">{{ __("Content Settings") }}</h4>

        </div>
        <div class="card-body ml-2">
            <form method="post" enctype="multipart/form-data" action="{{url('admin/update/content')}}">
            @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>{{__("Writer Name")}}: <span class="required">*</span></label>
                            <input placeholder="{{ __('Writer Name') }}" type="text" name="writer" value="{{ $settings->writer }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>{{__("Content")}}: <span class="required">*</span></label><br>
                            <textarea name="content" id="editor1" rows="2" class="form-control">{{ $settings->content }}</textarea>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-success-rgba" value="Update">
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom-script')

@endsection