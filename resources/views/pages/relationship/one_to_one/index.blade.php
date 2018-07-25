@extends('layouts.app')

@section('content')
<div class="container">
    <h2>One to one relationship</h2>
    <div class="panel panel-default">
        <div class="panel-heading">Contact List <a href="{{ route('onetoone.create') }}" class="btn btn-primary btn-sm pull-right">Add</a></div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($contacts as $contact)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->phone->number }}</td>
                        <td>
                            <a href="{{ route('onetoone.edit', $contact->id) }}" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger" onclick="document.getElementById('deleteContact').submit();">Delete</button>
                            <form id="deleteContact" action="{{ route('onetoone.destroy', $contact->id) }}" method="post">
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No Data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
