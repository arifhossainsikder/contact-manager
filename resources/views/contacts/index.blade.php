@extends('layouts.app')


@section('content')



        <div class="card card-outline-secondary my-4">
            <div class="card-header">
                All contacts
            </div>
            @if($contacts)
                <div class="card-body">
                    @foreach($contacts as $contact)
                        <h3>{{ $contact->name }}</h3>
                        <h4>{{ $contact->company }}</h4>
                        <p>{{ $contact->email }}</p>
                        <hr>
                    @endforeach
                </div>
            @endif
        </div>
        <!-- /.card -->

        <div class="text-center">
            <nav>
                {!! $contacts->appends(Request::query())->render() !!}
            </nav>
        </div>


@endsection