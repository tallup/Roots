<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Finance - ROOTS')</title>
    <link rel="icon" href="/images/roots-logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .stats-card.finance {
            background: #fff;
            border-radius: 1.25rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 2rem 1.5rem;
            text-align: center;
            margin-bottom: 1.5rem;
            min-width: 180px;
        }
        .stats-icon.finance {
            font-size: 2.2rem;
            color: #00bcd4;
            margin-bottom: 0.5rem;
        }
        .stats-number {
            font-size: 1.6rem;
            font-weight: bold;
            color: #00796b;
        }
        .stats-label {
            font-size: 1.1rem;
            color: #555;
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 p-0">
                @include('finance.partials.sidebar')
            </div>
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>