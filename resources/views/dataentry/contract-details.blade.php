<style>
    .contract-details {
        font-family: 'PT Sans', sans-serif;
        font-size: 1.1rem;
    }
    .section-title {
        color: #00796b;
        font-weight: 700;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e9ecef;
        font-size: 1.25rem;
    }
    .info-table {
        background: #f8f9fa;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .info-table .table {
        margin-bottom: 0;
    }
    .info-table .table td {
        padding: 12px 18px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
        font-size: 1.08rem;
    }
    .info-table .table td:first-child {
        font-weight: 600;
        color: #495057;
        background: #f1f3f4;
        width: 40%;
    }
    .info-table .table td:last-child {
        color: #2c3e50;
        background: white;
    }
    .info-table .table tr:last-child td {
        border-bottom: none;
    }
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        text-transform: uppercase;
    }
    .status-Approved {
        background: #d4edda;
        color: #155724;
    }
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    .status-Reject {
        background: #f8d7da;
        color: #721c24;
    }
    .remarks-box {
        background: linear-gradient(135deg, #00796b 0%, #00bcd4 100%);
        color: white;
        border-radius: 10px;
        padding: 15px;
        margin-top: 10px;
    }
</style>

<div class="contract-details">
    <div class="row">
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-info-circle me-2"></i>Basic Information
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-hashtag me-2"></i>Contract ID</td>
                        <td>{{ $contract->conId }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-calendar me-2"></i>Year</td>
                        <td>{{ $contract->year }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-clock me-2"></i>Quarter</td>
                        <td>{{ $contract->proId }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-file-contract me-2"></i>Contract/MOU</td>
                        <td>{{ $contract->name }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-tags me-2"></i>Status</td>
                        <td>
                            <span class="status-badge status-{{ $contract->status }}">
                                {{ $contract->status }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-user me-2"></i>Added By</td>
                        <td>{{ $contract->added_by_name ?? $contract->addedby ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-cubes me-2"></i>Component & Subcomponent
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-cube me-2"></i>Component</td>
                        <td>{{ $contract->component_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-cubes me-2"></i>Subcomponent</td>
                        <td>{{ $contract->sub_name ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-users me-2"></i>Actors & Persons
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-user-tie me-2"></i>Actor</td>
                        <td>{{ $contract->actorId }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-user me-2"></i>Person</td>
                        <td>{{ $contract->personId }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-briefcase me-2"></i>Contract Details
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-handshake me-2"></i>Type Intervention</td>
                        <td>{{ $contract->intervenId }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-file-signature me-2"></i>Contract Type</td>
                        <td>{{ $contract->ctyId }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-money-bill me-2"></i>Cost</td>
                        <td>{{ $contract->cost }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-exclamation-circle me-2"></i>Key Issues
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-exclamation-triangle me-2"></i>Key Issues</td>
                        <td>{{ $contract->key_issue }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-lightbulb me-2"></i>Recommendations
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-lightbulb me-2"></i>Recommendations</td>
                        <td>{{ $contract->recommendation }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @if($contract->rmk)
    <div class="row mt-3">
        <div class="col-12">
            <h6 class="section-title">
                <i class="fa fa-comment me-2"></i>Remarks
            </h6>
            <div class="remarks-box">
                <i class="fa fa-quote-left me-2"></i>{{ $contract->rmk }}
            </div>
        </div>
    </div>
    @endif
</div> 