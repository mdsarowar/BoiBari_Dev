@extends('admin.layouts.master-soyuz')
@section('title',__('Advertisements |'))
@section('body')

<?php
  $data['heading'] = 'Advertisements';
  $data['title0'] = 'Marketing';
  $data['title1'] = 'Advertisements';
?>
@include('admin.layouts.topbar',$data)

<div class="contentbar bardashboard-card">
    <div class="row">
      <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    
                    <div class="row">
                      <div class="col-lg-8">
                        <h5 class="box-title">{{ __('All Advertisements') }}</h5>
                      </div>
                      <div class="col-md-4">
                        <div class="widgetbar">
                          @can('advertisements.create')
                          <div class="widgetbar">
                            <a href="{{ route('adv.create') }}"  class="btn btn-primary-rgba mr-2"><i class="feather icon-plus mr-2"></i>{{ __("Create New AD") }}</a>
                              </div> 
                          @endcan
                        </div>
                      </div>
                    </div>

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="adTable" class="width100 table table-bordered table-striped">
                      <thead>
          
                        <th>
                          #
                        </th>
                        <th>
                          {{__('Layout')}}
                        </th> 
                        <th>
                            {{__("Position")}}
                        </th>
                        <th>
                          {{__("Status")}}
                        </th>
                        <th>
                          {{__("Action")}}
                        </th>
                      </thead>
          
                      <tbody>
                        
                      </tbody>
                   </table>
                  </div>
                </div>
            </div>
      </div>
    </div>
</div>
@endsection
@section('custom-script')
 <script>var advindexurl = "<?=route('adv.index')?>"</script>
 <script src="{{ url('js/layoutadvertise.js') }}"></script>
@endsection
