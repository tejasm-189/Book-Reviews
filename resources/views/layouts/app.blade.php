<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Reviews</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased">
    <div class="fixed top-0 w-full z-10 glass border-b border-slate-200">
        <div class="container mx-auto max-w-5xl px-4 py-4 flex justify-between items-center">
            <a href="{{ route('books.index') }}" class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">
                BookReviews
            </a>
            <nav>
                <a href="{{ route('books.index') }}" class="text-slate-600 hover:text-slate-900 font-medium">Browse</a>
            </nav>
        </div>
    </div>

    <main class="container mx-auto max-w-5xl px-4 mt-24 mb-10 min-h-screen">
        @if (session('flash_message'))
        <div class="fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg border font-medium {{ session('flash_class', 'bg-slate-800 text-white') }} transition-all animate-bounce">
            {{ session('flash_message') }}
        </div>
        @endif
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 py-8 mt-auto">
        <div class="container mx-auto text-center text-slate-500 text-sm">
            &copy; {{ date('Y') }} Book Reviews. All rights reserved.
        </div>
    </footer>
</body>

</html>