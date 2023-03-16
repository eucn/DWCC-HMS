<form action="{{ route('admin_delete-rooms.destroy', $room->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete Room</button>
</form>