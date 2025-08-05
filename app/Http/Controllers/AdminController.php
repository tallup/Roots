<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Check if user exists in tbladmin
        $admin = DB::table('tbladmin')
            ->where('UserName', $username)
            ->first();

        if ($admin && Hash::check($password, $admin->Password)) {
            // Store admin session
            Session::put('admin_id', $admin->ID);
            Session::put('admin_name', $admin->AdminName);
            Session::put('admin_username', $admin->UserName);
            Session::put('admin_email', $admin->Email);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'Invalid credentials.',
        ])->withInput($request->only('username'));
    }

    public function dashboard()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        // Get dashboard statistics
        $stats = $this->getDashboardStats();

        return view('admin.dashboard', compact('stats'));
    }

    public function logout()
    {
        Session::forget(['admin_id', 'admin_name', 'admin_username', 'admin_email']);
        return redirect()->route('admin.login');
    }

    public function showResetPassword()
    {
        return view('admin.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $username = $request->input('username');
        $email = $request->input('email');
        $newPassword = $request->input('new_password');

        // Check if admin exists with matching username and email
        $admin = DB::table('tbladmin')
            ->where('UserName', $username)
            ->where('Email', $email)
            ->first();

        if (!$admin) {
            return back()->withErrors([
                'username' => 'No admin found with these credentials.',
            ])->withInput($request->only('username', 'email'));
        }

        // Update password
        DB::table('tbladmin')
            ->where('ID', $admin->ID)
            ->update([
                'Password' => Hash::make($newPassword)
            ]);

        return redirect()->route('admin.login')->with('success', 'Password reset successfully! You can now login with your new password.');
    }

    public function showAddAdmin()
    {
        return view('admin.add-admin');
    }

    public function storeAddAdmin(Request $request)
    {
        $request->validate([
            'AdminName' => 'required|string|max:255',
            'UserName' => 'required|string|max:255|unique:tbladmin,UserName',
            'Email' => 'required|email|max:255|unique:tbladmin,Email',
            'MobileNumber' => 'nullable|string|max:20',
            'Password' => 'required|string|min:6|confirmed',
            'acc_type' => 'required|string|max:50',
        ]);

        DB::table('tbladmin')->insert([
            'AdminName' => $request->AdminName,
            'UserName' => $request->UserName,
            'Email' => $request->Email,
            'MobileNumber' => $request->MobileNumber,
            'Password' => bcrypt($request->Password),
            'acc_typ' => $request->acc_type,
            'addedby' => session('admin_name') ?? 'system',
        ]);

        return redirect()->route('admin.add-admin')->with('success', 'Admin user added successfully!');
    }

    public function showAddSupervisor()
    {
        // Get regions for dropdown
        $regions = DB::table('region')->orderBy('region_name')->get();
        return view('admin.add-supervisor', compact('regions'));
    }

    public function storeAddSupervisor(Request $request)
    {
        $request->validate([
            'CompanyName' => 'required|string|max:120',
            'Address' => 'nullable|string|max:200',
            'region_name' => 'required|string|max:200',
            'Workphnumber' => 'nullable|numeric',
            'Email' => 'required|email|max:200|unique:tblclient,Email',
            'Password' => 'required|string|min:6|confirmed',
        ]);

        DB::table('tblclient')->insert([
            'CompanyName' => $request->CompanyName,
            'Address' => $request->Address,
            'region_name' => $request->region_name,
            'Workphnumber' => $request->Workphnumber,
            'Email' => $request->Email,
            'Password' => bcrypt($request->Password),
            'uid' => 2, // Assuming 2 is for supervisors
            'login_count' => 0,
        ]);

        return redirect()->route('admin.add-supervisor')->with('success', 'Supervisor added successfully!');
    }

    public function showAddFinance()
    {
        return view('admin.add-finance');
    }

    public function storeAddFinance(Request $request)
    {
        $request->validate([
            'Name' => 'required|string|max:50',
            'address' => 'required|string|max:30',
            'username' => 'required|string|max:40|unique:tblfinance,username',
            'mobileNo' => 'required|numeric',
            'email' => 'required|email|max:50|unique:tblfinance,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        DB::table('tblfinance')->insert([
            'Name' => $request->Name,
            'address' => $request->address,
            'username' => $request->username,
            'mobileNo' => $request->mobileNo,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.add-finance')->with('success', 'Finance user added successfully!');
    }

    public function showAddDataEntry()
    {
        // Get regions for dropdown
        $regions = DB::table('region')->orderBy('region_name')->get();
        return view('admin.add-dataentry', compact('regions'));
    }

    public function storeAddDataEntry(Request $request)
    {
        $request->validate([
            'CompanyName' => 'required|string|max:120',
            'Address' => 'required|string|max:200',
            'region_name' => 'required|string|max:200',
            'Workphnumber' => 'required|numeric',
            'Email' => 'required|email|max:200|unique:dataentry,Email',
            'Password' => 'required|string|min:6|confirmed',
        ]);

        DB::table('dataentry')->insert([
            'CompanyName' => $request->CompanyName,
            'Address' => $request->Address,
            'region_name' => $request->region_name,
            'Workphnumber' => $request->Workphnumber,
            'Email' => $request->Email,
            'Password' => bcrypt($request->Password),
            'uid' => 3, // Assuming 3 is for data entry users
            'login_count' => 0,
        ]);

        return redirect()->route('admin.add-dataentry')->with('success', 'Data Entry user added successfully!');
    }

    // Contract Types Methods
    public function showContractTypes()
    {
        $contractTypes = DB::table('contract_type')->orderBy('ctyId', 'ASC')->get();
        return view('admin.contract-types', compact('contractTypes'));
    }

    public function showAddContractType()
    {
        return view('admin.add-contract-type');
    }

    public function storeAddContractType(Request $request)
    {
        $request->validate([
            'contractType' => 'required|string|max:150|unique:contract_type,contractType',
        ]);

        DB::table('contract_type')->insert([
            'contractType' => $request->contractType,
            'addedby' => session('admin_name') ?? 'system',
        ]);

        return redirect()->route('admin.contract-types')->with('success', 'Contract type added successfully!');
    }

    public function showEditContractType($id)
    {
        $contractType = DB::table('contract_type')->where('ctyId', $id)->first();
        if (!$contractType) {
            return redirect()->route('admin.contract-types')->with('error', 'Contract type not found!');
        }
        return view('admin.edit-contract-type', compact('contractType'));
    }

    public function updateContractType(Request $request, $id)
    {
        $request->validate([
            'contractType' => 'required|string|max:150|unique:contract_type,contractType,' . $id . ',ctyId',
        ]);

        DB::table('contract_type')
            ->where('ctyId', $id)
            ->update([
                'contractType' => $request->contractType,
            ]);

        return redirect()->route('admin.contract-types')->with('success', 'Contract type updated successfully!');
    }

    public function deleteContractType($id)
    {
        DB::table('contract_type')->where('ctyId', $id)->delete();
        return redirect()->route('admin.contract-types')->with('success', 'Contract type deleted successfully!');
    }

    // Indicator Types Methods
    public function showIndicatorTypes()
    {
        $indicatorTypes = DB::table('indicator')->orderBy('indicatorId', 'ASC')->get();
        return view('admin.indicator-types', compact('indicatorTypes'));
    }

    public function showAddIndicatorType()
    {
        return view('admin.add-indicator-type');
    }

    public function storeAddIndicatorType(Request $request)
    {
        $request->validate([
            'indicator_type' => 'required|string|max:150|unique:indicator,indicator_type',
        ]);

        DB::table('indicator')->insert([
            'indicator_type' => $request->indicator_type,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.indicator-types')->with('success', 'Indicator type added successfully!');
    }

    public function showEditIndicatorType($id)
    {
        $indicatorType = DB::table('indicator')->where('indicatorId', $id)->first();
        if (!$indicatorType) {
            return redirect()->route('admin.indicator-types')->with('error', 'Indicator type not found!');
        }
        return view('admin.edit-indicator-type', compact('indicatorType'));
    }

    public function updateIndicatorType(Request $request, $id)
    {
        $request->validate([
            'indicator_type' => 'required|string|max:150|unique:indicator,indicator_type,' . $id . ',indicatorId',
        ]);

        DB::table('indicator')
            ->where('indicatorId', $id)
            ->update([
                'indicator_type' => $request->indicator_type,
            ]);

        return redirect()->route('admin.indicator-types')->with('success', 'Indicator type updated successfully!');
    }

    public function deleteIndicatorType($id)
    {
        DB::table('indicator')->where('indicatorId', $id)->delete();
        return redirect()->route('admin.indicator-types')->with('success', 'Indicator type deleted successfully!');
    }

    // Indicator Descriptions Methods
    public function showIndicatorDescriptions()
    {
        $indicatorDescriptions = DB::table('indicator_desc')
            ->join('indicator', 'indicator_desc.indi_id', '=', 'indicator.indicatorId')
            ->select('indicator_desc.*', 'indicator.indicator_type')
            ->orderBy('indicator_desc.descid', 'ASC')
            ->get();
        return view('admin.indicator-descriptions', compact('indicatorDescriptions'));
    }

    public function showAddIndicatorDescription()
    {
        $indicatorTypes = DB::table('indicator')->orderBy('indicator_type', 'ASC')->get();
        return view('admin.add-indicator-description', compact('indicatorTypes'));
    }

    public function storeAddIndicatorDescription(Request $request)
    {
        $request->validate([
            'indi_id' => 'required|exists:indicator,indicatorId',
            'description' => 'required|string|max:65535',
        ]);

        DB::table('indicator_desc')->insert([
            'indi_id' => $request->indi_id,
            'description' => $request->description,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.indicator-descriptions')->with('success', 'Indicator description added successfully!');
    }

    public function showEditIndicatorDescription($id)
    {
        $indicatorDescription = DB::table('indicator_desc')->where('descid', $id)->first();
        if (!$indicatorDescription) {
            return redirect()->route('admin.indicator-descriptions')->with('error', 'Indicator description not found!');
        }
        
        $indicatorTypes = DB::table('indicator')->orderBy('indicator_type', 'ASC')->get();
        return view('admin.edit-indicator-description', compact('indicatorDescription', 'indicatorTypes'));
    }

    public function updateIndicatorDescription(Request $request, $id)
    {
        $request->validate([
            'indi_id' => 'required|exists:indicator,indicatorId',
            'description' => 'required|string|max:65535',
        ]);

        DB::table('indicator_desc')
            ->where('descid', $id)
            ->update([
                'indi_id' => $request->indi_id,
                'description' => $request->description,
            ]);

        return redirect()->route('admin.indicator-descriptions')->with('success', 'Indicator description updated successfully!');
    }

    public function deleteIndicatorDescription($id)
    {
        DB::table('indicator_desc')->where('descid', $id)->delete();
        return redirect()->route('admin.indicator-descriptions')->with('success', 'Indicator description deleted successfully!');
    }

    // Intervention Types Methods
    public function showInterventionTypes()
    {
        $interventionTypes = DB::table('intervention')->orderBy('intervenId', 'ASC')->get();
        return view('admin.intervention-types', compact('interventionTypes'));
    }

    public function showAddInterventionType()
    {
        return view('admin.add-intervention-type');
    }

    public function storeAddInterventionType(Request $request)
    {
        $request->validate([
            'intervention_type' => 'required|string|max:200|unique:intervention,intervention_type',
        ]);

        DB::table('intervention')->insert([
            'intervention_type' => $request->intervention_type,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.intervention-types')->with('success', 'Intervention type added successfully!');
    }

    public function showEditInterventionType($id)
    {
        $interventionType = DB::table('intervention')->where('intervenId', $id)->first();
        if (!$interventionType) {
            return redirect()->route('admin.intervention-types')->with('error', 'Intervention type not found!');
        }
        return view('admin.edit-intervention-type', compact('interventionType'));
    }

    public function updateInterventionType(Request $request, $id)
    {
        $request->validate([
            'intervention_type' => 'required|string|max:200|unique:intervention,intervention_type,' . $id . ',intervenId',
        ]);

        DB::table('intervention')
            ->where('intervenId', $id)
            ->update([
                'intervention_type' => $request->intervention_type,
            ]);

        return redirect()->route('admin.intervention-types')->with('success', 'Intervention type updated successfully!');
    }

    public function deleteInterventionType($id)
    {
        DB::table('intervention')->where('intervenId', $id)->delete();
        return redirect()->route('admin.intervention-types')->with('success', 'Intervention type deleted successfully!');
    }

    // Training Types Methods
    public function showTrainingTypes()
    {
        $trainingTypes = DB::table('training')->orderBy('traId', 'ASC')->get();
        return view('admin.training-types', compact('trainingTypes'));
    }

    public function showAddTrainingType()
    {
        return view('admin.add-training-type');
    }

    public function storeAddTrainingType(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:150|unique:training,type',
        ]);

        DB::table('training')->insert([
            'type' => $request->type,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.training-types')->with('success', 'Training type added successfully!');
    }

    public function showEditTrainingType($id)
    {
        $trainingType = DB::table('training')->where('traId', $id)->first();
        if (!$trainingType) {
            return redirect()->route('admin.training-types')->with('error', 'Training type not found!');
        }
        return view('admin.edit-training-type', compact('trainingType'));
    }

    public function updateTrainingType(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|max:150|unique:training,type,' . $id . ',traId',
        ]);

        DB::table('training')
            ->where('traId', $id)
            ->update([
                'type' => $request->type,
            ]);

        return redirect()->route('admin.training-types')->with('success', 'Training type updated successfully!');
    }

    public function deleteTrainingType($id)
    {
        DB::table('training')->where('traId', $id)->delete();
        return redirect()->route('admin.training-types')->with('success', 'Training type deleted successfully!');
    }

    public function showTrainingTypesReport()
    {
        $trainingTypes = DB::table('training')->orderBy('traId', 'ASC')->get();
        return view('admin.training-types-report', compact('trainingTypes'));
    }

    // Beneficiary Types Methods
    public function showBeneficiaryTypes()
    {
        $beneficiaryTypes = DB::table('beneficiary')->orderBy('benId', 'ASC')->get();
        return view('admin.beneficiary-types', compact('beneficiaryTypes'));
    }

    public function showAddBeneficiaryType()
    {
        return view('admin.add-beneficiary-type');
    }

    public function storeAddBeneficiaryType(Request $request)
    {
        $request->validate([
            'beneficiary_type' => 'required|string|max:150|unique:beneficiary,beneficiary_type',
        ]);

        DB::table('beneficiary')->insert([
            'beneficiary_type' => $request->beneficiary_type,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.beneficiary-types')->with('success', 'Beneficiary type added successfully!');
    }

    public function showEditBeneficiaryType($id)
    {
        $beneficiaryType = DB::table('beneficiary')->where('benId', $id)->first();
        if (!$beneficiaryType) {
            return redirect()->route('admin.beneficiary-types')->with('error', 'Beneficiary type not found!');
        }
        return view('admin.edit-beneficiary-type', compact('beneficiaryType'));
    }

    public function updateBeneficiaryType(Request $request, $id)
    {
        $request->validate([
            'beneficiary_type' => 'required|string|max:150|unique:beneficiary,beneficiary_type,' . $id . ',benId',
        ]);

        DB::table('beneficiary')
            ->where('benId', $id)
            ->update([
                'beneficiary_type' => $request->beneficiary_type,
            ]);

        return redirect()->route('admin.beneficiary-types')->with('success', 'Beneficiary type updated successfully!');
    }

    public function deleteBeneficiaryType($id)
    {
        DB::table('beneficiary')->where('benId', $id)->delete();
        return redirect()->route('admin.beneficiary-types')->with('success', 'Beneficiary type deleted successfully!');
    }

    public function showBeneficiaryTypesReport()
    {
        $beneficiaryTypes = DB::table('beneficiary')->orderBy('benId', 'ASC')->get();
        return view('admin.beneficiary-types-report', compact('beneficiaryTypes'));
    }

    // Report Methods for other forms
    public function showContractTypesReport()
    {
        $contractTypes = DB::table('contract_type')->orderBy('ctyId', 'ASC')->get();
        return view('admin.contract-types-report', compact('contractTypes'));
    }

    public function showIndicatorTypesReport()
    {
        $indicatorTypes = DB::table('indicator')->orderBy('indicatorId', 'ASC')->get();
        return view('admin.indicator-types-report', compact('indicatorTypes'));
    }

    public function showIndicatorDescriptionsReport()
    {
        $indicatorDescriptions = DB::table('indicator_desc')
            ->join('indicator', 'indicator_desc.indi_id', '=', 'indicator.indicatorId')
            ->select('indicator_desc.*', 'indicator.indicator_type')
            ->orderBy('indicator_desc.descid', 'ASC')
            ->get();
        return view('admin.indicator-descriptions-report', compact('indicatorDescriptions'));
    }

    public function showInterventionTypesReport()
    {
        $interventionTypes = DB::table('intervention')->orderBy('intervenId', 'ASC')->get();
        return view('admin.intervention-types-report', compact('interventionTypes'));
    }

    // Implementing Partners Methods
    public function showImplementingPartners()
    {
        $implementingPartners = DB::table('actor')->orderBy('actorId', 'ASC')->get();
        return view('admin.implementing-partners', compact('implementingPartners'));
    }

    public function showAddImplementingPartner()
    {
        return view('admin.add-implementing-partner');
    }

    public function storeAddImplementingPartner(Request $request)
    {
        $request->validate([
            'Actor_name' => 'required|string|max:150|unique:actor,Actor_name',
        ]);

        DB::table('actor')->insert([
            'Actor_name' => $request->Actor_name,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.implementing-partners')->with('success', 'Implementing partner added successfully!');
    }

    public function showEditImplementingPartner($id)
    {
        $implementingPartner = DB::table('actor')->where('actorId', $id)->first();
        if (!$implementingPartner) {
            return redirect()->route('admin.implementing-partners')->with('error', 'Implementing partner not found!');
        }
        return view('admin.edit-implementing-partner', compact('implementingPartner'));
    }

    public function updateImplementingPartner(Request $request, $id)
    {
        $request->validate([
            'Actor_name' => 'required|string|max:150|unique:actor,Actor_name,' . $id . ',actorId',
        ]);

        DB::table('actor')
            ->where('actorId', $id)
            ->update([
                'Actor_name' => $request->Actor_name,
            ]);

        return redirect()->route('admin.implementing-partners')->with('success', 'Implementing partner updated successfully!');
    }

    public function deleteImplementingPartner($id)
    {
        DB::table('actor')->where('actorId', $id)->delete();
        return redirect()->route('admin.implementing-partners')->with('success', 'Implementing partner deleted successfully!');
    }

    public function showImplementingPartnersReport()
    {
        $implementingPartners = DB::table('actor')->orderBy('actorId', 'ASC')->get();
        return view('admin.implementing-partners-report', compact('implementingPartners'));
    }

    // Regions Methods
    public function showRegions()
    {
        $regions = DB::table('region')->orderBy('regId', 'ASC')->get();
        return view('admin.regions', compact('regions'));
    }

    public function showAddRegion()
    {
        return view('admin.add-region');
    }

    public function storeAddRegion(Request $request)
    {
        $request->validate([
            'region_initial' => 'required|string|max:100|unique:region,region_initial',
            'region_name' => 'required|string|max:150|unique:region,region_name',
        ]);

        DB::table('region')->insert([
            'region_initial' => $request->region_initial,
            'region_name' => $request->region_name,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.regions')->with('success', 'Region added successfully!');
    }

    public function showEditRegion($id)
    {
        $region = DB::table('region')->where('regId', $id)->first();
        if (!$region) {
            return redirect()->route('admin.regions')->with('error', 'Region not found!');
        }
        return view('admin.edit-region', compact('region'));
    }

    public function updateRegion(Request $request, $id)
    {
        $request->validate([
            'region_initial' => 'required|string|max:100|unique:region,region_initial,' . $id . ',regId',
            'region_name' => 'required|string|max:150|unique:region,region_name,' . $id . ',regId',
        ]);

        DB::table('region')
            ->where('regId', $id)
            ->update([
                'region_initial' => $request->region_initial,
                'region_name' => $request->region_name,
            ]);

        return redirect()->route('admin.regions')->with('success', 'Region updated successfully!');
    }

    public function deleteRegion($id)
    {
        DB::table('region')->where('regId', $id)->delete();
        return redirect()->route('admin.regions')->with('success', 'Region deleted successfully!');
    }

    public function showRegionsReport()
    {
        $regions = DB::table('region')->orderBy('regId', 'ASC')->get();
        return view('admin.regions-report', compact('regions'));
    }

    // Activities Methods
    public function showActivities()
    {
        $activities = DB::table('activities')->orderBy('activity_name', 'ASC')->get();
        return view('admin.activities', compact('activities'));
    }

    public function showAddActivity()
    {
        return view('admin.add-activity');
    }

    public function storeAddActivity(Request $request)
    {
        $request->validate([
            'activity_name' => 'required|string|max:255|unique:activities,activity_name',
        ]);

        DB::table('activities')->insert([
            'activity_name' => $request->activity_name,
        ]);

        return redirect()->route('admin.activities')->with('success', 'Activity added successfully!');
    }

    public function showEditActivity($id)
    {
        $activity = DB::table('activities')->where('activity_id', $id)->first();
        if (!$activity) {
            return redirect()->route('admin.activities')->with('error', 'Activity not found!');
        }
        return view('admin.edit-activity', compact('activity'));
    }

    public function updateActivity(Request $request, $id)
    {
        $request->validate([
            'activity_name' => 'required|string|max:255|unique:activities,activity_name,' . $id . ',activity_id',
        ]);

        DB::table('activities')
            ->where('activity_id', $id)
            ->update([
                'activity_name' => $request->activity_name,
            ]);

        return redirect()->route('admin.activities')->with('success', 'Activity updated successfully!');
    }

    public function deleteActivity($id)
    {
        DB::table('activities')->where('activity_id', $id)->delete();
        return redirect()->route('admin.activities')->with('success', 'Activity deleted successfully!');
    }

    public function showActivitiesReport()
    {
        $activities = DB::table('activities')->orderBy('activity_name', 'ASC')->get();
        return view('admin.activities-report', compact('activities'));
    }

    // Indicator Reporting Frequencies Methods
    public function showIndicatorFrequencies()
    {
        $indicatorFrequencies = DB::table('indicator_freq')->orderBy('freqId', 'ASC')->get();
        return view('admin.indicator-frequencies', compact('indicatorFrequencies'));
    }

    public function showAddIndicatorFrequency()
    {
        return view('admin.add-indicator-frequency');
    }

    public function storeAddIndicatorFrequency(Request $request)
    {
        $request->validate([
            'frequency_type' => 'required|string|max:40|unique:indicator_freq,frequency_type',
        ]);

        DB::table('indicator_freq')->insert([
            'frequency_type' => $request->frequency_type,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.indicator-frequencies')->with('success', 'Indicator reporting frequency added successfully!');
    }

    public function showEditIndicatorFrequency($id)
    {
        $indicatorFrequency = DB::table('indicator_freq')->where('freqId', $id)->first();
        if (!$indicatorFrequency) {
            return redirect()->route('admin.indicator-frequencies')->with('error', 'Indicator reporting frequency not found!');
        }
        return view('admin.edit-indicator-frequency', compact('indicatorFrequency'));
    }

    public function updateIndicatorFrequency(Request $request, $id)
    {
        $request->validate([
            'frequency_type' => 'required|string|max:40|unique:indicator_freq,frequency_type,' . $id . ',freqId',
        ]);

        DB::table('indicator_freq')
            ->where('freqId', $id)
            ->update([
                'frequency_type' => $request->frequency_type,
            ]);

        return redirect()->route('admin.indicator-frequencies')->with('success', 'Indicator reporting frequency updated successfully!');
    }

    public function deleteIndicatorFrequency($id)
    {
        DB::table('indicator_freq')->where('freqId', $id)->delete();
        return redirect()->route('admin.indicator-frequencies')->with('success', 'Indicator reporting frequency deleted successfully!');
    }

    public function showIndicatorFrequenciesReport()
    {
        $indicatorFrequencies = DB::table('indicator_freq')->orderBy('freqId', 'ASC')->get();
        return view('admin.indicator-frequencies-report', compact('indicatorFrequencies'));
    }

    // Activities Status Methods
    public function showActivityStatus()
    {
        $activityStatuses = DB::table('status')->orderBy('stuId', 'ASC')->get();
        return view('admin.activity-status', compact('activityStatuses'));
    }

    public function showAddActivityStatus()
    {
        return view('admin.add-activity-status');
    }

    public function storeAddActivityStatus(Request $request)
    {
        $request->validate([
            'activ_status' => 'required|string|max:50|unique:status,activ_status',
        ]);

        DB::table('status')->insert([
            'activ_status' => $request->activ_status,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.activity-status')->with('success', 'Activity status added successfully!');
    }

    public function showEditActivityStatus($id)
    {
        $activityStatus = DB::table('status')->where('stuId', $id)->first();
        if (!$activityStatus) {
            return redirect()->route('admin.activity-status')->with('error', 'Activity status not found!');
        }
        return view('admin.edit-activity-status', compact('activityStatus'));
    }

    public function updateActivityStatus(Request $request, $id)
    {
        $request->validate([
            'activ_status' => 'required|string|max:50|unique:status,activ_status,' . $id . ',stuId',
        ]);

        DB::table('status')
            ->where('stuId', $id)
            ->update([
                'activ_status' => $request->activ_status,
            ]);

        return redirect()->route('admin.activity-status')->with('success', 'Activity status updated successfully!');
    }

    public function deleteActivityStatus($id)
    {
        DB::table('status')->where('stuId', $id)->delete();
        return redirect()->route('admin.activity-status')->with('success', 'Activity status deleted successfully!');
    }

    public function showActivityStatusReport()
    {
        $activityStatuses = DB::table('status')->orderBy('stuId', 'ASC')->get();
        return view('admin.activity-status-report', compact('activityStatuses'));
    }

    // Units Measurement Methods
    public function showUnitsMeasurement()
    {
        $measurements = DB::table('measurement')->orderBy('meauId', 'ASC')->get();
        return view('admin.units-measurement', compact('measurements'));
    }

    public function showAddUnitMeasurement()
    {
        return view('admin.add-unit-measurement');
    }

    public function storeAddUnitMeasurement(Request $request)
    {
        $request->validate([
            'unit' => 'required|string|max:50|unique:measurement,unit',
            'description' => 'required|string|max:255',
        ]);

        DB::table('measurement')->insert([
            'unit' => $request->unit,
            'description' => $request->description,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.units-measurement')->with('success', 'Unit measurement added successfully!');
    }

    public function showEditUnitMeasurement($id)
    {
        $measurement = DB::table('measurement')->where('meauId', $id)->first();
        if (!$measurement) {
            return redirect()->route('admin.units-measurement')->with('error', 'Unit measurement not found!');
        }
        return view('admin.edit-unit-measurement', compact('measurement'));
    }

    public function updateUnitMeasurement(Request $request, $id)
    {
        $request->validate([
            'unit' => 'required|string|max:50|unique:measurement,unit,' . $id . ',meauId',
            'description' => 'required|string|max:255',
        ]);

        DB::table('measurement')
            ->where('meauId', $id)
            ->update([
                'unit' => $request->unit,
                'description' => $request->description,
            ]);

        return redirect()->route('admin.units-measurement')->with('success', 'Unit measurement updated successfully!');
    }

    public function deleteUnitMeasurement($id)
    {
        DB::table('measurement')->where('meauId', $id)->delete();
        return redirect()->route('admin.units-measurement')->with('success', 'Unit measurement deleted successfully!');
    }

    public function showUnitsMeasurementReport()
    {
        $measurements = DB::table('measurement')->orderBy('meauId', 'ASC')->get();
        return view('admin.units-measurement-report', compact('measurements'));
    }

    // Persons Methods
    public function showPersons()
    {
        // First, let's get all persons without join to see if data exists
        $persons = DB::table('person')->orderBy('personId', 'ASC')->get();
        
        // If we have persons, try to get the implementing partners
        if ($persons->count() > 0) {
            $persons = DB::table('person')
                ->select('person.*', 'actor.Actor_name as implementing_partner')
                ->leftJoin('actor', 'person.actorId', '=', 'actor.Actor_name')
                ->orderBy('person.personId', 'ASC')
                ->get();
        }
        
        return view('admin.persons', compact('persons'));
    }

    public function showAddPerson()
    {
        $actors = DB::table('actor')->orderBy('Actor_name', 'ASC')->get();
        return view('admin.add-person', compact('actors'));
    }

    public function storeAddPerson(Request $request)
    {
        $request->validate([
            'Name' => 'required|string|max:255|unique:person,Name',
            'actorId' => 'required|string|max:255',
        ]);

        DB::table('person')->insert([
            'Name' => $request->Name,
            'actorId' => $request->actorId,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.persons')->with('success', 'Person added successfully!');
    }

    public function showEditPerson($id)
    {
        $person = DB::table('person')->where('personId', $id)->first();
        if (!$person) {
            return redirect()->route('admin.persons')->with('error', 'Person not found!');
        }
        $actors = DB::table('actor')->orderBy('Actor_name', 'ASC')->get();
        return view('admin.edit-person', compact('person', 'actors'));
    }

    public function updatePerson(Request $request, $id)
    {
        $request->validate([
            'Name' => 'required|string|max:255|unique:person,Name,' . $id . ',personId',
            'actorId' => 'required|string|max:255',
        ]);

        DB::table('person')
            ->where('personId', $id)
            ->update([
                'Name' => $request->Name,
                'actorId' => $request->actorId,
            ]);

        return redirect()->route('admin.persons')->with('success', 'Person updated successfully!');
    }

    public function deletePerson($id)
    {
        DB::table('person')->where('personId', $id)->delete();
        return redirect()->route('admin.persons')->with('success', 'Person deleted successfully!');
    }

    public function showPersonsReport()
    {
        $persons = DB::table('person')
            ->select('person.*', 'actor.Actor_name as implementing_partner')
            ->leftJoin('actor', 'person.actorId', '=', 'actor.Actor_name')
            ->orderBy('person.personId', 'ASC')
            ->get();
        return view('admin.persons-report', compact('persons'));
    }

    // Contractors Methods
    public function showContractors()
    {
        // First, let's get all contractors without join to see if data exists
        $contractors = DB::table('contractor')->orderBy('contractorId', 'ASC')->get();
        
        // If we have contractors, try to get the implementing partners
        if ($contractors->count() > 0) {
            $contractors = DB::table('contractor')
                ->select('contractor.*', 'actor.Actor_name as implementing_partner')
                ->leftJoin('actor', 'contractor.actorId', '=', 'actor.Actor_name')
                ->orderBy('contractor.contractorId', 'ASC')
                ->get();
        }
        
        return view('admin.contractors', compact('contractors'));
    }

    public function showAddContractor()
    {
        $actors = DB::table('actor')->orderBy('Actor_name', 'ASC')->get();
        return view('admin.add-contractor', compact('actors'));
    }

    public function storeAddContractor(Request $request)
    {
        $request->validate([
            'contractorName' => 'required|string|max:255|unique:contractor,contractorName',
            'contact' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'actorId' => 'required|string|max:255',
        ]);

        DB::table('contractor')->insert([
            'contractorName' => $request->contractorName,
            'contact' => $request->contact,
            'address' => $request->address,
            'actorId' => $request->actorId,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.contractors')->with('success', 'Contractor added successfully!');
    }

    public function showEditContractor($id)
    {
        $contractor = DB::table('contractor')->where('contractorId', $id)->first();
        if (!$contractor) {
            return redirect()->route('admin.contractors')->with('error', 'Contractor not found!');
        }
        $actors = DB::table('actor')->orderBy('Actor_name', 'ASC')->get();
        return view('admin.edit-contractor', compact('contractor', 'actors'));
    }

    public function updateContractor(Request $request, $id)
    {
        $request->validate([
            'contractorName' => 'required|string|max:255|unique:contractor,contractorName,' . $id . ',contractorId',
            'contact' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'actorId' => 'required|string|max:255',
        ]);

        DB::table('contractor')
            ->where('contractorId', $id)
            ->update([
                'contractorName' => $request->contractorName,
                'contact' => $request->contact,
                'address' => $request->address,
                'actorId' => $request->actorId,
            ]);

        return redirect()->route('admin.contractors')->with('success', 'Contractor updated successfully!');
    }

    public function deleteContractor($id)
    {
        DB::table('contractor')->where('contractorId', $id)->delete();
        return redirect()->route('admin.contractors')->with('success', 'Contractor deleted successfully!');
    }

    public function showContractorsReport()
    {
        $contractors = DB::table('contractor')
            ->select('contractor.*', 'actor.Actor_name as implementing_partner')
            ->leftJoin('actor', 'contractor.actorId', '=', 'actor.Actor_name')
            ->orderBy('contractor.contractorId', 'ASC')
            ->get();
        return view('admin.contractors-report', compact('contractors'));
    }

    // Venues Methods
    public function showVenues()
    {
        $venues = DB::table('venue')->orderBy('venId', 'ASC')->get();
        return view('admin.venues', compact('venues'));
    }

    public function showAddVenue()
    {
        return view('admin.add-venue');
    }

    public function storeAddVenue(Request $request)
    {
        $request->validate([
            'venue_name' => 'required|string|max:255|unique:venue,venue_name',
            'venue_address' => 'required|string|max:255',
        ]);

        DB::table('venue')->insert([
            'venue_name' => $request->venue_name,
            'venue_address' => $request->venue_address,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.venues')->with('success', 'Venue added successfully!');
    }

    public function showEditVenue($id)
    {
        $venue = DB::table('venue')->where('venId', $id)->first();
        if (!$venue) {
            return redirect()->route('admin.venues')->with('error', 'Venue not found!');
        }
        return view('admin.edit-venue', compact('venue'));
    }

    public function updateVenue(Request $request, $id)
    {
        $request->validate([
            'venue_name' => 'required|string|max:255|unique:venue,venue_name,' . $id . ',venId',
            'venue_address' => 'required|string|max:255',
        ]);

        DB::table('venue')
            ->where('venId', $id)
            ->update([
                'venue_name' => $request->venue_name,
                'venue_address' => $request->venue_address,
            ]);

        return redirect()->route('admin.venues')->with('success', 'Venue updated successfully!');
    }

    public function deleteVenue($id)
    {
        DB::table('venue')->where('venId', $id)->delete();
        return redirect()->route('admin.venues')->with('success', 'Venue deleted successfully!');
    }

    public function showVenuesReport()
    {
        $venues = DB::table('venue')->orderBy('venId', 'ASC')->get();
        return view('admin.venues-report', compact('venues'));
    }

    // Payment Modes Methods
    public function showPaymentModes()
    {
        $paymentModes = DB::table('payment_mode')->orderBy('payId', 'ASC')->get();
        return view('admin.payment-modes', compact('paymentModes'));
    }

    public function showAddPaymentMode()
    {
        return view('admin.add-payment-mode');
    }

    public function storeAddPaymentMode(Request $request)
    {
        $request->validate([
            'pay_mode' => 'required|string|max:255|unique:payment_mode,pay_mode',
        ]);

        DB::table('payment_mode')->insert([
            'pay_mode' => $request->pay_mode,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.payment-modes')->with('success', 'Payment mode added successfully!');
    }

    public function showEditPaymentMode($id)
    {
        $paymentMode = DB::table('payment_mode')->where('payId', $id)->first();
        if (!$paymentMode) {
            return redirect()->route('admin.payment-modes')->with('error', 'Payment mode not found!');
        }
        return view('admin.edit-payment-mode', compact('paymentMode'));
    }

    public function updatePaymentMode(Request $request, $id)
    {
        $request->validate([
            'pay_mode' => 'required|string|max:255|unique:payment_mode,pay_mode,' . $id . ',payId',
        ]);

        DB::table('payment_mode')
            ->where('payId', $id)
            ->update([
                'pay_mode' => $request->pay_mode,
            ]);

        return redirect()->route('admin.payment-modes')->with('success', 'Payment mode updated successfully!');
    }

    public function deletePaymentMode($id)
    {
        DB::table('payment_mode')->where('payId', $id)->delete();
        return redirect()->route('admin.payment-modes')->with('success', 'Payment mode deleted successfully!');
    }

    public function showPaymentModesReport()
    {
        $paymentModes = DB::table('payment_mode')->orderBy('payId', 'ASC')->get();
        return view('admin.payment-modes-report', compact('paymentModes'));
    }

    // Payment Tranches Methods
    public function showPaymentTranches()
    {
        $paymentTranches = DB::table('payment_tranche')->orderBy('trancheId', 'ASC')->get();
        return view('admin.payment-tranches', compact('paymentTranches'));
    }

    public function showAddPaymentTranche()
    {
        return view('admin.add-payment-tranche');
    }

    public function storeAddPaymentTranche(Request $request)
    {
        $request->validate([
            'pay_tranche' => 'required|string|max:255|unique:payment_tranche,pay_tranche',
        ]);

        DB::table('payment_tranche')->insert([
            'pay_tranche' => $request->pay_tranche,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.payment-tranches')->with('success', 'Payment tranche added successfully!');
    }

    public function showEditPaymentTranche($id)
    {
        $paymentTranche = DB::table('payment_tranche')->where('trancheId', $id)->first();
        if (!$paymentTranche) {
            return redirect()->route('admin.payment-tranches')->with('error', 'Payment tranche not found!');
        }
        return view('admin.edit-payment-tranche', compact('paymentTranche'));
    }

    public function updatePaymentTranche(Request $request, $id)
    {
        $request->validate([
            'pay_tranche' => 'required|string|max:255|unique:payment_tranche,pay_tranche,' . $id . ',trancheId',
        ]);

        DB::table('payment_tranche')
            ->where('trancheId', $id)
            ->update([
                'pay_tranche' => $request->pay_tranche,
            ]);

        return redirect()->route('admin.payment-tranches')->with('success', 'Payment tranche updated successfully!');
    }

    public function deletePaymentTranche($id)
    {
        DB::table('payment_tranche')->where('trancheId', $id)->delete();
        return redirect()->route('admin.payment-tranches')->with('success', 'Payment tranche deleted successfully!');
    }

    public function showPaymentTranchesReport()
    {
        $paymentTranches = DB::table('payment_tranche')->orderBy('trancheId', 'ASC')->get();
        return view('admin.payment-tranches-report', compact('paymentTranches'));
    }

    // Project Frequencies Methods
    public function showProjectFrequencies()
    {
        $projectFrequencies = DB::table('project_freq')->orderBy('proId', 'ASC')->get();
        return view('admin.project-frequencies', compact('projectFrequencies'));
    }

    public function showAddProjectFrequency()
    {
        return view('admin.add-project-frequency');
    }

    public function storeAddProjectFrequency(Request $request)
    {
        $request->validate([
            'Rep_frequency' => 'required|string|max:255|unique:project_freq,Rep_frequency',
        ]);

        DB::table('project_freq')->insert([
            'Rep_frequency' => $request->Rep_frequency,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.project-frequencies')->with('success', 'Project reporting frequency added successfully!');
    }

    public function showEditProjectFrequency($id)
    {
        $projectFrequency = DB::table('project_freq')->where('proId', $id)->first();
        if (!$projectFrequency) {
            return redirect()->route('admin.project-frequencies')->with('error', 'Project reporting frequency not found!');
        }
        return view('admin.edit-project-frequency', compact('projectFrequency'));
    }

    public function updateProjectFrequency(Request $request, $id)
    {
        $request->validate([
            'Rep_frequency' => 'required|string|max:255|unique:project_freq,Rep_frequency,' . $id . ',proId',
        ]);

        DB::table('project_freq')
            ->where('proId', $id)
            ->update([
                'Rep_frequency' => $request->Rep_frequency,
            ]);

        return redirect()->route('admin.project-frequencies')->with('success', 'Project reporting frequency updated successfully!');
    }

    public function deleteProjectFrequency($id)
    {
        DB::table('project_freq')->where('proId', $id)->delete();
        return redirect()->route('admin.project-frequencies')->with('success', 'Project reporting frequency deleted successfully!');
    }

    public function showProjectFrequenciesReport()
    {
        $projectFrequencies = DB::table('project_freq')->orderBy('proId', 'ASC')->get();
        return view('admin.project-frequencies-report', compact('projectFrequencies'));
    }

    // Components Methods
    public function showComponents()
    {
        $components = DB::table('component')->orderBy('compId', 'ASC')->get();
        return view('admin.components', compact('components'));
    }

    public function showAddComponent()
    {
        return view('admin.add-component');
    }

    public function storeAddComponent(Request $request)
    {
        $request->validate([
            'component_name' => 'required|string|max:255|unique:component,component_name',
        ]);

        DB::table('component')->insert([
            'component_name' => $request->component_name,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.components')->with('success', 'Component added successfully!');
    }

    public function showEditComponent($id)
    {
        $component = DB::table('component')->where('compId', $id)->first();
        if (!$component) {
            return redirect()->route('admin.components')->with('error', 'Component not found!');
        }
        return view('admin.edit-component', compact('component'));
    }

    public function updateComponent(Request $request, $id)
    {
        $request->validate([
            'component_name' => 'required|string|max:255|unique:component,component_name,' . $id . ',compId',
        ]);

        DB::table('component')
            ->where('compId', $id)
            ->update([
                'component_name' => $request->component_name,
            ]);

        return redirect()->route('admin.components')->with('success', 'Component updated successfully!');
    }

    public function deleteComponent($id)
    {
        DB::table('component')->where('compId', $id)->delete();
        return redirect()->route('admin.components')->with('success', 'Component deleted successfully!');
    }

    public function showComponentsReport()
    {
        $components = DB::table('component')->orderBy('compId', 'ASC')->get();
        return view('admin.components-report', compact('components'));
    }

    // Sub-Components Methods
    public function showSubComponents()
    {
        $subComponents = DB::table('subcomponent')->orderBy('subId', 'ASC')->get();
        return view('admin.sub-components', compact('subComponents'));
    }

    public function showAddSubComponent()
    {
        $components = DB::table('component')->orderBy('compId', 'ASC')->get();
        return view('admin.add-sub-component', compact('components'));
    }

    public function storeAddSubComponent(Request $request)
    {
        $request->validate([
            'sub_name' => 'required|string|max:255|unique:subcomponent,sub_name',
            'comid' => 'required|integer|exists:component,compId',
        ]);

        DB::table('subcomponent')->insert([
            'sub_name' => $request->sub_name,
            'comid' => $request->comid,
            'addedby' => session('admin_id') ?? 1,
        ]);

        return redirect()->route('admin.sub-components')->with('success', 'Sub-component added successfully!');
    }

    public function showEditSubComponent($id)
    {
        $subComponent = DB::table('subcomponent')->where('subId', $id)->first();
        if (!$subComponent) {
            return redirect()->route('admin.sub-components')->with('error', 'Sub-component not found!');
        }
        $components = DB::table('component')->orderBy('compId', 'ASC')->get();
        return view('admin.edit-sub-component', compact('subComponent', 'components'));
    }

    public function updateSubComponent(Request $request, $id)
    {
        $request->validate([
            'sub_name' => 'required|string|max:255|unique:subcomponent,sub_name,' . $id . ',subId',
            'comid' => 'required|integer|exists:component,compId',
        ]);

        DB::table('subcomponent')
            ->where('subId', $id)
            ->update([
                'sub_name' => $request->sub_name,
                'comid' => $request->comid,
            ]);

        return redirect()->route('admin.sub-components')->with('success', 'Sub-component updated successfully!');
    }

    public function deleteSubComponent($id)
    {
        DB::table('subcomponent')->where('subId', $id)->delete();
        return redirect()->route('admin.sub-components')->with('success', 'Sub-component deleted successfully!');
    }

    public function showSubComponentsReport()
    {
        $subComponents = DB::table('subcomponent')->orderBy('subId', 'ASC')->get();
        return view('admin.sub-components-report', compact('subComponents'));
    }

    // Quality Checks - Indicator Performance Tracking
    public function showIndicatorPerformance()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        // Get indicator performance data from the database, ordered by newest first (indicator_id DESC)
        $indicatorPerformances = DB::table('indication_profile')
            ->orderBy('indicator_id', 'desc')
            ->get();
        
        return view('admin.indicator-performance', compact('indicatorPerformances'));
    }

    public function showIndicatorPerformanceReview($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        // Get specific indicator performance record
        $performance = DB::table('indication_profile')
            ->where('indicator_id', $id)
            ->first();

        if (!$performance) {
            return redirect()->route('admin.indicator-performance')
                ->with('error', 'Record not found.');
        }

        return view('admin.indicator-performance-review', compact('performance'));
    }

    public function approveIndicatorPerformance($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            // Update the status to approved
            DB::table('indication_profile')
                ->where('indicator_id', $id)
                ->update(['status' => 'Approved']);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateIndicatorPerformance(Request $request, $id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'year' => 'required',
            'indicator_type' => 'required',
            'description' => 'required',
            'unit_measurement' => 'required',
            'target' => 'required|numeric',
            'quarter' => 'required',
            'indicator_category' => 'required',
            'baseline' => 'required|numeric',
            'achieved' => 'required|numeric',
            'achievement_percentage' => 'required|numeric',
            'freq_data_collection' => 'required',
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        try {
            DB::table('indication_profile')
                ->where('indicator_id', $id)
                ->update([
                    'year' => $request->year,
                    'proId' => $request->quarter,
                    'indicator_desc' => $request->description,
                    'indicatorId' => $request->indicator_type,
                    'icat' => $request->indicator_category,
                    'measuId' => $request->unit_measurement,
                    'data' => $request->freq_data_collection,
                    'baseline' => $request->baseline,
                    'target' => $request->target,
                    'acheived' => $request->achieved,
                    'acheivement' => $request->achievement_percentage,
                    'comment' => $request->breakdown_achieved,
                    'commentAc' => $request->breakdown_plan,
                    'rmk' => $request->remarks,
                    'status' => $request->status,
                ]);

            return redirect()->route('admin.indicator-performance')
                ->with('success', 'Record updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error updating record: ' . $e->getMessage()]);
        }
    }

    public function deleteIndicatorPerformance($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            DB::table('indication_profile')
                ->where('indicator_id', $id)
                ->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Beneficiary Performance Tracking Methods
    public function showBeneficiaryPerformance()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        // Get beneficiary performance data from the view with proper names, ordered by newest first
        $beneficiaryPerformances = DB::table('beneficiary_profile_vw')
            ->orderBy('profile_id', 'desc')
            ->get();
        
        return view('admin.beneficiary-performance', compact('beneficiaryPerformances'));
    }

    public function showBeneficiaryPerformanceReview($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        // Get specific beneficiary performance record from the view
        $performance = DB::table('beneficiary_profile_vw')
            ->where('profile_id', $id)
            ->first();

        if (!$performance) {
            return redirect()->route('admin.beneficiary-performance')
                ->with('error', 'Record not found.');
        }

        return view('admin.beneficiary-performance-review', compact('performance'));
    }

    public function approveBeneficiaryPerformance($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            DB::table('beneficiary_profile')
                ->where('profile_id', $id)
                ->update(['admstatus' => 'approve']);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function rejectBeneficiaryPerformance($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            DB::table('beneficiary_profile')
                ->where('profile_id', $id)
                ->update(['admstatus' => 'reject']);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Disbursement Performance Methods
    public function showDisbursementPerformance()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }
        
        $disbursementPerformances = DB::table('disbursement_view')
            ->orderBy('disburs_id', 'desc')
            ->get();
            
        return view('admin.disbursement-performance', compact('disbursementPerformances'));
    }

    public function showDisbursementPerformanceReview($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }
        
        $performance = DB::table('disbursement_view')
            ->where('disburs_id', $id)
            ->first();
            
        if (!$performance) {
            return redirect()->route('admin.disbursement-performance')
                ->with('error', 'Record not found.');
        }
        
        return view('admin.disbursement-performance-review', compact('performance'));
    }

    public function approveDisbursementPerformance($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            DB::table('disbursement')
                ->where('disburs_id', $id)
                ->update(['admstatus' => 'approve']);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function rejectDisbursementPerformance($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            DB::table('disbursement')
                ->where('disburs_id', $id)
                ->update(['admstatus' => 'reject']);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateDisbursementPerformance(Request $request, $id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'year' => 'required',
            'quarter' => 'required',
            'disburs_source' => 'required',
            'comp_id' => 'required',
            'subcomp' => 'required',
            'querter_taeget' => 'required|numeric',
            'actual' => 'required|numeric',
            'commit' => 'required|numeric',
            'perfor' => 'required|numeric',
            'execu' => 'required|numeric',
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        try {
            DB::table('disbursement')
                ->where('disburs_id', $id)
                ->update([
                    'year' => $request->year,
                    'quarter' => $request->quarter,
                    'disburs_source' => $request->disburs_source,
                    'comp_id' => $request->comp_id,
                    'subcomp' => $request->subcomp,
                    'querter_taeget' => $request->querter_taeget,
                    'actual' => $request->actual,
                    'commit' => $request->commit,
                    'perfor' => $request->perfor,
                    'execu' => $request->execu,
                    'admstatus' => $request->status === 'Approved' ? 'approve' : ($request->status === 'Rejected' ? 'reject' : 'pending'),
                ]);

            return redirect()->route('admin.disbursement-performance')
                ->with('success', 'Record updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error updating record: ' . $e->getMessage()]);
        }
    }

    public function deleteDisbursementPerformance($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            DB::table('disbursement')
                ->where('disburs_id', $id)
                ->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateBeneficiaryPerformance(Request $request, $id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'year' => 'required',
            'quarter' => 'required',
            'region' => 'required',
            'activity' => 'required',
            'intervention' => 'required',
            'beneficiary' => 'required',
            'pwd' => 'required|numeric',
            'youth' => 'required|numeric',
            'female' => 'required|numeric',
            'total_ben' => 'required|numeric',
            'town_village' => 'required',
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        try {
            DB::table('beneficiary_profile')
                ->where('profile_id', $id)
                ->update([
                    'year' => $request->year,
                    'proId' => $request->quarter,
                    'regId' => $request->region,
                    'activity_id' => $request->activity,
                    'comp' => $request->intervention,
                    'benId' => $request->beneficiary,
                    'npwd' => $request->pwd,
                    'nyouth' => $request->youth,
                    'female' => $request->female,
                    'beneficiary_no' => $request->total_ben,
                    'community' => $request->town_village,
                    'admstatus' => $request->status === 'Approved' ? 'approve' : ($request->status === 'Rejected' ? 'reject' : 'pending'),
                ]);

            return redirect()->route('admin.beneficiary-performance')
                ->with('success', 'Record updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error updating record: ' . $e->getMessage()]);
        }
    }

    public function deleteBeneficiaryPerformance($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            DB::table('beneficiary_profile')
                ->where('profile_id', $id)
                ->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Contract/MOU Performance Methods
    public function showContractPerformance()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $contracts = DB::table('cperformance_vw')
            ->orderBy('conId', 'desc')
            ->get();

        return view('admin.contract-performance', compact('contracts'));
    }

    public function showContractPerformanceReview($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $contract = DB::table('cperformance_vw')
            ->where('conId', $id)
            ->first();

        if (!$contract) {
            return redirect()->route('admin.contract-performance')
                ->with('error', 'Contract performance record not found.');
        }

        return view('admin.contract-performance-review', compact('contract'));
    }

    public function approveContractPerformance($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            DB::table('contract_performance')
                ->where('conId', $id)
                ->update(['status' => 'Approved']);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function rejectContractPerformance($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            DB::table('contract_performance')
                ->where('conId', $id)
                ->update(['status' => 'Rejected']);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateContractPerformance(Request $request, $id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'year' => 'required|numeric',
            'proId' => 'required',
            'compId' => 'required',
            'subId' => 'required',
            'actorId' => 'required',
            'personId' => 'required',
            'intervenId' => 'required',
            'ctyId' => 'required',
            'stuId' => 'required|numeric',
            'name' => 'required',
            'cost' => 'required|numeric',
            'key_issue' => 'required',
            'recommendation' => 'required',
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        try {
            DB::table('contract_performance')
                ->where('conId', $id)
                ->update([
                    'year' => $request->year,
                    'proId' => $request->proId,
                    'compId' => $request->compId,
                    'subId' => $request->subId,
                    'actorId' => $request->actorId,
                    'personId' => $request->personId,
                    'intervenId' => $request->intervenId,
                    'ctyId' => $request->ctyId,
                    'stuId' => $request->stuId,
                    'name' => $request->name,
                    'cost' => $request->cost,
                    'key_issue' => $request->key_issue,
                    'recommendation' => $request->recommendation,
                    'status' => $request->status,
                ]);

            return redirect()->route('admin.contract-performance')
                ->with('success', 'Contract performance updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error updating contract performance: ' . $e->getMessage()]);
        }
    }

    public function deleteContractPerformance($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            DB::table('contract_performance')
                ->where('conId', $id)
                ->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    private function getDashboardStats()
    {
        $stats = [
            'pending_approvals' => DB::table('beneficiary_profile')
                ->where('status', 'Pending')
                ->count(),
            'total_beneficiaries' => DB::table('beneficiary_profile')->count(),
            'total_activities' => DB::table('activities')->count(),
            'total_regions' => DB::table('region')->count(),
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
            'pwd_beneficiaries' => DB::table('beneficiary_profile')
                ->whereNotNull('npwd')
                ->where('npwd', '!=', '')
                ->sum('npwd'),
        ];

        return $stats;
    }

    // Training Performance Methods
    public function showTrainingPerformance()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            $trainings = DB::table('trainin_vw')->orderBy('train_Id', 'desc')->get();
            return view('admin.training-performance', compact('trainings'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading training performance data: ' . $e->getMessage());
        }
    }

    public function showTrainingPerformanceReview($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            $training = DB::table('trainin_vw')->where('train_Id', $id)->first();
            
            if (!$training) {
                return redirect()->route('admin.training-performance')->with('error', 'Training performance record not found.');
            }
            
            return view('admin.training-performance-review', compact('training'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading training performance review: ' . $e->getMessage());
        }
    }

    public function approveTrainingPerformance($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            $training = DB::table('train')->where('train_Id', $id)->first();
            
            if (!$training) {
                return redirect()->back()->with('error', 'Training performance record not found.');
            }
            
            DB::table('train')->where('train_Id', $id)->update(['status' => 'Approved']);
            
            return redirect()->route('admin.training-performance')->with('success', 'Training performance record approved successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error approving training performance record: ' . $e->getMessage());
        }
    }

    public function rejectTrainingPerformance($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            $training = DB::table('train')->where('train_Id', $id)->first();
            
            if (!$training) {
                return redirect()->back()->with('error', 'Training performance record not found.');
            }
            
            DB::table('train')->where('train_Id', $id)->update(['status' => 'Rejected']);
            
            return redirect()->route('admin.training-performance')->with('success', 'Training performance record rejected successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error rejecting training performance record: ' . $e->getMessage());
        }
    }

    public function updateTrainingPerformance(Request $request, $id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'year' => 'required|numeric',
            'proId' => 'required',
            'traId' => 'required',
            'compId' => 'required',
            'subId' => 'required',
            'actorId' => 'required',
            'personId' => 'required',
            'venId' => 'required',
            'train_desc' => 'required',
            'cost' => 'required|numeric',
            'total_target' => 'required|integer',
            'total_acheived' => 'required|integer',
            'key_issue' => 'nullable',
            'recommendation' => 'nullable',
            'rmk' => 'nullable',
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        try {
            DB::table('train')
                ->where('train_Id', $id)
                ->update([
                    'year' => $request->year,
                    'proId' => $request->proId,
                    'traId' => $request->traId,
                    'compId' => $request->compId,
                    'subId' => $request->subId,
                    'actorId' => $request->actorId,
                    'personId' => $request->personId,
                    'venId' => $request->venId,
                    'train_desc' => $request->train_desc,
                    'cost' => $request->cost,
                    'total_target' => $request->total_target,
                    'total_acheived' => $request->total_acheived,
                    'key_issue' => $request->key_issue,
                    'recommendation' => $request->recommendation,
                    'rmk' => $request->rmk,
                    'status' => $request->status,
                ]);

            return redirect()->route('admin.training-performance')
                ->with('success', 'Training performance updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error updating training performance: ' . $e->getMessage()]);
        }
    }

    public function deleteTrainingPerformance($id)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        try {
            DB::table('train')
                ->where('train_Id', $id)
                ->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // General Reports
    public function showBeneficiariesNew()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $beneficiaries = DB::table('beneficiary_profile')
            ->orderBy('profile_id', 'desc')
            ->get();

        return view('admin.beneficiaries-new', compact('beneficiaries'));
    }

    public function showIndicators()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $indicators = DB::table('indicator_profile_vw')
            ->orderBy('indicator_id', 'desc')
            ->get();

        return view('admin.indicators', compact('indicators'));
    }

    public function showContracts()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $contracts = DB::table('cperformance_vw')
            ->orderBy('conId', 'desc')
            ->get();

        return view('admin.contracts', compact('contracts'));
    }

    public function showTrainings()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $trainings = DB::table('trainin_vw')
            ->orderBy('train_Id', 'desc')
            ->get();

        return view('admin.trainings', compact('trainings'));
    }

}
