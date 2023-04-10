@extends('layouts.dashboard')

@section('title', 'Редактировать страницу')

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

                    <form action="{{route('page.update', [$page->id])}}" method="post" class="form-admin">
                        @csrf
                        @method('PUT')
                        <p>Заголовок</p>
                        <input type="text" name="title" value="{{$page->title}}" placeholder="Заголовок">
                        <p>ЧПУ-slug</p>
                        <input type="text" name="slug" value="{{$page->slug}}" placeholder="URL">
                        <p>Текст</p>
                        <textarea name="text" id="text" cols="30" rows="10" placeholder="Содержание">{{$page->text}}</textarea>
                        <p>Мета-заголовок</p>
                        <input type="text" name="seo_title" value="{{$page->seo_title}}" placeholder="Мета заголовок">
                        <p>Мета-описание</p>
                        <input type="text" name="seo_description" value="{{$page->seo_description}}" placeholder="Мета описание">
                        <button>Редактировать страницу</button>
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
