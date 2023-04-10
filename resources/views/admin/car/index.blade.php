@extends('layouts.dashboard')

@section('title', 'Автомобили')

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Автомобили</h1>
                </div>
                <div class="col-12">
                    <a href="{{ route('car.create') }}" class="add-new-btn">Добавить авто</a>
                </div>
                <div class="col-12">
                    <table class="car-table table-sort">
                        <thead>
                            <tr>
                                <th class="car-table__th-id table-arrows">ID</th>
                                <th class="car-table__th-img"></th>
                                <th class="car-table__th-name table-arrows">Название</th>
                                <th class="car-table__th-price table-arrows">Цена</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cars as $car)
                            <tr>
                                <td class="car-table__td-id">{{$car->id}}</td>
                                <td class="car-table__td-img"><a href="{{route('car.edit', [$car->id])}}">@isset($images[$car->id]->uri)<img src="{{$images[$car->id]->uri}}" alt="{{$car->name}}" class="car-table__img">@endisset</a></td>
                                <td class="car-table__td-name"><a href="{{route('car.edit', [$car->id])}}">{{$car->name}}</a></td>
                                <td class="car-table__td-price">{{$car->price}} / {{$car->price2}} / {{$car->price3}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script src={{ asset('libs/table-sort/table-sort.js') }}></script>
@endsection
