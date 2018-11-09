@extends('master')
@section('content')

        <!-- ABOUT BAR -->
<aside>
    <div id="aboutBar">
        <div class="container">
            <div class="row">
                <div class="col-lg-5"><span class="">PKW AUTO SERVICE</span></div>
                <div class="col-lg-2"><img src="{!! asset('img/logo.png') !!}" alt=""></div>
                <div class="col-lg-5"><span>ДИАГНОСТИКА &bull; РЕМОНТИ &bull; ГУМИ</span></div>
            </div>
        </div>
    </div>
</aside>

<!-- INTRODUCTION -->
<section>
    <div id="introduction">
        <div class="container">
            <div class="row">
                <article>
                    <div class="col-lg-6">
                        <p class="lead">{!! $aboutData -> about_slogan !!}</p>
                    </div>
                    <div class="col-lg-6">
                        <p>{!! str_limit($aboutData -> about_textOne, $limit = 300, $end = '...') !!}</p>
                        <a href="{!! url('about') !!}">Научи повече <span>&rarr;</span></a>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section>
    <div id="services">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 left">
                    <header><h2 class="title">Услуги</h2></header>
                    <nav>
                        <ul class="nav nav-tabs tabs-left">
                            @foreach( $servicesData as $key => $service )
                                <style>
                                    #services .tabs-left a[href="#{!! $key + 1 !!}"]:before {
                                        content: url({!! asset('uploads/images/services/icon/' . $service -> service_icon) !!});
                                    }
                                </style>
                                <li class="@if( $key == 0 ) active @endif"><a href="#{!! $key + 1 !!}"
                                                                              data-toggle="tab">{!! $service -> service_name !!}</a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
                <div class="col-md-2 mid">
                    <div style="visibility: hidden">HERE I AM</div>
                </div>
                <div class="col-md-5 right">
                    <div class="tab-content">
                        @foreach( $servicesData as $key => $service )
                            <div class="tab-pane @if( $key == 0 ) active @endif" id="{!! $key + 1 !!}">
                                <article>
                                    <header><h3 class="tab-heading">{!! $service -> service_name !!}</h3></header>
                                    <p>{!! $service -> service_text !!}</p>
                                    <footer><a href="http://pkw.onecreative.eu/services#service{!! $key + 1 !!}" class="more">Научи повече<span>&rarr;</span></a></footer>
                                </article>

                                {{--http://pkw.onecreative.eu/services#service2--}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CAREERS -->
<section>
    @if(count($careersData)!=0)


        <div id="careers">
            <div class="container">
                <header>
                    <h1 class="title">Кариери</h1>

                    <h2 class="subTitle">Свободни позиции</h2>
                </header>
                <div class="row padded">
                    @foreach( $careersData as $key => $careers )
                        <div class="col-lg-6">
                            <article>
                                <header>
                                    <h3 class="jobTitle">{!! str_limit($careers -> career_position, $limit = '25', $end = '...') !!}</h3>
                                </header>
                                <section>{!! str_limit($careers -> career_description, $limit = '300', $end = '...') !!}</section>
                                <footer><a href="{!! url('careers/' . $careers -> career_id) !!}"
                                           class="more hidden-lg internal">Вижте още <span>&rarr;</span></a></footer>
                            </article>
                        </div>
                        @if( $key == 1 )
                            <div class="spacer hidden-lg"></div>
                        @endif
                    @endforeach

                    @foreach( $careersData as $careers )
                        <div class="col-lg-6 visible-lg-block padded"><a
                                    href="{!! url('careers/#' . $careers -> career_id) !!}" class="more">Вижте още
                                <span>&rarr;</span></a></div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</section>

<!-- CONTACTS -->
<section>
    <div id="contacts">
        <div class="container-fluid">
            <div class="row">
                @foreach( $contactsData as $key => $contacts )
                    <div class="col-lg-6 @if( $key == 0 ) left @elseif( $key == 1 ) right @endif">
                        <div class="vcard" itemscope itemtype="http://schema.org/AutoBodyShop">
                            <address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                                <p class="lead"><strong>гр. <span
                                                itemprop="addressLocality">{!! $contacts -> contact_city !!}</span></strong>
                                </p>

                                <p>Адрес: ул. <span itemprop="streetAddress">{!! $contacts -> contact_address !!}</span>
                                </p>
                            </address>
                            <p>Работно време: <strong>
                                    <time itemprop="openingHours"
                                          datetime="Mo-Fr 09:00-19:00">{!! $contacts -> contact_worktime !!}</time>
                                </strong></p>
                            <p>тел. <strong itemprop="telephone">{!! $contacts -> contact_telephone !!}</strong></p>
                        </div>
                        <div id="@if( $key == 0 ) leftIMap @elseif( $key == 1 ) rightIMap @endif"
                             style="width:100%; height:350px;"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@stop