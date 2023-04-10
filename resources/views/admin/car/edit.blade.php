@extends('layouts.dashboard')

@section('title', 'Редактировать авто '.$car->name)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if($errors->any())
                    <ul class="errors-container alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{route('car.update', [$car->id])}}" method="post" class="form-admin">
                    @csrf
                    @method('PATCH')
                    <p>Заголовок</p>
                    <input type="text" name="name" placeholder="Название авто" value="{{$car->name}}">
                    <div class="quad-input">
                        <div class="input-item">
                            <p>Цена 2-3</p>
                            <input type="number" name="price3" placeholder="Цена за сутки" value="{{$car->price3}}">
                        </div>
                        <div class="input-item">
                            <p>Цена 4-9</p>
                            <input type="number" name="price2" placeholder="Цена за сутки" value="{{$car->price2}}">
                        </div>
                        <div class="input-item">
                            <p>Цена 10+</p>
                            <input type="number" name="price" placeholder="Цена за сутки" value="{{$car->price}}">
                        </div>
                        <div class="input-item">
                            <p>Залог</p>
                            <input type="number" name="zalog" placeholder="Залог" value="{{$car->zalog}}">
                        </div>
                    </div>
                    <div class="quad-input">
                        @foreach($metas as $key => $meta)
                            <div class="input-item">
                                <p>{{$meta[0]->title}}</p>
                                <select name="meta[]" id="{{$key}}">
                                    @foreach($meta as $item)
                                        <option value="{{$item->id}}" @isset($carMeta[$key]->id) @if($carMeta[$key]->id === $item->id) selected @endif @endisset>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                    <p>Количество мест</p>
                    <input type="number" name="seats" placeholder="Количество мест" step="1" value="{{$car->seats}}">
                    <p>Год выпуска</p>
                    <input type="number" name="year" placeholder="Год выпуска" step="1" value="{{$car->year}}">
                    <div class="quad-input">
                        <div class="input-item">
                            <p>Расположение автомобиля</p>
                            <select name="home_place" id="home_place">
                                <option value="">По умолчанию</option>
                                @foreach($places as $place)
                                    <option value="{{$place['id']}}" @if($place['id'] === $car->home_place) selected @endif>{{$place['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <p>Статус</p>
                    <select name="is_published" id="class_id">
                        <option value="1" @if($car->is_published === 1) selected @endif>Опубликовано</option>
                        <option value="0" @if($car->is_published === 0) selected @endif>Не опубликовано</option>
                    </select>
                    <p>Анонс/сообщение</p>
                    <input type="text" name="msg" placeholder="Анонс/сообщение" value="{{$car->msg}}">
                    <p>Скидки (32 символа)</p>
                    <input type="text" name="discount" placeholder="Текст скидки" value="{{$car->discount}}">
                    <p>SEO-заголовок</p>
                    <input type="text" name="seo_title" placeholder="SEO-заголовок" value="{{$car->seo_title}}">
                    <p>META-описание</p>
                    <input type="text" name="seo_description" placeholder="Мета-описание" value="{{$car->seo_description}}">
                    <p>Текст</p>
                    <textarea class="seo_text" name="seo_text" id="text" placeholder="SEO текст">{{$car->seo_text}}</textarea>
                    <button>Сохранить изменения</button>
                </form>
                <div class="admin-car-price__container">
                    <div class="admin-car-price">
                        <div class="admin-car-price__head">
                            <div class="admin-car-price__item">Период</div>
                            <div class="admin-car-price__item">2-3 дня</div>
                            <div class="admin-car-price__item">4-9 дней</div>
                            <div class="admin-car-price__item">10+ дней</div>
                            <div class="admin-car-price__item">Редактировать</div>
                            <div class="admin-car-price__item">Удаление</div>
                        </div>
                        <div class="admin-car-price__head">
                            <div class="admin-car-price__item">25.12-10.01<br>(По умолчанию)</div>
                            <div class="admin-car-price__item">{{$car->price3}}</div>
                            <div class="admin-car-price__item">{{$car->price2}}</div>
                            <div class="admin-car-price__item">{{$car->price}}</div>
                            <div class="admin-car-price__item">-</div>
                            <div class="admin-car-price__item">-</div>
                        </div>
                        @foreach($carPrices as $carPrice)
                            <div class="admin-car-price__content">
                                <form action="{{route('car.price.update', [$carPrice->id])}}" method="post" class="admin-car-price__form">
                                    @csrf
                                    @method('PATCH')
                                    <div class="admin-car-price__item">{{\Illuminate\Support\Carbon::parse($carPrice->start)->format('d.m')}}-{{\Illuminate\Support\Carbon::parse($carPrice->end)->format('d.m')}}</div>
                                    <div class="admin-car-price__item"><input type="number" name="price3" class="price3-input" value="{{$carPrice->price3}}"></div>
                                    <div class="admin-car-price__item"><input type="number" name="price2" class="price2-input" value="{{$carPrice->price2}}"></div>
                                    <div class="admin-car-price__item"><input type="number" name="price" class="price-input" value="{{$carPrice->price}}"></div>
                                    <div class="admin-car-price__item"><button class="admin-car-price__form-btn">Редактировать</button></div>
                                </form>
                                <form action="{{route('car.price.delete', [$carPrice->id])}}" method="post" class="admin-car-price__del">
                                    @csrf
                                    @method('DELETE')
                                    <button>Удалить</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
                <form action="{{route('car.price.save', [$car->id])}}" method="post" class="form_car-pricing form-admin">
                    @csrf
                    <div class="form_car-pricing-container">
                        <div class="form_car-pricing-item">
                           <p>Цена 2-3</p>
                            <input type="number" name="price3" placeholder="Цена 2-3" step="1" value="{{old('price3')}}">
                        </div>
                        <div class="form_car-pricing-item">
                            <p>Цена 4-9</p>
                            <input type="number" name="price2" placeholder="Цена 4-9" step="1" value="{{old('price2')}}">
                        </div>
                        <div class="form_car-pricing-item">
                            <p>Цена 10+</p>
                            <input type="number" name="price" placeholder="Цена 10+" step="1" value="{{old('price')}}">
                        </div>
                    </div>
                    <div class="form_car-pricing-container">
                        <div class="form_car-pricing-item">
                            <p>Начало периода</p>
                            <input type="date" name="start" class="start_price" min="2020-01-01" max="2020-12-31" value="{{old('start')}}">
                        </div>
                        <div class="form_car-pricing-item">
                            <p>Конец периода</p>
                            <input type="date" name="end" min="2020-01-01" max="2020-12-31" value="{{old('end')}}">
                        </div>
                    </div>
                    <button>Создать</button>
                </form>
                <br><br>
                <form action="{{route('image.main', [$car->id])}}" method="post" class="form-admin" enctype="multipart/form-data">
                    @csrf
                    <label class="file">
                        <p>Добавить основное изображение</p>
                        <input type="file" name="main_img" class="form-file-input" id="image" accept="image">
                        <span class="file-custom" data-after="Выберать файлы"></span>
                    </label>
                    <br><br>
                    <button>Сохранить главное изображение</button>
                </form>
                @isset($mainImage['car_main'])
                <div class="image-container">
                    <div class="image-item">
                        <div class="image-block">
                            <img src="{{$mainImage['car_main'].'?'.time()}}" alt="изображаение заказа">
                        </div>
                    </div>
                </div>
                @endisset
                <br>
                <form action="{{route('image.store', [$car->id])}}" class="form-admin" method="post" enctype="multipart/form-data">
                    @csrf
                    <label class="file">
                        <p>Добавить изображение в галерею авто</p>
                        <input type="file" name="images[]" multiple class="form-file-input" id="image" accept="image/*">
                        <span class="file-custom" data-after="Выберать файлы"></span>
                    </label>
                    <br><br>
                    <button>Сохранить изображения</button>

                </form>
                <div class="image-container">
                    @foreach($images as $key => $image)
                        <div class="image-item">
                            <div class="image-block">
                                <img src="{{$image['car']}}" alt="изображаение заказа">
                            </div>
                            <form action="{{route('image.destroy', [$car->id, $key])}}" method="post" class="image-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Удалить изображение</button>
                            </form>
                        </div>
                    @endforeach
                </div>
                <br><br>
                <form action="{{route('car.destroy', [$car->id])}}" method="post" class="form-admin">
                    @csrf
                    @method('DELETE')
                    <button class="del-btn">Удалить авто</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="{{ asset('libs/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'text', {
            filebrowserBrowseUrl: '{{asset('libs/filemanager/index.html')}}',
            filebrowserUploadUrl: '{{asset('libs/filemanager/index.html')}}',
            filebrowserImageBrowseUrl: '{{asset('libs/filemanager/index.html')}}',
            filebrowserFlashBrowseUrl: '{{asset('libs/filemanager/index.html')}}',
            filebrowserImageUploadUrl: '{{asset('libs/filemanager/index.html')}}',
            filebrowserFlashUploadUrl: '{{asset('libs/filemanager/index.html')}}',
        });
    </script>
@endsection
