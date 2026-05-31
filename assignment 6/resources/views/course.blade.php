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
        <h1>Course Enrollment Page</h1>
        @php
            $final_course = isset($course) ? $course : "course";
            $final_year = isset($year) ? $year : 0000;
        @endphp
            <ul>
                <li>Course: {{$final_course}}</li>
                <li>Year Level: {{$final_year }}</li>
            </ul>
    </div>
</body>
</html>