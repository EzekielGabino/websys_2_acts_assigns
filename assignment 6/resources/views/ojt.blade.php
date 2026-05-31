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
        <h1>OJT Company Information Page</h1>
        @php
            $final_company = isset($company) ? $company : "company";
            $final_city = isset($city) ? $city : "city";
            $final_allowance = isset($allowance) ? $allowance : "(Yes or No)";
        @endphp
            <ul>
                <li>Company: {{$final_company}}</li>
                <li>City: {{$final_city}}</li>
                <li>Allowance: {{$final_allowance}}</li>
            </ul>
    </div>
</body>
</html>