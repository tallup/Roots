<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subcomponent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 p-0">
            @include('finance.partials.sidebar')
        </div>
        <div class="col-md-9 py-4">
            <div class="row justify-content-center">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow-lg border-0" style="border-radius: 1.25rem;">
                        <div class="card-header text-white fw-bold" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); border-radius: 1.25rem 1.25rem 0 0;">
                            Add New Subcomponent
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('finance.subcomponents.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="subcomponent" class="form-control" required value="{{ old('subcomponent') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="sub_desc" class="form-control" rows="3" required>{{ old('sub_desc') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Allocation (USD)</label>
                                    <input type="number" name="allocation" id="allocation" class="form-control" required value="{{ old('allocation') }}">
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-lg" style="min-width:200px; background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: #fff; border: none;">Save</button>
                                    <a href="{{ route('finance.subcomponents') }}" class="btn btn-secondary btn-lg ms-2">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html> 