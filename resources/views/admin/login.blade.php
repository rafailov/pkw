@extends('admin.layouts.default')
@section('body')
    <div class="container" style="margin-top: 5%">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Вход като администратор</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(array('role' => 'form', 'action' => 'AdminController@postLogin','method'=>'post')) !!}


                        {!! csrf_field() !!}
                        <div class="form-group">
                            {{--{!! Form::hidden('name','admin') !!}--}}
                            {!! Form::text( 'name',null,['placeholder' => 'Име','class'=>'form-control' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::password('password', array('placeholder' => 'Парола', 'class' => 'form-control')) !!}
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">Запомни ме
                            </label>
                        </div>
                        {!! Form::submit('Влез', ['name' => 'action[login]','class'=>'btn btn-lg btn-success btn-block']) !!}

                        {!! Form::Close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


