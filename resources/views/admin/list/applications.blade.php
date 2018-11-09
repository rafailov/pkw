@extends('admin.master')
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Кандидатури</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Кариера</th>
                            <th>Име</th>
                            <th>E-mail</th>
                            <th>Телефон</th>
                            <th>Виж повече</th>
                            <th>Изтрий</th>
                        </thead>
                        <tbody>
                            @foreach( $applicationsData as $key => $applications )
                                <tr>
                                    <td>{!! $applications -> app_id !!}</td>
                                    <td>
                                        @foreach( $careerData as $career )
                                            @if( $applications -> app_career == $career -> career_id )
                                                {!! $career -> career_position !!}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{!! $applications -> app_name !!}</td>
                                    <td>{!! $applications -> app_email !!}</td>
                                    <td>{!! $applications -> app_telephone !!}</td>
                                    <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal{!! $key !!}">Виж повече</button></td>
                                    <td>
                                        {!! Form::open(array('action' => 'ApplicationsController@destroy', 'id' => 'applicationFormDel' . $key)) !!}
                                        {!! Form::button('Изтриване', ['name' => 'action[del]','class'=>'btn btn-danger', 'onclick' => 'submitDellApplicationsFunction('.$key.');']) !!}
                                        {!! Form::hidden( 'app_id', $applications -> app_id  ) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal{!! $key !!}" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">{!! $applications -> app_name !!}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p><b>Описание:</b> {!! $applications -> app_text !!}</p>
                                            </div>
                                            <div class="modal-body">
                                                <p><b>Образование:</b> {!! $applications -> app_education !!}</p>
                                            </div>
                                            <div class="modal-body">
                                                <p><b>Прикачен файл:</b> <a href="{!! asset('uploads/files/cv/' . $applications -> app_cv) !!}">Изтегли прикаченото CV</a></p>
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
                                    {!! $applicationsData -> render() !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

    @foreach( $applicationsData as $key => $applications )
        <script>
            function submitDellApplicationsFunction(key) {
                var r = confirm("Наистина ли желаете да изтриете записа");
                if (r == true) {
                    $('#applicationFormDel' + key).submit();
                }
            }
        </script>
    @endforeach

@stop