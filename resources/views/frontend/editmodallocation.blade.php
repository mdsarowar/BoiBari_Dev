<html>
  <head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  </head>
  <body>
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="p-2 modal-title" id="myModalLabel">{{ __('Edit Address') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="{{ route('address.update',$address->id) }}" role="form" method="POST" id="update_form">
                  @csrf
                  <div class="row">
                      <div class="col-lg-4 col-md-6 col-12">
                          <div class="mb-3">
                              <label class="font-weight-bold" class="font-weight-normal" for="name">{{ __('Name') }}:<span class="required">*</span></label>
                              <input required="" name="name" type="text" value="{{ $address->name }}" placeholder="{{ __('Name') }}" class="form-control">
                          </div>
                      </div>
                      {{--                                <div class="col-lg-4 col-md-6 col-12">--}}
                      {{--                                  <div class="mb-3">--}}
                      {{--                                    <label class="font-weight-bold" class="font-weight-normal" for="email">{{ __('Email') }}: <span class="required">*</span></label>--}}
                      {{--                                    <input type="email" placeholder="Edit Email" class="form-control" name="{{ __('email') }}" value="{{ $address->email }}">--}}
                      {{--                                  </div>--}}
                      {{--                                </div>--}}
                      <div class="col-lg-4 col-md-6 col-12">
                          <div class="mb-3">
                              <label class="font-weight-bold" class="font-weight-normal" for="email">{{ __('PhoneNo') }}: <span class="required">*</span></label>
                              <input  type="text" placeholder="Edit Phone no" class="form-control" name="{{ __('phone') }}" value="{{ $address->phone }}">
                          </div>
                      </div>
                      @include('frontend.edit_bdlocation')



                      {{--                                <div class="col-lg-4 col-md-6 col-12">--}}
                      {{--                                  <div class="mb-3">--}}
                      {{--                                    @if ($pincodesystem == 1)--}}
                      {{--                                    <label class="font-weight-bold" class="font-weight-normal">{{ __('Pincode') }}: <span class="required">*</span> </label>--}}
                      {{--                                    <input pattern="[0-9]+" required value="{{ $address->pin_code }}" onkeyup="pincodetry('{{ $address->id }}')" type="text" id="pincode{{ $address->id }}" class="form-control z-index99" name="pin_code">--}}
                      {{--                                    @endif--}}
                      {{--                                  </div>--}}
                      {{--                                </div>--}}
                      <div class="col-lg-12 col-md-12 col-12">
                          <div class="mb-3">
                              <label class="font-weight-bold" class="font-weight-normal">{{ __('Address') }}: <span class="required">*</span></label>
                              <textarea required="" name="address" id="address" cols="20" rows="5" class="form-control">{{ strip_tags($address->address) }}</textarea>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-12 col-md-6 col-12">
                      <div class="mb-3">
                          <div class="form-group checkout-personal-dtl">
                              <label class="address-checkbox">{{ __('Set Default Address') }}
                                  <input {{ $address->defaddress == 1 ? "checked" : "" }} type="checkbox" name="setdef">
                                  <span class="checkmark"></span>
                              </label>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-12 col-md-6 col-12">
                      <button type="submit"  class="btn btn-primary"><i data-feather="save"></i>{{ __('Update') }}</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
    
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
      $(".select_city").select2({
          placeholder: "Select a programming language",
          allowClear: true
      });
      $(".select_city").select2({
          minimumInputLength: 2
      });
    </script>

  <script>
      $('#update_button').on('click', function(e) {
          e.preventDefault();
          let form = $('#update_form')[0];
          let data = new FormData(form);
          console.log(data);

          $.ajax({
              url: "{{ route('choose.address') }}",
              type: "POST",
              data : data,
              dataType:"JSON",
              processData : false,
              contentType:false,
          });
          });
  </script>
    <script>
      function selectCity(city_id) {
        var up = $('.select_state').empty();
        var up1 = $('.select_country').empty();
        var cat_id = city_id;

        if (cat_id) {
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: baseUrl + '/admin/select_state_country',
            data: {
              catId: cat_id
            },
            success: function (data) {
              console.log(data);
              // $('#country_id').append('<option value="">Please Choose</option>');
              // up.append('<option value="">Please Choose</option>');
              $.each(data.states, function (id, title) {
                up.append($('<option>', {
                  value: id,
                  text: title
                }));
              });

              $.each(data.country, function (id, title) {
                up1.append($('<option>', {
                  value: id,
                  text: title
                }));
              });
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
              console.log(XMLHttpRequest);
            }
          });
        }
      }
    </script>

  </body>
</html>