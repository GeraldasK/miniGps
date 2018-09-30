{!! $data['map']['js'] !!}
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Dashboard<a href="devices/create" class="btn btn-primary btn-sm float-right">Add Devices</a></div>

                <div class="card-body">
                    <h3>All Your Devices</h3>
                    @if(count($data['devices']))
                        <table class="table table-striped">
                            <tr>
                                <th>Device Id</th>
                                <th>Place name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            @foreach($data['devices'] as $device)
                            <tr>
                                <td>{{$device->id}}</td>
                                <td>{{$device->place_name}}</td>
                                <td><a href="devices/{{$device->id}}/edit" class="btn btn-warning btn-sm">Edit</a></td>
                                <td>
                                    {!! Form::open(['action' => ['DevicesController@update', $device->id], 'method' => 'POST']) !!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])}}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            {!! $data['map']['html'] !!}
        </div>
    </div>
</div>
@endsection
