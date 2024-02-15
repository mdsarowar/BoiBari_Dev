@extends('admin.layouts.master-soyuz')
@section('title',__('Edit Subcategory | '))
@section('body')

<?php
  $data['heading'] = 'Edit Subcategory';
  $data['title0'] = 'Product Management';
  $data['title1'] = 'All Subcategories';
  $data['title2'] = 'Edit Subcategory';
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
                <h5 class="box-title">{{ __('Edit') }} {{ __('SubCategory') }}</h5>
            </div>
            <div class="col-md-2">
              <div class="widgetbar">
                <a href="{{url('admin/subcategory')}}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
              </div>
            </div>
          </div>

        </div>

        <div class="card-body">

          <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{url('admin/subcategory/'.$cat->id)}}" data-parsley-validate class="form-horizontal form-label-left">
            {{csrf_field()}}
            {{ method_field('PUT') }}
            <div class="row">
              <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name"> {{__("Parent Category")}}: <span class="required">*</span> </label>
                <select name="parent_cat" class="form-control select2">
                  <option value="">Select Parent Category</option>
                  @foreach($parent as $p)
                  <option {{ $p['id'] == $cat->category->id ? "selected" : "" }} value="{{$p->id}}">{{$p->title}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name"> {{__("Subcategory")}}: <span class="required">*</span> </label>
                <input placeholder="{{__("Please enter subcategory name")}}" type="text" id="first-name" name="title" value="{{$cat->title}}" class="form-control">
              </div>
              
              <!-- <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name"> {{__("Icon")}}: </label>
                <div class="input-group">
                  <input type="text" class="form-control iconvalue" name="icon" value="{{ $cat->icon }}">
                  <span class="input-group-append">
                    <button type="button" class="btnicon btn btn-outline-secondary" role="iconpicker"></button>
                  </span>
                </div>
              </div> -->

              <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name"> {{__("Image")}}: <span class="required"></span> </label>               
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="readURL(this);">
                    <label class="custom-file-label" for="inputGroupFile01">{{ __("Browse") }} </label>
                  </div>
                </div>

                <div class="mt-3">
                  @if(@file_get_contents('images/subcategory/'.$cat->image))
                  <img id="image-pre" class="img-fluid bg-primary-rgba rounded p-3" width="100px" src=" {{url('images/subcategory/'.$cat->image)}}">
                  @else
                  <img id="image-pre" title="{{ $cat->title }}" src="{{ Avatar::create($cat['title'])->toBase64() }}" />
                  @endif
                </div>

              </div>

              <div class="form-group col-md-12">
                <label class="control-label text-dark" for="first-name"> {{__("Description")}}: </label>

                <textarea cols="2" id="editor1" name="description" rows="5">
                {{ucfirst($cat->description)}}
              </textarea>
                <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__("Please enter description")}})</small>s


              </div>
              <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name">
                  {{__('Featured')}}:
                </label>
                <br>
                <label class="switch">
                  <input class="slider tgl tgl-skewed" type="checkbox" id="toggle-event33"
                    {{$cat->featured ==1 ? "checked" : ""}}>
                  <span class="knob"></span>
                  <input type="hidden" name="featured" value="{{ $cat->featured }}" id="status3">

                </label>
                <br>
                <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__('If enabled than subcategory will be Featured')}})</small>

              </div>
              <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name">
                  {{__("Status")}}:<span class="required">*</span>
                </label>
                <br>
                <label class="switch">
                  <input class="slider tgl tgl-skewed" type="checkbox" id="toggle-event33"
                    {{$cat->status ==1 ? "checked" : ""}}>
                  <span class="knob"></span>
                  <input type="hidden" name="status" value="{{ $cat->status }}" id="status3">

                </label>
                <br>
                <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__("Please choose status")}})</small>


              </div>
            </div>
            <div class="form-group">
              <button @if(env('DEMO_LOCK')==0) type="reset" @else disabled title="{{ __('This operation is disabled is demo !') }}"
                @endif class="btn btn-danger"><i class="fa fa-ban"></i> {{ __("Reset") }}</button>
              <button @if(env('DEMO_LOCK')==0) type="submit" @else disabled title="{{ __('This operation is disabled is demo !') }}"
                @endif class="btn btn-primary"><i class="fa fa-check-circle"></i>
                {{ __("Update") }}</button>
            </div>
            <div class="clear-both"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom-script')
<script>
  $(".midia-toggle").midia({
    base_url: '{{ url('') }}',
    directory_name: 'subcategory'
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('.thumbnail-img-block').show();
        $('#image-pre').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endsection