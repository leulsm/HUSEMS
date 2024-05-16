<!DOCTYPE html>
<html>

<head>
    <title>Invigilator Registration</title>
</head>

<body>
    <h2>Hello, {{ $fullname }}!</h2>

    <h2>You are assigned for the exam setup, {{ $exam_title }}!</h2>
    <br>
    <h3>Exam Start Day and Time {{ $date }},{{ $time }}</h3>
    <hr>
    <h4>Your password is: {{ $password }}</h4>
    <h4>Please Use this link to get start: <a href="{{ $urllink }}">Click here</a></h4>
    <p>Please keep this information secure and do not share it with others.</p>
</body>

</html>
