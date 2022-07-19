<link rel="stylesheet" href="{{ URL('app.css') }}">
<div class="d-block">
    <nav class="nav">
        <div class="div"> <a href="{{ url('/home') }}" class="{{ Request::segment(1) === 'home' ? 'item' : 'item' }}">Home</a></div>
        <div  class="div"> <a href="{{ url('/dice') }}" class="{{ Request::segment(1) === 'dice' ? 'item' : 'item' }}">Dice Game</a></div>
        <div  class="div"> <a href="{{ url('/start-guess') }}" class="{{ Request::segment(1) === 'start-guess' ? 'item ' : 'item' }}">Guess Game</a>
        </div>

    </nav>
</div>