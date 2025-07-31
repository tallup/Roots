<style>
    .beneficiary-details {
        font-family: 'PT Sans', sans-serif;
    }
    .section-title {
        color: #00796b;
        font-weight: 600;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e9ecef;
        font-size: 1.1rem;
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
        padding: 10px 15px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
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
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    .status-approved {
        background: #d1edff;
        color: #0c5460;
    }
    .status-reject {
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
    .total-beneficiary {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        font-weight: 600;
        padding: 8px 12px;
        border-radius: 6px;
        display: inline-block;
    }
</style>

<div class="beneficiary-details">
    <div class="row">
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-info-circle me-2"></i>Basic Information
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-hashtag me-2"></i>ID</td>
                        <td>{{ $beneficiary->profile_id }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-calendar me-2"></i>Year</td>
                        <td>{{ $beneficiary->year }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-clock me-2"></i>Quarter</td>
                        <td>{{ $beneficiary->proid }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-map-marker-alt me-2"></i>Region</td>
                        <td>{{ $beneficiary->regid }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-tasks me-2"></i>Activity</td>
                        <td>{{ $beneficiary->activity }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-cogs me-2"></i>Intervention</td>
                        <td>{{ $beneficiary->intervenid }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-layer-group me-2"></i>Component & Indicator Information
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-cube me-2"></i>Component</td>
                        <td>{{ $beneficiary->component_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-cubes me-2"></i>Subcomponent</td>
                        <td>{{ $beneficiary->sub_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-chart-line me-2"></i>Indicator Type</td>
                        <td>{{ $beneficiary->indicator_type ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-chart-bar me-2"></i>Indicator Description</td>
                        <td>{{ $beneficiary->description ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-users me-2"></i>Beneficiary Information
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-user-tag me-2"></i>Beneficiary Type</td>
                        <td>{{ $beneficiary->benid }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-male me-2"></i>Male</td>
                        <td>{{ $beneficiary->male }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-female me-2"></i>Female</td>
                        <td>{{ $beneficiary->female }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-wheelchair me-2"></i>PWD</td>
                        <td>{{ $beneficiary->npwd }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-child me-2"></i>Youth</td>
                        <td>{{ $beneficiary->nyouth }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-users-cog me-2"></i>Total</td>
                        <td><span class="total-beneficiary">{{ $beneficiary->beneficiary_no }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-map-pin me-2"></i>Location & Contact
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-home me-2"></i>Town/Village</td>
                        <td>{{ $beneficiary->community }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-phone me-2"></i>Contact</td>
                        <td>{{ $beneficiary->contact }}</td>
                    </tr>
                </table>
            </div>
            
            <h6 class="section-title mt-4">
                <i class="fa fa-clipboard-check me-2"></i>Status Information
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-user-shield me-2"></i>Supervisor Status</td>
                        <td>
                            <span class="status-badge status-{{ strtolower($beneficiary->status) }}">
                                {{ $beneficiary->status }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-user-cog me-2"></i>Admin Status</td>
                        <td>
                            <span class="status-badge status-{{ strtolower($beneficiary->admstatus) }}">
                                {{ $beneficiary->admstatus }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-user me-2"></i>Added By</td>
                        <td>{{ $beneficiary->added_by_name ?? $beneficiary->addedby ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    @if($beneficiary->rmk)
    <div class="row mt-3">
        <div class="col-12">
            <h6 class="section-title">
                <i class="fa fa-comment me-2"></i>Remarks
            </h6>
            <div class="remarks-box">
                <i class="fa fa-quote-left me-2"></i>{{ $beneficiary->rmk }}
            </div>
        </div>
    </div>
    @endif
</div> 