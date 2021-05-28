<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/app.css" rel="stylesheet">
    <title>siev20~laravel</title>
</head>
<body>
    <header>
        <nav>
            <a href={{ url("/") }} class={{ request()->path() == "/" ? 'active' : '' }}>Home</a>
            <a href={{ url("/session") }} class={{ request()->path() == "session" ? 'active' : '' }}>Session</a>
            <a href={{ url("/test") }} class={{ request()->path() == "test" ? 'active' : '' }}>Test</a>
            <a href={{ url("/yatzy") }} class={{ request()->path() == "yatzy" ? 'active' : '' }}>Yatzy</a>
        </nav>
    </header>
<main>