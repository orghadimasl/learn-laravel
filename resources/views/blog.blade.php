<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-50 text-gray-800">
    <div class="container mx-auto px-6 py-8">
        
        <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-gray-800">
                📚 Daftar Blog
            </h1>

            <div class="flex flex-wrap gap-3 items-center">
                <form method="GET" class="relative">
                    <input name="title" type="search" placeholder="Cari blog..."
                        value="{{ $title }}"
                        class="w-60 md:w-72 pl-10 pr-4 py-2 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                    </svg>
                </form>

                <a href="{{ route('blog.create') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 shadow-md transition">Create</a>

                <a href="{{ route('blog.trash') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 shadow-md transition">Restore</a>

                <a href="{{ route('comment.index') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 shadow-md transition">Comments</a>

                <a href="{{ route('tag.index') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-purple-500 hover:bg-purple-600 shadow-md transition">Tags</a>

                <a href="{{ route('logout') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-red-500 hover:bg-red-600 shadow-md transition">Logout</a>
            </div>
        </div>

        @if (session('success'))
            <div class="p-4 mb-5 text-sm text-green-800 bg-green-100 border border-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="p-4 mb-5 text-sm text-red-800 bg-red-100 border border-red-200 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 text-gray-700 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">No</th>
                        <th class="px-6 py-3 text-left font-semibold">Title</th>
                        <th class="px-6 py-3 text-left font-semibold">Tag</th>
                        <th class="px-6 py-3 text-left font-semibold">Status</th>
                        <th class="px-6 py-3 text-center font-semibold w-1/4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($blogs->count() == 0)
                        <tr>
                            <td colspan="5" class="text-center py-6 text-lg text-gray-500">
                                Tidak ada data ditemukan untuk <strong>{{ $title }}</strong>
                            </td>
                        </tr>
                    @endif

                    @foreach ($blogs as $blog)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-3">
                                {{ ($blogs->currentpage() - 1) * $blogs->perpage() + $loop->iteration }}
                            </td>
                            <td class="px-6 py-3 font-medium">{{ $blog->title }}</td>
                            <td class="px-6 py-3">
                                @foreach ($blog->tags as $tag)
                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full mr-1">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-6 py-3">
                                @if ($blog->status == 'Active')
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                        {{ $blog->status }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                                        {{ $blog->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-center space-x-2">
                                <a href="{{ route('blog.show', ['id' => $blog->id]) }}"
                                    class="px-3 py-1 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white transition">View</a>
                                <a href="{{ route('blog.edit', ['id' => $blog->id]) }}"
                                    class="px-3 py-1 text-blue-600 border border-blue-600 rounded hover:bg-blue-600 hover:text-white transition">Edit</a>
                                <form action="{{ route('blog.delete', ['id' => $blog->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus data ini?')"
                                        class="px-3 py-1 text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $blogs->links() }}
        </div>
    </div>
</body>
</html>
