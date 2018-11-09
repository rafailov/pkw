@extends('admin.master')
@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Редактиране на контакт</h3>

            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(array('action' => 'ContactsController@updateContacts','method'=>'post','files' => true)) !!}
                    {!! Form::hidden('contact_id',$contact->contact_id) !!}
                    <div class="form-group">
                        {!! Form::label('Град') !!}
                        {!! Form::text('contact_city',@$contact->contact_city, array('class' => 'form-control')) !!}
                        @if($errors -> first('contact_city') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('contact_city') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Адрес') !!}
                        {!! Form::text('contact_address',@$contact->contact_address, array('id' => 'address', 'class' => 'form-control')) !!}

                        @if($errors -> first('contact_address') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('contact_address') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Телефон') !!}
                        {!! Form::text('contact_telephone',@$contact->contact_telephone, array('class' => 'form-control')) !!}

                        @if($errors -> first('contact_telephone') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('contact_telephone') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Работно време') !!}
                        {!! Form::text('contact_worktime',@$contact->contact_worktime, array('class' => 'form-control')) !!}

                        @if($errors -> first('contact_worktime') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('contact_worktime') !!}
                            </div>
                        @endif
                    </div>


                    <div class="form-group">
                        {!! Form::label('Координати за Google карта') !!}
                        {!! Form::text('contact_coordinates',@$contact->contact_coordinates, array('id' => 'info', 'class' => 'form-control')) !!}
                        @if($errors -> first('contact_coordinates') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('contact_coordinates') !!}
                            </div>
                        @endif
                        <p class="help-block">Хванете маркера на мапа и почнете да го влачите.</p>
                        <div id="mapCanvas"></div>
                        <div id="contactsEditMap"></div>
                    </div>


                    <div class="text-center">
                        {!! Form::submit('Редактирай', array('class' => 'btn btn-block btn-primary btn-sm')) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop