@extends('admin.layouts.master-soyuz')
@section('title',__('Create a Subcategory |'))
@section('body')

<?php
  $data['heading'] = 'Create a Subcategory';
  $data['title0'] = 'Product Management';
  $data['title1'] = 'All Subcategories';
  $data['title2'] = 'Create a Subcategory';
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
                <h5 class="box-title">{{ __('Create a Subcategory') }}</h5>
            </div>
            <div class="col-md-2">
              <div class="widgetbar">
                <a href="{{url('admin/subcategory')}}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
              </div>
            </div>
          </div>

        </div>

        <div class="card-body">
          <!-- Start From -->
          <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{url('admin/subcategory')}}" data-parsley-validate class="form-horizontal form-label-left">
            {{csrf_field()}}
            
              <div class="row">

                <div class="form-group col-md-6">
                  <label class="control-label text-dark" for="first-name"> Parent Category: <span class="required">*</span></label>
                  <div class="row">
                    <div class="col-md-10">
                      <select name="parent_cat" class="form-control select2 col-md-12">
                        <option value="">Select Parent Category</option>
                        @foreach($parent as $p)
                        <option value="{{$p->id}}">{{$p->title}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-2">
                      @can('category.create')
                      <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-md btn-primary">+</button>
                      @endcan
                    </div>
                  </div>
                </div>

                <div class="form-group col-md-6">
                  <label class="control-label text-dark" for="first-name"> {{__("Subcategory")}}: <span class="required">*</span></label>
                  <input placeholder="{{ __('Please enter subcategory name') }}" type="text" id="first-name" name="title" class="form-control col-md-12">
                </div>
                                
                <!-- <div class="form-group col-md-6">
                  <label class="control-label text-dark" for="first-name"> {{__('Icon')}}: </label>
                    <div class="input-group">
                      <input type="text" class="form-control iconvalue" name="icon" value="{{  __('Choose icon') }}">
                      <span class="input-group-append">
                        <button type="button" class="btnicon btn btn-outline-secondary" role="iconpicker"></button>
                      </span>
                    </div>
                </div> -->

                <div class="col-md-6">
                  <label class="text-dark" for="first-name"> {{__("Image:")}}</label>
                  <div class="input-group mb-3">
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="readURL(this);">
                      <label class="custom-file-label" for="inputGroupFile01">{{ __("Browse") }} </label>
                    </div>
                  </div><br>
                  <div class="thumbnail-img-block mb-3">
                    <img id="image-pre" class="img-fluid" alt="">
                  </div>                         
                </div>
                
                <div class="form-group col-md-12">
                  <label class="control-label text-dark" for="first-name"> {{__('Description')}}:</label>
                  <textarea cols="2" id="editor1" name="description" rows="5" placeholder="Please enter description"> </textarea>
                </div>

                <div class="form-group col-md-6">
                  <label class="control-label text-dark" for="first-name"> {{__("Featured")}}:</label> <br>
                  <label class="switch">
                    <input class="slider tgl tgl-skewed" type="checkbox" id="featured" checked="checked">
                    <span class="knob"></span>
                  </label><br>
                  <input type="hidden" name="featured" value="1" id="featured">
                  <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__("If enabled than Subcategory will be featured")}})</small>
                </div>

                <div class="form-group col-md-6">
                  <label class="control-label text-dark" for="first-name"> {{__('Status')}}: <span class="required">*</span></label><br>
                  <label class="switch">
                    <input class="slider tgl tgl-skewed" type="checkbox" id="status" checked="checked">
                    <span class="knob"></span>
                  </label> <br>
                  <input type="hidden" name="status" value="1" id="status3">
                  <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__("Please Choose Status")}})</small>
                </div>

              </div>

            <div class="form-group">
              <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i>{{ __("Reset") }}</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>{{ __("Create") }}</button>
            </div>

            <div class="clear-both"></div>
          </form>
          <!-- End Form -->
        </div>
        <!-- /.box -->

        @can('category.create')

        <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{ __('Add Category') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>

              <div class="modal-body">
                <form enctype="multipart/form-data" action="{{ route('quick.cat.add') }}" method="POST">
                  @csrf
                  <label for="">{{__("Category Name")}}:</label>
                  <input required type="text" class="form-control" placeholder="{{ __("Enter category name") }}" name="title" />
                  
                  <br>
                  <label for="">{{__("Icon")}}:</label>
                  <div class="input-group">
                    <input type="text" class="form-control iconvalue" name="icon" value="{{ __('Choose icon') }}">
                    <span class="input-group-append">
                        <button  type="button" class="btnicon btn btn-outline-secondary" role="iconpicker"></button>
                    </span>
                  </div>
                 
                  <br>
                  <label class="text-dark" for="first-name"> {{__("Category Image:")}}</label>
                    <div class="input-group mb-3">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="readURLSec(this);">
                        <label class="custom-file-label" for="inputGroupFile01">{{ __("Browse") }} </label>
                      </div>
                    </div><br>
                    <div class="thumbnail-img-block-sec mb-3">
                      <img id="image-pre-sec" class="img-fluid" alt="">
                    </div>                     

                  <br>
                  <label for="">{{ __('Description') }}:</label>
                  <textarea name="detail" id="editor2" cols="30" rows="10"></textarea>
                  
                  <br>
                  <div class="row">

                    <div class="col-lg-6">

                      <label for="">{{__("Status")}}:</label>
                      <label class="switch">
                        <input class="slider tgl tgl-skewed" type="checkbox" id="status4" checked="checked">
                        <span class="knob"></span>
                      </label>
                      <br>
                      <input type="hidden" name="status" value="1" id="status4">
                      <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__("Please Choose Status")}})</small>
                    
                    </div>
                    <div class="col-lg-6">
                      
                      <label for="">{{__('Featured')}}:</label>
                      <label class="switch">
                        <input class="slider tgl tgl-skewed" type="checkbox" id="status5" checked="checked">
                        <span class="knob"></span>
                      </label>
                      <br>
                      <input type="hidden" name="featured" value="1" id="status5">
                      <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__("Please Choose Feature")}})</small>
                    
                    </div>

                  </div>

                  <div class="form-group mt-4">
                    <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i> {{ __("Reset") }}</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> {{ __("Create") }}</button>
                  </div>

                  <div class="clear-both"></div>
                </form>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>

@endcan

@endsection
@section('custom-script')
  <script>
      $(".midia-toggle").midia({
          base_url: '{{ url('') }}',
          directory_name: 'subcategory'
      });

      $(".midia-toggle1").midia({
          base_url: '{{ url('') }}',
          directory_name: 'category'
      });
  </script>
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

    $('.thumbnail-img-block-sec').hide();
    function readURLSec(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('.thumbnail-img-block-sec').show();
          $('#image-pre-sec').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
@endsection