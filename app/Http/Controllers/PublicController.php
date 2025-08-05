<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function showAnalytics()
    {
        // Get analytics data
        $achievedTraining = DB::table('train')->sum('total_acheived');
        $targetTraining = DB::table('train')->sum('total_target');
        
        $totalBeneficiaries = DB::table('beneficiary_profile')
            ->selectRaw('SUM(male + female) as total')
            ->value('total') ?? 0;
        
        $communitiesReached = DB::table('beneficiary_profile')->count();
        
        $totalIndicators = DB::table('indication_profile')->count();
        $interventionsAchieved = DB::table('intervention')->count();
        $uniqueInterventions = DB::table('contract_performance')->count();
        $totalCost = DB::table('contract_performance')->sum('cost') ?? 0;

        // Regional data
        $regionData = [
            'northBank' => [
                'male' => DB::table('beneficiary_profile')
                    ->where('regid', 'like', '%North Bank Region%')
                    ->sum('male') ?? 0,
                'female' => DB::table('beneficiary_profile')
                    ->where('regid', 'like', '%North Bank Region%')
                    ->sum('female') ?? 0
            ],
            'westCoast' => [
                'male' => DB::table('beneficiary_profile')
                    ->where('regid', 'like', '%West Coast Region%')
                    ->sum('male') ?? 0,
                'female' => DB::table('beneficiary_profile')
                    ->where('regid', 'like', '%West Coast Region%')
                    ->sum('female') ?? 0
            ],
            'lowerRiver' => [
                'male' => DB::table('beneficiary_profile')
                    ->where('regid', 'like', '%Lower River Region%')
                    ->sum('male') ?? 0,
                'female' => DB::table('beneficiary_profile')
                    ->where('regid', 'like', '%Lower River Region%')
                    ->sum('female') ?? 0
            ],
            'centralRiverNorth' => [
                'male' => DB::table('beneficiary_profile')
                    ->where('regid', 'like', '%Central River Region-North%')
                    ->sum('male') ?? 0,
                'female' => DB::table('beneficiary_profile')
                    ->where('regid', 'like', '%Central River Region-North%')
                    ->sum('female') ?? 0
            ],
            'upperRiver' => [
                'male' => DB::table('beneficiary_profile')
                    ->where('regid', 'like', '%Upper River Region%')
                    ->sum('male') ?? 0,
                'female' => DB::table('beneficiary_profile')
                    ->where('regid', 'like', '%Upper River Region%')
                    ->sum('female') ?? 0
            ],
            'centralRiverSouth' => [
                'male' => DB::table('beneficiary_profile')
                    ->where('regid', 'like', '%Central River Region-South%')
                    ->sum('male') ?? 0,
                'female' => DB::table('beneficiary_profile')
                    ->where('regid', 'like', '%Central River Region-South%')
                    ->sum('female') ?? 0
            ],
            'banjul' => [
                'male' => DB::table('beneficiary_profile')
                    ->where('regid', 'like', '%Banjul%')
                    ->sum('male') ?? 0,
                'female' => DB::table('beneficiary_profile')
                    ->where('regid', 'like', '%Banjul%')
                    ->sum('female') ?? 0
            ]
        ];

        return view('public.analytics', compact(
            'achievedTraining',
            'targetTraining',
            'totalBeneficiaries',
            'communitiesReached',
            'totalIndicators',
            'interventionsAchieved',
            'uniqueInterventions',
            'totalCost',
            'regionData'
        ));
    }
} 