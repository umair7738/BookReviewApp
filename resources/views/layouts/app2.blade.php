<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Review Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Toastr CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>

<body>
    @include('partials.header')

    <div class="container mt-4">
        <!-- Breadcrumb Section -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <!-- Only show Books breadcrumb on the book list page, not the home page -->
                @if (request()->is('books*'))
                    {{-- <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Home</a></li> --}}
                    <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $book->title }}</li>
                @endif
            </ol>
        </nav>


        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @elseif (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>

    <!-- Pushed scripts will go here -->
    @stack('scripts')

</body>

</html>
