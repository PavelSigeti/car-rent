@extends('layouts.dashboard')

@section('title', 'Контроль панель')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Добавить точку</h1>
            </div>
            <div class="col-12">
                @if($errors->any())
                    <ul class="errors-container">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-12">
                <form action="{{route('place.store')}}" method="post" class="form-admin">
                    @csrf
                    <p>Название точки</p>
                    <input type="text" name="name" value="{{old('name')}}" placeholder="Название точки">
                    <p>Заголовок</p>
                    <input type="text" name="title" value="{{old('title')}}" placeholder="Заголовок">
                    <p>ЧПУ-slug</p>
                    <input type="text" name="slug" value="{{old('slug')}}" placeholder="URL">
                    <p>Стоимость доставки</p>
                    <input type="number" name="delivery_price" value="{{old('delivery_price')}}" placeholder="Стоимость доставки">
                    <p>Надбавака</p>
                    <input type="number" name="extra_price" value="{{old('extra_price')}}" placeholder="Надбавака за неудобное время">
                    <p>Текст</p>
                    <textarea name="big_text" id="text" cols="30" rows="10" placeholder="Большой текст">{{old('big_text')}}</textarea>
                    <p>Мета-заголовок</p>
                    <input type="text" name="seo_title" value="{{old('seo_title')}}" placeholder="Мета заголовок">
                    <p>Мета-описание</p>
                    <input type="text" name="seo_description" value="{{old('seo_description')}}" placeholder="Мета описание">
                    <button>Создать новую точку</button>
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
