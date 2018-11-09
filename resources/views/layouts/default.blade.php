<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>PKW Auto</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{!! asset('favicon.ico') !!}?v=3">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}">

    <!-- Latest compiled and minified CSS (CDN) -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous"> -->

    <!-- Optional theme -->
    <link rel="stylesheet" href="{!! asset('css/bootstrap-theme.min.css') !!}">

    <!-- Optional theme (CDN) -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous"> -->

    <!-- Bootstrap Vertical Tabs -->
    <link rel="stylesheet" href="{!! asset('css/bootstrap.vertical-tabs.min.css') !!}">

    <!-- Fonts (CDN) -->
    <link href='https://fonts.googleapis.com/css?family=Exo+2:400,700&subset=latin,cyrillic' rel='stylesheet'
          type='text/css'>

    <!-- Important Owl stylesheet -->
    <link rel="stylesheet" href="{!! asset('owl-carousel/owl.carousel.css') !!}">

    <!-- Default Theme -->
    <link rel="stylesheet" href="{!! asset('owl-carousel/owl.theme.css') !!}">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <!--<script src="{!! asset('js/dropzone.js') !!}"></script>-->
</head>
<body>

@yield('body')

{{--<input type="hidden" name="sliderSwitch" value="{!! $sliderSwithStatus !!}">--}}

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{!! asset('js/jquery.min.js') !!}"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) (CDN) -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="{!! asset('js/bootstrap.min.js') !!}"></script>
<!-- Latest compiled and minified Bootstrap JavaScript (CDN) -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script> -->
<!-- Include carousel js plugin -->
<script src="{!! asset('owl-carousel/owl.carousel.js') !!}"></script>
<!-- Execute when document has finished loading -->
@if( Request::is('/') || Request::is('home') )
    <script>

