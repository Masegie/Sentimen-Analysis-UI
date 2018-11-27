<!doctype html>
<html lang="en">
  <head>
    <title>TUBES - NLP</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900|Raleway" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  </head>
  <body>
    
    <header role="banner">
    </header>
    <!-- END header -->

    <section class="site-hero" data-stellar-background-ratio="0.5" style="background-color: #fffff  ">
      <div class="container">
        <div>
          <div class="col-md-8">

            <div class="mb-5 element-animate">
              <h1>Sentiment Analisis Pantai Parangtritis berdasar Tweet</h1>
            </div>

            <form id="input_artikel" class="mb-5 element-animate" action="{{url('submit_text.store')}}">
              <meta name="csfr-token" content="{{ csrf_token() }}" />
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group">
                <input type="text" name="textSentence" id="text_sentence" class="form-control form-control-block search-input" placeholder="Masukan Kalimat disini....">
              </div> 
              <input class="form-group" type="hidden" name="categoryPredict" id="category_predict" />     
              <button type="button" class="btn" id="submit_text" >Test </button>
            </form>

            <div class="mb-5 element-animate">
              <h6 class="yasudah" >Jadi kata / kalimat ini termasuk : </h6>
                <label class="yasudah" for="testResult" id="predictResult"></label>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->
    
    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>

    <script>
   
      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }
        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&libraries=places&callback=initAutocomplete"
        async defer></script>

    <script src="js/main.js"></script>

    <script src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function(){
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#submit_text').click(function(){
                    $('#predictResult').empty();
                    var text=$('#text_sentence').val();
                    
                    $.ajax({
                    type: "POST",
                    url:"https://tugasbesarnlp.herokuapp.com/input/task",
                    data:'{"textSentence":"'+text+'"}',
                    contentType: 'application/json; charset=utf-8',
                    dataType: "json",
                    success:function(data){
                        console.log(data);
                        var dataTemp=data['message'];
                        if (dataTemp == "[1]"){
                          dataTemp1 = "Positive";
                        } else {
                          dataTemp1 = "Negative";
                        }
                        $('#predictResult').append(dataTemp1);
                        $('#category_predict').val(dataTemp1);
                    }
                });
            });
        });
    </script>
  </body>
</html>