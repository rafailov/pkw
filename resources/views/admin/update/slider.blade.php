@extends('admin.master')
@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Редактиране на слайд</h3>

            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(array('action' => 'SliderController@update','method'=>'post','files' => true)) !!}
                    {!! Form::hidden('slide_id',$slider->slide_id) !!}
                    <div class="form-group">
                        {!! Form::label('Име') !!}
                        {!! Form::textarea('slide_title',@$slider->slide_title, array('class' => 'form-control', 'id' => 'editor')) !!}
                        @if($errors -> first('slide_title') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('slide_title') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Текст') !!}
                        {!! Form::textarea('slide_text',@$slider->slide_text, array('class' => 'form-control', 'id' => 'editor1')) !!}

                        @if($errors -> first('slide_text') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('slide_text') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Изображение') !!}<br />
						<img src="{!! asset('uploads/images/SliderImages/'.@$slider->slide_image) !!}" width="500px" height="200px" /><br />
                        {!! Form::file('slide_image', array('id' => 'exampleInputFile')) !!}
                        @if($errors -> first('slide_image') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('slide_image') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Линк') !!}
                        {!! Form::text('slide_link',@$slider->slide_link, array('class' => 'form-control')) !!}
                        @if($errors -> first('slide_link') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('slide_link') !!}
                            </div>
                        @endif
                    </div>
                    <div class="text-center">
                        {!! Form::submit('Запамети', array('class' => 'btn btn-block btn-primary btn-sm')) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>


@stop