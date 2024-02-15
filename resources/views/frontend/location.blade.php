<html>
  <head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  </head>
  <body>
    <div class="col-lg-4 col-md-6">
        <div class="mb-30">
            <label for="select_city" class="form-label">City</label>
            <select id="select_city" class="form-select select2 select_city" name="city_id" onchange="selectCity(this.value)" required>
                <option value="">{{ __('Select City') }}</option>                
                @foreach(App\Allcity::get() as $city)
                <option value="{{$city->id}}">{{ $city->name }}</option>
                @endforeach                
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="mb-30">
            <label for="select_state" class="form-label">{{ __('State') }}</label>
            <select id="select_state" name="state_id" class="form-select select_state" aria-label="Default select example" required></select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="mb-30">
            <label for="select_country" class="form-label">{{ __('Country') }}</label>
            <select id="select_country" class="form-select select_country" aria-label="Default select example" name="country_id" required></select>
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