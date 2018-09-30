@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard<a href="../home" class="btn btn-primary btn-sm float-right">Go Back</a></div>

                <div class="card-body">
                    {!! Form::open(['action' => 'DevicesController@store', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::label('device_id', 'Device Id:')}}
                        {{Form::text('device_id', '', ['class' => 'form-control', 'placeholder' => 'Enter Device_id'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('', 'Select place:')}}
                        <div class="form-check">
                            Home: {{Form::radio('place_name', 'home', ['class' =>'form-check-input'])}}
                            Work: {{Form::radio('place_name', 'work', ['class' =>'form-check-input'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('', 'Enter Coordinates:')}}
                        {{Form::text('long', '', ['class' => 'form-control', 'placeholder' => 'Longtitude'])}}
                        {{Form::text('lat', '', ['class' => 'form-control', 'placeholder' => 'Latitude'])}}
                    </div>
                    <div>
                        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection