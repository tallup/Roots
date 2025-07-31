<style>
    .indicator-details {
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
    .achievement-badge {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        font-weight: 600;
        padding: 8px 12px;
        border-radius: 6px;
        display: inline-block;
    }
    .achievement-warning {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        color: white;
        font-weight: 600;
        padding: 8px 12px;
        border-radius: 6px;
        display: inline-block;
    }
    .achievement-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        font-weight: 600;
        padding: 8px 12px;
        border-radius: 6px;
        display: inline-block;
    }
</style>

<div class="indicator-details">
    <div class="row">
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-info-circle me-2"></i>Basic Information
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-hashtag me-2"></i>Indicator ID</td>
                        <td>{{ $indicator->indicator_id }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-calendar me-2"></i>Year</td>
                        <td>{{ $indicator->year }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-clock me-2"></i>Quarter</td>
                        <td>{{ $indicator->proId }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-chart-line me-2"></i>Indicator Type</td>
                        <td>{{ $indicator->indicator_type }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-chart-bar me-2"></i>Description</td>
                        <td>{{ $indicator->description }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-tags me-2"></i>Category</td>
                        <td>{{ $indicator->icat }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-chart-pie me-2"></i>Performance Metrics
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-bullseye me-2"></i>Baseline</td>
                        <td>{{ $indicator->baseline }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-target me-2"></i>Target</td>
                        <td>{{ number_format($indicator->target) }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-check-circle me-2"></i>Achieved</td>
                        <td>{{ number_format($indicator->acheived) }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-percentage me-2"></i>Achievement %</td>
                        <td>
                            @php
                                $achievementClass = $indicator->acheivement >= 100 ? 'achievement-badge' : 
                                    ($indicator->acheivement >= 80 ? 'achievement-warning' : 'achievement-danger');
                            @endphp
                            <span class="{{ $achievementClass }}">
                                {{ number_format($indicator->acheivement, 2) }}%
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-ruler me-2"></i>Measurement</td>
                        <td>{{ $indicator->measuId }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-calendar-alt me-2"></i>Frequency</td>
                        <td>{{ $indicator->data }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-clipboard-list me-2"></i>Breakdown Information
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-tasks me-2"></i>Breakdown Plan</td>
                        <td>{{ $indicator->comment ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-check-double me-2"></i>Breakdown Achieved</td>
                        <td>{{ $indicator->commentAc ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-clipboard-check me-2"></i>Status Information
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-user-shield me-2"></i>Status</td>
                        <td>
                            <span class="status-badge status-{{ strtolower(trim($indicator->status)) }}">
                                {{ $indicator->status ?? 'pending' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-user me-2"></i>Added By</td>
                        <td>{{ $indicator->added_by_name ?? $indicator->addedby ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    @if($indicator->rmk)
    <div class="row mt-3">
        <div class="col-12">
            <h6 class="section-title">
                <i class="fa fa-comment me-2"></i>Remarks
            </h6>
            <div class="remarks-box">
                <i class="fa fa-quote-left me-2"></i>{{ $indicator->rmk }}
            </div>
        </div>
    </div>
    @endif
</div> 