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
            <h3 class="box-title">Създаване на нова кариера</h3>

            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(array('action' => 'CareerController@store','method'=>'post','files' => true)) !!}

                    <div class="form-group">
                        {!! Form::label('Позиция') !!}
                        {!! Form::text('career_position',null, array('class' => 'form-control')) !!}
                        @if($errors -> first('career_position') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('career_position') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Описание') !!}
                        {!! Form::textarea('career_description',null, array('class' => 'form-control', 'id' => 'editor')) !!}

                        @if($errors -> first('career_description') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('career_description') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Изисквания') !!}
                        {!! Form::textarea('career_requirements',null, array('class' => 'form-control', 'id' => 'editor1')) !!}

                        @if($errors -> first('career_requirements') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('career_requirements') !!}
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