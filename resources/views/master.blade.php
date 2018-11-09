@extends('layouts.default')
@section('body')

  <div id="topSection">

      <!-- NAVBAR -->
      <nav id="mainNav" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{!! url('home') !!}"><img src="{!! asset('img/logo.png') !!}" alt=""></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
              <li class="@if( Request::is('/') || Request::is('home') ) active @endif">
                <a href="{!! url('home') !!}">Начало</a>
              </li>
              <li class="@if( Request::is('about') ) active @endif">
                <a href="{!! url('about') !!}">За нас</a>
              </li>
              <li class="@if( Request::is('services') || Request::is('services/*') ) active @endif">
                <a href="{!! url('services') !!}">Услуги</a>
              </li>
              <li class="@if( Request::is('careers') ) active @endif">
                <a href="{!! url('careers') !!}">Кариери</a>
              </li>
              <li class="@if( Request::is('contacts') ) active @endif">
                <a href="{!! url('contacts') !!}">Контакти</a>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li>
                <div class="minicard"><a href="tel:{!! $aboutData -> about_telephone !!}"><p>свържете се с нас<br />{!! $aboutData -> about_telephone !!}</p></a></div>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div>
      </nav>

      @if( Request::is('/') || Request::is('home') )
        <!-- MAIN SLIDER -->
        <section>
          <div id="owl-main" class="owl-carousel owl-theme">
            @foreach( $sliderData as $slider )
              <div>
                <figure><div class="image" style="background-image: url({!! asset('uploads/images/SliderImages/' . $slider -> slide_image) !!});"></div></figure>
                <div class="contentOut vCenterParent">
                  <div class="contentIn centered">
                    <div class="container">
                      {!! $slider -> slide_title !!}
                      <div class="link"><a href="{!! $slider -> slide_link !!}" target="_blank">{!! $slider -> slide_text !!}</a></div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div> <!-- /#owl-main -->
        </section>
      @elseif( Request::is('about') || Request::is('careers') || Request::is('careers/*') || Request::is('contacts'))
        <!-- HERO IMAGE -->
        <section>
          <div id="hero">
            <div class="container-fluid">
              <div class="row">
                <figure><div class="image"></div></figure>
              </div>
            </div>
          </div>
        </section>
      @elseif( Request::is('services') )
        <section>
          <div id="hero" class="services">
            <div class="container-fluid">
              <div class="row">
                <figure><div class="image"></div></figure>
              </div>
            </div>
          </div>
        </section>

        <style>
          #hero .image {
            background-image: url('{!! asset('img/pic-contacts-1.jpg') !!}');
          }
        </style>
      @endif

  </div> <!-- /.topSection -->

    @yield('content')

    <!-- FOOTER -->
    <footer>
      <div id="footer" class="clearfix">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="copyright">
                <!-- <span><p>Created By <a href="http://onecreative.eu/">OneCreative</a></p>
                <p>Copyright &copy; 2015</p></span> -->
                <span> <p> Варненски Свободен Университет </p></span>
                <span> <p> Денис Рафаилов фк.н. 22301023 </p></span>
                <span> <p>Дисциплина "Интернет в публичния и бизнес сектор HTML&JavaScript"</p></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="social">
                <p>ТЕЛ: <a href="tel:{!! $aboutData -> about_telephone !!}">{!! $aboutData -> about_telephone !!}</a></p>
                <ul>
                  <li><a href="#" title="Facebook"><img src="{!! asset('img/social/icon-fb.png') !!}" alt="Facebook" /></a></li>
                  <li><a href="#" title="Twitter"><img src="{!! asset('img/social/icon-twitter.png') !!}" alt="Twitter" /></a></li>
                  <li><a href="#" title="Foursqare"><img src="{!! asset('img/social/icon-f.png') !!}" alt="Foursqare" /></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

@stop