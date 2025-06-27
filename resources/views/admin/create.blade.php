<form action="{{ route('admin.causes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="title">Title</label>
    <input type="text" name="title" required>

    <label for="description">Description</label>
    <textarea name="description" required></textarea>

    <label for="goal">Goal Amount</label>
    <input type="number" name="goal" required>

    <label for="image">Upload Image</label>
    <input type="file" name="image" required>

    <button type="submit">Create Cause</button>
</form>
