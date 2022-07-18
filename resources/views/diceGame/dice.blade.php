<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('head')

<body class="antialiased">
    <div>
        @include('navbar')
    </div>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-top py-4 sm:pt-0">
        <div class=" text-center container jumbotron w-50 bg-white text-dark">
            <h1 style="border: double;">Dice Game</h1>
            <form method="post">
                @csrf

                <label>Dices:
                    <input type="number" name="dicesAmount" min="1" max="5" required class="border">
                </label>

                <label>Players:
                    <input type="number" name="AmoundOfPlayer" min="2" max="5" required class="border">
                </label>
                <p><input type="submit" value="Play" name="doit" class="btn"></p>
            </form>
        </div>
    </div>
</body>

</html>