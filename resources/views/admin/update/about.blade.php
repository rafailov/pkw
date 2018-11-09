@extends('admin.master')
@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Редакция на страницата За Нас</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(array('action' => 'AboutController@update', 'files' => true)) !!}
                    {!! Form::hidden('about_id', $aboutData -> about_id) !!}
                    <div class="form-group">
                        {!! Form::label('Заглавие на страницата:') !!}
                        {!! Form::text('about_title', $aboutData -> about_title, array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Слоган на страницата:') !!}
                        {!! Form::text('about_slogan', $aboutData -> about_slogan, array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Телефон за контакти:') !!}
                        {!! Form::text('about_telephone', $aboutData -> about_telephone, array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Снимка от ляво:') !!} <br />
                        <img src="{!! asset('uploads/images/about/' . $aboutData -> about_imageOne) !!}" width="500px" height="200px" /><br />
                        {!! Form::file('about_imageOne', null, array('id' => 'exampleInputFile')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Снимка от дясно:') !!}<br />
                        <img src="{!! asset('uploads/images/about/' . $aboutData -> about_imageTwo) !!}" width="500px" height="200px" /><br />
                        {!! Form::file('about_imageTwo', null, array('id' => 'exampleInputFile')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Текст 1:') !!}
                        {!! Form::textarea('about_textOne', $aboutData -> about_textOne, array('class' => 'form-control', 'id' => 'editor')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Текст 2:') !!}
                        {!! Form::textarea('about_textTwo', $aboutData -> about_textTwo, array('class' => 'form-control', 'id' => 'editor1')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Промени данните', array('class' => 'btn btn-block btn-primary btn-sm')) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop