@php
$request = request();
@endphp
@include('head')

<body class="antialiased">
    <div>
        @include('navbar')
        <div
            class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-top py-4 sm:pt-0">
            <div class=" text-center container jumbotron w-50 bg-white text-dark">

                <h3>Dice Game</h3>


                <p class="text-dark">{!! $request->session()->get('playersHands') !!}</p>

                <p>The player dice sum:</p>
                <p class="text-dark">{!! $request->session()->get('sumForHands') !!}</p>

                @if (is_int($app->session->get('player1')))
                    <p>Player <?= $app->session->get('player1') ?> will start playing</p>
                    <br>
                @else
                    <?= $request->session()->get('player1') ?>
                @endif

                <form method="post">
                    @csrf
                    <input type="submit" name="reset" value="Reset" class="btn">
                    <input type="submit" name="play" value="Play" class="btn">
                </form>
            </div>
        </div>
</body>