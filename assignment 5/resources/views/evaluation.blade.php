<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="form-container">
        <h2>Student Academic Performance</h2>
        <form method="POST" action="/evaluation" >
            @csrf
            <table>
                <tr>
                    <td><label for="name">Name</label></td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td><label for="prelim">Prelim</label></td>
                    <td><input type="number" name="prelim"></td>
                </tr>
                <tr>
                    <td><label for="midterm">Midterm</label></td>
                    <td><input type="number" name="midterm"></td>
                </tr>
                <tr>
                    <td><label for="final">Finals</label></td>
                    <td><input type="number" name="final"></td>
                </tr>
            </table>
            <button name="evaluate" type="submit" class="btn-evaluate">Evaluate</button>
        </form>
    </div>
    
    @if(isset($name) && isset($prelim) && isset($midterm) && isset($final))
        @php
            $average = ($prelim + $midterm + $final) / 3;

            if($average >= 90 && $average <= 100) $letter = 'A';
            elseif($average >= 80 && $average <= 89) $letter = 'B';
            elseif($average >= 70 && $average <= 79) $letter = 'C';
            elseif($average >= 60 && $average <= 69) $letter = 'D';
            elseif($average < 60 ) $letter = 'F';
            else $letter = 'Invalid Input';
            
            if($average >= 75) $remarks = 'Passed';
            elseif($average < 75) $remarks = 'Failed';
            
            if($average >= 98 && $average <= 100) $awards = 'With Highest Honors';
            elseif($average >= 95 && $average <= 97) $awards = 'With High Honors';
            elseif($average >= 90 && $average <= 94) $awards = 'With Honors';
            elseif($average < 90) $awards = 'No Award';
            else $awards = 'Invalid Input';
            
        @endphp
        <div class="result-container">
            <h2>Results</h2>
            <p>Average: {{number_format($average, 0)}}</p>
            <p>Letter Grade: {{$letter}}</p>
            <p>Remarks: {{$remarks}}</p>
            <p>Award: {{$awards}}</p>
        </div>
    @endif
</body>
</html>