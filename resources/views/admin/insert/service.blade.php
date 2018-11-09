@extends('admin.master')
@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Добавяне на услуга</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(array('action' => 'ServiceController@store','method'=>'post','files' => true)) !!}
                        <div class="form-group">
                            {!! Form::label('Име') !!}
                            {!! Form::text('service_name',null, array('class' => 'form-control')) !!}
                            @if($errors -> first('service_name') != '')
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {!! $errors -> first('service_name') !!}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('Текст') !!}
                            {!! Form::textarea('service_text',null, array('class' => 'form-control', 'id' => 'edit')) !!}

                            @if($errors -> first('service_text') != '')
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {!! $errors -> first('service_text') !!}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                        {!! Form::label('Изображение') !!}
                        {!! Form::file('service_image', array('id' => 'exampleInputFile')) !!}
                        @if($errors -> first('service_image') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('service_image') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Малко изображение') !!}
                        {!! Form::file('service_icon', array('id' => 'exampleInputFile')) !!}
                        @if($errors -> first('service_icon') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('service_icon') !!}
                            </div>
                        @endif
                    </div>

                        <div class="text-center">
                            {!! Form::submit('Създаване', array('class' => 'btn btn-block btn-primary btn-sm')) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@stop