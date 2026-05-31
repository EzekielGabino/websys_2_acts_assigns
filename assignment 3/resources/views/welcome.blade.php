<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata</title>
    <link rel="stylesheet" href="biodata.css">
</head>
<body style="width: 150vh; position: absolute; left: 200px">
    <div class="top-part" style="display: flex; background-color: aqua;">
        @php
            $name = "Ezekiel John D. Gabino";
            $profession = "Programmer";
            $phone = "09100984747";
            $address = "Poblacion West, Umingan, Pangasinan";
            $email = "omoshiroi@gmail.com";
            $dob = "19 May 2004";
            $gender = "Male";
            $nationality = "Filipino";
            $linkedin = "https://www.linkedin.com/in/ezekiel-gabino-402a36256/";
            $age = 21;

            $desc = "I am Student at Pangasinan State Univerity studying BS in Information Technology. 
            3rd year majoring in Web and Mobile Development, taking Capstone Project 101 as a programmer, Mobile Applications Development, and Web Systems and Technology. 
            As a Programmer for our Captone Project I would like to explore something I haven't tried to broaden my horizons.";

            $eduname = "EDUCATION";
            $junioryear = "2016-2020";
            $juniorschool = "Saint Louis High School-Philex";
            $juniordesc = "Took Computer Systems Servicing for Technichal and Livelihood Education";

            $senioryear = "2020-2022";
            $seniorschool = "Umingan National High School";
            $seniordesc = "Took Information and Communications Technology as a Track for Senior High";

            $expname = "EXPERIENCE";
            $expyear = "2025-2025(5 months)";
            $exptitle = "Build Applications For School Projects";
            $expdesc1 = "Built a Mobile App for Application Development & Emerging Technologies";
            $expdesc2 = "Built a Windows App for Information Management";
            $expdesc3 = "Built a Web App for Web Systems";
            $expdesc4 = "Built a Mobile App for Mobile Applications Development";

            $skillsname = "SKILLS";
            $skills1 = "Flutter&dart";
            $skills2 = "PHP";
            $skills3 = "HTML";
            $skills4 = "CSS";
            $skills5 = "C# .NET Framework";
        @endphp
        <div>
            <img src="{{ asset('images/22-UR-0512.png')}}" alt="profile" height="200" width="200" style="padding: 10px">
        </div>
        <div>
            <h1>{{$name}}</h1>
            <h2>{{$profession}}</h2> 
            <table>
                <tbody>
                    <tr>
                        <td><strong>Phone: </strong>{{$phone}}</td>
                        <td><strong>Address: </strong>{{$address}}</td>
                    </tr>
                    <tr>
                        <td><strong>Email: </strong>{{$email}}</td>
                        <td><strong>Date of Birth: </strong>{{$dob}}</td>
                    </tr>
                    <tr>
                        
                        <td><strong>Age: </strong>{{$age}}
                        @if($age == 21)
                            <span>(Dalawamput Isa)</span>
                        @elseif($age == 22)
                            <span>(Bente Dos)</span>
                        @elseif($age == 23)
                            <span>(Bente Tres)</span>
                        @elseif($age == 24)
                            <span>(Duamplo tan apat)</span>
                        @endif
                    </td>
                        <td><strong>Gender: </strong>{{$gender}}</td>
                    </tr>
                    <tr>
                        <td><strong>Nationality: </strong>{{$nationality}}</td>
                        <td><strong>Linkedin: </strong>{{$linkedin}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="body-content">
        <div class="description">
            <p style="width: 800px; position: relative; left: 150px; font-size: 18px">{{$desc}}</p>
        </div>
        <h2 style="color: blue; margin-left: 55px">{{$eduname}}</h2>
        <hr>
        <div class="education">
            <table style="position: relative; left: 80px">
                <tr >
                    <th style="padding-right: 150px; font-size: 20px; padding-bottom: 50px">{{$junioryear}}</th>
                    <td  style="padding-bottom: 50px"><span style="font-size: 25px; font-weight: bold;">{{$juniorschool}}</span><br>
                    <span>{{$juniordesc}}</span></td>
                </tr>
                <tr>
                    <th style="padding-right: 150px; font-size: 20px; padding-bottom: 50px">{{$senioryear}}</th>
                    <td style="padding-bottom: 50px"><span style="font-size: 25px; font-weight: bold">{{$seniorschool}}</span><br>
                    <span>{{$seniordesc}}</span></td>
                </tr>
                <tr>
                    <th style="padding-right: 150px; font-size: 20px;">{{$senioryear}}</th>
                    <td><span style="font-size: 25px; font-weight: bold">{{$seniorschool}}</span><br>
                    <span>{{$seniordesc}}</span></td>
                </tr>
            </table>
        </div>
        <h2 style="color: blue; margin-left: 55px">{{$expname}}</h2>
        <hr>
        <div class="exprience">
            <table style="position: relative; left: 80px">
                <tr >
                    <th style="padding-right: 150px; font-size: 20px;">{{$expyear}}</th>
                    <td  style=""><span style="font-size: 25px; font-weight: bold;">{{$exptitle}}</span><br>
                    <span><ul>
                        <li>{{$expdesc1}}</li>
                        <li>{{$expdesc2}}</li>
                        <li>{{$expdesc3}}</li>
                        <li>{{$expdesc4}}</li>
                    </ul></span></td>
                </tr>
            </table>
        </div>
        <h2 style="color: blue; margin-left: 55px">{{$skillsname}}</h2>
        <hr>
        <div class="skills" style="margin-left: 410px">
            <ul>
                <li>{{$skills1}}</li>
                <li>{{$skills2}}</li>
                <li>{{$skills3}}</li>
                <li>{{$skills4}}</li>
                <li>{{$skills5}}</li>
            </ul>
        </div>
    </div>
    
</body>
</html>