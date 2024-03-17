<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />



</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">


    @foreach ($collections as $collection)
    <h2>{{ $collection['name'] }}</h2>
    <ul>
        @foreach ($collection->posts as $content)
        <li><a href="/edit/{{$content->id}}">{{ $content->title }}</a></li>
        @endforeach
    </ul>
    @endforeach


</body>

</html>