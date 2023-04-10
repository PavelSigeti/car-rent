@extends('layouts.dashboard')

@section('title', $meta->title.' '.$meta->name.' - редактировать')

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

                    <form action="{{route('meta.update', [$meta->id])}}" method="post" class="form-admin">
                        @csrf
                        @method('PATCH')
                        <label for="name">Название</label>
                        <input type="text" id="name" name="name" value="{{$meta->name}}" placeholder="Название нового элемента">
                        <label for="seo_title">Мета-заголовок</label>
                        <input type="text" id="name" name="seo_title" value="{{$meta->seo_title}}" placeholder="Мета-заголовок">
                        <label for="seo_description">Мета-описание</label>
                        <input type="text" id="seo_description" name="seo_description" value="{{$meta->seo_description}}" placeholder="Мета-описание">
                        <label for="big_title">Заголовок H1</label>
                        <input type="text" id="big_title" name="big_title" value="{{$meta->big_title}}" placeholder="Заголовок H1">
                        <label for="small_title">Заголовок H2</label>
                        <input type="text" id="small_title" name="small_title" value="{{$meta->small_title}}" placeholder="Заголовок H2">
                        <label for="text">Описание</label>
                        <textarea id="text" name="text" placeholder="Описание">{!! $meta->text !!}</textarea>
                        <button>Сохранить изменения</button>
                    </form>
                    <br><br>
                    <form action="{{route('meta.destroy', [$meta->id])}}" method="post" class="form-admin">
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
