@extends('admin.master')
@section('content')

    <div class="row">

        <div class="col-lg-6 col-xs-6">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{!! count($sliders) !!}</h3>

                    <p>Слайдове</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{!! url('admin/slider') !!}" class="small-box-footer">Отиди на слайдове <i
                            class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-6 col-xs-6">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{!! count($services) !!}</h3>

                    <p>Услуги</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{!! url('admin/service') !!}" class="small-box-footer">Отиди на услуги <i
                            class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-6 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{!! count($careers) !!}</h3>

                    <p>Кариери</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{!! url('admin/careers') !!}" class="small-box-footer">Отиди на кариери <i
                            class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-6 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{!! count($applications) !!}</h3>

                    <p>Кандидатури</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{!! url('admin/applications') !!}" class="small-box-footer">Отиди на кандидатури <i
                            class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-6 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{!! count($mails) !!}</h3>

                    <p>Получени E-mails</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{!! url('admin/mails') !!}" class="small-box-footer">Покажи пощата <i
                            class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-6 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{!! count($posts) !!}</h3>

                    <p>Мнения от потребители</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{!! url('admin/posts') !!}" class="small-box-footer">Покажи мненията <i
                            class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>

@stop