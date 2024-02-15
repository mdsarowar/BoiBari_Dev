@extends('admin.layouts.master-soyuz')
@section('title',__('Edit Childcategory'))
@section('body')

<?php
  $data['heading'] = 'Edit Childcategory';
  $data['title0'] = 'Product Management';
  $data['title1'] = 'All Childcategories';
  $data['title2'] = 'Edit Childcategory';
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
                <h5 class="card-title"> {{__("Edit Childcategory")}}</h5>
            </div>
            <div class="col-md-2">
              <div class="widgetbar">
                <a href="{{url('admin/grandcategory')}}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">  
          <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{url('admin/grandcategory/'.$cat->id)}}" data-parsley-validate class="form-horizontal form-label-left">
          {{csrf_field()}}
          {{ method_field('PUT') }}

          <div class="row">
            <div class="form-group col-md-6">
              <label class="control-label text-dark" for="first-name">
              {{__('Parent Category')}}: <span class="required">*</span>
              </label>
              
            
                <select name="parent_id" class="form-control select2 col-md-12" id="category_id">
                @foreach($parent as $p)
                  <option {{ $p['id'] == $cat->category->id ? "selected" : "" }} value="{{$p->id}}"/>{{$p['title']}}</option>
                  @endforeach
                </select>
                <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__('Please Choose Parent Category')}})</small>
            </div>
          
            <div class="form-group col-md-6">
              <label class="control-label text-dark" for="first-name">
                {{__("Subcategory")}}: <span class="required">*</span>
              </label>
              
                <select name="subcat_id" class="form-control select2 col-md-12" id="upload_id">
                  @foreach($subcat as $sub)
                    <option {{ $sub->id == $cat->subcategory->id ? "selected" : "" }} value="{{ $sub->id }}">{{ $sub->title }}</option>
                  @endforeach
                </select>
                <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(Please Choose Subcategory)</small>
              
            </div>
            <div class="form-group col-md-6">
              <label class="control-label text-dark" for="first-name">
              {{__('Childcategory')}}: <span class="required">*</span>
              </label>
            
                <input type="text" id="first-name" name="title" value=" {{$cat['title']}} " class="form-control col-md-12">
                <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__('Please Enter Childcategory Name')}})</small>
            
            </div>
          
            <div class="form-group col-md-6">
              <label class="control-label text-dark" for="first-name"> {{__('Image')}}:</label>
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input type="file" name="image" class="inputfile inputfile-1" id="user_img"
                      aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">{{ __("Choose file") }} </label>
                  </div>                  
                </div><br>
                @if(@file_get_contents('images/grandcategory/'.$cat->image))
                  <img src=" {{url('images/grandcategory/'.$cat->image)}}" class="pro-img">
                @else
                  <img class="pro-img" title="{{ $cat->title }}" src="{{ Avatar::create($cat['title'])->toBase64() }}" />
                @endif
                <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{ __('Please choose image') }})</small>
              </div>
                
              <div class="form-group col-md-12">
                  <label class="control-label text-dark" for="first-name">{{__("Description")}}: </label>
                  <textarea cols="2" id="editor1" name="description" rows="5" >{{ucfirst($cat->description)}}</textarea>
                  <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__('Please Enter Description')}})</small>
              </div>
              
              <div class="form-group col-md-6">
                <label class="control-label text-dark"  for="first-name">
                  {{__("Featured")}}:
                </label>
                <br>
                <label class="switch">
                  <input class="slider tgl tgl-skewed" type="checkbox" id="toggle-event33" {{ $cat->featured==1 ? 'checked' : '' }} >
                  <span class="knob"></span>
                  <input type="hidden" name="featured" value="{{ $cat->featured }}" id="featured">

                </label>
                
            </div>
            <div class="form-group col-md-6">
              <label class="control-label text-dark" for="first-name">
                {{ __('Status:') }} <span class="required">*</span>
              </label>
              <br>
              <label class="switch">
                <input class="slider tgl tgl-skewed" type="checkbox" id="toggle-event33" {{ $cat->status==1 ? 'checked' : '' }} >
                <span class="knob"></span>
                <input type="hidden" name="status" value="{{ $cat->status }}" id="status">

              </label>
              
            </div>
          </div>

        <div class="form-group">
          <button @if(env('DEMO_LOCK')==0) type="reset"  @else disabled title="{{ __('This operation is disabled is demo !') }}" @endif  class="btn btn-danger"><i class="fa fa-ban"></i> {{ __("Reset") }}</button>
          <button @if(env('DEMO_LOCK')==0)  type="submit" @else disabled title="{{ __('This operation is disabled is demo !') }}" @endif  class="btn btn-primary"><i class="fa fa-check-circle"></i>
              {{ __("Update") }}</button>
      </div>
      <div class="clear-both"></div>
    </form>
    
  </div>
      </div>
    </div>
  </div>
</div>

  <!-- /.box -->

@endsection
