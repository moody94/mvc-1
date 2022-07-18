@php
$request = request();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('head')

<body class="antialiased">
    <div>
        @include('navbar')
    </div>
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-top py-4 sm:pt-0">
        <div class=" text-center container jumbotron w-50 bg-white text-dark">
            <main style="text-align: center;">
                <h1 style="border: double;">Guess Game</h1>
                
                <p>Try to guess the number in my mind</p>
                <form method="post">
                    @csrf
                    <input type="submit" name="play" value="play" class="btn">
                </form>
            </main>
        </div>
    </div>
</body>

</html>