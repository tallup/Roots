@extends('supervisor.layouts.app')
@section('title', 'Review Beneficiary')
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
        <div class="card-header text-white fw-bold" style="background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); border-radius: 1.25rem 1.25rem 0 0;">Beneficiary Profile Review</div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ route('supervisor.beneficiaries.review.submit', $beneficiary->profile_id) }}">
                @csrf
                <!-- General Info -->
                <h5 class="mb-3 mt-2 gradient-title">General Information</h5>
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">ID</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->profile_id }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Year</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->year }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Quarter</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->proid }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Region</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->regid }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Activity</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->activity }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Intervention</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->intervenid }}" readonly>
                    </div>
                </div>
                <!-- Indicator Info -->
                <h5 class="mb-3 mt-4 gradient-title">Indicator Information</h5>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Component</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->component_name ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Sub Component</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->sub_name ?? '' }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Indicator Type</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->indicator_type ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Indicator Description</label>
                        <textarea class="form-control" rows="2" readonly>{{ $beneficiary->description ?? '' }}</textarea>
                    </div>
                </div>
                <!-- Demographics -->
                <h5 class="mb-3 mt-4 gradient-title">Demographics</h5>
                <div class="row mb-3">
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold"># of PwD</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->npwd ?? '' }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold"># of Youth</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->nyouth ?? '' }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Male</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->male ?? '' }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Female</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->female ?? '' }}" readonly>
                    </div>
                </div>
                <!-- Contact Info -->
                <h5 class="mb-3 mt-4 gradient-title">Contact & Other Info</h5>
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Beneficiary</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->benid }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Total Ben</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->beneficiary_no }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Town/Village</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->community }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Contact</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->contact }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Remarks</label>
                        <textarea class="form-control" rows="2" readonly>{{ $beneficiary->rmk ?? '' }}</textarea>
                    </div>
                </div>
                <!-- Status Info -->
                <h5 class="mb-3 mt-4 gradient-title">Status</h5>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Supervisor Status</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->status }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Admin Status</label>
                        <input type="text" class="form-control" value="{{ $beneficiary->admstatus }}" readonly>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="status" class="form-label">Action <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">-- Select Action --</option>
                            <option value="Approve">Approve</option>
                            <option value="Reject">Reject</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="sup_revw" class="form-label">Supervisor Review <span class="text-danger">*</span></label>
                        <textarea name="sup_revw" id="sup_revw" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-lg me-2" style="min-width:200px; background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%); color: #fff; border: none;">Submit</button>
                    <a href="{{ route('supervisor.beneficiaries') }}" class="btn btn-secondary btn-lg">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 