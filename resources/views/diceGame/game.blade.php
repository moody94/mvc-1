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
                @if ($request->session()->get('winner') === 'No winner yet!')
                    @if ($request->session()->get('player1') === $request->session()->get('firstPlayer1'))
                        <p>Player <?= $request->session()->get('player1') ?>
                            Throws <?= $request->session()->get('diceInHand') ?>
                            and the round's score is <?= $request->session()->get('sumTheRound') ?>.
                        </p>
                        <p style='color:green; font-weight:bold;'>Player
                            <?= $request->session()->get('player1') ?>
                            can either play or save!</p>
                    @else
                        <p>Player
                            <?= $request->session()->get('player1') ?>
                            Throws <?= $request->session()->get('diceInHand') ?>
                            and the round's score is <?= $request->session()->get('sumTheRound') ?>.
                        </p>
                        <p style='color:red; font-weight:bold;'>It is player's
                            <?= $request->session()->get('firstPlayer1') ?>
                            turn now!</p>
                    @endif
                @endif

                @if ($request->session()->get('lastSum') !== '')
                    <h3>The players' final scores:</h3>
                    <?= $request->session()->get('lastSum') ?>
                @endif

                <p style='font-weight:bold;'><?= $request->session()->get('winner') ?></p>

                <form method="post">
                    @csrf
                    <input type="submit" class="btn btn-primary" name="reset" value="Reset">
                    <input type="submit" class="btn btn-primary"
                        style='display:<?= $request->session()->get('playButton') ?>;' name="Players"
                        value="Play">
                    <input type="submit" class="btn btn-primary"
                        style='display:<?= $request->session()->get('saveButton') ?>;' name="save"
                        value="Save">
                </form>
            </div>
        </div>
    </div>
</body>