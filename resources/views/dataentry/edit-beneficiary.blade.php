<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Beneficiary - Data Entry - ROOTS</title>
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
        .form-check-input:checked {
            background-color: #00796b;
            border-color: #00796b;
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
                    <i class="fa fa-edit me-2"></i>Edit Beneficiary Performance Monitoring
                </h2>

                <form method="POST" action="{{ route('dataentry.edit-beneficiary.update', $beneficiary->profile_id) }}" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Year and Quarter -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="year" class="form-label required">Year</label>
                            <select class="form-select" id="year" name="year" required>
                                <option value="">Choose Year</option>
                                @for($i = 2020; $i <= 2030; $i++)
                                    <option value="{{ $i }}" {{ old('year', $beneficiary->year ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="qrts" class="form-label required">Quarter</label>
                            <select class="form-select" id="qrts" name="qrts" required>
                                <option value="">Select Quarter</option>
                                @foreach($projectFreq as $freq)
                                    <option value="{{ $freq->Rep_frequency }}" {{ old('qrts', $beneficiary->proid ?? '') == $freq->Rep_frequency ? 'selected' : '' }}>
                                        {{ $freq->Rep_frequency }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Region and Intervention -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="region" class="form-label required">Region</label>
                            <select class="form-select" id="region" name="region" required>
                                <option value="">Select Region</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->region_name }}" {{ old('region', $beneficiary->regid ?? '') == $region->region_name ? 'selected' : '' }}>
                                        {{ $region->region_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="interven" class="form-label required">Intervention Type</label>
                            <select class="form-select" id="interven" name="interven" required>
                                <option value="">Select Intervention</option>
                                @foreach($interventions as $intervention)
                                    <option value="{{ $intervention->intervention_type }}" {{ old('interven', $beneficiary->intervenid ?? '') == $intervention->intervention_type ? 'selected' : '' }}>
                                        {{ $intervention->intervention_type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Component and Subcomponent -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="country" class="form-label required">Component</label>
                            <select class="form-select" name="country" id="country" required>
                                <option value="">Select Component</option>
                                @foreach($components as $component)
                                    <option value="{{ $component->compId }}" {{ old('country', $beneficiary->comp ?? '') == $component->compId ? 'selected' : '' }}>
                                        {{ $component->component_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="state" class="form-label required">Subcomponent</label>
                            <select class="form-select" name="state" id="state" required>
                                <option value="">Select Subcomponent</option>
                            </select>
                        </div>
                    </div>

                    <!-- Indicator Type and Description -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="countryI" class="form-label required">Indicator Type</label>
                            <select class="form-select" name="countryI" id="countryI" required>
                                <option value="">Select Indicator Type</option>
                                @foreach($indicators as $indicator)
                                    <option value="{{ $indicator->indicatorId }}" {{ old('countryI', $beneficiary->ind ?? '') == $indicator->indicatorId ? 'selected' : '' }}>
                                        {{ $indicator->indicator_type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="stateI" class="form-label required">Indicator Description</label>
                            <select class="form-select" name="stateI" id="stateI" required>
                                <option value="">Select Indicator Description</option>
                            </select>
                        </div>
                    </div>

                    <!-- Community and Contact -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="community" class="form-label required">Town/Village</label>
                            <input type="text" class="form-control" name="community" id="community" 
                                   placeholder="Enter town/village" value="{{ old('community', $beneficiary->community ?? '') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="person" class="form-label required">Contact Person & Phone#</label>
                            <input type="text" class="form-control" name="person" id="person" 
                                   placeholder="Enter contact person and phone" value="{{ old('person', $beneficiary->contact ?? '') }}" required>
                        </div>
                    </div>

                    <!-- Beneficiary Type -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="form-label">Beneficiary Type</label>
                            <div class="row">
                                @php
                                    $benTypes = explode(' ', $beneficiary->benid ?? '');
                                @endphp
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="benw" name="benw" value="women" 
                                               {{ in_array('women', $benTypes) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="benw">Women</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="beny" name="beny" value="youth" 
                                               {{ in_array('youth', $benTypes) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="beny">Youth</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="bena" name="bena" value="kafoos" 
                                               {{ in_array('kafoos', $benTypes) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bena">Kafoos</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="pwd" name="pwd" value="PwD" 
                                               {{ in_array('PwD', $benTypes) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pwd">PwD</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="sme" name="sme" value="SME" 
                                               {{ in_array('SME', $benTypes) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sme">SME</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PWD and Youth Numbers -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="npwd" class="form-label"># of PwD</label>
                            <input type="number" class="form-control" name="npwd" id="npwd" 
                                   placeholder="Enter number" value="{{ old('npwd', $beneficiary->npwd ?? '') }}" onkeyup="sum()">
                        </div>
                        <div class="col-md-6">
                            <label for="nyouth" class="form-label"># of Youth</label>
                            <input type="number" class="form-control" name="nyouth" id="nyouth" 
                                   placeholder="Enter number" value="{{ old('nyouth', $beneficiary->nyouth ?? '') }}" onkeyup="sum()">
                        </div>
                    </div>

                    <!-- Male and Female Numbers -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="male" class="form-label required"># of Male</label>
                            <input type="number" class="form-control" name="male" id="male" 
                                   placeholder="Enter number" value="{{ old('male', $beneficiary->male ?? '') }}" onkeyup="sum()" required>
                        </div>
                        <div class="col-md-6">
                            <label for="female" class="form-label required"># of Female</label>
                            <input type="number" class="form-control" name="female" id="female" 
                                   placeholder="Enter number" value="{{ old('female', $beneficiary->female ?? '') }}" onkeyup="sum()" required>
                        </div>
                    </div>

                    <!-- Total Beneficiary and File Upload -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="number" class="form-label required">Total Beneficiary</label>
                            <input type="text" class="form-control" name="number" id="number" 
                                   placeholder="Total" value="{{ old('number', $beneficiary->beneficiary_no ?? '') }}" readonly required>
                        </div>
                        <div class="col-md-6">
                            <label for="profile" class="form-label">Upload File</label>
                            <input type="file" class="form-control" name="profile" id="profile" 
                                   accept="image/*,application/pdf">
                            <small class="form-text text-muted">Accepted formats: JPG, PNG, GIF, PDF (Max: 2MB)</small>
                            @if(isset($beneficiary->add_profile) && $beneficiary->add_profile)
                                <div class="mt-2">
                                    <small class="text-muted">Current file: {{ $beneficiary->add_profile }}</small>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Activity -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <label for="activity_id" class="form-label required">Activity</label>
                            <select class="form-select" name="activity_id" id="activity_id" required>
                                <option value="">Select Activity</option>
                                @foreach($activities as $activity)
                                    <option value="{{ $activity->activity_id }}" {{ old('activity_id', $beneficiary->activity_id ?? '') == $activity->activity_id ? 'selected' : '' }}>
                                        {{ $activity->activity_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Remarks -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <label for="rmk" class="form-label required">Remarks</label>
                            <input type="text" class="form-control" name="rmk" id="rmk" 
                                   placeholder="Enter remarks" value="{{ old('rmk', $beneficiary->rmk ?? '') }}" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-lg" name="submit" id="submit">
                                <i class="fa fa-save me-2"></i>Update Beneficiary Data
                            </button>
                            <a href="{{ route('dataentry.beneficiaries') }}" class="btn btn-outline-secondary btn-lg ms-3">
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
        // Store Blade variables in JavaScript variables
        var beneficiaryData = {
            subComp: '{{ $beneficiary->SubComp ?? "" }}',
            indtyp: '{{ $beneficiary->indtyp ?? "" }}',
            ind: '{{ $beneficiary->ind ?? "" }}',
            comp: '{{ $beneficiary->comp ?? "" }}'
        };

        function sum() {
            var femaleValue = document.getElementById('female').value;
            var maleValue = document.getElementById('male').value;
            var pwdValue = document.getElementById('npwd').value;
            var nyouthValue = document.getElementById('nyouth').value;

            var femaleNum = parseInt(femaleValue) || 0;
            var maleNum = parseInt(maleValue) || 0;
            var pwdNum = parseInt(pwdValue) || 0;
            var nyouthNum = parseInt(nyouthValue) || 0;

            var totalResult = femaleNum + maleNum + pwdNum + nyouthNum;
            document.getElementById('number').value = totalResult;
        }

        // Component to Subcomponent AJAX
        $(document).ready(function() {
            $('#country').change(function() {
                var country_id = $(this).val();
                $("#state > option").remove();
                $("#state").append('<option value="">Select Subcomponent</option>');
                
                if (country_id) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('dataentry.get-subcomponents') }}",
                        data: {
                            cid: country_id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(opt) {
                            $('#state').html(opt);
                            // Set the correct subcomponent value
                            if (beneficiaryData.subComp) {
                                $('#state').val(beneficiaryData.subComp);
                            }
                        }
                    });
                }
            });

            // Indicator Type to Description AJAX
            $('#countryI').change(function() {
                var country_id = $(this).val();
                $("#stateI > option").remove();
                $("#stateI").append('<option value="">Select Indicator Description</option>');
                
                if (country_id) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('dataentry.get-indicator-descriptions') }}",
                        data: {
                            cid: country_id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(opt) {
                            $('#stateI').html(opt);
                            // Set the correct indicator description value
                            if (beneficiaryData.indtyp) {
                                $('#stateI').val(beneficiaryData.indtyp);
                            }
                        }
                    });
                }
            });

            // Load initial data for edit form
            if (beneficiaryData.comp) {
                $('#country').trigger('change');
            }
            
            // Set indicator type value directly if available
            if (beneficiaryData.ind) {
                $('#countryI').val(beneficiaryData.ind);
                $('#countryI').trigger('change');
            }
        });
    </script>
</body>
</html> 