@extends('admin.layouts.master-soyuz')
@section('title',__('News Latter | '))
@section('body')

<?php
  $data['heading'] = 'News Latter';
  $data['title0'] = 'Footer';
  $data['title1'] = 'News Latter';
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
          <a href="{{ url()->previous() }}" class="float-right btn btn-md btn-primary-rgba"><i class="feather icon-arrow-left"></i> {{ __("Back") }}</a>
          <h4 class="card-title">{{ __("News Latter") }}</h4>

        </div>
        <div class="card-body ml-2">
            <form method="post" enctype="multipart/form-data" action="{{url('admin/update/news')}}">
            @csrf
                <div class="row">

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>{{__("Heading")}}:</label>
                            <input type="text" name="heading" value="{{$footer->heading}}" class="form-control" placeholder="Heading">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>{{__("Sub Heading")}}:</label>
                            <input type="text" name="sub_heading" value="{{$footer->sub_heading}}" class="form-control" placeholder="Sub Heading">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label text-dark" for="first-name"> {{__("Image")}}: </label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" name="image" class="inputfile inputfile-1" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">{{ __("Choose file") }} </label>
                                </div>
                            </div>
                            <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{ __('Please choose image') }})</small>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <img src="{{url('images/newslatter/'.$footer->image)}}" height="100px">
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