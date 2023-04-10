@extends('layouts.dashboard')

@section('title', 'Создать авто')

@section('content')
<section class="section-item">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if($errors->any())
                    <ul class="errors-container">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif

                <form action="{{route('car.store')}}" method="post" enctype="multipart/form-data" class="form-admin">
                    @csrf
                    <p>Заголовок</p>
                    <input type="text" name="name" placeholder="Название авто" value="{{old('name')}}">
                    <div class="quad-input">
                        <div class="input-item">
                            <p>Цена 2-3</p>
                            <input type="number" name="price3" placeholder="Цена за сутки" value="{{old('price3')}}">
                        </div>
                        <div class="input-item">
                            <p>Цена 4-9</p>
                            <input type="number" name="price2" placeholder="Цена за сутки" value="{{old('price2')}}">
                        </div>
                        <div class="input-item">
                            <p>Цена 10+</p>
                            <input type="number" name="price" placeholder="Цена за сутки" value="{{old('price')}}">
                        </div>
                        <div class="input-item">
                            <p>Залог</p>
                            <input type="number" name="zalog" placeholder="Залог" value="{{old('zalog')}}">
                        </div>
                    </div>
                    <div class="quad-input">
                        @foreach($metas as $key => $meta)
                            <div class="input-item">
                                <p>{{$meta[0]->title}}</p>
                                <select name="meta[]" id="{{$key}}">
                                    @foreach($meta as $item)
                                        <option value="{{$item->id}}" @if(old($key) === $item->id) selected @endif>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                    <p>Количество мест</p>
                    <input type="number" name="seats" placeholder="Количество мест" step="1" value="{{old('seats')}}">
                    <p>Год выпуска</p>
                    <input type="number" name="year" placeholder="Год выпуска" step="1" value="{{old('year')}}">
                    <div class="quad-input">
                        <div class="input-item">
                            <p>Расположение автомобиля</p>
                            <select name="home_place" id="home_place">
                                <option value="">По умолчанию</option>
                                @foreach($places as $place)
                                    <option value="{{$place['id']}}">{{$place['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <p>Статус</p>
                    <select name="is_published" id="class_id">
                        <option value="1">Опубликовано</option>
                        <option value="0">Не опубликовано</option>
                    </select>
                    <p>SEO-заголовок</p>
                    <input type="text" name="seo_title" placeholder="Мета-заголовок" value="Аренда  в Крыму - FoxRent">
                    <p>META-описание</p>
                    <input type="text" name="seo_description" placeholder="Мета-описание" value="Аренда  в Крыму по низкой цене, без водителя, от 2-х суток. Подача авто в любую точку Крыма. Круглосуточная поддержка, звоните">
                    <p>Текст</p>
                    <textarea name="seo_text" id="text" placeholder="SEO текст"></textarea>
                    <button>Добавить авто</button>
                </form>
            </div>
        </div>
    </div>
</section>
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
