<html>
  <head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  </head>
  <body>
  <div class="col-lg-4 col-md-6 col-12">
      <div class="mb-3">
          <label class="font-weight-bold" class="font-weight-normal">{{ __('Divisionss') }} <span class="required">*</span></label>
          {{--                                <select data-placeholder="{{ __("Please select country") }}" name="country_id" id="city_id" class="form-control select2">--}}
          <select data-placeholder="{{ __("Please select Division") }}" name="division_id" id="division_id" class="form-control select2">

              <option value="">{{ __("Please Choosess") }}</option>
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
          <select data-placeholder="Please select state" required name="district_id" class="form-control select2" id="district_id">
              {{--                                  <option value="">{{ __("Please choose") }}</option>--}}

          </select>
      </div>
  </div>
  <div class="col-lg-4 col-md-6 col-12">
      <div class="mb-3">
          <label class="font-weight-bold" class="font-weight-normal">{{ __('Upazila') }} <span class="required"></span></label>
          <select data-placeholder="Please select state" required name="upazila_id" class="form-control select2" id="upazila_id">
              {{--                                  <option value="">{{ __("Please choose") }}</option>--}}

          </select>
      </div>
  </div>
  <div class="col-lg-4 col-md-6 col-12">
      <div class="mb-3">
          <label class="font-weight-bold" class="font-weight-normal">{{ __('Union') }} <span class="required"></span></label>
          <select data-placeholder="Please select state" required name="union_id" class="form-control select2" id="union_id">
              {{--                                  <option value="">{{ __("Please choose") }}</option>--}}

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
      $('#division_id').on('change',function (){
          console.log('hello');
          var div_id=$(this).val();
          var dist_id=$('#district_id').empty();

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
      $('#district_id').on('change',function (){
          // console.log('hello');
          var dist_id=$(this).val();
          var upa_id=$('#upazila_id').empty();

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
      $('#upazila_id').on('change',function (){
          // console.log('hello');
          var upa_id=$(this).val();
          var union_id=$('#union_id').empty();

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