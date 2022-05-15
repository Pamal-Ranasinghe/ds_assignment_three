{{-- @component('mail::message')
# Hello Customer,

Your payment confirmed.
{{$details['title']}}
{{$details['body']}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail Test</title>
</head>
<body>

    <h1> {{$details['title']}}</h1>
    <p> {{$details['body']}}</p>
    <p> Name : {{$details['name']}}</p>
    <p> Amount : {{$details['amount']}}</p>
    <p> Email : {{$details['email']}}</p>
    <p> Phone number : {{$details['phone_number']}}</p>
    <p> Thank You...!!! </p>
    
</body>
</html>
