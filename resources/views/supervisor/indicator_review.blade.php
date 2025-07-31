@extends('supervisor.layouts.app')
@section('title', 'Review Indicator')
@section('content')
<style>
    .gradient-title {
        background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        /* text-fill-color: transparent; */
        font-weight: bold;
    }
</style>
<div class="container py-4">
    <div class="card shadow-lg mb-4" style="border-radius: 1.25rem;">
        <div class="card-header text-white fw-bold" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); border-radius: 1.25rem 1.25rem 0 0;">Indicator Review</div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ route('supervisor.indicators.review.submit', $indicator->indicator_id) }}">
                @csrf
                <!-- General Info -->
                <h5 class="mb-3 mt-2 gradient-title">General Information</h5>
                <div class="row mb-3">
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">ID</label>
                        <input type="text" class="form-control" value="{{ $indicator->indicator_id }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Year</label>
                        <input type="text" class="form-control" value="{{ $indicator->year }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <input type="text" class="form-control" value="{{ $indicator->status }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Category</label>
                        <input type="text" class="form-control" value="{{ $indicator->icat }}" readonly>
                    </div>
                </div>
                <!-- Indicator Details -->
                <h5 class="mb-3 mt-4 gradient-title">Indicator Details</h5>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Indicator Type</label>
                        <input type="text" class="form-control" value="{{ $indicator->indicator_type }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea class="form-control" rows="2" readonly>{{ $indicator->description }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Baseline</label>
                        <input type="text" class="form-control" value="{{ $indicator->baseline }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Target</label>
                        <input type="text" class="form-control" value="{{ $indicator->target }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Achieved</label>
                        <input type="text" class="form-control" value="{{ $indicator->acheived }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">% Achievement</label>
                        <input type="text" class="form-control" value="{{ $indicator->acheivement }}%" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Measurement</label>
                        <input type="text" class="form-control" value="{{ $indicator->measuId }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Frequency</label>
                        <input type="text" class="form-control" value="{{ $indicator->data }}" readonly>
                    </div>
                </div>
                <!-- Remarks & Supervisor Review -->
                <h5 class="mb-3 mt-4 gradient-title">Remarks</h5>
                <div class="row mb-3">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Remarks</label>
                        <textarea class="form-control" rows="2" readonly>{{ $indicator->rmk }}</textarea>
                    </div>
                </div>
                <!-- Action Form -->
                <hr>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <input type="text" class="form-control" value="{{ $indicator->status }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Action <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">-- Select Action --</option>
                            <option value="Approve">Approve</option>
                            <option value="Reject">Reject</option>
                        </select>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-lg me-2" style="min-width:200px; background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: #fff; border: none;">Submit</button>
                    <a href="{{ route('supervisor.indicators') }}" class="btn btn-secondary btn-lg">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 