<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table, th, td {
            border:1px solid black;
        }
        h1 {
            background-color: lightskyblue;
        }
        p {
            background-color: yellow;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Data Buku</h1>
    <p style="text-align: center;">Laporan Data Buku Bulanan</p>
    <br>

    <table style="border-collapse: collapse; border:1px solid black; ">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun</th>
                <th>Penerbit</th>
                <th>Kota</th>
                <th>Cover</th>
                <th>Kode Rak</th>
            </tr>
        </thead>
        <tbody>
            @php $num=1; @endphp
                @foreach($books as $book)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->year }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->city }}</td>
                        <td>
                            @if($book->cover)
                                <img src="{{ public_path('storage/cover_buku/'.$book->cover) }}" width="100px" alt="Cover"/>
                            @else
                                <span class="text-gray-400">No image</span>
                            @endif
                        </td>
                        <td>{{ $book->bookshelf->code }}-{{ $book->bookshelf->name }}</td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</body>
</html>