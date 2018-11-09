@extends('admin.layouts.default')
@section('body')
    <div class="wrapper">

        <header class="main-header">
            <a href="{!! url('admin') !!}" class="logo">
                <span class="logo-mini"><b>PKW</b></span>
                <span class="logo-lg"><b>PKW</b>AUTO</span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
            </nav>
        </header>

        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li><a href="{!! url('admin') !!}"><i class="glyphicon glyphicon-play-circle"></i> <span>Начало</span></a></li>
                    <li><a href="{!! url('admin/about') !!}"><i class="glyphicon glyphicon-eye-open"></i> <span>За нас</span></a></li>
                    <li><a href="{!! url('admin/contacts') !!}"><i class="glyphicon glyphicon-phone"></i> <span>Контакти</span></a></li>
                    <li><a href="{!! url('admin/slider') !!}"><i class="glyphicon glyphicon-resize-horizontal"></i> <span>Слайдер</span></a></li>
                    <li><a href="{!! url('admin/service') !!}"><i class="glyphicon glyphicon-wrench"></i> <span>Услуги</span></a></li>
                    <li><a href="{!! url('admin/careers') !!}"><i class="glyphicon glyphicon-usd"></i> <span>Кариери</span></a></li>
                    <li><a href="{!! url('admin/applications') !!}"><i class="glyphicon glyphicon-send"></i> <span>Кандидатури</span></a></li>
                    <li><a href="{!! url('admin/mails') !!}"><i class="glyphicon glyphicon-envelope"></i> <span>Поща</span></a></li>
                    <li><a href="{!! url('admin/posts') !!}"><i class="glyphicon glyphicon-comment"></i> <span>Мнения от потребители</span></a></li>
                    <li><a href="{!! url('auth/logout') !!}"><i class="glyphicon glyphicon-off"></i> <span>Изход</span></a></li>
                </ul>
            </section>

        </aside>

        <div class="content-wrapper">
            <section class="content">
                @yield('content')
            </section>
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.3.0
            </div>
            <strong>Copyright &copy; 2015-2016 PKW Auto.</strong> All rights reserved.
        </footer>

    </div>

@stop