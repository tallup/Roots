@extends('supervisor.layouts.app')
@section('title', 'Review Contract')
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
        <div class="card-header text-white fw-bold" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); border-radius: 1.25rem 1.25rem 0 0;">Contract Review</div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ route('supervisor.contracts.review.submit', $contract->conId) }}">
                @csrf
                <!-- General Info -->
                <h5 class="mb-3 mt-2 gradient-title">General Information</h5>
                <div class="row mb-3">
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">ID</label>
                        <input type="text" class="form-control" value="{{ $contract->conId }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Year</label>
                        <input type="text" class="form-control" value="{{ $contract->year }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <input type="text" class="form-control" value="{{ $contract->status }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Cost</label>
                        <input type="text" class="form-control" value="{{ number_format($contract->cost, 2) }}" readonly>
                    </div>
                </div>
                <!-- Contract Details -->
                <h5 class="mb-3 mt-4 gradient-title">Contract Details</h5>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Contract Name</label>
                        <input type="text" class="form-control" value="{{ $contract->name }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Component</label>
                        <input type="text" class="form-control" value="{{ $contract->component_name }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Subcomponent</label>
                        <input type="text" class="form-control" value="{{ $contract->sub_name }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Key Issue</label>
                        <input type="text" class="form-control" value="{{ $contract->key_issue }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Recommendation</label>
                        <input type="text" class="form-control" value="{{ $contract->recommendation }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Remark</label>
                        <input type="text" class="form-control" value="{{ $contract->rmk }}" readonly>
                    </div>
                </div>
                <!-- Action Form -->
                <hr>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <input type="text" class="form-control" value="{{ $contract->status }}" readonly>
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
                    <a href="{{ route('supervisor.contracts') }}" class="btn btn-secondary btn-lg">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 