@extends('admin.master')
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Изпратени E-mails</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <th>ID</th>
                        <th>Име</th>
                        <th>E-mail</th>
                        <th>Телефон</th>
                        <th>Съобщение</th>
                        <th>Изтрий</th>
                        </thead>
                        <tbody>
                        @foreach( $mailsData as $key => $mails )
                            <tr>
                                <td>{!! $mails -> send_id !!}</td>
                                <td>{!! $mails -> send_name !!}</td>
                                <td>{!! $mails -> send_email !!}</td>
                                <td>{!! $mails -> send_telephone !!}</td>
                                <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal{!! $key !!}">Покажи текста</button></td>
                                <td>
                                    {!! Form::open(array('action' => 'ContactsController@destroyMeil', 'id' => 'emailFormDel' . $key)) !!}
                                    {!! Form::button('Изтриване', ['name' => 'action[del]', 'class'=>'btn btn-danger', 'onclick' => 'submitDellEmailFunction('.$key.');']) !!}
                                    {!! Form::hidden( 'send_id', $mails -> send_id ) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            <div class="modal fade" id="myModal{!! $key !!}" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">{!! $mails -> send_name !!}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>{!! $mails -> send_message !!}</p>
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
                                {!! $mailsData -> render() !!}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

    @foreach( $mailsData as $key => $mails )
        <script>
            function submitDellEmailFunction(key) {
                var r = confirm("Наистина ли желаете да изтриете записа");
                if (r == true) {
                    $('#emailFormDel' + key).submit();
                }
            }
        </script>
    @endforeach

@stop