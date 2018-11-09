@extends('admin.master')
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Постове от потребители</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Снимка</th>
                            <th>Име</th>
                            <th>Позиция</th>
                            <th>Текст</th>
                            <th>Редактирай</th>
                            <th>Изтрий</th>
                        </thead>
                        <tbody>
                            @foreach( $postsData as $key => $posts )
                                <tr>
                                    <td>{!! $posts -> post_id !!}</td>
                                    @if($posts -> post_image=='default')
                                        <td><img src="{!! asset('avatar.jpg') !!}" width="50px" /></td>
                                        @else
                                        <td><img src="{!! asset('uploads/images/posts/' . $posts -> post_image) !!}" width="50px" /></td>
                                        @endif

                                    <td>{!! $posts -> post_name !!}</td>
                                    <td>{!! $posts -> post_position !!}</td>
                                    <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal{!! $key !!}">Покажи текста</button></td>
                                    @if( $posts -> post_approve == 0 )
                                        <td>
                                            {!! Form::open(array('action' => 'PostsController@approve', 'id' => 'postsFormApprove' . $key)) !!}
                                            {!! Form::button('Покажи в сайта', array('class' => 'btn btn-primary', 'onclick' => 'submitApprovePostsFunction('.$key.');')) !!}
                                            {!! Form::hidden( 'post_id', $posts -> post_id  ) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    @elseif( $posts -> post_approve == 1 )
                                        <td>
                                            {!! Form::open(array('action' => 'PostsController@reject', 'id' => 'postsFormReject' . $key)) !!}
                                            {!! Form::button('Скрий от сайта', array('class' => 'btn btn-primary', 'onclick' => 'submitRejectPostsFunction('.$key.');')) !!}
                                            {!! Form::hidden( 'post_id', $posts -> post_id  ) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    @endif
                                    <td>
                                        {!! Form::open(array('action' => 'PostsController@destroy', 'id' => 'postsFormDel' . $key)) !!}
                                        {!! Form::button('Изтриване', ['name' => 'action[del]','class'=>'btn btn-danger', 'onclick' => 'submitDellPostsFunction('.$key.');']) !!}
                                        {!! Form::hidden( 'post_id',$posts -> post_id  ) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal{!! $key !!}" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">{!! $posts -> post_name !!}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>{!! $posts -> post_text !!}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    {!! $postsData -> render() !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

    @foreach( $postsData as $key => $posts )
        <script>
            function submitDellPostsFunction(key) {
                var r = confirm("Наистина ли желаете да изтриете записа");
                if (r == true) {
                    $('#postsFormDel' + key).submit();
                }
            }
        </script>
    @endforeach

    @foreach( $postsData as $key => $posts )
        <script>
            function submitApprovePostsFunction(key) {
                var r = confirm("Желаете ли е да покажете записа в сайта?");
                if (r == true) {
                    $('#postsFormApprove' + key).submit();
                }
            }
        </script>
    @endforeach

    @foreach( $postsData as $key => $posts )
        <script>
            function submitRejectPostsFunction(key) {
                var r = confirm("Желаете ли е да скриете записа в сайта?");
                if (r == true) {
                    $('#postsFormReject' + key).submit();
                }
            }
        </script>
    @endforeach
@stop