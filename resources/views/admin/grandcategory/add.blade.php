@extends('admin.layouts.master-soyuz')
@section('title',__('Create a Child Category'))
@section('body')

<?php
  $data['heading'] = 'Add Child Category';
  $data['title0'] = 'Product Management';
  $data['title1'] = 'All Child Categories';
  $data['title2'] = 'Add Child Category';
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
                <h5 class="card-title"> {{__("Add Child Category")}}</h5>
            </div>
            <div class="col-md-2">
              <div class="widgetbar">
                <a href="{{url('admin/grandcategory')}}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
              </div>
            </div>
          </div>

        </div>
        <div class="card-body">
          <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{url('admin/grandcategory')}}"
            data-parsley-validate class="form-horizontal form-label-left">
            {{csrf_field()}}
            
            <div class="row">
              <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name">
                  Parent Category: <span class="required">*</span>
                </label>
                <div class="row">
                  <div class="col-md-10">
                    <select name="parent_id" class="form-control select2 col-md-12" id="category_id">
                      <option value="0">{{ __('Please Select') }}</option>
                      @foreach($parent as $p)
                      <option value="{{$p->id}}">{{$p->title}}</option>
                      @endforeach
                    </select>
                    <span class="text-red">{{$errors->first('parent_id')}}</span>
                    <small class="text-info"> <i
                        class="text-dark feather icon-help-circle"></i>({{ __('Please Choose Parent Category') }})</small>

                  </div>
                  <div class="col-md-2">
                    @can('category.create')
                    <button title="{{ __('Add Category') }}" type="button" data-target="#catModal" data-toggle="modal"
                      class="btn btn-md btn-primary">+</button>
                    @endcan
                  </div>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name">
                  {{__("Subcategory")}}: <span class="required">*</span>
                </label>
                <div class="row">
                  <div class="col-md-10">
                    <select name="subcat_id" class="form-control select2 col-md-12" id="upload_id">
                    </select>
                    <small class="text-info"> <i
                        class="text-dark feather icon-help-circle"></i>({{__('Please Choose Subcategory')}})</small>

                  </div>
                  <div class="col-md-2">

                    @can('subcategory.create')
                    <button data-toggle="modal" data-target="#subModal" title="{{ __('Add Subcategory') }}" type="button"
                      class="btn btn-md btn-primary">
                      +
                    </button>
                    @endcan
                  </div>
                </div>
              </div>
              <div class="form-group col-md-6">

                <label class="control-label text-dark" for="first-name">
                  {{__("Child Category")}} <span class="required">*</span>
                </label>
                <input type="text" id="first-name" name="title" class="form-control col-md-12">
                <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{ __('Please Enter Child Category Name') }})</small>

              </div>
              
              <div class="form-group col-md-6">
                <label class="control-label text-dark" for="first-name"> {{__("Image")}}: </label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" id="img_upload_input" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="readURL(this);" />
                    <label class="custom-file-label" for="inputGroupFile01">{{ __("Choose Profile") }} </label>
                  </div>
                </div> <br>
                <div class="thumbnail-img-block mb-3">
                  <img id="image-pre" class="img-fluid" alt="">
                </div> 

              </div>

              <div class="form-group col-md-12">
                <label class="control-label text-dark" for="first-name"> {{__('Description')}}: </label>
                <textarea cols="2" id="editor1" name="description" rows="5"></textarea>
                <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__("Please Enter Description")}})</small>
              </div>

              <div class="form-group col-md-6">
                <label class="text-dark">
                  {{__("Featured")}}:
                </label><br>
                <label class="switch">
                  <input class="slider tgl tgl-skewed" type="checkbox" checked="checked">
                  <span class="knob"></span>
                </label>
                <br>
                <input value="0" type="hidden" id="featured" name="featured">
                <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__("Choose status for your post")}})</small>

              </div>
              <div class="form-group col-md-6">
                <label class="text-dark">
                  {{ __('Status:') }}
                </label><br>
                <label class="switch">
                  <input class="slider tgl tgl-skewed" type="checkbox" checked="checked">
                  <span class="knob"></span>
                </label>
                <br>
                <input value="0" type="hidden" id="featured" name="status">
                <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__("Choose status for your post")}})</small>

              </div>
            </div>

            <div class="form-group">
              <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i>
                {{ __("Reset") }}</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                {{ __("Create") }}</button>
            </div>

            <div class="clear-both"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@can('subcategory.create')
