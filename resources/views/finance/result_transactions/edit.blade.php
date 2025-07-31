@extends('finance.layouts.app')
@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-10">
        <div class="card shadow-lg border-0" style="border-radius: 1.25rem;">
            <div class="card-header text-white fw-bold" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); border-radius: 1.25rem 1.25rem 0 0;">
                Update Disbursement Figures
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
                <form method="POST" action="{{ route('finance.result-transactions.update', $row->subid) }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Component Description</label>
                            <input type="text" class="form-control" name="comp" value="{{ $row->component_desc }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Subcomponent Description</label>
                            <input type="text" class="form-control" name="compsub" value="{{ $row->sub_desc }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Allocation</label>
                            <input type="text" class="form-control" name="allo" value="{{ $row->sub_allocation }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Allocation Balance</label>
                            <input type="text" class="form-control" name="allobal" id="allobal" value="{{ $row->sub_allocation_balance }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Component Allocation Balance</label>
                            <input type="text" class="form-control" name="cbalance" id="cbalance" value="{{ $row->C_allocation_balance }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Year</label>
                            <select class="form-control" name="year" required>
                                <option value="">Choose</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Quarter</label>
                            <select class="form-control" name="qrts" required>
                                <option value="">Select</option>
                                @foreach($quarters as $q)
                                    <option value="{{ $q }}">{{ $q }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Output</label>
                            <select class="form-control" name="outp" required>
                                <option value="">Select</option>
                                @foreach($outputs as $out)
                                    <option value="{{ $out }}">{{ $out }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Output Amount</label>
                            <input type="number" class="form-control" name="oamt" id="oamt" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Balance</label>
                            <input type="number" class="form-control" name="bal" id="bal" readonly>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn px-4" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: #fff; border: none;">Update Transaction</button>
                        <a href="{{ route('finance.result-transactions.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#oamt').on('input', function() {
    var allobal = parseFloat($('#allobal').val()) || 0;
    var oamt = parseFloat($('#oamt').val()) || 0;
    var cbalance = parseFloat($('#cbalance').val()) || 0;
    var bal = allobal - oamt;
    var cbal = cbalance - oamt;
    if (!isNaN(bal)) {
        $('#bal').val(bal);
        $('#cbalance').val(cbal);
    }
});
</script>
@endsection 