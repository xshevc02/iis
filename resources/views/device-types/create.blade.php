<h1>Add Device Type</h1>
<form action="{{ route('device-types.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="type_name">Device Type Name</label>
        <input type="text" id="type_name" name="type_name" class="form-control" value="{{ old('type_name') }}" required>
    </div>
    <button type="submit" class="btn btn-success">Add Device Type</button>
</form>
