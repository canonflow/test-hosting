<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="w-full h-screen flex flex-col justify-center items-center gap-5">
        <h1 class="text-2xl font-medium">401 | UNAUTHORIZED</h1>
        <a href="{{ route('login') }}" class="btn btn-primary px-20 rounded-md">Back</a>
    </div>
</body>
</html>