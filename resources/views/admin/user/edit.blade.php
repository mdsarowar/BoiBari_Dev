@extends('admin.layouts.master-soyuz')
@section('title',__("Edit user :username |",['username' => $user->name]))
@section('body')

<?php
  $role = Auth::user()->getRoleNames()?Auth::user()->getRoleNames()[0]:'No Role';
  $current_role = $user->getRoleNames()?$user->getRoleNames()[0]:'No Role';
  $data['heading'] = 'Edit '.$current_role;
  $data['title0'] = $current_role;
  $data['title1'] = 'Edit '.$current_role;
?>
@include('admin.layouts.topbar',$data)

<div class="contentbar bardashboard-card"> 

  <div class="row">

    <div class="col-lg-9">
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
                <h5 class="card-title"> {{__("Edit")}} {{$current_role}}</h5>
            </div>
            <div class="col-md-2">
              <div class="widgetbar">
                <a href="{{ route('users.index',['filter' => app('request')->input('type') ]) }}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="post" enctype="multipart/form-data" action="{{ route("users.update",$user->id) }}">
            @csrf
            @method('PUT')
            
                <div class="card card-bg">
                    <div class="card-header">
                        <h5 class="card-title"> {{__("Basic Info")}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="text-dark">{{__("Full Name:")}} <span class="required text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ __("Please enter full name") }}" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                    
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="text-dark">{{__("Email:")}} <span class="required text-danger">*</span></label>
                                <input placeholder="{{ __("Please enter email") }}" type="email" name="email" value="{{ $user->email }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="text-dark"> {{__("Mobile:")}} <span class="required text-danger">*</span></label>
                                <div class="row no-gutter">
                                    <div class="col-md-12">
                                    <div class="input-group">
                                        <input required pattern="[0-9]+" title="Invalid mobile no." placeholder="1" type="text" name="phonecode" value="{{$user->phonecode}}" class="col-md-2 form-control">
                                        <input required pattern="[0-9]+" title="Invalid mobile no." placeholder="{{ __("Please enter mobile no.") }}" type="text" name="mobile" value="{{$user->mobile}}" class="col-md-10 form-control">
                                    </div>
                                    </div>
                                </div>
                                </div>                          
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="text-dark">
                                    {{__("Phone:")}}
                                </label>
                                <input pattern="[0-9]+" title="Invalid Phone no." placeholder="{{ __("Please enter phone no.") }}" type="text"
                                    name="phone" value="{{$user->phonne}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="text-dark" for="first-name"> {{__("Choose Profile:")}}</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <!-- <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">{{ __("Choose file") }} </label> -->
                                        <div class="input-group">
                                            <div class="custom-file">
                                            <input type="file" id="img_upload_input" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01"  onchange="readURL(this);" />
                                            <label class="custom-file-label" for="inputGroupFile01">{{ __("Choose Profile") }} </label>
                                            </div>
                                        </div> 
                                    </div>
                                </div> <br>
                                <div class="thumbnail-img-block mb-3">
                                    <img id="image-pre" class="img-fluid" alt="">
                                </div>                       
                            </div>
                            @if($role=='Super Admin' || $role=='Admin')
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="text-dark">
                                    {{__("User Role:")}} <span class="required">*</span>
                                </label>
                                <select name="role" data-placeholder="{{ __("Please choose user role") }}" class="form-control select2">
                                    
                                    @foreach($roles as $role)
                                    <option {{ $user->getRoleNames()->contains($role->name) ? 'selected' : "" }} value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach

                                </select>
                                </div>
                            </div>
                            @endif

                            @if(in_array('Seller', auth()->user()->getRoleNames()->toArray()) && Module::has('SellerSubscription') && Module::find('sellersubscription')->isEnabled())
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark">{{ __('Select seller plan:') }}</label>
                                        <select name="seller_plan" class="form-control select2" data-placeholder="{{ __('Please select seller plan') }}" >
                                        <option value="">{{ __('Please select seller plan') }}</option>
                                        @if(isset($plans))
                                            @foreach ($plans as $plan)
                                                <option {{ isset($user->activeSubscription) && $user->activeSubscription->plan->id == $plan->id ? "selected" : "" }} value="{{ $plan->id }}"> {{ $plan->name }} ({{ $defCurrency->currency->symbol.$plan->price }})</option>
                                            @endforeach
                                        @endif
                                        </select>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="text-dark">{{ __('Status:') }}</label><br>
                                <label class="switch">
                                    <input class="slider" type="checkbox" checked id="toggle-event3" name="status" >
                                    <span class="knob"></span>
                                </label>
                                <br>                            
                                <input type="hidden" name="status" value="1" id="status3">
                                </div>
                            </div>

                            @if($wallet_system == 1 )
                                @if(isset($user->wallet))
                                <div class="col-md-3">
                                    <div class="form-group">

                                    <label class="text-dark">{{ __("Wallet:") }}</label>
                                    <label class="text-dark">{{ __('Status:') }}</label><br>
                                    <label class="switch">
                                        <input class="slider" name="wallet_status" type="checkbox"<?php echo ($user->wallet->status=='1')?'checked':'' ?> id="wallet">
                                        <span class="knob"></span>
                                    </label><br>
                                    
                                    <small class="text-muted"><i class="fa fa-question-circle"></i>{{ __('Please select wallet status') }}</small>
                                    </div>
                                </div>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>

                <div class="card mt-4 card-bg">
                    <div class="card-header">
                      <h5 class="card-title"> {{__("Address")}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">  

                            <div class="col-md-4">
                                <div class="form-group">

                                <label class="text-dark">
                                    {{__("Country:")}}
                                </label>

                                <select data-placeholder="{{ __("Please select country") }}" name="country_id"
                                    class="form-control select2" id="country_id">

                                    <option value="">{{ __("Please Choose") }}</option>
                                    @foreach($country as $coun)

                                    <option {{ $coun->id == $user['country_id'] ? "selected" : "" }} value="{{$coun->id}}">
                                    {{$coun->nicename}}
                                    </option>

                                    @endforeach
                                </select>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="text-dark">
                                    {{__("State:")}}
                                </label>

                                <select data-placeholder="Please select state" required name="state_id" class="form-control select2"
                                    id="upload_id">
                                    @foreach($states as $s)
                                    <option {{ $s->id == $user->state_id ? "selected" : '' }} value="{{$s->id}}" >
                                    {{$s->name}}
                                    </option>
                                    @endforeach
                                </select>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-dark" for="first-name">
                                        {{__("City:")}}
                                    </label>
                                    <select data-placeholder="{{ __("Please select city") }}" name="city_id" id="city_id"
                                        class="form-control select2">

                                        @foreach($citys as $c)
                                        <option value="{{$c->id}}" {{ $c->id == $user->city_id ? 'selected' : '' }}>
                                        {{$c->name}}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card mt-4 card-bg">
                    <div class="card-header">
                      <h5 class="card-title"> {{__("Social Media")}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">  

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Website:") }}</label>
                                    <input placeholder="http://" type="text" id="first-name" name="website" value="{{ $user['website'] }}" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card mt-4 card-bg">
                    <div class="card-header">
                      <h5 class="card-title"> {{__("Authentication")}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">  

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="eyeCy">
                                    <label for="password" class="text-dark">{{ __("Enter Password:") }}</label>
                                        <div class="input-group mb-3">
                                            <input minlength="8" id="password" type="password" class="passwordbox form-control" placeholder="{{ __("Enter password min. length 8") }}" name="password">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" id="main_password" type="button"><span class="fa fa-fw fa-eye field-icon toggle-password"></span></button>
                                            </div>
                                        </div>                                  
                                    </div>
                                </div>              
                            </div>            
                
                            <div class="col-md-6">              
                                <div class="form-group">
                                    <div class="eyeCy">
                                        <label for="confirm" class="text-dark">{{ __("Confirm Password:") }}</label>
                                        <div class="input-group mb-3">
                                            <input id="confirm_password" type="password" class="passwordbox form-control" placeholder="{{ __("Re-enter password for confirmation") }}" name="password_confirmation">
                                            <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" id="confirmPassword" type="button"><span class="fa fa-fw fa-eye field-icon toggle-password"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="required">{{$errors->first('password_confirmation')}}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            <button type="reset" class="btn btn-danger-rgba mr-1 mt-4"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
            <button @if(env('DEMO_LOCK')==0) type="submit" @else title="{{ __("This action is disabled in demo !") }}"
              disabled="disabled" @endif class="btn btn-primary-rgba mt-4"><i class="fa fa-save"></i>
              {{ __("Update")}}</button>

          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card m-b-30">
        <div class="user-slider">
          <div class="user-slider-item">
              <div class="card-body text-center">
                <span>
                  @if($user->image !="" && @file_exists(public_path().'/images/user/'.$user->image))
                  <img title="{{ $user->name }}" id="preview1" src="{{url('images/user/'.$user->image)}}" class="img-circle edit-image rounded mx-auto d-block">
                  @else
                  <img id="preview1" class="img-circle edit-image rounded mx-auto d-block" title="{{ $user->name }}" src="{{ Avatar::create($user->name)->toBase64() }}" />
                  @endif
                </span>
                  <h5 class="mt-2">{{ $user->name }}</h5>
                  <p>{{ $user->store['name'] ?? '' }}</p>
                  <p> <i class="feather icon-map-pin"></i> @if(!isset($user->country))
                    {{__("Location not updated")}}
                  @else
                   {{ isset($user->city) ? $user->city->name : "" }}
                   {{ isset($user->state) ? $user->state->name : "" }}
                   {{ isset($user->country) ? $user->country->nicename : "" }}
                  @endif
                 </p>

                  
              </div>
              <div class="card-footer text-center">
                  <div class="row">
                      <div class="col-6 border-right">
                          <h5>{{ count($user->products) }}</h5>
                          <p class="my-2">{{ __('TOTAL PRODUCTS') }}</p>
                      </div>
                      <div class="col-6">
                          <h5>{{ $user->purchaseorder->count() }}</h5>
                          <p class="my-2">
                            {{__("TOTAL PURCHASE")}}
                          </p>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom-script')
<script>
  var baseUrl = "<?= url('/') ?>";
</script>
<script src="{{ url("js/ajaxlocationlist.js") }}"></script>
<script>
  $(document).on('click', '#main_password', function() {

    var input = $("#password");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')

  });

  $(document).on('click', '#confirmPassword', function() {

    var input = $("#confirm_password");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')

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
</script>
@endsection