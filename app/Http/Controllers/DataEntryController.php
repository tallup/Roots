<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class DataEntryController extends Controller
{
    public function showLogin()
    {
        return view('dataentry.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Check if data entry user exists
        $dataEntryUser = DB::table('dataentry')
            ->where('Email', $request->email)
            ->first();

        if (!$dataEntryUser) {
            return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
        }

        // Verify password
        if (!Hash::check($request->password, $dataEntryUser->Password)) {
            return back()->withErrors(['password' => 'Invalid credentials.'])->withInput();
        }

        // Update login statistics
        DB::table('dataentry')
            ->where('ID', $dataEntryUser->ID)
            ->update([
                'last_login' => now(),
                'login_count' => DB::raw('login_count + 1')
            ]);

        // Store session data
        session([
            'dataentry_id' => $dataEntryUser->ID,
            'dataentry_name' => $dataEntryUser->CompanyName,
            'dataentry_email' => $dataEntryUser->Email,
            'dataentry_region' => $dataEntryUser->region_name,
            'dataentry_role' => 'dataentry'
        ]);

        return redirect()->route('dataentry.dashboard')->with('success', 'Welcome back, ' . $dataEntryUser->CompanyName . '!');
    }

    public function logout()
    {
        session()->forget(['dataentry_id', 'dataentry_name', 'dataentry_email', 'dataentry_region', 'dataentry_role']);
        return redirect()->route('dataentry.login')->with('success', 'You have been logged out successfully.');
    }

    public function showResetPassword()
    {
        return view('dataentry.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if data entry user exists
        $dataEntryUser = DB::table('dataentry')
            ->where('Email', $request->email)
            ->first();

        if (!$dataEntryUser) {
            return back()->withErrors(['email' => 'No account found with this email address.'])->withInput();
        }

        // Generate new password
        $newPassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
        
        // Update password in database
        DB::table('dataentry')
            ->where('ID', $dataEntryUser->ID)
            ->update([
                'Password' => Hash::make($newPassword),
                'CreationDate' => now()
            ]);

        // Send email with new password (you can implement this later)
        // Mail::to($dataEntryUser->Email)->send(new PasswordResetMail($newPassword));

        return redirect()->route('dataentry.login')
            ->with('success', 'Password reset successfully. Your new password has been sent to your email.');
    }

    public function dashboard()
    {
        // Get dashboard statistics
        $stats = $this->getDashboardStats();
        
        return view('dataentry.dashboard', compact('stats'));
    }

    private function getDashboardStats()
    {
        $stats = [
            'total_beneficiaries' => DB::table('beneficiary_profile')->count(),
            'total_activities' => DB::table('activities')->count(),
            'total_contracts' => DB::table('contract_performance')->count(),
            'total_trainings' => DB::table('train')->count(),
            'pending_approvals' => DB::table('beneficiary_profile')
                ->where('status', 'Pending')
                ->count(),
            'male_beneficiaries' => DB::table('beneficiary_profile')
                ->whereNotNull('male')
                ->where('male', '!=', '')
                ->sum('male'),
            'female_beneficiaries' => DB::table('beneficiary_profile')
                ->whereNotNull('female')
                ->where('female', '!=', '')
                ->sum('female'),
            'youth_beneficiaries' => DB::table('beneficiary_profile')
                ->whereNotNull('nyouth')
                ->where('nyouth', '!=', '')
                ->sum('nyouth'),
        ];

        return $stats;
    }

    // Beneficiary Management Methods
    public function showBeneficiaries(Request $request)
    {
        $status = $request->get('status', 'reject'); // Default to rejected status
        
        $query = DB::table('beneficiary_profile_vw')
            ->leftJoin('dataentry', 'beneficiary_profile_vw.addedby', '=', 'dataentry.ID')
            ->select('beneficiary_profile_vw.*', 'dataentry.CompanyName as added_by_name');
        
        if ($status && $status !== 'all') {
            $query->where('beneficiary_profile_vw.status', $status);
        }
        
        $beneficiaries = $query->orderBy('beneficiary_profile_vw.profile_id', 'DESC')->get();
        
        return view('dataentry.beneficiaries', compact('beneficiaries', 'status'));
    }

    public function showAddBeneficiary()
    {
        // Get dropdown data
        $regions = DB::table('region')->orderBy('region_name')->get();
        $interventions = DB::table('intervention')->orderBy('intervention_type')->get();
        $components = DB::table('component')->orderBy('component_name')->get();
        $indicators = DB::table('indicator')->orderBy('indicator_type')->get();
        $activities = DB::table('activities')->orderBy('activity_name')->get();
        $projectFreq = DB::table('project_freq')->get();
        
        return view('dataentry.add-beneficiary', compact('regions', 'interventions', 'components', 'indicators', 'activities', 'projectFreq'));
    }

    public function storeAddBeneficiary(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'qrts' => 'required',
            'region' => 'required',
            'interven' => 'required',
            'country' => 'required', // component
            'state' => 'required', // subcomponent
            'countryI' => 'required', // indicator type
            'stateI' => 'required', // indicator description
            'community' => 'required',
            'person' => 'required',
            'male' => 'required|numeric',
            'female' => 'required|numeric',
            'number' => 'required|numeric',
            'activity_id' => 'required',
            'rmk' => 'required',
            'profile' => 'nullable|file|mimes:jpeg,jpg,png,gif,pdf|max:2048'
        ]);

        try {
            // Handle file upload
            $picProfile = null;
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $picProfile = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $picProfile);
            }

            // Build beneficiary type string
            $benTypes = [];
            if ($request->has('benw')) $benTypes[] = $request->benw;
            if ($request->has('beny')) $benTypes[] = $request->beny;
            if ($request->has('bena')) $benTypes[] = $request->bena;
            if ($request->has('pwd')) $benTypes[] = $request->pwd;
            if ($request->has('sme')) $benTypes[] = $request->sme;
            $ben = implode(' ', $benTypes);

            // Insert beneficiary data
            $beneficiaryId = DB::table('beneficiary_profile')->insertGetId([
                'addedby' => session('dataentry_id'),
                'regid' => $request->region,
                'intervenid' => $request->interven,
                'comp' => $request->country,
                'SubComp' => $request->state,
                'ind' => $request->countryI,
                'indtyp' => $request->stateI,
                'benid' => $ben,
                'male' => $request->male,
                'female' => $request->female,
                'beneficiary_no' => $request->number,
                'community' => $request->community,
                'contact' => $request->person,
                'status' => 'pending',
                'sup_revw' => 'pending',
                'admstatus' => 'pending',
                'year' => $request->year,
                'proid' => $request->qrts,
                'add_profile' => $picProfile,
                'rmk' => $request->rmk,
                'npwd' => $request->npwd ?? 0,
                'nyouth' => $request->nyouth ?? 0,
                'activity_id' => $request->activity_id
            ]);

            return redirect()->route('dataentry.beneficiaries')
                ->with('success', 'Beneficiary data added successfully!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error adding beneficiary: ' . $e->getMessage()])->withInput();
        }
    }

    public function showEditBeneficiary($id)
    {
        // Get data from the view for display purposes
        $beneficiary = DB::table('beneficiary_profile_vw')->where('profile_id', $id)->first();
        
        if (!$beneficiary) {
            return redirect()->route('dataentry.beneficiaries')->with('error', 'Beneficiary not found.');
        }

        // Get dropdown data
        $regions = DB::table('region')->orderBy('region_name')->get();
        $interventions = DB::table('intervention')->orderBy('intervention_type')->get();
        $components = DB::table('component')->orderBy('component_name')->get();
        $indicators = DB::table('indicator')->orderBy('indicator_type')->get();
        $activities = DB::table('activities')->orderBy('activity_name')->get();
        $projectFreq = DB::table('project_freq')->get();
        
        // Map the indicator type name to ID for the dropdown
        if (isset($beneficiary->indicator_type)) {
            $indicator = DB::table('indicator')
                ->where('indicator_type', $beneficiary->indicator_type)
                ->first();
            if ($indicator) {
                $beneficiary->ind = $indicator->indicatorId;
            }
        }
        
        // Map the activity name to ID for the dropdown
        if (isset($beneficiary->activity)) {
            $activity = DB::table('activities')
                ->where('activity_name', $beneficiary->activity)
                ->first();
            if ($activity) {
                $beneficiary->activity_id = $activity->activity_id;
            }
        }
        
        return view('dataentry.edit-beneficiary', compact('beneficiary', 'regions', 'interventions', 'components', 'indicators', 'activities', 'projectFreq'));
    }

    public function updateBeneficiary(Request $request, $id)
    {
        $request->validate([
            'year' => 'required',
            'qrts' => 'required',
            'region' => 'required',
            'interven' => 'required',
            'country' => 'required',
            'state' => 'required',
            'countryI' => 'required',
            'stateI' => 'required',
            'community' => 'required',
            'person' => 'required',
            'male' => 'required|numeric',
            'female' => 'required|numeric',
            'number' => 'required|numeric',
            'activity_id' => 'required',
            'rmk' => 'required',
            'profile' => 'nullable|file|mimes:jpeg,jpg,png,gif,pdf|max:2048'
        ]);

        try {
            $updateData = [
                'regid' => $request->region,
                'intervenid' => $request->interven,
                'comp' => $request->country,
                'SubComp' => $request->state,
                'ind' => $request->countryI,
                'indtyp' => $request->stateI,
                'male' => $request->male,
                'female' => $request->female,
                'beneficiary_no' => $request->number,
                'community' => $request->community,
                'contact' => $request->person,
                'year' => $request->year,
                'proid' => $request->qrts,
                'rmk' => $request->rmk,
                'npwd' => $request->npwd ?? 0,
                'nyouth' => $request->nyouth ?? 0,
                'activity_id' => $request->activity_id
            ];

            // Handle file upload
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $picProfile = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $picProfile);
                $updateData['add_profile'] = $picProfile;
            }

            // Build beneficiary type string
            $benTypes = [];
            if ($request->has('benw')) $benTypes[] = $request->benw;
            if ($request->has('beny')) $benTypes[] = $request->beny;
            if ($request->has('bena')) $benTypes[] = $request->bena;
            if ($request->has('pwd')) $benTypes[] = $request->pwd;
            if ($request->has('sme')) $benTypes[] = $request->sme;
            $updateData['benid'] = implode(' ', $benTypes);

            DB::table('beneficiary_profile')
                ->where('profile_id', $id)
                ->update($updateData);

            return redirect()->route('dataentry.beneficiaries')
                ->with('success', 'Beneficiary data updated successfully!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error updating beneficiary: ' . $e->getMessage()])->withInput();
        }
    }

    // AJAX Methods for Dropdowns
    public function getSubcomponents(Request $request)
    {
        $componentId = $request->cid;
        
        $subcomponents = DB::table('subcomponent')
            ->where('comid', $componentId)
            ->orderBy('sub_name')
            ->get();
        
        $output = '<option value="">Select Subcomponent</option>';
        foreach ($subcomponents as $subcomponent) {
            $output .= '<option value="' . $subcomponent->subId . '">' . $subcomponent->sub_name . '</option>';
        }
        
        return $output;
    }

    public function getIndicatorDescriptions(Request $request)
    {
        $indicatorId = $request->cid;
        
        $descriptions = DB::table('indicator_desc')
            ->where('indi_id', $indicatorId)
            ->orderBy('description')
            ->get();
        
        $output = '<option value="">Select Indicator Description</option>';
        foreach ($descriptions as $description) {
            $output .= '<option value="' . $description->descid . '">' . $description->description . '</option>';
        }
        
        return $output;
    }

    public function viewBeneficiary(Request $request)
    {
        $id = $request->input('id');
        
        $beneficiary = DB::table('beneficiary_profile_vw')
            ->leftJoin('dataentry', 'beneficiary_profile_vw.addedby', '=', 'dataentry.ID')
            ->select('beneficiary_profile_vw.*', 'dataentry.CompanyName as added_by_name')
            ->where('beneficiary_profile_vw.profile_id', $id)
            ->first();
            
        if (!$beneficiary) {
            return response()->json(['error' => 'Beneficiary not found'], 404);
        }
        
        $html = view('dataentry.beneficiary-details', compact('beneficiary'))->render();
        
        // Check if beneficiary can be edited
        $canEdit = strtolower(trim($beneficiary->admstatus)) === 'pending' || strtolower(trim($beneficiary->admstatus)) === 'reject';
        $editUrl = $canEdit ? route('dataentry.edit-beneficiary', $beneficiary->profile_id) : null;
        
        return response()->json([
            'html' => $html,
            'canEdit' => $canEdit,
            'editUrl' => $editUrl
        ]);
    }
    
    // Indicator Management Methods
    public function showIndicators(Request $request)
    {
        $status = $request->get('status', 'pending');
        $query = DB::table('indicator_profile_vw')
            ->leftJoin('dataentry', 'indicator_profile_vw.addedby', '=', 'dataentry.ID')
            ->select('indicator_profile_vw.*', 'dataentry.CompanyName as added_by_name');
        if ($status !== 'all') {
            $query->where('indicator_profile_vw.status', $status);
        }
        $indicators = $query->orderBy('indicator_profile_vw.indicator_id', 'desc')->paginate(25);
        return view('dataentry.indicators', compact('indicators', 'status'));
    }
    
    public function showAddIndicator()
    {
        $years = range(2020, 2030);
        $quarters = DB::table('project_freq')->pluck('Rep_frequency');
        $indicatorTypes = DB::table('indicator')->orderBy('indicator_type')->get();
        $indicatorDescriptions = DB::table('indicator_desc')->orderBy('description')->get();
        $indicatorCategories = DB::table('IndicatorCatego')->pluck('catname');
        $measurements = DB::table('measurement')->pluck('unit');
        $dataFrequencies = ['quarterly', 'yearly', 'six month', 'Bi Annual', 'Midterm (MTR)', 'Completion'];
        
        return view('dataentry.add-indicator', compact(
            'years', 'quarters', 'indicatorTypes', 'indicatorDescriptions', 
            'indicatorCategories', 'measurements', 'dataFrequencies'
        ));
    }
    
    public function storeAddIndicator(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'quarter' => 'required',
            'indicator_type' => 'required',
            'indicator_description' => 'required',
            'category' => 'required',
            'measurement' => 'required',
            'frequency' => 'required',
            'baseline' => 'required',
            'target' => 'required|numeric',
            'achieved' => 'required|numeric',
            'achievement_percentage' => 'required|numeric',
            'indicator_breakdown_plan' => 'required',
            'indicator_breakdown_achieved' => 'required',
            'remarks' => 'required',
        ]);
        
        try {
            DB::table('indication_profile')->insert([
                'year' => $request->year,
                'proId' => $request->quarter,
                'indicator_desc' => $request->indicator_description,
                'indicatorId' => $request->indicator_type,
                'icat' => $request->category,
                'measuId' => $request->measurement,
                'data' => $request->frequency,
                'baseline' => $request->baseline,
                'target' => $request->target,
                'acheived' => $request->achieved,
                'acheivement' => $request->achievement_percentage,
                'comment' => $request->indicator_breakdown_plan,
                'commentAc' => $request->indicator_breakdown_achieved,
                'rmk' => $request->remarks,
                'addedby' => session('dataentry_id'),
                'status' => 'pending',
            ]);
            
            return redirect()->route('dataentry.indicators')->with('success', 'Indicator profile added successfully!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding indicator profile: ' . $e->getMessage())->withInput();
        }
    }
    
    public function showEditIndicator($id)
    {
        $indicator = DB::table('indication_profile')->where('indicator_id', $id)->first();
        
        if (!$indicator) {
            return redirect()->route('dataentry.indicators')->with('error', 'Indicator not found.');
        }
        
        $years = range(2020, 2030);
        $quarters = DB::table('project_freq')->pluck('Rep_frequency');
        $indicatorTypes = DB::table('indicator')->orderBy('indicator_type')->get();
        $indicatorDescriptions = DB::table('indicator_desc')->orderBy('description')->get();
        $indicatorCategories = ['Project Specific indicator', 'COSOP Indicator', 'NDP indicator'];
        $measurements = DB::table('measurement')->pluck('unit');
        $dataFrequencies = ['quarterly', 'yearly', 'six month', 'Bi Annual', 'Midterm (MTR)', 'Completion'];
        
        return view('dataentry.edit-indicator', compact(
            'indicator', 'years', 'quarters', 'indicatorTypes', 'indicatorDescriptions', 
            'indicatorCategories', 'measurements', 'dataFrequencies'
        ));
    }
    
    public function updateIndicator(Request $request, $id)
    {
        $request->validate([
            'year' => 'required',
            'quarter' => 'required',
            'indicator_type' => 'required',
            'indicator_description' => 'required',
            'category' => 'required',
            'measurement' => 'required',
            'frequency' => 'required',
            'baseline' => 'required',
            'target' => 'required|numeric',
            'achieved' => 'required|numeric',
            'achievement_percentage' => 'required|numeric',
            'indicator_breakdown_plan' => 'required',
            'indicator_breakdown_achieved' => 'required',
            'remarks' => 'required',
        ]);
        
        try {
            DB::table('indication_profile')
                ->where('indicator_id', $id)
                ->update([
                    'year' => $request->year,
                    'proId' => $request->quarter,
                    'indicator_desc' => $request->indicator_description,
                    'indicatorId' => $request->indicator_type,
                    'icat' => $request->category,
                    'measuId' => $request->measurement,
                    'data' => $request->frequency,
                    'baseline' => $request->baseline,
                    'target' => $request->target,
                    'acheived' => $request->achieved,
                    'acheivement' => $request->achievement_percentage,
                    'comment' => $request->indicator_breakdown_plan,
                    'commentAc' => $request->indicator_breakdown_achieved,
                    'rmk' => $request->remarks,
                ]);
                
            return redirect()->route('dataentry.indicators')->with('success', 'Indicator profile updated successfully!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating indicator profile: ' . $e->getMessage())->withInput();
        }
    }
    
    public function viewIndicator(Request $request)
    {
        $id = $request->input('id');
        
        $indicator = DB::table('indicator_profile_vw')
            ->leftJoin('dataentry', 'indicator_profile_vw.addedby', '=', 'dataentry.ID')
            ->select('indicator_profile_vw.*', 'dataentry.CompanyName as added_by_name')
            ->where('indicator_profile_vw.indicator_id', $id)
            ->first();
            
        if (!$indicator) {
            return response()->json(['error' => 'Indicator not found'], 404);
        }
        
        $html = view('dataentry.indicator-details', compact('indicator'))->render();
        
        // Check if indicator can be edited
        $canEdit = strtolower(trim($indicator->status)) === 'pending' || strtolower(trim($indicator->status)) === 'reject';
        $editUrl = $canEdit ? route('dataentry.edit-indicator', $indicator->indicator_id) : null;
        
        return response()->json([
            'html' => $html,
            'canEdit' => $canEdit,
            'editUrl' => $editUrl
        ]);
    }
    
    public function getIndicatorDescriptionsByType(Request $request)
    {
        $indicatorTypeId = $request->input('indicator_type_id');
        
        $descriptions = DB::table('indicator_desc')
            ->where('indicatorId', $indicatorTypeId)
            ->orderBy('description')
            ->get();
            
        return response()->json($descriptions);
    }

    public function showContracts(Request $request)
    {
        $status = $request->input('status', 'all');
        $query = DB::table('cperformance_vw')
            ->leftJoin('dataentry', 'cperformance_vw.addedby', '=', 'dataentry.ID')
            ->select('cperformance_vw.*', 'dataentry.CompanyName as added_by_name');
        if ($status && strtolower($status) !== 'all') {
            $query->whereRaw('LOWER(cperformance_vw.status) = ?', [strtolower($status)]);
        }
        $contracts = $query->orderBy('cperformance_vw.conId', 'desc')->paginate(25);
        return view('dataentry.contracts', compact('contracts', 'status'));
    }

    public function viewContract(Request $request)
    {
        $id = $request->input('id');
        $contract = DB::table('cperformance_vw')
            ->leftJoin('dataentry', 'cperformance_vw.addedby', '=', 'dataentry.ID')
            ->select('cperformance_vw.*', 'dataentry.CompanyName as added_by_name')
            ->where('cperformance_vw.conId', $id)
            ->first();
        if (!$contract) {
            return response()->json(['error' => 'Contract not found'], 404);
        }
        $html = view('dataentry.contract-details', compact('contract'))->render();
        // Allow edit if status is pending or reject
        $canEdit = strtolower(trim($contract->status)) === 'pending' || strtolower(trim($contract->status)) === 'reject';
        $editUrl = $canEdit ? route('dataentry.edit-contract', $contract->conId) : null;
        return response()->json([
            'html' => $html,
            'canEdit' => $canEdit,
            'editUrl' => $editUrl
        ]);
    }

    public function showAddContract()
    {
        $years = range(2020, 2030);
        $quarters = DB::table('project_freq')->pluck('Rep_frequency');
        $components = DB::table('component')->orderBy('component_name')->get();
        $subcomponents = DB::table('subcomponent')->orderBy('sub_name')->get();
        $actors = DB::table('actor')->orderBy('Actor_name')->get();
        $persons = DB::table('person')->orderBy('Name')->get();
        $interventions = DB::table('intervention')->orderBy('intervention_type')->get();
        $contractTypes = DB::table('contract_type')->pluck('contractType');
        $statuses = DB::table('status')->pluck('activ_status');
        return view('dataentry.add-contract', compact('years', 'quarters', 'components', 'subcomponents', 'actors', 'persons', 'interventions', 'contractTypes', 'statuses'));
    }

    public function storeAddContract(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'quarter' => 'required',
            'component' => 'required',
            'subcomponent' => 'required',
            'actor' => 'required',
            'person' => 'required',
            'intervention' => 'required',
            'contract_type' => 'required',
            'status' => 'required',
            'name' => 'required',
            'cost' => 'required|numeric',
            'key_issue' => 'required',
            'recommendation' => 'required',
            'remarks' => 'required',
        ]);
        try {
            DB::table('contract_performance')->insert([
                'year' => $request->year,
                'proId' => $request->quarter,
                'compId' => $request->component,
                'subId' => $request->subcomponent,
                'actorId' => $request->actor,
                'personId' => $request->person,
                'intervenId' => $request->intervention,
                'ctyId' => $request->contract_type,
                'stuId' => $request->status,
                'name' => $request->name,
                'cost' => $request->cost,
                'key_issue' => $request->key_issue,
                'recommendation' => $request->recommendation,
                'rmk' => $request->remarks,
                'addedby' => session('dataentry_id'),
                'status' => 'pending',
            ]);
            return redirect()->route('dataentry.contracts')->with('success', 'Contract performance added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding contract performance: ' . $e->getMessage())->withInput();
        }
    }

    public function showEditContract($id)
    {
        $contract = DB::table('contract_performance')
            ->leftJoin('status', 'contract_performance.stuId', '=', 'status.stuId')
            ->where('conId', $id)
            ->select('contract_performance.*', 'status.activ_status')
            ->first();
        if (!$contract) {
            return redirect()->route('dataentry.contracts')->with('error', 'Contract not found.');
        }
        $years = range(2020, 2030);
        $quarters = DB::table('project_freq')->pluck('Rep_frequency');
        $components = DB::table('component')->orderBy('component_name')->get();
        $subcomponents = DB::table('subcomponent')->orderBy('sub_name')->get();
        $actors = DB::table('actor')->orderBy('Actor_name')->get();
        $persons = DB::table('person')->orderBy('Name')->get();
        $interventions = DB::table('intervention')->orderBy('intervention_type')->get();
        $contractTypes = DB::table('contract_type')->pluck('contractType');
        $statuses = DB::table('status')->get(); // get stuId and activ_status
        return view('dataentry.edit-contract', compact('contract', 'years', 'quarters', 'components', 'subcomponents', 'actors', 'persons', 'interventions', 'contractTypes', 'statuses'));
    }

    public function updateContract(Request $request, $id)
    {
        $request->validate([
            'year' => 'required',
            'quarter' => 'required',
            'component' => 'required',
            'subcomponent' => 'required',
            'actor' => 'required',
            'person' => 'required',
            'intervention' => 'required',
            'contract_type' => 'required',
            'status' => 'required',
            'name' => 'required',
            'cost' => 'required|numeric',
            'key_issue' => 'required',
            'recommendation' => 'required',
            'remarks' => 'required',
        ]);
        try {
            DB::table('contract_performance')->where('conId', $id)->update([
                'year' => $request->year,
                'proId' => $request->quarter,
                'compId' => $request->component,
                'subId' => $request->subcomponent,
                'actorId' => $request->actor,
                'personId' => $request->person,
                'intervenId' => $request->intervention,
                'ctyId' => $request->contract_type,
                'stuId' => $request->status, // keep supervisor status field
                'name' => $request->name,
                'cost' => $request->cost,
                'key_issue' => $request->key_issue,
                'recommendation' => $request->recommendation,
                'rmk' => $request->remarks,
                'status' => 'pending', // Always set to pending on update by data entry
            ]);
            return redirect()->route('dataentry.contracts')->with('success', 'Contract performance updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating contract performance: ' . $e->getMessage())->withInput();
        }
    }

    public function showTrainings(Request $request)
    {
        $status = $request->get('status', 'pending');
        $query = DB::table('trainin_vw');
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        $trainings = $query->orderByDesc('train_Id')->get();
        return view('dataentry.trainings', compact('trainings', 'status'));
    }

    public function viewTraining(Request $request)
    {
        $id = $request->id;
        $training = DB::table('trainin_vw')->where('train_Id', $id)->first();
        if (!$training) {
            return response()->json(['html' => '<div class="alert alert-danger">Training not found.</div>', 'canEdit' => false]);
        }
        $canEdit = strtolower(trim($training->status)) === 'pending' || strtolower(trim($training->status)) === 'reject';
        $editUrl = route('dataentry.edit-training', $training->train_Id);
        $html = view('dataentry.training-details', compact('training'))->render();
        return response()->json(['html' => $html, 'canEdit' => $canEdit, 'editUrl' => $editUrl]);
    }

    public function showEditTraining($id)
    {
        $training = DB::table('train')->where('train_Id', $id)->first();
        if (!$training) {
            return redirect()->route('dataentry.trainings')->with('error', 'Training not found.');
        }
        // Fetch dropdown data
        $years = range(2020, 2030);
        $quarters = DB::table('project_freq')->pluck('Rep_frequency');
        $trainingTypes = DB::table('training')->pluck('type');
        $components = DB::table('component')->orderBy('component_name')->get();
        $subcomponents = DB::table('subcomponent')->orderBy('sub_name')->get();
        $actors = DB::table('actor')->orderBy('Actor_name')->get();
        $persons = DB::table('person')->orderBy('Name')->get();
        $venues = DB::table('venue')->pluck('venue_name');
        return view('dataentry.edit-training', compact('training', 'years', 'quarters', 'trainingTypes', 'components', 'subcomponents', 'actors', 'persons', 'venues'));
    }

    public function updateTraining(Request $request, $id)
    {
        $request->validate([
            'year' => 'required',
            'quarter' => 'required',
            'training_type' => 'required',
            'desc' => 'required',
            'component' => 'required',
            'subcomponent' => 'required',
            'actor' => 'required',
            'person' => 'required',
            'venue' => 'required',
            'cost' => 'required|numeric',
            'total_target' => 'required',
            'total_acheived' => 'required',
            'plan' => 'required',
            'achis' => 'required',
            'key_issue' => 'required',
            'recommendation' => 'required',
            'rmk' => 'required',
        ]);
        try {
            DB::table('train')->where('train_Id', $id)->update([
                'year' => $request->year,
                'proId' => $request->quarter,
                'traId' => $request->training_type,
                'train_desc' => $request->desc,
                'compId' => $request->component,
                'subId' => $request->subcomponent,
                'actorId' => $request->actor,
                'personId' => $request->person,
                'venId' => $request->venue,
                'cost' => $request->cost,
                'total_target' => $request->total_target,
                'total_acheived' => $request->total_acheived,
                'plans' => $request->plan,
                'achis' => $request->achis,
                'key_issue' => $request->key_issue,
                'recommendation' => $request->recommendation,
                'rmk' => $request->rmk,
                'status' => 'pending', // Always set to pending on update by data entry
            ]);
            return redirect()->route('dataentry.trainings')->with('success', 'Training updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating training: ' . $e->getMessage())->withInput();
        }
    }

    public function showAddTraining()
    {
        $years = range(2020, 2030);
        $quarters = DB::table('project_freq')->pluck('Rep_frequency');
        $trainingTypes = DB::table('training')->pluck('type');
        $components = DB::table('component')->orderBy('component_name')->get();
        $subcomponents = DB::table('subcomponent')->orderBy('sub_name')->get();
        $actors = DB::table('actor')->orderBy('Actor_name')->get();
        $persons = DB::table('person')->orderBy('Name')->get();
        $venues = DB::table('venue')->pluck('venue_name');
        return view('dataentry.add-training', compact('years', 'quarters', 'trainingTypes', 'components', 'subcomponents', 'actors', 'persons', 'venues'));
    }

    public function storeAddTraining(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'quarter' => 'required',
            'training_type' => 'required',
            'desc' => 'required',
            'component' => 'required',
            'subcomponent' => 'required',
            'actor' => 'required',
            'person' => 'required',
            'venue' => 'required',
            'cost' => 'required|numeric',
            'total_target' => 'required',
            'total_acheived' => 'required',
            'plan' => 'required',
            'achis' => 'required',
            'key_issue' => 'required',
            'recommendation' => 'required',
            'rmk' => 'required',
        ]);
        try {
            DB::table('train')->insert([
                'year' => $request->year,
                'proId' => $request->quarter,
                'traId' => $request->training_type,
                'train_desc' => $request->desc,
                'compId' => $request->component,
                'subId' => $request->subcomponent,
                'actorId' => $request->actor,
                'personId' => $request->person,
                'venId' => $request->venue,
                'cost' => $request->cost,
                'total_target' => $request->total_target,
                'total_acheived' => $request->total_acheived,
                'plans' => $request->plan,
                'achis' => $request->achis,
                'key_issue' => $request->key_issue,
                'recommendation' => $request->recommendation,
                'rmk' => $request->rmk,
                'addedby' => session('dataentry_id'),
                'status' => 'pending',
            ]);
            return redirect()->route('dataentry.trainings')->with('success', 'Training record added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding training: ' . $e->getMessage())->withInput();
        }
    }

    public function showProfile()
    {
        $user = DB::table('dataentry')->where('ID', session('dataentry_id'))->first();
        return view('dataentry.profile', compact('user'));
    }

    public function showSettings()
    {
        return view('dataentry.settings');
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
        $user = DB::table('dataentry')->where('ID', session('dataentry_id'))->first();
        if (!$user || !Hash::check($request->current_password, $user->Password)) {
            return back()->with('error', 'Current password is incorrect.');
        }
        if ($request->current_password === $request->new_password) {
            return back()->with('error', 'New password must be different from the current password.');
        }
        DB::table('dataentry')->where('ID', $user->ID)->update([
            'Password' => Hash::make($request->new_password)
        ]);
        return back()->with('success', 'Password updated successfully!');
    }
} 