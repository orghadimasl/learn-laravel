<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Blog</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 py-10">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $blog->title }}</h1>

        <p class="inline text-sm text-gray-500 mbb-4 mr-3">
            Penulis:
            <span class="px-2 py-1 rounded-full text-sm bg-green-100 text-green-800">{{ $blog->user->name }}</span>
        </p>
        <p class="inline text-sm text-gray-500 mbb-4 mr-3">
            Email:
            <span class="px-2 py-1 rounded-full text-sm bg-blue-100 text-blue-800">{{ $blog->user->email }}</span>
        </p>
        <p class="inline text-sm text-gray-500 mbb-4 mr-3">
            Dibuat:
            <span
                class="px-2 py-1 rounded-full text-sm bg-blue-100 text-blue-800">{{ $blog->created_at->diffForHumans() }}</span>
        </p>

        <p class="text-sm text-gray-500 mb-4 mt-5">Tag:
            @foreach ($blog->tags as $tag)
                <span class="px-2 py-1 mr-1 rounded-full text-sm bg-gray-100 text-gray-700">{{ $tag->name }}</span>
            @endforeach
        </p>
        <div class="text-gray-700 leading-relaxed mb-8">{{ $blog->descripsi }}</div>

        <hr class="my-6">
        <h2 class="text-xl font-semibold mb-4">Komentar</h2>
        @foreach ($blog->comments as $comment)
            <div class="mb-4 border-l-4 border-blue-500 pl-4">
                <p class="text-gray-800 font-medium">{{ $comment->commenter_name }}</p>
                <p class="text-gray-800 font-medium">{{ $comment->comment_text }}</p>
                <p class="text-gray-800 font-medium">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
        @endforeach

        @if ($blog->comments->isEmpty())
            <p class="text-gray-500 italic mb-4">Belum ada komentar</p>
        @endif

        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-2">Tinggalkan Komentar</h3>
            @if (session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-800 rounded">
                    {{ session('success') }}</div>
            @elseif (session('failed'))
                <div class="mb-4 px-4 py-2 bg-red-100 border border-red-400 text-red-800 rounded">
                    {{ session('failed') }}</div>
            @endif
            <form action="{{ route('comment.store', $blog->id) }}" method="POST" class="space-y-4">
                @csrf
                <div class="">
                    <label for="name" class="block font-medium">Nama</label>
                    <input type="text" name="name" id="name" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-1 focus:ring-blue-500">
                    @error('name')
                        <div class="mt-2 p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">{{ $message }}</div>
                    @enderror
                </div>
                <div class="">
                    <label for="message" class="block font-medium">Pesan</label>
                    <input type="text" name="message" id="message" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-1 focus:ring-blue-500">
                    @error('message')
                        <div class="mt-2 p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">{{ $message }}</div>
                    @enderror
                </div>
                <div class="">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Kirim
                        Komentar</button>
                    <a href="{{ route('blogs.homepage') }}"
                        class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">Kembali</a>
                </div>
            </form>
        </div>
    </div>


</body>

</html>
