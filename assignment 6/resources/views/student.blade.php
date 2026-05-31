<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 6</title>
    <link rel="stylesheet" href="{{asset('css/student.css')}}">
</head>
<body>
    <div>
        <h1>Student Profile Page</h1>
        @php
            $final_id = isset($id) ? $id : 0000;
            $final_name = isset($name) ? $name : "Name";
        @endphp
            <ul>
                <li>Student ID: {{$final_id}}</li>
                <li>Student Name: {{$final_name}}</li>
            </ul>
        
    </div>
</body>
</html>