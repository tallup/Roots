<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Supervisor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('supervisor.partials.navbar')
    <div class="container py-5">
        <h1 class="display-4 text-center">{{ $title }}</h1>
        <p class="lead text-center text-muted">This is a placeholder for the {{ $title }} page.</p>
    </div>
</body>
</html> 