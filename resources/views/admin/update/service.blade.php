@extends('admin.master')
@section('content')
    @if(Session::has('successMessage'))
        <div class="alert alert-success">
            {!! Session::get('successMessage') !!}
        </div>
    @endif

    @if($errors -> any() )
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" style="width: 100%;">
                <button type="button" class="close" data-dismiss="alert">?</button>
                <p>{{ $error }}</p>
            </div>
        @endforeach
    @endif
    <div class="box box-default">
        <div class="box-header with-border">

            <h3 class="box-title">Редактиране на услуга</h3>

            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(array('action' => 'ServiceController@update','method'=>'post','files' => true)) !!}
                    {!! Form::hidden('service_id',$service->service_id) !!}
                    <div class="form-group">
                        {!! Form::label('Име') !!}
                        {!! Form::text('service_name',@$service->service_name, array('class' => 'form-control')) !!}
                        @if($errors -> first('service_name') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('service_name') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Текст') !!}
                        {!! Form::textarea('service_text',@$service->service_text, array('class' => 'form-control', 'id' => 'edit')) !!}

                        @if($errors -> first('service_text') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('service_text') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Изображение') !!}<br /> 
						<img src="{!! asset('uploads/images/services/image/'.@$service->service_image) !!}" width="500px" height="200px" /><br />
                        {!! Form::file('service_image', array('id' => 'exampleInputFile')) !!}
                        @if($errors -> first('service_image') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('service_image') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Малко изображение') !!}<br />
						<img src="{!! asset('uploads/images/services/icon/'.@$service->service_icon) !!}" width="500px" height="200px" /><br />
                        {!! Form::file('service_icon', array('id' => 'exampleInputFile')) !!}
                        @if($errors -> first('service_icon') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('service_icon') !!}
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