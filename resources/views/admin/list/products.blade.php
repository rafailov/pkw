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
                    <h3 class="box-title">Продукти в категория {!! $services->service_name !!}</h3>

                    <div class="box-tools">
                        <a href="{!! url('/admin/product/create/'.$services->service_id) !!}"
                           class="btn btn-block btn-success btn-flat">Добавяне
                            на продукт в категорията</a>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <th>ID</th>
                        <th>Име</th>
                        <th>Цена</th>
                        <th>Видимост</th>
                        <th>Редактирай</th>
                        <th>Изтрий</th>
                        </thead>
                        <tbody>
                        @foreach($services->getProducts as  $key=>$products)
                            <tr>
                                <td> {!! $products->product_id !!}</td>
                                <td> {!! $products->product_name !!}</td>
                                <td> {!! $products->product_price !!}</td>
                                @if($products->product_visible==true)
                                    <td> Видим</td>
                                @else
                                    <td> Скрит</td>
                                @endif

                                <td><a
                                            href="{!! url('admin/product/edit/' . $products -> product_id.'/'.$services->service_id) !!}"
                                            class="btn btn-primary">Промяна</a></td>

                                <td>
                                    {!! Form::open(array('action' => 'ProductListController@destroy','method'=>'post','id'=>'productFormDel'.$key)) !!}
                                    {!! Form::button('Изтриване', ['name' => 'action[del]','class'=>'btn btn-danger','onclick'=>'submitDellProductFunction('.$key.');']) !!}
                                    {!! Form::hidden( 'product_id',$products->product_id  ) !!}
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

    @foreach($services->getProducts as  $key=>$products)
        <script>
            function submitDellProductFunction(key) {

                var r = confirm("Наистина ли желаете да изтриете записа");
                if (r == true) {
                    $('#productFormDel' + key).submit();
                }
            }
        </script>
    @endforeach

@stop