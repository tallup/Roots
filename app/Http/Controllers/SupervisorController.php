<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SupervisorController extends Controller
{
    public function showLogin()
    {
        return view('supervisor.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = DB::table('tblclient')->where('Email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->Password)) {
            // Set session variables
            Session::put('supervisor_id', $user->ID);
            Session::put('supervisor_name', $user->CompanyName);
            Session::put('supervisor_email', $user->Email);
            Session::put('supervisor_region', $user->region_name);
            // Look up regid from region table
            $region = DB::table('region')->where('region_name', $user->region_name)->first();
            if ($region) {
                Session::put('supervisor_regid', $region->regId);
            } else {
                Session::forget('supervisor_regid');
            }
            return redirect()->route('supervisor.dashboard');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    public function logout()
    {
        Session::forget(['supervisor_id', 'supervisor_name', 'supervisor_email', 'supervisor_region']);
        return redirect()->route('supervisor.login');
    }

    public function dashboard()
    {
        if (!session()->has('supervisor_id')) {
            return redirect()->route('supervisor.login');
        }
        $region_name = session('supervisor_region');
        $regionFilter = $region_name ? ['regid' => $region_name] : [];

        // Beneficiaries
        $total_beneficiaries = DB::table('beneficiary_profile_vw')->where($regionFilter)->count();
        // Pending Approvals
        $pending_approvals = DB::table('beneficiary_profile_vw')->where(array_merge($regionFilter, ['status' => 'pending']))->count();
        // File Uploads
        $file_uploads = DB::table('beneficiary_profile_vw')->where($regionFilter)->whereNotNull('add_profile')->where('add_profile', '!=', '')->count();
        // Activities
        $activities = DB::table('beneficiary_profile_vw')->where($regionFilter)->distinct('activity')->count('activity');
        // Recent Beneficiaries
        $recent_beneficiaries = DB::table('beneficiary_profile_vw')->where($regionFilter)->orderByDesc('profile_id')->limit(5)->get();
        // Indicators
        $indicators = DB::table('beneficiary_profile_vw')->where($regionFilter)->distinct('indtyp')->count('indtyp');
        // Contracts
        $contracts = DB::table('beneficiary_profile_vw')->where($regionFilter)->distinct('comp')->count('comp');
        // Trainings
        $trainings = DB::table('beneficiary_profile_vw')->where($regionFilter)->distinct('SubComp')->count('SubComp');

        return view('supervisor.dashboard', [
            'total_beneficiaries' => $total_beneficiaries,
            'pending_approvals' => $pending_approvals,
            'file_uploads' => $file_uploads,
            'activities' => $activities,
            'indicators' => $indicators,
            'contracts' => $contracts,
            'trainings' => $trainings,
            'recent_beneficiaries' => $recent_beneficiaries,
        ]);
    }

    public function showForgotPassword()
    {
        return view('supervisor.forgot-password');
    }

    public function handleForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = DB::table('tblclient')->where('Email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'No supervisor found with that email.');
        }
        // Store email in session for reset step
        session(['reset_email' => $request->email]);
        return redirect()->route('supervisor.reset-password');
    }

    public function showResetPassword(Request $request)
    {
        if (!session('reset_email')) {
            return redirect()->route('supervisor.forgot-password')->with('error', 'Please enter your email first.');
        }
        return view('supervisor.reset-password', ['email' => session('reset_email')]);
    }

    public function handleResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);
        $user = DB::table('tblclient')->where('Email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'No supervisor found with that email.');
        }
        DB::table('tblclient')->where('Email', $request->email)->update([
            'Password' => Hash::make($request->password)
        ]);
        session()->forget('reset_email');
        return redirect()->route('supervisor.login')->with('status', 'Password reset successfully! You can now login.');
    }

    public function beneficiaries() {
        $region_name = session('supervisor_region');
        $regionFilter = $region_name ? ['regid' => $region_name] : [];
        $beneficiaries = DB::table('beneficiary_profile_vw')
            ->where($regionFilter)
            ->orderByDesc('profile_id')
            ->get();
        return view('supervisor.beneficiaries', compact('beneficiaries'));
    }

    public function reviewBeneficiary($profile_id) {
        $region_name = session('supervisor_region');
        $regionFilter = $region_name ? ['regid' => $region_name] : [];
        $beneficiary = DB::table('beneficiary_profile_vw')
            ->where($regionFilter)
            ->where('profile_id', $profile_id)
            ->first();
        if (!$beneficiary) {
            return redirect()->route('supervisor.beneficiaries')->with('error', 'Beneficiary not found or not in your region.');
        }
        return view('supervisor.beneficiary_review', compact('beneficiary'));
    }

    public function submitReview(Request $request, $profile_id)
    {
        $request->validate([
            'status' => 'required|in:Approve,Reject',
            'sup_revw' => 'required|string|max:1000',
        ]);

        $region_name = session('supervisor_region');
        $regionFilter = $region_name ? ['regid' => $region_name] : [];

        // Only update if the record belongs to the supervisor's region
        $updated = DB::table('beneficiary_profile')
            ->where($regionFilter)
            ->where('profile_id', $profile_id)
            ->update([
                'status' => $request->input('status'),
                'sup_revw' => $request->input('sup_revw'),
            ]);

        if ($updated) {
            return redirect()->route('supervisor.beneficiaries')->with('success', 'Review submitted successfully!');
        } else {
            return back()->with('error', 'Unable to update record.');
        }
    }

    public function indicators() {
        $indicators = DB::table('indicator_profile_vw')
            ->orderByDesc('indicator_id')
            ->get();
        return view('supervisor.indicators', compact('indicators'));
    }

    public function reviewIndicator($indicator_id) {
        $indicator = DB::table('indicator_profile_vw')
            ->where('indicator_id', $indicator_id)
            ->first();
        if (!$indicator) {
            return redirect()->route('supervisor.indicators')->with('error', 'Indicator not found.');
        }
        return view('supervisor.indicator_review', compact('indicator'));
    }

    public function submitIndicatorReview(Request $request, $indicator_id)
    {
        $request->validate([
            'status' => 'required|in:Approve,Reject',
        ]);

        // Update the status in the base table
        $updated = DB::table('indication_profile')
            ->where('indicator_id', $indicator_id)
            ->update([
                'status' => $request->input('status'),
            ]);

        if ($updated) {
            return redirect()->route('supervisor.indicators')->with('success', 'Status updated successfully!');
        } else {
            return back()->with('error', 'Unable to update record.');
        }
    }

    public function contracts() {
        $contracts = DB::table('cperformance_vw')
            ->orderByDesc('conId')
            ->get();
        return view('supervisor.contracts', compact('contracts'));
    }

    public function reviewContract($conId) {
        $contract = DB::table('cperformance_vw')
            ->where('conId', $conId)
            ->first();
        if (!$contract) {
            return redirect()->route('supervisor.contracts')->with('error', 'Contract not found.');
        }
        return view('supervisor.contract_review', compact('contract'));
    }

    public function submitContractReview(Request $request, $conId)
    {
        $request->validate([
            'status' => 'required|in:Approve,Reject',
        ]);

        $updated = DB::table('contract_performance')
            ->where('conId', $conId)
            ->update([
                'status' => $request->input('status'),
            ]);

        if ($updated) {
            return redirect()->route('supervisor.contracts')->with('success', 'Status updated successfully!');
        } else {
            return back()->with('error', 'Unable to update record.');
        }
    }

    public function trainings() {
        $trainings = DB::table('trainin_vw')
            ->orderByDesc('train_Id')
            ->get();
        return view('supervisor.trainings', compact('trainings'));
    }

    public function reviewTraining($train_Id) {
        $training = DB::table('trainin_vw')
            ->where('train_Id', $train_Id)
            ->first();
        if (!$training) {
            return redirect()->route('supervisor.trainings')->with('error', 'Training not found.');
        }
        return view('supervisor.training_review', compact('training'));
    }

    public function submitTrainingReview(Request $request, $train_Id)
    {
        $request->validate([
            'status' => 'required|in:Approve,Reject',
        ]);

        $updated = DB::table('train')
            ->where('train_Id', $train_Id)
            ->update([
                'status' => $request->input('status'),
            ]);

        if ($updated) {
            return redirect()->route('supervisor.trainings')->with('success', 'Status updated successfully!');
        } else {
            return back()->with('error', 'Unable to update record.');
        }
    }

    public function profile() {
        $user = null;
        if (session('supervisor_id')) {
            $user = DB::table('tblclient')->where('ID', session('supervisor_id'))->first();
        }
        return view('supervisor.profile', compact('user'));
    }
    public function settings() {
        return view('supervisor.settings');
    }

    public function updateSettings(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
        $user = DB::table('tblclient')->where('ID', session('supervisor_id'))->first();
        if (!$user || !\Hash::check($request->current_password, $user->Password)) {
            return back()->with('error', 'Current password is incorrect.');
        }
        DB::table('tblclient')->where('ID', $user->ID)->update([
            'Password' => bcrypt($request->new_password),
        ]);
        return back()->with('success', 'Password updated successfully!');
    }
} 