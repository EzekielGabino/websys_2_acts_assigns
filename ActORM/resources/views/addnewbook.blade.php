<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Book</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f5f7fa; }
        .card { border-radius: 12px; }
    </style>
</head>
<body>

<div class="container py-5">

    <div class="card shadow-sm p-4 mx-auto" style="max-width: 500px;">
        <h3 class="mb-3 text-center">➕ Add New Book</h3>

        <form action="{{ route('books.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Author</label>
                <input type="text" name="author" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Published Date</label>
                <input type="date" name="published_date" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Add Book</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary w-100 mt-2">Back</a>
        </form>

    </div>

</div>

</body>
</html>