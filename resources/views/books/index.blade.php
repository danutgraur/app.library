@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ __('messages.books') }}</h1>

        <a href="{{ route('books.create') }}" class="btn btn-success mb-3" title="Add book"><i class="fas fa-user-plus"></i> {{ __('messages.add') }}</a>

        @if($books->count() == 0)
            <div>{{ __('messages.not_available') }}</div>
        @else
            <table class="table table-striped">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>{{ __('messages.cover') }}</th>
                        <th>{{ __('messages.title') }}</th>
                        <th>{{ __('messages.author') }}</th>
                        <th>{{ __('messages.tags') }}</th>
                        <th>{{ __('messages.description') }}</th>
                        <th>{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td><img src="{{ $book->cover_image ? '/storage/covers/'.$book->cover_image : '/storage/covers/default.png' }}" style="width:70px;"></td>
                            <td>{{$book->title}}</td>
                            <td>{{$book->author->name}}</td>
                            <td>{{$book->tags->implode('name', ', ')}}</td>
                            <td>{{$book->description}}</td>
                            <td class="text-center ico text-lg-right">
                                <div class="btn-group align-items-start" role="group" aria-label="Butoane utilizator">
                                    <a class="btn btn-success" href="{{route('books.show',$book->id)}}"><i class="far fa-eye"></i></a>
                                    {!! Html::decode(link_to_route('books.edit', '<i class="far fa-edit"></i>', array($book->id), array('class' => 'btn btn-primary'))) !!}
                                    {!! Form::open(['route' =>['books.destroy', $book->id], 'method' => 'DELETE']) !!}
                                    <button class="btn btn-danger mb-3" style="border-bottom-left-radius: 0; border-top-left-radius: 0; margin-left:-1px;"><i class="fas fa-trash"></i></button>
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
