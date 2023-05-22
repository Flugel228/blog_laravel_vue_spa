@extends('layouts.main')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Изменить Тег</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.tag.index') }}">Теги</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.tag.show', $tag) }}">{{ $tag->title }}</a></li>
                            <li class="breadcrumb-item active">Изменить</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- MAIN CONTENT -->
                <tag-edit-component></tag-edit-component>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
