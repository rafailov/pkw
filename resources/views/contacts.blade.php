@extends('master')
@section('content')

    @if(Session::has('successMessage'))
    <div class="container">
        <div class="alert alert-success">
            {!! Session::get('successMessage') !!}
        </div>
    </div>
    @endif

    @if($errors -> any() )
    <div class="container">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" style="width: 100%;">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <p>{{ $error }}</p>
            </div>
        @endforeach
    </div>
    @endif

    <!-- MAPS -->
    <section>
        <div id="maps">
            <div class="container">
                <header><h2 class="title">Намерете ни в</h2></header>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 left">
                        <div id="leftMap" style="width:100%; height:350px;"></div>
                    </div>
                    <div class="col-lg-6 right">
                        <div id="rightMap" style="width:100%; height:350px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- COORDINATES -->
    <section>
        <div id="coordinates">
            <div class="container-fluid split">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 left">
                                <div class="row">
                                    <div class="col-lg-6" itemscope itemtype="http://schema.org/AutoBodyShop">
                                        <address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                                            <p class="city"><strong><span itemprop="addressLocality">{!! $contactsDataS -> contact_city !!}</span></strong></p>
                                            <p class="street"><span itemprop="streetAddress">{!! $contactsDataS -> contact_address !!}</span></p>
                                        </address>
                                        <p class="times"><strong><time itemprop="openingHours" datetime="Mo-Fr {!! $contactsDataS -> contact_worktime !!}">{!! $contactsDataS -> contact_worktime !!}</time></strong></p>
                                        <p class="tel"><a href="tel:{!! $contactsDataS -> contact_telephone !!}"><strong><span itemprop="telephone">{!! $contactsDataS -> contact_telephone !!}</span></strong></a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 right">
                                <div class="row">
                                    <div class="col-lg-6 col-lg-offset-6" itemscope itemtype="http://schema.org/AutoBodyShop">
                                        <address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                                            <p class="city"><strong><span itemprop="addressLocality">{!! $contactsDataP -> contact_city !!}</span></strong></p>
                                            <p class="street"><span itemprop="streetAddress">{!! $contactsDataP -> contact_address !!}</span></p>
                                        </address>
                                        <p class="times"><strong><time itemprop="openingHours" datetime="Mo-Fr {!! $contactsDataP -> contact_worktime !!}">{!! $contactsDataP -> contact_worktime !!}</time></strong></p>
                                        <p class="tel"><a href="tel:{!! $contactsDataP -> contact_telephone !!}"><strong><span itemprop="telephone">{!! $contactsDataP -> contact_telephone !!}</span></strong></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        #coordinates .left .street:before {
            content: url('{!! asset('img/coordinates/icon-1-black.png') !!}');
        }
        #coordinates .left .times:before {
            content: url('{!! asset('img/coordinates/icon-2-black.png') !!}');
        }
        #coordinates .left .tel:before {
            content: url('{!! asset('img/coordinates/icon-3-black.png') !!}');
        }
        #coordinates .right .street:before {
            content: url('{!! asset('img/coordinates/icon-1-white.png') !!}');
        }
        #coordinates .right .times:before {
            content: url('{!! asset('img/coordinates/icon-2-white.png') !!}');
        }
        #coordinates .right .tel:before {
            content: url('{!! asset('img/coordinates/icon-3-white.png') !!}');
        }
    </style>

    <!-- FEEDBACK -->
    <section>
        <div id="feedback" class="contactForm">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <a href="#feedbackForm" class="toggler btn btn-yellow" data-toggle="collapse" data-target="#feedbackForm">Свържете се с нас</a>
                    </div>
                </div>
                <div class="row">
                    <div id="feedbackForm" class="collapse">
                        {!! Form::open(array('action' => 'ContactsController@store', 'role' => 'form')) !!}
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group input-group-xl">
                                    <span class="input-group-addon" id="basic-addon1"><label for="fName"><img src="{!! asset('img/form/icon-1.png') !!}" alt=""></label></span>
                                    {!! Form::text('send_name', null, array('id' => 'fName', 'class' => 'form-control', 'placeholder' => 'Вашето име...', 'aria-describedby' => 'basic-addon1', 'required' => 'required')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-xl">
                                    <span class="input-group-addon" id="basic-addon2"><label for="fEmail"><img src="{!! asset('img/form/icon-2.png') !!}" alt=""></label></span>
                                    {!! Form::text('send_email', null, array('id' => 'fEmail', 'class' => 'form-control', 'placeholder' => 'Вашият e-mail...', 'aria-describedby' => 'basic-addon2', 'required' => 'required')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-xl">
                                    <span class="input-group-addon" id="basic-addon3"><label for="aPhone"><img src="{!! asset('img/form/icon-8.png') !!}" alt=""></label></span>
                                    {!! Form::text('send_telephone', null, array('id' => 'aPhone', 'class' => 'form-control', 'placeholder' => 'Вашият телефон...', 'aria-describedby' => 'basic-addon3', 'required' => 'required')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon input-xl" id="basic-addon5"><label for="fComment"><img src="{!! asset('img/form/icon-5.png') !!}" alt=""></label></span>
                                    {!! Form::textarea('send_message', null, array('id' => 'fComment', 'class' => 'form-control', 'placeholder' => 'Вашето мнение...', 'rows' => '9', 'aria-describedby' => 'basic-addon5', 'required' => 'required')) !!}
                                </div>
                            </div>
                            <div class="form-group text-right">
                                {!! Form::submit('Изпрати', array('class' => 'btn btn-yellow')) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop