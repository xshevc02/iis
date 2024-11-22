@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Device</h1>
        <form action="{{ route('devices.update', $device->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Device Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $device->name }}" required>
            </div>

            <div class="form-group">
                <label for="type_id">Device Type</label>
                <select name="type_id" id="type_id" class="form-control" required>
                    @foreach ($device_types as $type)
                        <option value="{{ $type->id }}" {{ $device->type_id == $type->id ? 'selected' : '' }}>
                            {{ $type->type_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="studio_id">Studio</label>
                <select name="studio_id" id="studio_id" class="form-control" required>
                    @foreach ($studios as $studio)
                        <option value="{{ $studio->id }}" {{ $device->studio_id == $studio->id ? 'selected' : '' }}>
                            {{ $studio->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="available">Available</label>
                <input type="checkbox" name="available" id="available" value="1" {{ $device->available ? 'checked' : '' }}>
            </div>

            <button type="submit" class="btn btn-primary">Update Device</button>
        </form>
    </div>
@endsection
