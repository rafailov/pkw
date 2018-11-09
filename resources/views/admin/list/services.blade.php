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
                    <h3 class="box-title">Услуги</h3>

                    <div class="box-tools">
                        <a href="{!! url('admin/service/create') !!}" class="btn btn-block btn-success btn-flat">Добавяне
                            на услуга</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <th>ID</th>
                        <th>Име</th>
                        <th>Продукти</th>
                        <th>Редактирай</th>
                        <th>Изтрий</th>
                        </thead>
                        <tbody>
                        @foreach($services as $key => $service)
                            <tr>
                                <td> {!! $service->service_id !!}</td>
                                <td> {!! $service->service_name !!}</td>
                                <td><a href="{!! url('admin/products/' . $service->service_id ) !!}" class="btn btn-primary">Продукти</a></td>
                                {{--<td><a href="admin/products/{!! $service->service_id !!}" class="btn btn-primary">Продукти</a></td>--}}
                                <td><a href="{!! url('admin/service/edit/' . $service -> service_id) !!}" class="btn btn-primary">Промяна</a></td>
                                <td>
                                    {!! Form::open(array('action' => 'ServiceController@destroy','method'=>'post','id'=>'serviceFormDel'.$key)) !!}
                                    {!! Form::button('Изтриване', ['name' => 'action[del]','class'=>'btn btn-danger','onclick'=>'submitDellServiceFunction('.$key.');']) !!}
                                    {!! Form::hidden( 'service_id',$service->service_id  ) !!}
                                    {!! Form::Close() !!}
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    @foreach($services as $key=> $service)
        <script>
            function submitDellServiceFunction(key) {

                var r = confirm("Наистина ли желаете да изтриете записа");
                if (r == true) {
                    $('#serviceFormDel' + key).submit();
                }
            }
        </script>
    @endforeach

@stop