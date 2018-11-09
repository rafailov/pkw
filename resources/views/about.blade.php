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

    <!-- ACTIVITIES BAR -->
    <section>
    	<div id="activities">
    	    <div class="container">
    	        <header><h2 class="title">Запознайте се с нашата дейност</h2></header>
    	        <div class="row">
    	            <article>
    	            	<div class="col-lg-5">{!! $aboutData -> about_textOne !!}</div>
    	            	<div class="col-lg-7">
    	            	    <figure><img src="{!! asset('uploads/images/about/' . $aboutData -> about_imageOne) !!}" class="img-responsive" alt=""></figure>
    	            	</div>
    	            </article>
    	            <div class="clearfix spacer"></div>
    	            <article>
    	            	<div class="col-lg-5 col-lg-push-7">{!! $aboutData -> about_textTwo !!}</div>
    	            	<div class="col-lg-7 col-lg-pull-5">
    	            	    <figure><img src="{!! asset('uploads/images/about/' . $aboutData -> about_imageTwo) !!}" class="img-responsive" alt=""></figure>
    	            	</div>
    	            </article>
    	        </div>
    	    </div>
    	</div>
    </section>

    <!-- TESTIMONIALS SLIDER -->
    <section>
    	<div id="testimonials">
    	    <div class="container">
    	        <header><h2 class="title">Какво мислят клиентите ни за нас</h2></header>
    	        <div id="owl-testimonials" class="owl-carousel owl-theme">
    	            @foreach( $postsData as $posts )
    	                <article>
    	                	<div>
    	                	    <div class="row">
    	                	        <div class="col-lg-2 img-column">
    	                	            <figure><img src="{!! asset('uploads/images/posts/' . $posts -> post_image) !!}" class="img-circle img-responsive" alt=""></figure>
    	                	        </div>
    	                	        <div class="col-lg-10">
    	                	            <p class="comment">{!! $posts -> post_text !!}</p>
    	                	            <h3 class="name">{!! $posts -> post_name !!}</h3>
    	                	            <p>{!! $posts -> post_position !!}</p>
    	                	        </div>
    	                	    </div>
    	                	</div>
    	                </article>
    	            @endforeach
    	            <div><img src="" alt=""></div>
    	            <div><img src="" alt=""></div>
    	        </div> <!-- /#owl-testimonials -->
    	    </div>
    	</div>
    </section>

    <!-- FEEDBACK -->
    <section>
    	<div id="feedback">
    	    <div class="container">
    	        <div class="row">
    	            <div class="col-xs-12">
    	                <a href="#feedbackForm" class="toggler btn btn-yellow" data-toggle="collapse" data-target="#feedbackForm">Остави мнение</a>
    	            </div>
    	        </div>
    	        <div class="row">
    	            <div id="feedbackForm" class="collapse">
    	                {!! Form::open(array('action' => 'PostsController@store', 'role' => 'form', 'files' => true, 'class' => 'dropzone', 'id' => 'theFormItself')) !!}
    	                    <div class="col-lg-6">
    	                        <div class="form-group">
    	                            <div class="input-group input-group-lg">
    	                                <span class="input-group-addon" id="basic-addon1"><label for="fName"><img src="{!! asset('img/form/icon-1.png') !!}" alt=""></label></span>
    	                                {!! Form::text('post_name', null, array('id' => 'fName', 'class' => 'form-control', 'placeholder' => 'Вашето име...', 'aria-describedby' => 'basic-addon1')) !!}
    	                            </div>
    	                        </div>
    	                        <div class="form-group">
    	                            <div class="input-group input-group-lg">
    	                                <span class="input-group-addon" id="basic-addon2"><label for="fEmail"><img src="{!! asset('img/form/icon-2.png') !!}" alt=""></label></span>
    	                                {!! Form::text('post_email', null, array('id' => 'fEmail', 'class' => 'form-control', 'placeholder' => 'Вашият e-mail...', 'aria-describedby' => 'basic-addon2')) !!}
    	                            </div>
    	                        </div>
    	                        <div class="form-group">
    	                            <div class="input-group input-group-lg">
    	                                <span class="input-group-addon" id="basic-addon3"><label for="fJob"><img src="{!! asset('img/form/icon-3.png') !!}" alt=""></label></span>
    	                                {!! Form::text('post_position', null, array('id' => 'fJob', 'class' => 'form-control', 'placeholder' => 'Вашата професия...', 'aria-describedby' => 'basic-addon3')) !!}
    	                            </div>
    	                        </div>
    	                    </div>
    	                    <div class="col-lg-6">
    	                        <div class="form-group">
    	                            <div class="input-group input-group-lg outlined">
    	                                <span class="input-group-btn">
    	                                  <span class="btn btn-default btn-file">
    	                                      <img src="{!! asset('img/form/icon-4.png') !!}" alt="">
    	                                      {!! Form::file('post_image_one') !!}
    	                                  </span>
    	                                </span>
                                        {!! Form::text('post_image', null, array('class' => 'form-control', 'placeholder' => 'Качете снимка')) !!}
    	                                <!-- {!! Form::file('post_image', null, array('class' => 'form-control asd', 'placeholder' => 'Качете снимка')) !!} -->
    	                            </div>
    	                        </div>
    	                        <div class="form-group">
    	                            <div class="input-group">
    	                                <span class="input-group-addon input-lg" id="basic-addon5"><label for="fComment"><img src="{!! asset('img/form/icon-5.png') !!}" alt=""></label></span>
    	                                {!! Form::textarea('post_text', null, array('id' => 'fComment', 'class' => 'form-control', 'rows' => '4', 'required' => 'required', 'placeholder' => 'Вашето мнение...', 'aria-describedby' => 'basic-addon5')) !!}
    	                            </div>
    	                        </div>
    	                        <div class="form-group text-right">
    	                            {!! Form::submit('Изпрати', array('class'=>'btn btn-yellow')) !!}
    	                        </div>
    	                    </div>
    	                {!! Form::close() !!}
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </section>

@stop