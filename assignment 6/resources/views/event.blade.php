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
        <h1>Event Registration Page</h1>
        @php
            $final_event = isset($event) ? $event : "event";
            $final_participant = isset($participant) ? $participant : "participant";
            $final_year = isset($year) ? $year : 0000;
        @endphp
            <ul>
                <li>Event: {{$final_event}}</li>
                <li>Participant: {{$final_participant}}</li>
                <li>Year Level: {{$final_year}}</li>
            </ul>
    </div>
</body>
</html>