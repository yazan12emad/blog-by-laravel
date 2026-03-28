@props([
       'title' => 'blog | laravel version '
   ])
{{--
This is the layout component that will be used in all the pages of the website
 the double {} is used to echo the content of the variable in the blade template
 The @props directive is used to define the properties that can be passed to the component
 The $slot variable is used to display the content of the component
 The $title variable is used to set the title of the page
--}}

    <!doctype html>
<html lang="en" data-theme="night">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ $title }} </title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css"/>

    <style>

        body {
            padding: 0;
            margin: 0;
            font-family: sans-serif;
        }

        .navbar > a {
            display: inline-block;
            text-decoration: none;
            font-size: 20px;
            margin-right: 20px;
            color: #5a5adc;
            font-weight: bold;
            transition: color 0.3s ease, transform 0.3s ease;

        }

        .navbar > a:hover {
            color: #15a6d3;
            transform: scale(1.1);
        }

        .navbar > a:active {
            color: #15a6d3;
            transform: scale(1);
        }

        .container1 {
            display: flex;
        }


    </style>
</head>

<body class=" ">
{{--    <header>--}}
{{--    <div class="container1">--}}
{{--        <div class="navbar w-fit mx-auto gap-4 border-2 p-6 m-2 rounded-full">--}}
{{--            <a href="/">Home page</a>--}}
{{--            <a href="/about">About Us</a>--}}
{{--            <a href="/contact">Contact Us</a>--}}
{{--            <a href="/ideas">show Ideas</a>--}}
{{--            <a href="/ideas/create">Form link</a>--}}
{{--            <a href="/notes">Notes file</a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    </header>--}}

<x-nav></x-nav>


<main>

    {{ $slot }}

</main>
</body>
</html>
