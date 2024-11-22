@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Device</h1>
        <form action="{{ route('devices.update', $device->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Device Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $device->name) }}" required>
            </div>

            <div class="form-group">
                <label for="type_id">Device Type</label>
                <select id="type_id" name="type_id" class="form-control" required>
                    @foreach ($device_types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == $device->type_id ? 'selected' : '' }}>
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
