{{-- resources/views/layouts/master.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: #f4f7fb;
        }

        .main-card{
            border: none;
            border-radius: 18px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .student-card{
            border: none;
            border-radius: 18px;
            overflow: hidden;
            transition: 0.3s;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .student-card:hover{
            transform: translateY(-5px);
        }

        .student-image{
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #0d6efd;
        }

        .page-title{
            font-weight: bold;
            color: #0d6efd;
        }

        .form-control{
            border-radius: 10px;
        }

        .btn{
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="container py-5">
        @yield('content')
    </div>

</body>
</html>