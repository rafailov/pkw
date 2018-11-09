@extends('admin.master')
@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Създаване на нов контакт</h3>

            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(array('action' => 'ContactsController@storeContact','method'=>'post','files' => true)) !!}
                    <div class="form-group">
                        {!! Form::label('Град') !!}
                        {!! Form::text('contact_city',null, array('class' => 'form-control')) !!}
                        @if($errors -> first('contact_city') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('contact_city') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Адрес') !!}
                        {!! Form::text('contact_address',null, array('class' => 'form-control')) !!}

                        @if($errors -> first('contact_address') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('contact_address') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Телефон') !!}
                        {!! Form::text('contact_telephone',null, array('class' => 'form-control')) !!}

                        @if($errors -> first('contact_telephone') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('contact_telephone') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Работно време') !!}
                        {!! Form::text('contact_worktime',null, array('class' => 'form-control')) !!}

                        @if($errors -> first('contact_worktime') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('contact_worktime') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Координати за Google карта') !!}
                        {!! Form::text('contact_coordinates',null, array('class' => 'form-control')) !!}

                        @if($errors -> first('contact_coordinates') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('contact_coordinates') !!}
                            </div>
                        @endif
                    </div>
                    <div class="text-center">
                        {!! Form::submit('Създаване на контакт', array('class' => 'btn btn-block btn-primary btn-sm')) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@stop