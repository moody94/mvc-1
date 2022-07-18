<!DOCTYPE html>

<link rel="stylesheet" href="{{ URL('app.css') }}">
@include('head')

<body class="antialiased">
    <div>
        @include('navbar')
    </div>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-top py-4 sm:pt-0">
        <div class="text-center">
            <h1>The Games</h1>
            <h4>This wibsite have tow games</h4>

            <div>
                <div class="div1">
                    <h4 style="color: red;">Dice Game</h4>
                    <p>the game consists of at least 2 players, they can play with one dice or more.</p>
                    <p>the game starts emd throwing dice, the player who gets the highest number from dice,</p>
                    <p>he can start the game. each time we add the number that was on training to the sum</p>
                    <p> for example (the first time training showed 4 and others showed 6 the sum became 6 for the same player)</p>

                </div>
                <div class="div1">
                    <h4 style="color: red;">Guess Game</h4>
                    <p>The Game chooses a number from 1 to 100 and you have to guess what is this number and write it</p>
                    <p>you have 6 attempts to guess the correct number or you will lose</p>
                </div>
            </div>

        </div>
    </div>
</body>

</html>