<div class="modal fade" id="subModal" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">{{ __("Add Subcategory") }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>

      </div>

      <div class="modal-body">
        <form enctype="multipart/form-data" action="{{ route('quick.sub.add') }}" method="POST">
          {{ csrf_field() }}

          <label for="">{{__("Select Category")}}:</label>
          <select name="category" id="" class="form-control select2 col-md-12">
            @foreach($category = App\Category::all() as $cat)
            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
            @endforeach
          </select>
          <br><br><br>
          <label for="">{{ __("Subcategory Name") }}:</label>
          <input required type="text" class="form-control" placeholder="{{ __("Enter Subcategory name") }}" name="title" />
          <br>
          <label for="">{{ __('Description') }}:</label>
          <textarea name="detail" class="editor" cols="30" rows="10"></textarea>
          <br>
          <label for="">Icon:</label>
          <div class="input-group">
            <input type="text" class="form-control iconvalue" name="icon" value="{{  __('Choose icon') }}">
            <span class="input-group-append">
              <button type="button" class="btnicon btn btn-outline-secondary" role="iconpicker"></button>
            </span>
          </div>

          <br>
          <label for="">{{__('Category Image')}}:</label>
          <div class="input-group mb-3">

            <div class="custom-file">

              <input type="file" name="image" class="inputfile inputfile-1" aria-describedby="inputGroupFileAddon01">
              <label class="custom-file-label" for="inputGroupFile01">{{ __("Choose file") }} </label>
            </div>
          </div>
          <br>
          <label for="">{{ __('Status:') }}</label>
          <label class="switch">
            <input class="slider tgl tgl-skewed" type="checkbox" id="statuscat" checked="checked">
            <span class="knob"></span>
          </label>
          <br>
          <input type="hidden" name="status" value="1" id="statussub">



          <br>
          <label for="">{{__("Featured")}}:</label>
          <label class="switch">
            <input class="slider tgl tgl-skewed" type="checkbox" id="featuredcat" checked="checked">
            <span class="knob"></span>
          </label>
          <br>
          <input type="hidden" name="featured" value="1" id="featuredcat">

          <br>
          <div class="form-group">
            <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i>
              {{ __("Reset") }}</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
              {{ __("Create") }}</button>
          </div>

          <div class="clear-both"></div>
        </form>
      </div>

    </div>
  </div>
</div>
@endcan
@can('category.create')
<div class="modal fade" id="catModal" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">{{ __('Add Category') }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>

      </div>

      <div class="modal-body">
        <form enctype="multipart/form-data" action="{{ route('quick.cat.add') }}" method="POST">
          {{ csrf_field() }}
          <label for="">{{__("Category Name")}}:</label>
          <input required type="text" class="form-control" placeholder="{{ __("Enter category name") }}" name="title" />
          <br>
          <label for="">{{ __('Description') }}:</label>
          <textarea name="detail" class="editor" cols="30" rows="10"></textarea>
          <br>
          <label for="">{{__("Icon")}}:</label>
          <div class="input-group">
            <input type="text" class="form-control iconvalue" name="icon" value="{{  __('Choose icon') }}">
            <span class="input-group-append">
              <button type="button" class="btnicon btn btn-outline-secondary" role="iconpicker"></button>
            </span>
          </div>
          <br>
          <label for="">{{__("Category Image")}}:</label>
          <div class="input-group mb-3">


            <div class="custom-file">

              <input type="file" name="image" class="inputfile inputfile-1" aria-describedby="inputGroupFileAddon01">
              <label class="custom-file-label" for="inputGroupFile01">{{ __("Choose file") }} </label>
            </div>
          </div>
          <br>
          <label for="">{{ __('Status:') }}</label>
          <label class="switch">
            <input class="slider tgl tgl-skewed" type="checkbox" id="statussub" checked="checked">
            <span class="knob"></span>
          </label>
          <br>
          <input type="hidden" name="status" value="1" id="statussub">


          <br>
          <label for="">{{__("Featured")}}:</label>
          <label class="switch">
            <input class="slider tgl tgl-skewed" type="checkbox" id="featuredsub" checked="checked">
            <span class="knob"></span>
          </label>
          <br>
          <input type="hidden" name="featured" value="1" id="statussub">


          <br>
          <div class="form-group">
            <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i>{{ __("Reset") }}</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>{{ __("Create") }}</button>
          </div>

          <div class="clear-both"></div>
        </form>
      </div>

    </div>
  </div>
</div>
@endcan

@endsection
@section('custom-script')

  <script>
    $('.thumbnail-img-block').hide();
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