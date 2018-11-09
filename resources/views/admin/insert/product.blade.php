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
            <h3 class="box-title">Добавяне на продукт</h3>

            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(array('action' => 'ProductListController@store','method'=>'post','files' => true)) !!}
                    {!! Form::hidden('product_service_id',$service_id) !!}
                    <div class="form-group">
                        {!! Form::label('Име') !!}
                        {!! Form::text('product_name',null, array('class' => 'form-control')) !!}
                        @if($errors -> first('product_name') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('product_name') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Цена') !!}
                        {!! Form::text('product_price',null, array('class' => 'form-control')) !!}

                        @if($errors -> first('product_price') != '')
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {!! $errors -> first('product_price') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('Видимост') !!}
                        {!! Form::select('product_visible',@$visibleVal,null,array('class'=>'form-control')) !!}
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