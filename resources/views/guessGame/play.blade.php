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
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-top py-4 sm:pt-0">
        <div class=" text-center container jumbotron w-50 bg-white text-dark">
            <main style="text-align: center;">
                <h1>Guess the number in My mind:</h1>

                <p>This number between 1 and 100, you have {{$request->session()->get('tries')}} attempts left.</p>

                @if($request->session()->get('res'))
                <p>{!! $request->session()->get('res') !!}</p>
                @endif


                @if($request->session()->get('cheat') == true)
                <p>{{ $request->session()->get('number') }}</p>
                @endif

                <p>{!! $request->session()->get('makeGuess') !!}</p>

                <form method="post">

                    @csrf
                    <input type="number" name="guess" autofocus class="border'">

                    <input type="submit" name="makeGuess" value="Make a guess" class="btn">


                </form>
                <form method="post" class="form1">

                    @csrf
                    <input type="submit" name="doInit" value="Play again" class="btn">
                    <input type="submit" name="doCheat" value="Cheat" class="btn">
                </form>

            </main>
        </div>
    </div>
</body>

</html>