<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Photo Upload</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: #f5f7fa;
        }
        .card {
            border-radius: 12px;
        }
        .image-card {
            position: relative;
        }
        .delete-btn {
            position: absolute;
            top: 8px;
            right: 8px;
        }
        img {
            border-radius: 10px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="container py-5">

    <h2 class="mb-4 text-center">📸 Photo Upload System</h2>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">

        <!-- SINGLE UPLOAD -->
        <div class="col-md-6">
            <div class="card p-4 shadow-sm">
                <h5>Single Image Upload</h5>
                <form action="{{ route('photos.store.single') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image" class="form-control mb-3" required>
                    <button class="btn btn-primary w-100">Upload</button>
                </form>
            </div>
        </div>

        <!-- MULTIPLE UPLOAD -->
        <div class="col-md-6">
            <div class="card p-4 shadow-sm">
                <h5>Multiple Image Upload</h5>
                <form action="{{ route('photos.store.multiple') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="images[]" multiple class="form-control mb-3" required>
                    <button class="btn btn-success w-100">Upload</button>
                </form>
            </div>
        </div>

    </div>

    <hr class="my-5">

    <!-- IMAGE GALLERY -->
    <h4 class="mb-3">Uploaded Images</h4>

    <div class="row g-4">

        @foreach ($getimage as $image)
        <div class="col-md-3">
            <div class="card image-card shadow-sm p-2">

                <img src="{{ asset('images/'.$image->image) }}" height="200" width="100%">

                <!-- DELETE BUTTON -->
                <button class="btn btn-danger btn-sm delete-btn"
                        onclick="confirmDelete({{ $image->id }})">
                    ✕
                </button>

                <!-- HIDDEN FORM -->
                <form id="delete-form-{{ $image->id }}"
                      action="{{ route('photos.destroy', $image->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        </div>
        @endforeach

    </div>

</div>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Delete Image?',
        text: "This cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>

</body>
</html>