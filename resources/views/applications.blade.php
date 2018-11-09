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

    <!-- APPLYING FOR -->
    <section>
    	<div id="applyingFor">
    	    <div class="container">
    	        <header><h2 class="title">Вие кандидатствате за позиция:</h2></header>
    	        <div class="row">
    	            <div class="padded">
    	                <header><h3 class="jobTitle">{!! $careerData -> career_position !!}</h3></header>
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </section>

    <!-- APPLICATION -->

    <section>
    	<div id="application">
    	    <div class="container">
    	        <div class="row">
    	            <div id="applicationForm" class="">

    	                {!! Form::open(array('action' => 'ApplicationsController@store', 'files' => true, 'role' => 'form')) !!}
                        {!! Form::hidden('app_career', $careerData -> career_id) !!}
    	                    <div class="col-lg-6">
    	                        <div class="form-group">
    	                            <div class="input-group input-group-xl">
    	                                <span class="input-group-addon" id="basic-addon1"><label for="aName"><img src="{!! asset('img/form/icon-1.png') !!}" alt=""></label></span>
    	                                {!! Form::text('app_name', null, array('id' => 'aName', 'class' => 'form-control', 'placeholder' => 'Вашето име...', 'aria-describedby' => 'basic-addon1', 'required' => 'required')) !!}
    	                            </div>
    	                        </div>
    	                        <div class="form-group">
    	                            <div class="input-group input-group-xl">
    	                                <span class="input-group-addon" id="basic-addon2"><label for="aEmail"><img src="{!! asset('img/form/icon-2.png') !!}" alt=""></label></span>
    	                                {!! Form::text('app_email', null, array('id' => 'aEmail', 'class' => 'form-control', 'placeholder' => 'Вашият e-mail...', 'aria-describedby' => 'basic-addon2', 'required' => 'required')) !!}
    	                            </div>
    	                        </div>
    	                        <div class="form-group">
    	                            <div class="input-group input-group-xl">
    	                                <span class="input-group-addon" id="basic-addon3"><label for="aPhone"><img src="{!! asset('img/form/icon-8.png') !!}" alt=""></label></span>
    	                                {!! Form::text('app_telephone', null, array('id' => 'aPhone', 'class' => 'form-control', 'placeholder' => 'Вашият телефон...', 'aria-describedby' => 'basic-addon3', 'required' => 'required')) !!}
    	                            </div>
    	                        </div>
    	                        <div class="form-group">
    	                            <div class="input-group input-group-xl">
    	                                <span class="input-group-addon" id="basic-addon4"><label for="aEducation"><img src="{!! asset('img/form/icon-6.png') !!}" alt=""></label></span>
    	                                {!! Form::text('app_education', null, array('id' => 'aEducation', 'class' => 'form-control', 'placeholder' => 'Вашето образование...', 'aria-describedby' => 'basic-addon4', 'required' => 'required')) !!}
    	                            </div>
    	                        </div>
    	                    </div>
    	                    <div class="col-lg-6">
    	                        <div class="form-group">
    	                            <div class="input-group input-group-xl outlined">
    	                                <span class="input-group-btn">
    	                                  <span class="btn btn-default btn-file">
    	                                      <img src="{!! asset('img/form/icon-7.png') !!}" alt="">
    	                                      {!! Form::file('app_cv', array('id' => 'aCV', 'required' => 'required')) !!}
    	                                  </span>
    	                                </span>
    	                                {!! Form::text('app_cv', null, array('class' => 'form-control', 'placeholder' => 'Прикачете CV', 'readonly' => 'readonly')) !!}
    	                            </div>
    	                        </div>
    	                        <div class="form-group">
    	                            <div class="input-group">
    	                                <span class="input-group-addon input-xl" id="basic-addon6"><label for="aComment"><img src="{!! asset('img/form/icon-5.png') !!}" alt=""></label></span>
    	                                {!! Form::textarea('app_text', null, array('id' => 'aComment', 'class' => 'form-control', 'rows' => '9', 'placeholder' => 'Защо избрахте да работите при нас?', 'aria-describedby' => 'basic-addon6', 'required' => 'required')) !!}
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