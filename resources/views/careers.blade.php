@extends('master')
@section('content')

    <section>
        <div id="team">
            <div class="container">
                <header><h2 class="title">Станете част от екипа ни</h2></header>
                @if(count($careers)==0)
                    <h2>В момента нямаме отворени позиции</h2>
                @endif
                @foreach( $careers as $career )
                    <section id="{!! $career -> career_id !!}">
                        <article>
                            <div class="row openPosition">
                                <div class="padded">
                                    <header><h3 class="jobTitle">{!! $career -> career_position !!}</h3></header>
                                </div>
                                <div class="col-lg-6">
                                    <header><h3 class="description">Описание</h3></header>
                                    {!! $career -> career_description !!}
                                </div>
                                <div class="col-lg-6">
                                    <header><h3 class="requirements">Очакваме от вас</h3></header>
                                    {!! $career -> career_requirements !!}
                                </div>
                                <div class="col-xs-12 text-center">
                                    <a href="{!! url('careers/' . $career -> career_id) !!}"
                                       class="apply btn btn-yellow">Кандидатствай</a>
                                </div>
                            </div>
                        </article>
                    </section>
                @endforeach
            </div>
        </div>
    </section>

@stop