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
    {!! Form::open(['route' => 'contacts.store']) !!}
    <div class="form-group">
        <label for="name">Name:</label>
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="company">Company:</label>
        {!! Form::text('company',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        {!! Form::email('email',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="phone">Phone:</label>
        {!! Form::text('phone',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        {!! Form::textarea('address',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="group">Group:</label>
        {!! Form::select('group_id', App\Group::pluck('name','id'),null,['class'=>'form-control']) !!}
        <br>
        <button type="submit" class="btn btn-default">Add group</button>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
    {!! Form::close() !!}
    <br>
@endsection
