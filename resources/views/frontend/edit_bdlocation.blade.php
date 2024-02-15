<html>
  <head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  </head>
  <body>
  <div class="col-lg-4 col-md-6 col-12">
      <div class="mb-3">
          <label class="font-weight-bold" class="font-weight-normal">{{ __('Division') }} <span class="required">*</span></label>
          {{--                                <select data-placeholder="{{ __("Please select country") }}" name="country_id" id="city_id" class="form-control select2">--}}
          <select data-placeholder="{{ __("Please select Division") }}" name="division_id" id="edit_div_id_{{$address->id}}" class="form-control select2">
              <option value="">select</option>
              {{--                                      <option value={{$address->getDivisions->id}}>{{$address->getDivisions->bn_name }}</option>--}}
              @foreach($divisions as $div_id)
                  <option value="{{$div_id->id}}" >
                      {{$div_id->bn_name}}
                  </option>
              @endforeach
          </select>
      </div>
  </div>
  <div class="col-lg-4 col-md-6 col-12">
      <div class="mb-3">
          <label class="font-weight-bold" class="font-weight-normal">{{ __('District') }} <span class="required"></span></label>
          <select data-placeholder="Please select state" required name="district_id" class="form-control select2" id="edit_dist_id_{{$address->id}}">
              {{--                                      <option value={{ $address->getdistrict->id }}>{{ $address->getdistrict->bn_name }}</option>--}}
          </select>
      </div>
  </div>
  <div class="col-lg-4 col-md-6 col-12">
      <div class="mb-3">
          <label class="font-weight-bold" class="font-weight-normal">{{ __('Upazila') }} <span class="required"></span></label>
          <select data-placeholder="Please select state" required name="upazila_id" class="form-control select2" id="edit_upa_id_{{$address->id}}">
              {{--                                      <option value={{ $address->getupazila->id }}>{{ $address->getupazila->bn_name }}</option>--}}

          </select>
      </div>
  </div>
  <div class="col-lg-4 col-md-6 col-12">
      <div class="mb-3">
          <label class="font-weight-bold" class="font-weight-normal">{{ __('Union') }} <span class="required"></span></label>
          <select data-placeholder="Please select state" required name="union_id" class="form-control select2" id="edit_un_id_{{$address->id}}">
              {{--                                      <option value={{ $address->getunion->id }}>{{ $address->getunion->bn_name }}</option>--}}

          </select>
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
      $('#edit_div_id_{{$address->id}}').on('change',function (){
          console.log('hello');
          var div_id=$(this).val();
          var dist_id=$('#edit_dist_id_{{$address->id}}').empty();

          $.ajax({
              type: "GET",
              url: '{{route("choose_dist")}}',
              data: {
                  div_id: div_id
              },
              success:function (data){
                  dist_id.append('<option value="">Please Choose</option>');
                  $.each(data, function (key, value) {
                      dist_id.append($('<option>', {
                          value: value.id,
                          text: value.bn_name,
                      }));
                  });
              }
          })

      });

      $('#edit_dist_id_{{$address->id}}').on('change',function (){
          // console.log('hello');
          var dist_id=$(this).val();
          var upa_id=$('#edit_upa_id_{{$address->id}}').empty();

          $.ajax({
              type: "GET",
              url: '{{route("choose_upazila")}}',
              data: {
                  dist_id: dist_id
              },
              success:function (data){
                  upa_id.append('<option value="">Please Choose</option>');
                  $.each(data, function (key, value) {
                      upa_id.append($('<option>', {
                          value: value.id,
                          text: value.bn_name,
                      }));
                  });
              }
          })

      });

      $('#edit_upa_id_{{$address->id}}').on('change',function (){
          // console.log('hello');
          var upa_id=$(this).val();
          var union_id=$('#edit_un_id_{{$address->id}}').empty();

          $.ajax({
              type: "GET",
              url: '{{route("choose_union")}}',
              data: {
                  upa_id: upa_id
              },
              success:function (data){
                  union_id.append('<option value="">Please Choose</option>');
                  $.each(data, function (key, value) {
                      union_id.append($('<option>', {
                          value: value.id,
                          text: value.bn_name,
                      }));
                  });
              }
          })

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