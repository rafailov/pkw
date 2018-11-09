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
                    <h3 class="box-title">Контакти</h3>

                    {{--<div class="box-tools">--}}
                        {{--<a href="{!! url('admin/contact/create') !!}"--}}
                           {{--class="btn btn-block btn-success btn-flat">Добавяне--}}
                            {{--на контакт</a>--}}
                    {{--</div>--}}
                </div>
                <!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Град</th>
                            <th>Адрес</th>
                            <th>Телефон</th>
                            <th>Редактирай</th>
                            {{--<th>Изтрий</th>--}}
                        </thead>
                        <tbody>
                        @foreach($contactsData as  $key=>$contact)
                            <tr>
                                <td> {!! $contact->contact_id !!}</td>
                                <td> {!! $contact->contact_city !!}</td>
                                <td> {!! $contact->contact_address !!}</td>
                                <td> {!! $contact->contact_telephone !!}</td>
                                <td><a href="{!! url('admin/contact/edit/' . $contact -> contact_id) !!}" class="btn btn-primary">Промяна</a></td>

                                {{--<td>--}}
                                    {{--{!! Form::open(array('action' => 'ContactsController@destroyContact','method'=>'post','id'=>'contactFormDel'.$key)) !!}--}}
                                    {{--{!! Form::button('Изтриване', ['name' => 'action[del]','class'=>'btn btn-danger','onclick'=>'submitDellContactFunction('.$key.');']) !!}--}}
                                    {{--{!! Form::hidden( 'contact_id',$contact->contact_id ) !!}--}}
                                    {{--{!! Form::Close() !!}--}}
                                {{--</td>--}}
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

    @foreach($contactsData as  $key=>$contact)
        <script>
            function submitDellContactFunction(key) {

                var r = confirm("Наистина ли желаете да изтриете записа");
                if (r == true) {
                    $('#contactFormDel' + key).submit();
                }
            }
        </script>
    @endforeach

@stop