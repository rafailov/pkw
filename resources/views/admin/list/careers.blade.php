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
                    <h3 class="box-title">Кариери</h3>

                    <div class="box-tools">
                        <a href="{!! url('admin/career/create') !!}"
                           class="btn btn-block btn-success btn-flat">Добавяне
                            на кариера</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <th>ID</th>
                        <th>Позиция</th>
                        <th>Дата на създаване</th>
                        <th>Дата на редакция</th>
                        <th>Редактирай</th>
                        <th>Изтрий</th>
                        </thead>
                        <tbody>
                        @foreach($careers as  $key=>$career)
                            <tr>
                                <td> {!! $career->career_id !!}</td>
                                <td> {!! $career->career_position !!}</td>
                                <td> {!! $career->created_at !!}</td>
                                <td> {!! $career->updated_at !!}</td>

                                <td><a
                                            href="{!! url('admin/career/edit/' . $career -> career_id) !!}"
                                            class="btn btn-primary">Промяна</a></td>

                                <td>
                                    {!! Form::open(array('action' => 'CareerController@destroy','method'=>'post','id'=>'careerFormDel'.$key)) !!}
                                    {!! Form::button('Изтриване', ['name' => 'action[del]','class'=>'btn btn-danger','onclick'=>'submitDellCareerFunction('.$key.');']) !!}
                                    {!! Form::hidden( 'career_id',$career->career_id ) !!}
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

    @foreach($careers as  $key=>$career)
        <script>
            function submitDellCareerFunction(key) {

                var r = confirm("Наистина ли желаете да изтриете записа");
                if (r == true) {
                    $('#careerFormDel' + key).submit();
                }
            }
        </script>
    @endforeach

@stop