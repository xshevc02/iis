@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Device</h1>
        <form action="{{ route('devices.update', $device->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Device Name</label>
                <input type="text" name="name" id="name" value="{{ $device->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="type_id">Device Type</label>
                <select name="type_id" id="type_id" class="form-control">
                    @foreach ($device_types as $type)
                        <option value="{{ $type->id }}" {{ $device->type_id == $type->id ? 'selected' : '' }}>
                            {{ $type->type_name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <!-- Add other fields as necessary -->

            <button type="submit" class="btn btn-primary">Update Device</button>
        </form>
    </div>
@endsection
