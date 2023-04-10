<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//RU">

<h3>{{$order->car_name}} - Foxrent</h3>

<table border="0" style="margin:0; padding:0">
    <tr>
        <td>Авто:</td>
        <td>{{$order->car_name}}</td>
    </tr>
    <tr>
        <td>Начало:</td>
        <td>{{$startPlace.' - '.$order->start_at->format('d.m.Y H:i')}}</td>
    </tr>
    <tr>
        <td>Конец:</td>
        <td>{{$endPlace.' - '.$order->end_at->format('d.m.Y H:i')}}</td>
    </tr>
    <tr>
        <td>Цена за сутки:</td>
        <td>{{$order->price}}</td>
    </tr>
    <tr>
        <td>Кол-во суток:</td>
        <td>{{$order->days}}</td>
    </tr>
    <tr>
        <td>Доставка:</td>
        <td>{{$order->delivery_price}}</td>
    </tr>
    <tr>
        <td>Доставка возврат:</td>
        <td>{{$order->delivery_price_back}}</td>
    </tr>
    @if(count($order->services) > 0)
    <tr>
        <td>Доп.услуги:</td>
        <td>@foreach($order->services as $item) {{$item->name}}; @endforeach</td>
    </tr>
    <tr>
        <td>Цена за доп.услуги:</td>
        <td>{{$services}}</td>
    </tr>
    @endif
    <tr>
        <td>Имя:</td>
        <td>{{$order->name}}</td>
    </tr>
    <tr>
        <td>Телефон:</td>
        <td>{{$order->phone}}</td>
    </tr>
    <tr>
        <td>Комментарий:</td>
        <td>{{$order->comment}}</td>
    </tr>
    <tr>
        <td><b>Всего по заказу:</b></td>
        <td><b>{{$order->total_price}}</b></td>
    </tr>
</table>
<a href="{{route('order.show', [$order->id])}}">Смотреть на сайте</a>
