@extends('layouts.app')

@section('content')
    @if(count($errors))
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($contact,['route' => ['contacts.update',$contact->id], 'method' => 'PATCH']) !!}
      @include('contacts.form')
    {!! Form::close() !!}
    <br>
@endsection
