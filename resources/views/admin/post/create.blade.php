@extends('layouts.main')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('styles')

    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Добавление Поста</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.post.index') }}">Посты</a></li>
                            <li class="breadcrumb-item active">Добавить</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- MAIN CONTENT -->
                <div class="row mb-2">
                    <form action="{{ route('api.admin.post.store') }}" method="post" class="ml-3 w-75" id="form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group w-25">
                            <label for="title">Название поста</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Введите название поста"
                            >
                            @error('title')
                            <p class="text-error">The title can contain only: numbers, punctuation marks, Latin and
                                Cyrillic characters.</p>
                            @enderror
                        </div>
                        <div class="form-group w-75">
                            <label for="content">Контент поста</label>
                            <textarea class="content" name="content" id="summernote"></textarea>
                            @error('content')
                            <p class="text-error">Content must be filled</p>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <label for="preview">Превью поста</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="preview" name="preview">
                                    <label class="custom-file-label" for="preview">Выберите файл</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Загрузить</span>
                                </div>
                                @error('preview')
                                <div class="text-error">The post must have a preview.</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group w-25">
                            <label for="category_id">Категория поста</label>
                            <select class="form-control" name="category_id" id="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <p class="text-error">The post must have a category.</p>
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <label for="tag_ids">Теги поста</label>
                            <select name="tag_ids[]" id="tag_ids" class="select2" multiple="multiple"
                                    data-placeholder="Выберите теги" style="width: 100%;">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row ml-0">
                            <a class="btn btn-secondary back">Назад</a>
                            <button type="submit" class="btn btn-primary ml-2" id="button">Добавить</button>
                        </div>
                    </form>
                </div>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 250
            });
        });
    </script>
    <script>
        $(function () {
            bsCustomFileInput.init();
            $('.select2').select2();
        })
    </script>
    <style>
        .custom-file-input:lang(en) ~ .custom-file-label::after {
            content: '...';
        }
    </style>
    <script src="{{ asset('js/back.js') }}"></script>
@endsection
