@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{__('messages.modify')}}: {{$book->title}}</h1>
        {{ Form::model($book, array('route' => array('books.update', $book->id), 'method' => 'PUT', 'files' => true)) }}

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    {{ Form::label('title', __('messages.title'), ['class' => 'mb-0']) }}
                    {{ Form::text('title', $book->title, ['class' => 'form-control','required']) }}
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    {{ Form::label('author', __('messages.author'), ['class' => 'mb-0']) }}
                    {{ Form::select('author', $authors, $book->author->id, ['class' => 'form-control custom-select','placeholder'=>Lang::get('messages.selectAuthor')]) }}
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    {{ Form::label('tags', __('messages.tags'), ['class' => 'mb-0']) }}
                    {{ Form::select('tags[]', $tags, null, ['class' => 'form-control custom-select', 'multiple']) }}
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    {{ Form::label('description', __('messages.description'), ['class' => 'mb-0']) }}
                    {{ Form::text('description', $book->description, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-12">
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="cover" id="cover" aria-describedby="cover">
                        <label class="custom-file-label" for="cover">{{__('messages.choose')}}</label>
                    </div>
                </div>
            </div>
        </div>


        <button class="btn btn-success mb-3" type="submit"><i class="fas fa-save"></i> {{__('messages.save')}}</button>
        <a href="{{ route('books.show', $book->id) }}" class="btn btn-danger mb-3"><i class="far fa-times-circle"></i> {{__('messages.cancel')}}</a>
    </div>

@endsection
