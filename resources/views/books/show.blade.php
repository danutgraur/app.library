@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ __('messages.book') }}: <b class="text-primary">{{$book->title}}</b></h1>

        <a href="{{ route('books.index') }}" class="btn btn-secondary mb-3" title="{{ __('messages.index') }}"><i class="fas fa-list"></i> {{ __('messages.index') }}</a>
        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-success mb-3" title="{{ __('messages.modify') }}"><i class="far fa-edit"></i> {{ __('messages.modify') }}</a>
        {!! Form::open(['route' =>['books.destroy', $book->id], 'class' => 'd-inline-block', 'method' => 'DELETE']) !!}
        <button class="btn btn-danger mb-3" title="{{ __('messages.delete') }}"><i class="fas fa-trash"></i> {{ __('messages.delete') }}</button>
        {!! Form::close() !!}

        <div class="row">
            <div class="col-12">
                <table class="table table-striped clients-show-table">
                    <thead class="bg-secondary text-white">
                        <th>{{ __('messages.cover') }}</th>
                        <th>{{ __('messages.title') }}</th>
                        <th>{{ __('messages.author') }}</th>
                        <th>{{ __('messages.tags') }}</th>
                        <th>{{ __('messages.description') }}</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="{{ $book->cover_image ? '/storage/covers/'.$book->cover_image : '/storage/covers/default.png' }}" style="width: 70px;"></td>
                            <td>{{$book->title}}</td>
                            <td>{{$book->author->name}}</td>
                            <td>{{$book->tags->implode('name', ', ')}}</td>
                            <td>{{$book->description}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
