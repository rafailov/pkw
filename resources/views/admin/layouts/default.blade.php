<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{!! asset('panel/bootstrap/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{!! asset('panel/dist/css/AdminLTE.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('panel/dist/css/skins/_all-skins.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('panel/plugins/iCheck/flat/blue.css') !!}">
    <link rel="stylesheet" href="{!! asset('panel/plugins/morris/morris.css') !!}">
    <link rel="stylesheet" href="{!! asset('panel/plugins/jvectormap/jquery-jvectormap-1.2.2.css') !!}">
    <link rel="stylesheet" href="{!! asset('panel/plugins/datepicker/datepicker3.css') !!}">
    <link rel="stylesheet" href="{!! asset('panel/plugins/daterangepicker/daterangepicker-bs3.css') !!}">
    <link rel="stylesheet" href="{!! asset('panel/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') !!}">

    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{!! asset('froalaEditor/css/froala_editor.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('froalaEditor/css/froala_style.min.css') !!}" rel="stylesheet" type="text/css" />

    <!-- Include Editor Plugins style. -->
    <link rel="stylesheet" href="{!! asset('froalaEditor/css/plugins/char_counter.css') !!}">
    <link rel="stylesheet" href="{!! asset('froalaEditor/css/plugins/code_view.css') !!}">
    <link rel="stylesheet" href="{!! asset('froalaEditor/css/plugins/colors.css') !!}">
    <link rel="stylesheet" href="{!! asset('froalaEditor/css/plugins/emoticons.css') !!}">
    <link rel="stylesheet" href="{!! asset('froalaEditor/css/plugins/file.css') !!}">
    <link rel="stylesheet" href="{!! asset('froalaEditor/css/plugins/fullscreen.css') !!}">
    <link rel="stylesheet" href="{!! asset('froalaEditor/css/plugins/image.css') !!}">
    <link rel="stylesheet" href="{!! asset('froalaEditor/css/plugins/image_manager.css') !!}">
    <link rel="stylesheet" href="{!! asset('froalaEditor/css/plugins/line_breaker.css') !!}">
    <link rel="stylesheet" href="{!! asset('froalaEditor/css/plugins/table.css') !!}">
    <link rel="stylesheet" href="{!! asset('froalaEditor/css/plugins/video.css') !!}">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @if( Request::is('admin/contact/edit/*') )
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <style>
            #mapCanvas {
                width: 100%;
                height: 250px;
                float: left;
                margin: 10px 0;
            }
        </style>
        <script type="text/javascript">
            function updateMarkerPosition(latLng) {
                document.getElementById('info').value = [
                    latLng.lat(),
                    latLng.lng()
                ].join(', ');
            }

            function initialize() {
                var latLng = new google.maps.LatLng({!! $contact->contact_coordinates !!});
                var map = new google.maps.Map(document.getElementById('mapCanvas'), {
                    zoom: 15,
                    center: latLng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                var marker = new google.maps.Marker({
                    position: latLng,
                    title: 'Point A',
                    map: map,
                    draggable: true
                });

                // Update current position info.
                updateMarkerPosition(latLng);

                google.maps.event.addListener(marker, 'drag', function () {
                    updateMarkerPosition(marker.getPosition());
                });

            }

            // Onload handler to fire off the app.
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
    @endif
</head>

<body class="hold-transition skin-blue sidebar-mini">

@yield('body')

<script src="{!! asset('panel/plugins/jQuery/jQuery-2.1.4.min.js') !!}"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{!! asset('panel/bootstrap/js/bootstrap.min.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{!! asset('panel/plugins/morris/morris.min.js') !!}"></script>
<script src="{!! asset('panel/plugins/sparkline/jquery.sparkline.min.js') !!}"></script>
<script src="{!! asset('panel/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') !!}"></script>
<script src="{!! asset('panel/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') !!}"></script>
<script src="{!! asset('panel/plugins/knob/jquery.knob.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{!! asset('panel/plugins/daterangepicker/daterangepicker.js') !!}"></script>
<script src="{!! asset('panel/plugins/datepicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('panel/plugins/slimScroll/jquery.slimscroll.min.js') !!}"></script>
<script src="{!! asset('panel/plugins/fastclick/fastclick.min.js') !!}"></script>
<script src="{!! asset('panel/dist/js/app.min.js') !!}"></script>
<script src="{!! asset('panel/dist/js/pages/dashboard.js') !!}"></script>
<script src="{!! asset('panel/dist/js/demo.js') !!}"></script>
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script src="{!! asset('panel/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}"></script>
<script>
    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor1');
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<!-- Include JS files. -->
<script src="{!! asset('froalaEditor/js/froala_editor.min.js') !!}"></script>

<!-- Include Plugins. -->
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/align.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/char_counter.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/code_view.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/colors.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/emoticons.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/entities.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/file.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/font_family.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/font_size.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/fullscreen.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/image.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/image_manager.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/inline_style.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/inline_style.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/link.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/lists.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/paragraph_format.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/paragraph_style.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/quote.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/table.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/save.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/url.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('froalaEditor/js/plugins/video.min.js') !!}"></script>

<!-- Include Language file if we'll use it. -->
<script type="text/javascript" src="{!! asset('froalaEditor/js/languages/ro.js') !!}"></script>

<!-- Initialize the editor. -->
<script>
    $(function() {
        $('#edit').froalaEditor()
    });
</script>





</body>
</html>