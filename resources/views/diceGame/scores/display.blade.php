<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('head')

<body class="antialiased">
    <div>
        @include('navbar')
    </div>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div style="font-weight:800;  font-size: 24px;  float:right">
            @if(count($diceresults) == 0)
            There are no dice game scores yet!
            @else
            <table>
                <tr>
                    <th>Winner</th>
                    <th>Score</th>
                </tr>
                @foreach($diceresults as $data)
                <tr>
                    <td>{{ $data->winner }}</td>
                    <td>{{ $data->score }}</td>
                </tr>
                @endforeach
            </table>
            @endif
        </div>
    </div>
</body>

</html>
<style>
    img {
        border-style: none;
        box-sizing: border-box;
        width: 100px;
        max-width: 100%;
    }

    table {
        padding: .5em;
        width: 1000px;
        max-width: 100%;
        text-align: center;
        margin-bottom: 20px;
    }

    table tr,
    td,
    th {
        border: 2px solid rgb(179, 177, 177);
    }
</style>