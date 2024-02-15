@extends("frontend.layout.master")
@section('title','BoiBari | My Account')
@section("content")   

<!-- Home Start -->
<section id="home" class="home-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb" class="breadcrumb-main-block">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}" title="Home">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item">{{__('Account')}}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('My Bank Account')}}</li>
                    </ol>
                </nav>
                <div class="about-breadcrumb-block wishlist-breadcrumb" style="background-image: url('frontend/assets/images/wishlist/breadcrum.png');">
                  <div class="breadcrumb-nav">
                      <h3 class="breadcrumb-title">{{ __('My Bank Account') }}</h3>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home End -->

<!-- My Account Start -->
<section id="my-account" class="my-account-main-block popular-item-main-block">
    <div class="container">
        <div class="row">
            <?php $active['active'] = 'Mybankac'; ?>
            @include('frontend.profile.sidebar',$active)
            <div class="col-lg-9 col-md-8">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="personal-info-block bank-acc-block">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="section-title">{{__('My Bank Account')}}</h3>
                            </div>
                            <div class="col-lg-6">
                                <a href="javascript:" data-bs-toggle="modal" data-bs-target="#addbank" class="btn btn-info"><i data-feather="plus" width="18px" height="18px"></i>Add New Bank</a>
                                <!-- Add Modal -->
                                <div class="modal fade" id="addbank" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="p-2 modal-title" id="myModalLabel">{{ __('Add New Bank') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('user.bank.add') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                           
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">{{__('Ac Holder Name')}}: <span class="required">*</span></label>
                                                                    <input value="" required="" type="text" class="form-control" name="acname">
                                                                    <div class="required"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">{{__('Bank Name')}}: <span class="required">*</span></label>
                                                                    <input value="" required="" type="text" class="form-control" name="bankname">
                                                                    <div class="required"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">{{__('Account No')}}.: <span class="required">*</span></label>
                                                                    <input pattern="[0-9]+" value="" required="" type="text" class="form-control" name="acno">
                                                                    <div class="required"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">{{__('IFSC / SWIFT Code')}}: <span class="required">*</span></label>
                                                                    <input value="" required="" type="text" class="form-control" name="ifsc">
                                                                    <div class="required"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                                
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="table-responsive">
                                    <table class="table manage-address-block">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th>{{ __('A/C Holder Name') }}</th>
                                                <th>{{ __('Bank name') }}</th>
                                                <th>{{ __('IFSC / SWIFT Code') }}</th>
                                                <th>{{ __('A/C No') }}.</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(Auth::user()->banks as $key=> $bank)
                                            <tr>
                                                <th scope="row">{{ $key+1 }}</th>
                                                <td>{{ $bank->acname }}</td>
                                                <td>{{ $bank->bankname }}</td>
                                                <td>{{ $bank->ifsc }}</td>
                                                <td>{{ $bank->acno }}</td>
                                                <td>
                                                    <div class="manage-add-btn">
                                                        <button title="{{ __('Edit') }}" data-bs-toggle="modal" data-bs-target="#editbank{{ $bank->id }}" class="editlabel btn btn-sm btn-info">
                                                            <i data-feather="edit"></i>
                                                        </button>
                                                        <button @if(env('DEMO_LOCK')==0) data-bs-toggle="modal" data-bs-target="#deletebank{{ $bank->id }}"
                                                                title="{{ __('Delete') }}" @else disabled="disabled" title="This action is disabled in demo !"
                                                                @endif class="delbtn btn btn-danger btn-sm"><i data-feather="trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @foreach(Auth::user()->banks as $key=> $bank)
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editbank{{ $bank->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="p-2 modal-title" id="myModalLabel">{{ __('Edit Bank') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('user.bank.update',$bank->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">           
                                                                <div class="form-group">
                                                                    <label>{{ __('Ac Holder Name') }} <span class="required">*</span></label>
                                                                    <input value="{{ $bank->acname }}" required="" type="text" class="form-control" name="acname">
                                                                    <div class="required">{{$errors->first('acname')}}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">       
                                                                <div class="form-group">
                                                                    <label>{{ __('Bank Name') }}: <span class="required">*</span></label>
                                                                    <input value="{{ $bank->bankname }}" required="" type="text" class="form-control" name="bankname">
                                                                    <div class="required">{{$errors->first('bankname')}}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">  
                                                                <div class="form-group">
                                                                    <label>{{ __('Account No') }}.: <span class="required">*</span></label>
                                                                    <input pattern="[0-9]+" value="{{ $bank->acno }}" required="" type="text" class="form-control" name="acno">
                                                                    <div class="required">{{$errors->first('acno')}}</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">  
                                                                <div class="form-group">
                                                                    <label>{{ __('IFSC / SWIFT Code') }}: <span class="required">*</span></label>
                                                                    <input value="{{ $bank->ifsc }}" required="" type="text" class="form-control" name="ifsc">
                                                                    <div class="required">{{$errors->first('ifsc')}}</div>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button @if(env('DEMO_LOCK')==0) type="submit" @else title="This action is disabled in demo !" disabled="disabled" @endif class="btn btn-primary">
                                                            {{ __('Save') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    @foreach(Auth::user()->banks as $key=> $bank)
                                        <!-- Delete Modal -->
                                        <div class="modal fade delete-modal" id="deletebank{{ $bank->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        <div class="delete-icon"></div>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <h5 class="modal-heading">{{ __('Are You Sure ?') }}</h5>
                                                        <p>{{ __('Do you really want to delete this bank account') }} <b>{{ __('bankname') }}</b>?{{ __('This process cannot be undone') }}.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post" action="{{route('user.bank.delete',$bank->id)}}" class="pull-right">
                                                            {{csrf_field()}}
                                                            {{method_field("DELETE")}}
                                                            <button type="reset" class="btn btn-primary translate-y-3" data-bs-dismiss="modal">
                                                                {{ __('No') }}
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">
                                                                {{ __('Yes') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- My Account End -->

@endsection