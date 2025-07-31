<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Communities reached
        $comm = DB::table('beneficiary_profile')->distinct('community_name')->count('community_name');

        // Households reached
        $totalHouseholds = DB::table('beneficiary_profile')->sum('households');

        // Total beneficiaries reached (8 x households)
        $totalBeneficiaries = $totalHouseholds * 8;

        // Training by gender
        $maleTrained = DB::table('train')->sum('male_trained');
        $femaleTrained = DB::table('train')->sum('female_trained');

        // Total people trained
        $totalTrained = DB::table('train')->sum('total_acheived');

        // Total indicators
        $totalIndi = DB::table('indication_profile')->count();

        // Total interventions
        $totalI = DB::table('intervention')->count();

        // Unique interventions
        $totalUI = DB::table('contract_performance')->distinct('intervention_id')->count('intervention_id');

        // Intervention cost
        $totalInterventionCost = DB::table('contract_performance')->sum('cost');

        // Regions
        $regions = DB::table('region')->pluck('region_name');

        // Gender base region stats
        $regionStats = [
            'North Bank Region' => [
                'male' => DB::table('beneficiary_profile')->where('regid', 'LIKE', '%North Bank Region%')->sum('male'),
                'female' => DB::table('beneficiary_profile')->where('regid', 'LIKE', '%North Bank Region%')->sum('female'),
            ],
            'West Coast Region' => [
                'male' => DB::table('beneficiary_profile')->where('regid', 'LIKE', '%West Coast Region%')->sum('male'),
                'female' => DB::table('beneficiary_profile')->where('regid', 'LIKE', '%West Coast Region%')->sum('female'),
            ],
            'Lower River Region' => [
                'male' => DB::table('beneficiary_profile')->where('regid', 'LIKE', '%Lower River Region%')->sum('male'),
                'female' => DB::table('beneficiary_profile')->where('regid', 'LIKE', '%Lower River Region%')->sum('female'),
            ],
            'Central River Region-North' => [
                'male' => DB::table('beneficiary_profile')->where('regid', 'LIKE', '%Central River Region-North%')->sum('male'),
                'female' => DB::table('beneficiary_profile')->where('regid', 'LIKE', '%Central River Region-North%')->sum('female'),
            ],
            'Upper River Region' => [
                'male' => DB::table('beneficiary_profile')->where('regid', 'LIKE', '%Upper River Region%')->sum('male'),
                'female' => DB::table('beneficiary_profile')->where('regid', 'LIKE', '%Upper River Region%')->sum('female'),
            ],
            'Central River Region-South' => [
                'male' => DB::table('beneficiary_profile')->where('regid', 'LIKE', '%Central River Region-South%')->sum('male'),
                'female' => DB::table('beneficiary_profile')->where('regid', 'LIKE', '%Central River Region-South%')->sum('female'),
            ],
        ];

        return view('analytics.index', compact(
            'comm',
            'totalHouseholds',
            'totalBeneficiaries',
            'maleTrained',
            'femaleTrained',
            'totalTrained',
            'totalIndi',
            'totalI',
            'totalUI',
            'totalInterventionCost',
            'regions',
            'regionStats'
        ));
    }
}
