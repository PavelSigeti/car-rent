@extends('layouts.dashboard')

@section('title', 'Создать запись')

@section('content')

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Создать запись</h1>
                </div>
                <div class="col-12">
                    @if($errors->any())
                        <ul class="errors-container">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form action="{{route('post.store')}}" method="post" class="form-admin">
                        @csrf
                        <p>Заголовок</p>
                        <input type="text" name="title" value="{{old('title')}}" placeholder="Заголовок">
                        <p>ЧПУ-slug</p>
                        <input type="text" name="slug" value="{{old('slug')}}" placeholder="URL">
                        <p>Текст</p>
                        <textarea name="text" id="text" cols="30" rows="10" placeholder="Содержание">{{old('text')}}</textarea>
                        <p>Мета-заголовок</p>
                        <input type="text" name="seo_title" value="{{old('seo_title')}}" placeholder="Мета заголовок">
                        <p>Мета-описание</p>
                        <input type="text" name="seo_description" value="{{old('seo_description')}}" placeholder="Мета описание">
                        <button>Создать запись</button>
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
