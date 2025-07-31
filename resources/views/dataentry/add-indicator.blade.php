<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Indicator - Data Entry - ROOTS</title>
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
        .section-title {
            color: #00796b;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
        }
        .required::after {
            content: " *";
            color: #dc3545;
        }
    </style>
</head>
<body>
    @include('admin.partials.navbar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <!-- Hidden data for JavaScript -->
            <div id="indicator-data" data-descriptions='@json($indicatorDescriptions)' style="display: none;"></div>
            
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
                    <i class="fa fa-chart-line me-2"></i>Indicator Performance Monitoring
                </h2>

                <form method="POST" action="{{ route('dataentry.add-indicator.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Year and Quarter -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="year" class="form-label required">Year</label>
                            <select class="form-select" id="year" name="year" required>
                                <option value="">Choose Year</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="quarter" class="form-label required">Quarter</label>
                            <select class="form-select" id="quarter" name="quarter" required>
                                <option value="">Choose Quarter</option>
                                @foreach($quarters as $quarter)
                                    <option value="{{ $quarter }}" {{ old('quarter') == $quarter ? 'selected' : '' }}>{{ $quarter }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Indicator Type and Description -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="indicator_type" class="form-label required">Indicator Type</label>
                            <select class="form-select" id="indicator_type" name="indicator_type" required>
                                <option value="">Select Indicator Type</option>
                                @foreach($indicatorTypes as $type)
                                    <option value="{{ $type->indicatorId }}" {{ old('indicator_type') == $type->indicatorId ? 'selected' : '' }}>
                                        {{ $type->indicator_type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="indicator_description" class="form-label required">Indicator Description</label>
                            <select class="form-select" id="indicator_description" name="indicator_description" required>
                                <option value="">Select Indicator Description</option>
                            </select>
                        </div>
                    </div>

                    <!-- Category and Measurement -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="category" class="form-label required">Indicator Category</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="">Select Category</option>
                                @foreach($indicatorCategories as $category)
                                    <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="measurement" class="form-label required">Measurement Unit</label>
                            <select class="form-select" id="measurement" name="measurement" required>
                                <option value="">Select Measurement Unit</option>
                                @foreach($measurements as $measurement)
                                    <option value="{{ $measurement }}" {{ old('measurement') == $measurement ? 'selected' : '' }}>{{ $measurement }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Baseline, Target, and Achieved -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="baseline" class="form-label required">Baseline</label>
                            <input type="text" class="form-control" id="baseline" name="baseline" 
                                   placeholder="Enter baseline value" value="{{ old('baseline', '200') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="target" class="form-label required">Targeted Value</label>
                            <input type="number" class="form-control" id="target" name="target" 
                                   placeholder="Enter target value" value="{{ old('target') }}" step="0.01" required>
                        </div>
                        <div class="col-md-4">
                            <label for="achieved" class="form-label required">Achieved Value</label>
                            <input type="number" class="form-control" id="achieved" name="achieved" 
                                   placeholder="Enter achieved value" value="{{ old('achieved') }}" step="0.01" required>
                        </div>
                    </div>

                    <!-- Achievement Percentage and Frequency -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="achievement_percentage" class="form-label">% Achievement</label>
                            <input type="number" class="form-control" id="achievement_percentage" name="achievement_percentage" 
                                   placeholder="Calculated automatically" value="{{ old('achievement_percentage') }}" step="0.01" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="frequency" class="form-label required">Freq Data Collection</label>
                            <select class="form-select" id="frequency" name="frequency" required>
                                <option value="">Choose</option>
                                @foreach($dataFrequencies as $frequency)
                                    <option value="{{ $frequency }}" {{ old('frequency') == $frequency ? 'selected' : '' }}>{{ $frequency }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Indicator Breakdown Plan and Achieved -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="indicator_breakdown_plan" class="form-label required">Indicator Breakdown Plan</label>
                            <textarea class="form-control" id="indicator_breakdown_plan" name="indicator_breakdown_plan" rows="3" 
                                      placeholder="Enter" required>{{ old('indicator_breakdown_plan') }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="indicator_breakdown_achieved" class="form-label required">Indicator Breakdown Achieved</label>
                            <textarea class="form-control" id="indicator_breakdown_achieved" name="indicator_breakdown_achieved" rows="3" 
                                      placeholder="Enter" required>{{ old('indicator_breakdown_achieved') }}</textarea>
                        </div>
                    </div>

                    <!-- Remarks -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <label for="remarks" class="form-label required">Remarks</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="3" 
                                      placeholder="Enter" required>{{ old('remarks') }}</textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-lg" name="submit" id="submit">
                                <i class="fa fa-save me-2"></i>Add Indicator Data
                            </button>
                            <a href="{{ route('dataentry.indicators') }}" class="btn btn-outline-secondary btn-lg ms-3">
                                <i class="fa fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <script>
        // Store indicator descriptions data from Blade
        var indicatorDescriptions = JSON.parse(document.getElementById('indicator-data').getAttribute('data-descriptions'));

        // Calculate achievement percentage
        function calculateAchievement() {
            var target = parseFloat($('#target').val()) || 0;
            var achieved = parseFloat($('#achieved').val()) || 0;
            
            if (target > 0) {
                var percentage = (achieved / target) * 100;
                $('#achievement_percentage').val(percentage.toFixed(3));
            } else {
                $('#achievement_percentage').val('');
            }
        }

        // Handle indicator type change
        $('#indicator_type').change(function() {
            var selectedType = $(this).val();
            var $descriptionSelect = $('#indicator_description');
            
            // Clear current options
            $descriptionSelect.html('<option value="">Select Indicator Description</option>');
            
            if (selectedType) {
                // Filter descriptions by selected type
                var filteredDescriptions = indicatorDescriptions.filter(function(desc) {
                    return desc.indi_id == selectedType;
                });
                
                // Add filtered options
                filteredDescriptions.forEach(function(desc) {
                    $descriptionSelect.append(
                        $('<option></option>').val(desc.descid).text(desc.description)
                    );
                });
            }
        });

        // Calculate achievement when target or achieved changes
        $('#target, #achieved').on('input', calculateAchievement);

        // Initialize calculation on page load
        $(document).ready(function() {
            calculateAchievement();
        });
    </script>
</body>
</html> still the person dropdown is not showing
