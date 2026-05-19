<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <x-primary-button tag="a" href="{{ route('books.create') }}">Tambah Data Buku</x-primary-button>
                <x-danger-button tag="a" href="{{ route('books.print') }}" target="blank">Export PDF</x-danger-button>
                <x-primary-button tag="a" href="{{ route('books.export') }}" target="blank" class="bg-green-700">Export Excel</x-primary-button>
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'importBook')" class="bg-green-700">Import Excel</x-primary-button>
            </div>
            
            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Penerbit</th>
                        <th>Kota</th>
                        <th>Cover</th>
                        <th>Kode Rak</th>
                        <th>Aksi</th>
                    </tr>
                </x-slot>

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
                                <img src="{{ asset('storage/cover_buku/'.$book->cover) }}" width="100px" alt="Cover"/>
                            @else
                                <span class="text-gray-400">No image</span>
                            @endif
                        </td>
                        <td>{{ $book->bookshelf->code }}-{{ $book->bookshelf->name }}</td>
                        <td class="flex flex-auto">
                            <a href="{{ route('books.edit', $book->id) }}" class="mt-3"><i class="fa-solid fa-pencil"></i></a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="post" onsubmit="return confirm('Apakah anda yakin?');">
                                @csrf
                                @method('delete')
                                <x-danger-button type="submit" class="bg-transparent mt-3 ml-2"><i class="fa-solid fa-trash text-red-600 ml-1"></i></x-danger-button>
                                {{-- <x-danger-button type="submit">Delete</x-danger-button> --}}
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-table>
        </div>
    </div>
    <x-modal name="importBook">
        <form action="{{ route('books.import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <x-file-input name="file" required/>
            <x-primary-button>Upload</x-primary-button>
        </form>
    </x-modal>
</x-app-layout>