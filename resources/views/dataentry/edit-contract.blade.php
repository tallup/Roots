<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contract Performance - ROOTS Data Entry</title>
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
        .form-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 30px;
        }
        .form-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-label {
            color: #495057;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #00796b;
            box-shadow: 0 0 0 0.2rem rgba(0, 121, 107, 0.15);
        }
        .btn-primary {
            background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #00bcd4 0%, #00796b 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .required::after {
            content: " *";
            color: #dc3545;
        }
    </style>
</head>
<body>
    @include('dataentry.partials.navbar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="form-card">
                <h2 class="form-title">
                    <i class="fa fa-file-contract me-2"></i>Edit Contract/MOU Performance
                </h2>
                <form method="POST" action="{{ route('dataentry.edit-contract.update', $contract->conId) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="year" class="form-label required">Year</label>
                            <select class="form-select" id="year" name="year" required>
                                <option value="">Choose Year</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}" {{ $contract->year == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="quarter" class="form-label required">Quarter</label>
                            <select class="form-select" id="quarter" name="quarter" required>
                                <option value="">Choose Quarter</option>
                                @foreach($quarters as $quarter)
                                    <option value="{{ $quarter }}" {{ $contract->proId == $quarter ? 'selected' : '' }}>{{ $quarter }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="component" class="form-label required">Component</label>
                            <select class="form-select" id="component" name="component" required>
                                <option value="">Select Component</option>
                                @foreach($components as $component)
                                    <option value="{{ $component->compId }}" {{ $contract->compId == $component->compId ? 'selected' : '' }}>{{ $component->component_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="subcomponent" class="form-label required">Subcomponent</label>
                            <select class="form-select" id="subcomponent" name="subcomponent" required>
                                <option value="">Select Subcomponent</option>
                                @foreach($subcomponents as $subcomponent)
                                    <option value="{{ $subcomponent->subId }}" {{ $contract->subId == $subcomponent->subId ? 'selected' : '' }}>{{ $subcomponent->sub_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="actor" class="form-label required">Implementing Partner (Actor)</label>
                            <select class="form-select" id="actor" name="actor" required>
                                <option value="">Select Actor</option>
                                @foreach($actors as $actor)
                                    <option value="{{ $actor->Actor_name }}" {{ $contract->actorId == $actor->Actor_name ? 'selected' : '' }}>{{ $actor->Actor_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="person" class="form-label required">Person</label>
                            <select class="form-select" id="person" name="person" required>
                                <option value="">Select Person</option>
                                @foreach($persons as $person)
                                    <option value="{{ $person->personId }}"
                                        {{ (old('person', $contract->personId) == $person->personId) ? 'selected' : '' }}>
                                        {{ $person->Name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="intervention" class="form-label required">Type Intervention</label>
                            <select class="form-select" id="intervention" name="intervention" required>
                                <option value="">Select Intervention</option>
                                @foreach($interventions as $intervention)
                                    <option value="{{ $intervention->intervention_type }}" {{ $contract->intervenId == $intervention->intervention_type ? 'selected' : '' }}>{{ $intervention->intervention_type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="contract_type" class="form-label required">Contract Type</label>
                            <select class="form-select" id="contract_type" name="contract_type" required>
                                <option value="">Select Contract Type</option>
                                @foreach($contractTypes as $type)
                                    <option value="{{ $type }}" {{ $contract->ctyId == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="status" class="form-label required">Status of Contract</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="">Select Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->stuId }}" {{ (old('status', $contract->stuId) == $status->stuId) ? 'selected' : '' }}>{{ $status->activ_status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label required">Contract/MOU Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $contract->name }}" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="cost" class="form-label required">Result Area Cost</label>
                            <input type="number" class="form-control" id="cost" name="cost" value="{{ $contract->cost }}" step="0.01" required>
                        </div>
                        <div class="col-md-6">
                            <label for="key_issue" class="form-label required">Key Issues</label>
                            <textarea class="form-control" id="key_issue" name="key_issue" rows="2" required>{{ $contract->key_issue }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="recommendation" class="form-label required">Recommendation</label>
                            <textarea class="form-control" id="recommendation" name="recommendation" rows="3" required>{{ $contract->recommendation }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="remarks" class="form-label required">Remarks</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="3" required>{{ $contract->rmk }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-lg" name="submit" id="submit">
                                <i class="fa fa-save me-2"></i>Update Contract Performance
                            </button>
                            <a href="{{ route('dataentry.contracts') }}" class="btn btn-outline-secondary btn-lg ms-3">
                                <i class="fa fa-times me-2"></i>Cancel
                            </a>
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
    function loadSubcomponents(componentId, selectedSubId = null) {
        if (!componentId) {
            $('#subcomponent').html('<option value="">Select Subcomponent</option>');
            return;
        }
        $.ajax({
            url: "{{ route('dataentry.get-subcomponents') }}",
            type: 'POST',
            data: {
                cid: componentId,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                $('#subcomponent').html(data);
                if (selectedSubId) {
                    $('#subcomponent').val(selectedSubId);
                }
            }
        });
    }

    // On component change
    $('#component').on('change', function() {
        loadSubcomponents($(this).val());
    });

    // On page load, prefill if editing
    var initialComponent = $('#component').val();
    var initialSubcomponent = '{{ $contract->subId }}';
    if (initialComponent) {
        loadSubcomponents(initialComponent, initialSubcomponent);
    }
});
</script>
</body>
</html> 