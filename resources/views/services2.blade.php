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
                            <td colspan="2" class="blue">{!! $product -> product_name !!}</td>
                        @else
                            <td>{!! $product -> product_name !!}</td>
                            <td>{!! $product -> product_price !!}</td>
                        @endif
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>

        //STOP FOREACH FOR THIS SERVICE
        @break;

    @endif
@endforeach