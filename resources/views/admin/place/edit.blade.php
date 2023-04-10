@extends('layouts.dashboard')

@section('title', 'Контроль панель')

@section('content')

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

                    <form action="{{route('place.update', [$place->id])}}" method="post" class="form-admin">
                        @csrf
                        @method('PUT')
                        <p>Название</p>
                        <input type="text" name="name" value="{{$place->name}}" placeholder="Название точки">
                        <p>Заголовок</p>
                        <input type="text" name="title" value="{{$place->title}}" placeholder="Заголовок">
                        <p>ЧПУ-slug</p>
                        <input type="text" name="slug" value="{{$place->slug}}" placeholder="URL">
                        <p>Стоимость доставки</p>
                        <input type="number" name="delivery_price" value="{{$place->delivery_price}}" placeholder="Стоимость доставки">
                        <p>Надбавака</p>
                        <input type="number" name="extra_price" value="{{$place->extra_price}}" placeholder="Надбавака за неудобное время">
                        <p>Платная доставка, при малом количестве дней</p>
                        <p>Указать кол-во дней (включительно)</p>
                        <input type="number" name="min_days" value="{{$place->min_days}}" placeholder="Платная доставка, при малом количестве дней">
                        <p>Доплата к доставке за малое кол-во дней</p>
                        <input type="number" name="min_days_price" value="{{$place->min_days_price}}" placeholder="Доплата к доставке за малое кол-во дней">
                        <p>Текст</p>
                        <textarea name="big_text" id="text" cols="30" rows="10" placeholder="Большой текст">{{$place->big_text}}</textarea>
                        <p>Мета-заголовок</p>
                        <input type="text" name="seo_title" value="{{$place->seo_title}}" placeholder="Мета-заголовок">
                        <p>Мета-описание</p>
                        <input type="text" name="seo_description" value="{{$place->seo_description}}" placeholder="Мета описание">
                        <button>Редактировать точку</button>
                    </form>
                    <br>
                    <form action="{{route('image.place', [$place->id])}}" method="post" enctype="multipart/form-data" class="form-admin">
                        @csrf
                        <label class="file">
                            <p>Добавить основное изображение</p>
                            <input type="file" name="main_img" class="form-file-input" id="image" accept="image">
                            <span class="file-custom" data-after="Выберать файлы"></span>
                        </label>
                        <br><br>
                        <button>Сохранить фоновое изображение</button>
                    </form>
                    @if($image !== null)
                        <div class="image-container">
                            <div class="image-item">
                                <div class="image-block">
                                    <img src="{{$image->uri}}" alt="изображаение заказа">
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{route('place.destroy', [$place->id])}}" method="post" class="form-admin">
                        @csrf
                        @method('DELETE')
                        <button class="del-btn">Удалить</button>
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
