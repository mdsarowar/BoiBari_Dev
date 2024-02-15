@extends('admin.layouts.master-soyuz')
@section('title',__('Edit Coupan | '))
@section('body')

<?php
  $data['heading'] = 'Edit Coupan';
  $data['title0'] = 'Product Management';
  $data['title1'] = 'All Coupans';
  $data['title2'] = 'Edit Coupan';
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
              <h5 class="box-title">
                {{ __("Edit Coupan") }}
              </h5>
            </div>
            <div class="col-md-2">
              <div class="widgetbar">
                <a href="{{ route('coupan.index') }}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
              </div>
            </div>
          </div>

        </div>
        <div class="card-body ml-2">
          <form action="{{ route('coupan.update',$coupan->id) }}" method="POST">
            @csrf
            @method("PUT")
            <div class="box-body">

              <div class="row">
                <div class="form-group col-md-6">
                  <label class="text-dark">{{__("Coupon code")}}: <span class="required">*</span></label>
                  <input value="{{ $coupan->code }}" type="text" class="form-control select2" name="code">
                </div>
                <div class="form-group col-md-6">
                  <label class="text-dark">{{__('Discount type')}}: <span class="required">*</span></label>

                  <select required="" name="distype" id="distype" class="form-control select2">

                    <option {{ $coupan->distype == 'fix' ? "selected" : ""}} value="fix">
                      {{__("Fix Amount")}}
                    </option>
                    <option {{ $coupan->distype == 'per' ? "selected" : ""}} value="per">
                      {{__("% Percentage")}}
                    </option>

                  </select>

                </div>
                <div class="form-group col-md-6">
                  <label class="text-dark">{{__('Amount')}}: <span class="required">*</span></label>
                  <input type="text" value="{{ $coupan->amount }}" class="form-control select2" name="amount">

                </div>
                <div class="form-group col-md-6">
                  <label class="text-dark">{{__("Belongs To")}}: <span class="required">*</span></label>

                  <select required="" name="link_by" id="link_by" class="form-control select2">
                    <option {{ $coupan->link_by == 'cart' ? "selected" : ""}} value="cart">{{  __('Belongs To Cart') }}</option>
                    <option {{ $coupan->link_by == 'product' ? "selected" : ""}} value="product">{{ __("Belongs To Product") }}</option>
                    <option {{ $coupan->link_by == 'simple_product' ? "selected" : ""}} value="simple_product">{{ __('Belongs To Simple Product') }}</option>
                    <option {{ $coupan->link_by == 'category' ? "selected" : ""}} value="category">{{  __('Belongs To Category') }}
                    </option>
                  </select>

                </div>
                
                <div id="probox" class="form-group col-md-6 {{ $coupan->link_by == 'product' ? "" : 'display-none' }}">
                  <label class="text-dark">{{  __('Select Variant Product') }}: <span class="required">*</span> </label>
                  <br>
                  <select id="pro_id" name="pro_id" class="form-control select2">
                    @foreach(App\Product::where('status','1')->get() as $product)
                    @if(count($product->subvariants)>0)
                    <option {{ $coupan['pro_id'] == $product['id'] ? "selected" : "" }} value="{{ $product->id }}">
                      {{ $product['name'] }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>

                <div id="simpleprobox"
                  class="form-group col-md-6 {{ $coupan->link_by == 'simple_product' ? "" : 'display-none' }}">
                  <label class="text-dark">{{  __('Select Simple Product') }}: <span class="required">*</span> </label>
                  <br>
                  <select id="simple_pro_id" name="simple_pro_id" class="form-control select2">
                    @foreach(App\SimpleProduct::where('type','!=','ex_product')->where('status','1')->get() as $sproduct)

                    <option {{ $coupan['simple_pro_id'] == $sproduct['id'] ? "selected" : "" }}
                      value="{{ $sproduct->id }}">{{ $sproduct['product_name'] }}</option>

                    @endforeach
                  </select>
                </div>

                <div id="catbox" class="form-group col-md-6 {{ $coupan->link_by == 'category' ? "" : 'display-none'}}">
                  <label class="text-dark">{{  __('Select Category') }}: <span class="required">*</span> </label>
                  <br>
                  <select id="cat_id" name="cat_id" class="form-control select2">
                    @foreach(App\Category::where('status','1')->get() as $cat)
                    
                    <option {{ $coupan->cat_id == $cat->id ? "selected" : "" }} value="{{ $cat->id }}">{{ $cat['title'] }}
                    </option>
                    
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label class="text-dark">{{  __('Max Usage Limit') }}: <span class="required">*</span></label>
                  <input value="{{ $coupan->maxusage }}" type="number" min="1" class="form-control select2"
                    name="maxusage">
                </div>

                <div id="minAmount" class="form-group col-md-6 {{ $coupan->link_by=='product' ? 'display-none' : "" }}">
                  <label class="text-dark">{{  __('Min Amount') }}: </label>
                  <div class="input-group">
                    <input value="{{ $coupan->minamount }}" type="number" min="0.0" value="0.00" step="0.1"
                    class="form-control" name="minamount"
                    aria-describedby="basic-addon5" />
                    <div class="input-group-append">
                      <span class="input-group-text" id="basic-addon5"><i class="feather icon-dollar-sign"></i></span>
                    </div>
                  </div>
                
                </div>

                <div class="form-group col-md-6">
                  <label class="text-dark">{{  __('Expiry Date') }}: </label>
                  <div class="input-group">
                    <input type="datetime-local" class="form-control"
                      value="{{ $coupan->expirydate }}" name="expirydate"
                      placeholder="dd/mm/yyyy" />
                  </div>


                </div>

                <div class="form-group col-md-6">
                  <label class="text-dark">{{ __("Only For Registered Users") }}:</label>
                  <br>
                  <label class="switch">
                    <input {{ $coupan->is_login == 1 ? "checked" : "" }} type="checkbox"
                      class="quizfp toggle-input toggle-buttons" name="is_login">
                    <span class="knob"></span>
                  </label>
                </div>
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
  $('.per').hide();
  $('#distype').on('change', function() {
    if(this.value=='fix'){
      $('.fix').show();
      $('.per').hide();
    } else {
      $('.per').show();
      $('.fix').hide();
    }
  });
  
  $(document).ready(function() {
     
      if($('#link_by').val()=='product'){
        $('#probox').show();
        $('#simpleprobox').hide();
        $('#catbox').hide();
      } else if ($('#link_by').val()=='simple_product') {
        $('#probox').hide();
        $('#simpleprobox').show();
        $('#catbox').hide();
      } else if ($('#link_by').val()=='catgeory') {
        $('#probox').hide();
        $('#simpleprobox').hide();
        $('#catbox').show();
      } else {
        $('#probox').hide();
        $('#simpleprobox').hide();
        $('#catbox').hide();
      }
  });

  $('#link_by').on('change', function() {
    if(this.value=='product'){
      $('#probox').show();
      $('#simpleprobox').hide();
      $('#catbox').hide();
    } else if (this.value=='simple_product') {
      $('#probox').hide();
      $('#simpleprobox').show();
      $('#catbox').hide();
    } else if (this.value=='catgeory') {
      $('#probox').hide();
      $('#simpleprobox').hide();
      $('#catbox').show();
    } else {
      $('#probox').hide();
      $('#simpleprobox').hide();
      $('#catbox').hide();
    }
  }); 
</script>
@endsection