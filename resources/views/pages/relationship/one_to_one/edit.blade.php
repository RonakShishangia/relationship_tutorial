@extends('layouts.app')

@section('content')
<div class="container">
    <h2>One to one relationship</h2>
    <div class="panel panel-default">
        <div class="panel-heading">Edit Contact<a href="{{ route('onetoone.index') }}" class="btn btn-primary btn-sm pull-right">Back</a></div>
        <div class="panel-body">
            <form action="{{ route('onetoone.update', $contact->id) }}" method="post">
                {{ csrf_field() }} {{ method_field('put') }}
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $contact->name }}" placeholder="Enter Name">
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>
                <div class="form-group  {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $contact->email }}" placeholder="Enter Email">
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group  {{ $errors->has('number') ? 'has-error' : '' }}">
                    <label for="number">Number</label>
                    <input type="text" class="form-control" id="number" name="number" value="{{ $contact->phone->number }}" placeholder="Enter Number">
                    <span class="text-danger">{{ $errors->first('number') }}</span>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
