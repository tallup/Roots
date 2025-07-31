@extends('finance.layouts.app')
@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-10">
        <div class="card shadow-lg border-0" style="border-radius: 1.25rem;">
            <div class="card-header text-white fw-bold" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); border-radius: 1.25rem 1.25rem 0 0;">
                Edit Disbursement
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('finance.disbursements.update', $disbursement->disburs_id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Year</label>
                            <select name="year" class="form-control" required>
                                <option value="">Select Year</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}" {{ $disbursement->year == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Quarter</label>
                            <select name="quarter" class="form-control" required>
                                <option value="">Select Quarter</option>
                                @foreach($quarters as $key => $val)
                                    <option value="{{ $key }}" {{ $disbursement->quarter == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Disbursement Source</label>
                            <select name="disburs_source" class="form-control" required>
                                <option value="">Select Source</option>
                                @foreach($sources as $src)
                                    <option value="{{ $src }}" {{ $disbursement->disburs_source == $src ? 'selected' : '' }}>{{ $src }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Component Name</label>
                            <select name="comp_id" class="form-control" id="componentSelect" required>
                                <option value="">Select Component</option>
                                @foreach($components as $comp)
                                    <option value="{{ $comp->compId }}" {{ $disbursement->comp_id == $comp->compId ? 'selected' : '' }}>{{ $comp->component_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sub-component Name</label>
                            <select name="subcomp" class="form-control" id="subcomponentSelect" required>
                                <option value="">Select Sub-component</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Component 3</label>
                            <input type="text" name="comp_three" class="form-control" value="{{ $disbursement->comp_three }}" placeholder="Component 3 (if any)">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Total Budget ($USD)</label>
                            <input type="number" step="0.01" min="0" name="total_budjet" id="total_budget" class="form-control" value="{{ $disbursement->total_budjet }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Quarter Target ($USD)</label>
                            <input type="number" step="0.01" min="0" name="querter_taeget" class="form-control" value="{{ $disbursement->querter_taeget }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Actual ($USD)</label>
                            <input type="number" step="0.01" min="0" name="actual" id="actual" class="form-control" value="{{ $disbursement->actual }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Commitment ($USD)</label>
                            <input type="number" step="0.01" min="0" name="commit" id="commit" class="form-control" value="{{ $disbursement->commit }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Performance ($USD)</label>
                            <input type="number" step="0.01" min="0" name="perfor" id="perfor" class="form-control" value="{{ $disbursement->perfor }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Execution (%)</label>
                            <input type="number" step="0.01" min="0" name="execu" id="execu" class="form-control" value="{{ $disbursement->execu }}" readonly>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn px-4" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: #fff; border: none;">Update</button>
                        <a href="{{ route('finance.disbursements.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#componentSelect').on('change', function() {
    var compId = $(this).val();
    $('#subcomponentSelect').html('<option value="">Loading...</option>');
    if(compId) {
        $.post("{{ route('finance.disbursements.loadSubcomponents') }}", {cid: compId, _token: '{{ csrf_token() }}'}, function(data) {
            $('#subcomponentSelect').html(data);
        });
    } else {
        $('#subcomponentSelect').html('<option value="">Select Sub-component</option>');
    }
});
// Pre-select subcomponent if editing
$(document).ready(function() {
    var compId = $('#componentSelect').val();
    var selectedSub = '{{ $disbursement->subcomp }}';
    if(compId) {
        $.post("{{ route('finance.disbursements.loadSubcomponents') }}", {cid: compId, _token: '{{ csrf_token() }}'}, function(data) {
            $('#subcomponentSelect').html(data);
            $('#subcomponentSelect').val(selectedSub);
        });
    }
});
function calcPerfExec() {
    const actual = parseFloat(document.getElementById('actual').value) || 0;
    const commit = parseFloat(document.getElementById('commit').value) || 0;
    const total_budget = parseFloat(document.getElementById('total_budget').value) || 0;
    document.getElementById('perfor').value = (actual + commit).toFixed(2);
    document.getElementById('execu').value = total_budget > 0 ? ((actual / total_budget) * 100).toFixed(2) : '';
}
document.getElementById('actual').addEventListener('input', calcPerfExec);
document.getElementById('commit').addEventListener('input', calcPerfExec);
document.getElementById('total_budget').addEventListener('input', calcPerfExec);
</script>
@endsection 