<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<body>
<div class="container">

    <div class="row">
        <div class="col-md-6 col-md-offset-3"
             style="background-color: #dedef8;box-shadow:
                 inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
            @foreach($data as $val)
                <a href="/home">{{ $val->name }}</a>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>

