@extends('admin.layouts.master-soyuz')
@section('title',__('Return Policy Settings | '))
@section('body')

<?php
  $data['heading'] = 'Return Policy';
  $data['title0'] = 'Product Management';
  $data['title1'] = 'Return Policy';
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
            <div class="col-lg-8">
              <h5 class="box-title">{{ __('Return Policy') }}</h5>
            </div>
            <div class="col-md-4">
              <div class="widgetbar">
                <a href=" {{url('admin/return-policy/create')}}" class="btn btn-primary-rgba mr-2">
                    <i class="feather icon-plus mr-2"></i> {{__("Add Return Policy")}}
                </a>
              </div>
            </div>
          </div>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="datatable-buttons" class="table table-striped table-bordered">
              <thead>
              <th>#</th>
              <th>{{ __('Policy Name') }}</th>
              <th>{{ __('Return Amount') }}</th>
              <th>{{ __('Return Days') }}</th>
              <th>{{ __('Status') }}</th>
              <th>{{ __('Action') }}</th>
              </thead>
              <tbody>
                @foreach($pro_return as $key => $banks)
                  
                    <tr>
                      <td>{{++$key}}</td>
                      <td>{{$banks->name}}</td>
                      <td>{{$banks->amount}}</td>
                      <td>{{$banks->days}}</td>
                      <td>
                        <form action="{{ route('banks.quick.update',$banks->id) }}" method="POST">
                          {{csrf_field()}}
                          <button type="submit" class="btn btn-rounded {{ $banks->status == 1 ? 'btn-success-rgba' : 'btn-danger-rgba' }}">
                            {{ $banks->status ==1 ? 'Active' : 'Deactive' }}
                          </button>
                        </form>
                      </td>
                      <td>
                          <div class="dropdown">
                              <button class="btn btn-round btn-primary-rgba" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                              <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                                  
                                  <a class="dropdown-item" href="{{url('admin/return_policy/edit/'.$banks->id)}}"><i class="feather icon-edit mr-2"></i>{{ __("Edit") }}</a>
                                  
                                  <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#delete{{ $banks->id }}" >
                                      <i class="feather icon-delete mr-2"></i>{{ __("Delete") }}</a>
                                 
                              </div>
                          </div>
                          <div class="modal fade bd-example-modal-sm" id="delete{{ $banks->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog modal-sm">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="exampleSmallModalLabel">{{ __("DELETE") }}</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                              <h4>{{ __('Are You Sure ?')}}</h4>
                                              <p>{{ __('Do you really want to delete')}} <b></b> ? {{ __('This process cannot be undone.')}}</p>
                                      </div>
                                      <div class="modal-footer">
                                          <form method="post" action="{{url('admin/return_policy/destroy/'.$banks->id)}}" class="pull-right">
                                              {{csrf_field()}}
                                              {{method_field("Post")}}
                                              <button type="reset" class="btn btn-secondary" data-dismiss="modal">{{ __("No") }}</button>
                                              <button type="submit" class="btn btn-primary">{{ __("YES") }}</button>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </td>
                    </tr> 
                    @endforeach 
                  </tbody>
                </table>                  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
        
   
@endsection
