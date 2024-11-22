<h1>Edit Device Type</h1>
<form action="{{ route('device-types.update', $deviceType->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="type_name">Device Type Name</label>
        <input type="text" name="type_name" id="type_name" class="form-control" value="{{ $deviceType->type_name }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Device Type</button>
</form>
