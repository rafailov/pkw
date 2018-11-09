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

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Слайдове</h3>

                    <div class="box-tools">
                        <a href="{!! url('admin/slider/create') !!}" class="btn btn-block btn-success btn-flat">Добавяне
                            на слайдер</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <th>ID</th>
                        <th>Име</th>
                        <th>Линк</th>
                        <th>Редактирай</th>
                        <th>Изтрий</th>
                        </thead>
                        <tbody>
                        @foreach($sliders as $key => $lider)
                            <tr>
                                <td> {!! $lider->slide_id !!}</td>
                                <td> {!! $lider->slide_title !!}</td>
                                <td><a href="{!! $lider->slide_link !!}">{!! $lider->slide_link !!}</a></td>
                                <td align="center"><a href="{!! url('admin/slider/edit/' . $lider -> slide_id) !!}"
                                                      class="btn btn-primary">Промяна</a></td>
                                <td align="center">
                                    {!! Form::open(array('action' => 'SliderController@destroy','method'=>'post','id'=>'sliderFormDel'.$key)) !!}
                                    {!! Form::button('Изтриване', ['name' => 'action[del]','class'=>'btn btn-danger','onclick'=>'submitDellSliderFunction('.$key.');']) !!}
                                    {!! Form::hidden( 'slide_id',$lider->slide_id  ) !!}
                                    {!! Form::Close() !!}
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <br>

                <div class="text-center">
                    @if($switchVal=='true')
                        <a href="{!! url('admin/slider/switch/false') !!}" class="activation btn btn-success">Слайдера е
                            включен</a>
                    @else
                        <a href="{!! url('admin/slider/switch/true') !!}" class="activation btn btn-danger">Слайдера е
                            изключен</a>
                    @endif
                </div>


            </div>
        </div>
    </div>

    @foreach($sliders as $key=> $lider)
        <script>
            function submitDellSliderFunction(key) {

                var r = confirm("Наистина ли желаете да изтриете записа");
                if (r == true) {
                    $('#sliderFormDel' + key).submit();
                }
            }
        </script>
    @endforeach
    {{--<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>--}}
    <script>

        $('.activation.btn-danger').hover(function () {
            $(this).attr('class', 'activation btn btn-success');
            $(this).text('Включване на слайдера');
        }, function () {
            $(this).attr('class', 'activation btn btn-danger');
            $(this).text('Слайдера е изключен');
        });

        $('.activation.btn-success').hover(function () {
            $(this).attr('class', 'activation btn btn-danger');
            $(this).text('Изключване на слайдера');
        }, function () {
            $(this).attr('class', 'activation btn btn-success');
            $(this).text('Слайдера е включен');
        });
    </script>

@stop