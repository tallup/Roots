<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Training - Data Entry - ROOTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'PT Sans', sans-serif;
        }
        .navbar {
            background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            margin-right: 0 !important;
            padding-left: 0 !important;
            text-align: left;
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            font-size: 1.1rem;
            padding: 0.75rem 1.25rem !important;
            margin: 0 0.25rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white !important;
            font-weight: 600;
        }
        .nav-link i {
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }
        .main-content {
            padding: 30px 0;
        }
        .form-card { background: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); padding: 30px; margin-bottom: 30px; }
        .form-title { color: #2c3e50; font-weight: 700; margin-bottom: 30px; text-align: center; }
        .form-label { color: #495057; font-weight: 600; margin-bottom: 8px; }
        .form-control, .form-select { border: 2px solid #e9ecef; border-radius: 10px; padding: 12px 16px; font-size: 1rem; transition: all 0.3s ease; }
        .form-control:focus, .form-select:focus { border-color: #00796b; box-shadow: 0 0 0 0.2rem rgba(0, 121, 107, 0.15); }
        .btn-primary { background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); border: none; border-radius: 10px; padding: 12px 30px; font-weight: 600; font-size: 1rem; transition: all 0.3s ease; }
        .btn-primary:hover { background: linear-gradient(135deg, #00bcd4 0%, #00796b 100%); transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); }
        .alert { border-radius: 10px; border: none; }
    </style>
</head>
<body>
    @include('admin.partials.navbar')
    <div class="main-content">
        <div class="container mt-5">
            <div class="form-card mx-auto" style="max-width: 1000px;">
                <h2 class="form-title"><i class="fa fa-graduation-cap me-2"></i>Add Training</h2>
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <form method="POST" action="{{ route('dataentry.add-training.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Year</label>
                            <select class="form-select" name="year" required>
                                <option value="">Select</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Quarter</label>
                            <select class="form-select" name="quarter" required>
                                <option value="">Select</option>
                                @foreach($quarters as $quarter)
                                    <option value="{{ $quarter }}" {{ old('quarter') == $quarter ? 'selected' : '' }}>{{ $quarter }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Training Type</label>
                            <select class="form-select" name="training_type" required>
                                <option value="">Select</option>
                                @foreach($trainingTypes as $type)
                                    <option value="{{ $type }}" {{ old('training_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Training Title</label>
                            <input type="text" class="form-control" name="desc" value="{{ old('desc') }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Component</label>
                            <select class="form-select" name="component" required>
                                <option value="">Select</option>
                                @foreach($components as $component)
                                    <option value="{{ $component->compId }}" {{ old('component') == $component->compId ? 'selected' : '' }}>{{ $component->component_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Subcomponent</label>
                            <select class="form-select" name="subcomponent" required>
                                <option value="">Select</option>
                                @foreach($subcomponents as $subcomponent)
                                    <option value="{{ $subcomponent->subId }}" {{ old('subcomponent') == $subcomponent->subId ? 'selected' : '' }}>{{ $subcomponent->sub_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Implementing Partner (Actor)</label>
                            <select class="form-select" name="actor" required>
                                <option value="">Select</option>
                                @foreach($actors as $actor)
                                    <option value="{{ $actor->Actor_name }}" {{ old('actor') == $actor->Actor_name ? 'selected' : '' }}>{{ $actor->Actor_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Person</label>
                            <select class="form-select" name="person" required>
                                <option value="">Select</option>
                                @foreach($persons as $person)
                                    <option value="{{ $person->Name }}" {{ old('person') == $person->Name ? 'selected' : '' }}>{{ $person->Name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Venue</label>
                            <select class="form-select" name="venue" required>
                                <option value="">Select</option>
                                @foreach($venues as $venue)
                                    <option value="{{ $venue }}" {{ old('venue') == $venue ? 'selected' : '' }}>{{ $venue }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Training Cost</label>
                            <input type="number" step="0.01" class="form-control" name="cost" value="{{ old('cost') }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Total Targeted Beneficiary</label>
                            <input type="number" class="form-control" name="total_target" value="{{ old('total_target') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Total Achieved</label>
                            <input type="number" class="form-control" name="total_acheived" value="{{ old('total_acheived') }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Plan breakdown details</label>
                            <textarea class="form-control" name="plan" rows="2" required>{{ old('plan') }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Achieved breakdown details</label>
                            <textarea class="form-control" name="achis" rows="2" required>{{ old('achis') }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Key Issues</label>
                            <textarea class="form-control" name="key_issue" rows="2" required>{{ old('key_issue') }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Recommendations</label>
                            <textarea class="form-control" name="recommendation" rows="2" required>{{ old('recommendation') }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Remarks</label>
                            <textarea class="form-control" name="rmk" rows="2" required>{{ old('rmk') }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fa fa-save me-2"></i>Save Training Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function() {
    $('select[name="component"]').on('change', function() {
        var componentId = $(this).val();
        var subcomponentSelect = $('select[name="subcomponent"]');
        subcomponentSelect.html('<option value="">Loading...</option>');
        if (componentId) {
            $.ajax({
                url: "{{ route('dataentry.get-subcomponents-training') }}",
                type: 'POST',
                data: {
                    cid: componentId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    subcomponentSelect.html(data);
                },
                error: function() {
                    subcomponentSelect.html('<option value="">Select</option>');
                }
            });
        } else {
            subcomponentSelect.html('<option value="">Select</option>');
        }
    });
});
</script>
</body>
</html> 