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
<html lang="en" data-theme="dark">
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
        .listedLinks {
            transition: transform 0.3s ease;
        }
        .listedLinks:hover {
            font-weight: bold;

            transform: scale(1.1);
        }
        .listedLinks:active {
            font-weight: bold;
            transform: scale(1);
        }
        .no{
            background: red;
        }


    </style>
</head>

<body class=" min-h-full ">

<x-nav></x-nav>
<main>

    {{ $slot }}

</main>
</body>
</html>
