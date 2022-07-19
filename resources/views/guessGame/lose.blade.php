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
                <h1>Guess my number:</h1>

                <p style="color: red; font-weight: 900;">Oops you lost, Please try again!</p>

                <p>The correct guess is: {{ $request->session()->get('number') }}.</p>

                <form method="post">
                    @csrf
                    <input type="submit" name="init" value="Play again" class="btn">
                </form>
            </main>

        </div>
    </div>
</body>

</html>