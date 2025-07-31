<style>
    .training-details {
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
</style>
<div class="training-details">
    <div class="row">
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-info-circle me-2"></i>Basic Information
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr><td><i class="fa fa-hashtag me-2"></i>ID</td><td>{{ $training->train_Id }}</td></tr>
                    <tr><td><i class="fa fa-calendar me-2"></i>Year</td><td>{{ $training->year }}</td></tr>
                    <tr><td><i class="fa fa-clock me-2"></i>Quarter</td><td>{{ $training->proId }}</td></tr>
                    <tr><td><i class="fa fa-graduation-cap me-2"></i>Training Type</td><td>{{ $training->traId }}</td></tr>
                    <tr><td><i class="fa fa-cube me-2"></i>Component</td><td>{{ $training->component_name }}</td></tr>
                    <tr><td><i class="fa fa-cubes me-2"></i>Subcomponent</td><td>{{ $training->sub_name }}</td></tr>
                    <tr><td><i class="fa fa-align-left me-2"></i>Description</td><td>{{ $training->train_desc }}</td></tr>
                </table>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-chart-bar me-2"></i>Training Metrics
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr><td><i class="fa fa-dollar-sign me-2"></i>Cost</td><td>{{ $training->cost }}</td></tr>
                    <tr><td><i class="fa fa-users me-2"></i>Total Targeted</td><td>{{ $training->total_target }}</td></tr>
                    <tr><td><i class="fa fa-user-check me-2"></i>Total Achieved</td><td>{{ $training->total_acheived }}</td></tr>
                    <tr><td><i class="fa fa-map-marker-alt me-2"></i>Venue</td><td>{{ $training->venId }}</td></tr>
                    <tr><td><i class="fa fa-user-tie me-2"></i>Actor</td><td>{{ $training->actorId }}</td></tr>
                    <tr><td><i class="fa fa-user me-2"></i>Person</td><td>{{ $training->personId }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-info me-2"></i>Status Information
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr>
                        <td><i class="fa fa-flag me-2"></i>Status</td>
                        <td>
                            <span class="status-badge status-{{ strtolower($training->status) }}">
                                {{ $training->status }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <h6 class="section-title">
                <i class="fa fa-exclamation-circle me-2"></i>Key Issues & Recommendation
            </h6>
            <div class="info-table">
                <table class="table table-sm">
                    <tr><td><i class="fa fa-exclamation-triangle me-2"></i>Key Issues</td><td>{{ $training->key_issue }}</td></tr>
                    <tr><td><i class="fa fa-lightbulb me-2"></i>Recommendation</td><td>{{ $training->recommendation }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    @if($training->rmk)
    <div class="row mt-3">
        <div class="col-12">
            <h6 class="section-title">
                <i class="fa fa-comment me-2"></i>Remarks
            </h6>
            <div class="remarks-box">
                <i class="fa fa-quote-left me-2"></i>{{ $training->rmk }}
            </div>
        </div>
    </div>
    @endif
</div> 