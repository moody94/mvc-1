<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('head')

<body class="antialiased">
    <div>
        @include('navbar')
    </div>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div style="font-weight:800; width:80%; font-size: 24px; text-align:center; margin-left:10%;">
            @if(count($books) == 0)
            No Books Now!
            @else
            <table>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Image</th>
                </tr>
                @foreach($books as $data)
                <tr>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->author }}</td>
                    <td>{{ $data->ISBN }}</td>
                    <td><img src="{{ URL::asset('assets/image/' . $data->image) }}"></td>
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
        width: 100%;
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