//        var sliderSwitch = $('input[name="sliderSwitch"]').val();

        $(document).ready(function () {

            /* Initialize carousel */
            $("#owl-main").owlCarousel({
                navigation: false, // Show next and prev buttons
                autoPlay: {!! $sliderSwithStatus !!},
                /*autoHeight: true,*/
                slideSpeed: 300,
                paginationSpeed: 400,
                singleItem: true
            });

            /* Set navbar as affixed */
            $('#mainNav').affix({
                offset: {
                    top: function () {
                        return (this.top = $('.nav').outerHeight(true))
                    }
                }
            });

            /* Keyboard navigation for carousel */
            /* https://github.com/OwlFonk/OwlCarousel/issues/65#issuecomment-35905182 */
            var owl = $('#owl-main').data('owlCarousel');

            $(document.documentElement).keyup(function (event) {
                // handle cursor keys
                if (event.keyCode == 37) {
                    owl.prev();
                } else if (event.keyCode == 39) {
                    owl.next();
                }
            });

        });

        function initialize() {

                    @foreach( $contactsData as $key => $contacts )

                      var mapProp{!! $key !!}  = {
                center: new google.maps.LatLng({!! $contacts -> contact_coordinates !!}, 17),
                zoom: 15,
                scrollwheel: false,
                draggable: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map{!! $key !!}  = new google.maps.Map(document.getElementById("@if( $key == 0 ) leftIMap @elseif( $key == 1 ) rightIMap @endif"), mapProp{!! $key !!});

            marker{!! $key !!}  = new google.maps.Marker({
                map: map{!! $key !!},
                icon: "img/marker-k.png",
                position: new google.maps.LatLng({!! $contacts -> contact_coordinates !!}, 17)
            });
            infowindow{!! $key !!}  = new google.maps.InfoWindow({content: "<font style='color: #000;'><b>{!! $contacts -> contact_city !!}</b><br />{!! $contacts -> contact_address !!}</font>"});
            google.maps.event.addListener(marker{!! $key !!}, "click", function () {
                infowindow{!! $key !!}.open(map{!! $key !!}, marker{!! $key !!});
            });
            infowindow{!! $key !!}.open(map{!! $key !!}, marker{!! $key !!});

            @endforeach


        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@elseif( Request::is('about') )
    <script>
        $(document).ready(function () {

            /* Initialize carousel */
            $("#owl-testimonials").owlCarousel({
                navigation: true, // Show next and prev buttons
                autoPlay: false,
                slideSpeed: 300,
                pagination: false,
                paginationSpeed: 400,
                singleItem: true,
                navigationText: ['<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>', '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>']
            });

            /* Set navbar as affixed */
            $('#mainNav').affix({
                offset: {
                    top: function () {
                        return (this.top = $('.nav').outerHeight(true))
                    }
                }
            });

            /* Detect file upload */
            $('.btn-file :file').on('fileselect', function (event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;

                if (input.length) {
                    input.val(log);
                } else {
                    if (log) alert(log);
                }

            });

            /* Dropzone.js */
            /*Dropzone.options.theFormItself = {
              paramName: "post_image", // The name that will be used to transfer the file
              maxFilesize: 2, // MB
              accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                  done("Naha, you don't.");
                }
                else { done(); }
              }
            };*/

        });

        /* Form feedback */
        $(document).on('change', '.btn-file :file', function () {
            var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });
    </script>
@elseif( Request::is('careers') )
    <script>
        $(document).ready(function () {

            /* Set navbar as affixed */
            $('#mainNav').affix({
                offset: {
                    top: function () {
                        return (this.top = $('.nav').outerHeight(true))
                    }
                }
            });

        });
    </script>
@elseif( Request::is('careers/*') )
    <script>
        $(document).ready(function () {

            /* Set navbar as affixed */
            $('#mainNav').affix({
                offset: {
                    top: function () {
                        return (this.top = $('.nav').outerHeight(true))
                    }
                }
            });

            /* Detect file upload */
            $('.btn-file :file').on('fileselect', function (event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;

                if (input.length) {
                    input.val(log);
                } else {
                    if (log) alert(log);
                }

            });

        });

        /* Form feedback */
        $(document).on('change', '.btn-file :file', function () {
            var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });
    </script>
@elseif( Request::is('contacts') )
    <script>
        $(document).ready(function () {

            /* Set navbar as affixed */
            $('#mainNav').affix({
                offset: {
                    top: function () {
                        return (this.top = $('.nav').outerHeight(true))
                    }
                }
            });

            /* Detect file upload */
            $('.btn-file :file').on('fileselect', function (event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;

                if (input.length) {
                    input.val(log);
                } else {
                    if (log) alert(log);
                }

            });

        });

        /* Form feedback */
        $(document).on('change', '.btn-file :file', function () {
            var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        function initialize() {

            var mapProp = {
                center: new google.maps.LatLng({!! $contactsDataS -> contact_coordinates !!}, 17),
                zoom: 15,
                scrollwheel: false,
                draggable: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var mapProp2 = {
                center: new google.maps.LatLng({!! $contactsDataP -> contact_coordinates !!}, 17),
                zoom: 15,
                scrollwheel: false,
                draggable: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("leftMap"), mapProp);
            map2 = new google.maps.Map(document.getElementById("rightMap"), mapProp2);

            marker = new google.maps.Marker({
                map: map,
                icon: "img/marker-k.png",
                position: new google.maps.LatLng({!! $contactsDataS -> contact_coordinates !!}, 17)
            });
            infowindow = new google.maps.InfoWindow({content: "<font style='color: #000;'><b>{!! $contactsDataS -> contact_city !!}</b><br />{!! $contactsDataS -> contact_address !!}</font>"});
            google.maps.event.addListener(marker, "click", function () {
                infowindow.open(map, marker);
            });
            infowindow.open(map, marker);

            marker2 = new google.maps.Marker({
                map: map2,
                icon: "img/marker-k.png",
                position: new google.maps.LatLng({!! $contactsDataP -> contact_coordinates !!}, 17)
            });
            infowindow2 = new google.maps.InfoWindow({content: "<font style='color: #000;'><b>{!! $contactsDataP -> contact_city !!}</b><br />{!! $contactsDataP -> contact_address !!}</font>"});
            google.maps.event.addListener(marker2, "click", function () {
                infowindow2.open(map2, marker2);
            });
            infowindow2.open(map2, marker2);

        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@elseif( Request::is('services') )
    <script>
        $(document).ready(function () {

            /* Set navbar as affixed */
            $('#mainNav').affix({
                offset: {
                    top: function () {
                        return (this.top = $('.nav').outerHeight(true))
                    }
                }
            });

        });

        // Javascript to enable link to tab
        // http://stackoverflow.com/a/9393768
        var url = document.location.toString();
        if (url.match('#')) {
            $('.nav-tabs a[href=#' + url.split('#')[1] + ']').tab('show');
        }

        // Change hash for page-reload
        $('.nav-tabs a').on('shown.bs.tab', function (e) {
            window.location.hash = e.target.hash;
        });
    </script>
@endif

</body>
</html>



