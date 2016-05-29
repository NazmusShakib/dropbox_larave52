<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-aNUYGqSUL9wG/vP7+cWZ5QOM4gsQou3sBfWRr/8S3R1Lv0rysEmnwsRKMbhiQX/O" crossorigin="anonymous">
</head>
<body>

<div class="container">
    @if(Session::has('success'))
        <h2>{!! Session::get('success') !!}</h2>
    @endif
    <div>Upload form</div>
    {!! Form::open(array('url'=>'upload','method'=>'POST', 'files'=>true)) !!}
    {!! Form::file('image', array('multiple'=>false)) !!}
    {!! Form::submit('Submit', array('class'=>'send-btn')) !!}
    {!! Form::close() !!}

        <a href="http://localhost:8000/download">Download File</a>

    <div class="row">

        <div class="col-sm-12">
            <pre>
            <?php
                print_r ($data);
            ?>
            </pre>

        </div>
    </div>
</div>

</body>
</html>

