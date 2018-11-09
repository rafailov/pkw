@extends('master')
@section('content')

    <section>
        <div id="servicesAlone">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3"> <!-- required for floating -->
                        <!-- Nav tabs -->
                        <nav>
                            <ul class="nav nav-tabs tabs-left">
                                @foreach( $servicesData as $key => $service )
                                    <li class="@if( $key == 0 ) active @endif"><a href="#service{!! $key + 1 !!}"
                                                                                  data-toggle="tab">{!! $service -> service_name !!}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>

                    <div class="col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            @foreach( $servicesData as $key => $service )
                                <div class="tab-pane @if( $key == 0 ) active @endif" id="service{!! $key + 1 !!}">
                                    <article>
                                        <header><h1 class="tab-title"><span>{!! $service -> service_name !!}</span></h1>
                                        </header>
                                        <figure><img
                                                    src="{!! asset('uploads/images/services/image/' . $service -> service_image) !!}"
                                                    alt="" class="img-responsive main-image"></figure>
                                        {!! $service -> service_text !!}
                                        @foreach( $productsData as $product )
                                            @if( $product -> product_service_id == $service -> service_id )
                                                <table class="table table-hover table-small">
                                                    <tbody>
                                                    <tr>
                                                        <th class="blue">Продукт</th>
                                                        <th class="yellow">Цена</th>
                                                    </tr>
                                                    @foreach( $productsData as $product )
                                                        @if( $product -> product_service_id == $service -> service_id )
                                                            <tr>
                                                                @if($product -> product_price=="cat")
                                                                    <td colspan="2"
                                                                        class="blue">{!! $product -> product_name !!}</td>
                                                                @else
                                                                    <td>{!! $product -> product_name !!}</td>
                                                                    <td>{!! $product -> product_price !!}</td>
                                                                @endif
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>


                                                <?php break; ?>

                                            @endif
                                        @endforeach
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        @media screen and (min-width: 1200px) {
            @foreach( $servicesData as $key => $service )
        #service{!! $key + 1 !!} .tab-title span:before {
                content: url('{!! asset('uploads/images/services/icon/' . $service -> service_icon) !!}');
            }

        @endforeach











        }
    </style>

@stop