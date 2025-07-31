<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\SubComponent;

class FinanceController extends Controller
{
    public function showLogin()
    {
        return view('finance.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = DB::table('tblfinance')->where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('finance_id', $user->id ?? $user->ID ?? $user->id ?? $user->ID ?? null);
            Session::put('finance_name', $user->Name ?? $user->name ?? null);
            Session::put('finance_email', $user->email);
            return redirect()->route('finance.dashboard');
        }
        return back()->with('error', 'Invalid email or password.');
    }

    public function logout()
    {
        Session::forget(['finance_id', 'finance_name', 'finance_email']);
        return redirect()->route('finance.login');
    }

    public function dashboard() {
        $total_transactions = DB::table('ftransaction')->count();
        $total_components = DB::table('fcomponent')->count();
        $total_disbursements = DB::table('disbursement')->count();
        $total_subcomponents = DB::table('fsubcomponent')->count();
        $total_allocation = DB::table('fcomponent')->sum('C_allocation');
        $total_balance = DB::table('fcomponent')->sum('C_allocation_balance');
        // $pending_transactions removed (no status column)
        return view('finance.dashboard', compact(
            'total_transactions', 
            'total_components', 
            'total_disbursements',
            'total_subcomponents',
            'total_allocation',
            'total_balance'
        ));
    }

    public function components() {
        $components = DB::table('fcomponent')->orderBy('comid', 'asc')->get();
        return view('finance.components', compact('components'));
    }

    public function showAddComponent() {
        return view('finance.add_component');
    }

    public function storeAddComponent(Request $request) {
        $request->validate([
            'component' => 'required|string|max:100',
            'component_desc' => 'required|string|max:200',
            'C_allocation' => 'required|numeric',
        ]);
        $allocation = $request->C_allocation;
        $balance = $allocation; // Initial balance is the allocation
        $addedby = session('finance_id');
        $id = DB::table('fcomponent')->insertGetId([
            'component' => $request->component,
            'component_desc' => $request->component_desc,
            'C_allocation' => $allocation,
            'C_allocation_balance' => $balance,
            'addedby' => $addedby,
        ]);
        if ($id) {
            return redirect()->route('finance.components')->with('success', 'Component has been added.');
        } else {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function showEditComponent($id) {
        $component = DB::table('fcomponent')->where('comid', $id)->first();
        if (!$component) {
            return redirect()->route('finance.components')->with('error', 'Component not found.');
        }
        return view('finance.edit_component', compact('component'));
    }

    public function updateComponent(Request $request, $id) {
        $request->validate([
            'component' => 'required|string|max:100',
            'component_desc' => 'required|string|max:200',
            'C_allocation' => 'required|numeric',
        ]);
        $updated = DB::table('fcomponent')->where('comid', $id)->update([
            'component' => $request->component,
            'component_desc' => $request->component_desc,
            'C_allocation' => $request->C_allocation,
        ]);
        if ($updated) {
            return redirect()->route('finance.components')->with('success', 'Component updated successfully.');
        } else {
            return back()->with('error', 'Unable to update component.');
        }
    }

    public function componentReport() {
        $components = DB::table('fcomponent')->orderBy('comid', 'asc')->get();
        return view('finance.component_report', compact('components'));
    }

    public function deleteComponent($id) {
        $deleted = DB::table('fcomponent')->where('comid', $id)->delete();
        if ($deleted) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    // SUBCOMPONENTS
    public function subcomponents() {
        $subcomponents = DB::table('fsubcomponent')->orderBy('subid', 'asc')->get();
        return view('finance.subcomponents', compact('subcomponents'));
    }

    public function showAddSubcomponent() {
        return view('finance.add_subcomponent');
    }

    public function storeAddSubcomponent(Request $request) {
        $request->validate([
            'compid' => 'required|integer',
            'subcomponent' => 'required|string|max:20',
            'sub_desc' => 'required|string|max:100',
            'sub_allocation' => 'required|string|max:50',
        ]);
        $addedby = session('finance_id');
        $id = DB::table('fsubcomponent')->insertGetId([
            'compid' => $request->compid,
            'subcomponent' => $request->subcomponent,
            'sub_desc' => $request->sub_desc,
            'sub_allocation' => $request->sub_allocation,
            'sub_allocation_balance' => str_replace(',', '', $request->sub_allocation),
            'addedby' => $addedby,
        ]);
        if ($id) {
            return redirect()->route('finance.subcomponents')->with('success', 'Subcomponent has been added.');
        } else {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function showEditSubcomponent($id) {
        $subcomponent = DB::table('fsubcomponent')->where('subid', $id)->first();
        if (!$subcomponent) {
            return redirect()->route('finance.subcomponents')->with('error', 'Subcomponent not found.');
        }
        return view('finance.edit_subcomponent', compact('subcomponent'));
    }

    public function updateSubcomponent(Request $request, $id) {
        $request->validate([
            'compid' => 'required|integer',
            'subcomponent' => 'required|string|max:20',
            'sub_desc' => 'required|string|max:100',
            'sub_allocation' => 'required|string|max:50',
        ]);
        $updated = DB::table('fsubcomponent')->where('subid', $id)->update([
            'compid' => $request->compid,
            'subcomponent' => $request->subcomponent,
            'sub_desc' => $request->sub_desc,
            'sub_allocation' => $request->sub_allocation,
            'sub_allocation_balance' => str_replace(',', '', $request->sub_allocation),
        ]);
        if ($updated) {
            return redirect()->route('finance.subcomponents')->with('success', 'Subcomponent updated successfully.');
        } else {
            return back()->with('error', 'Unable to update subcomponent.');
        }
    }

    public function deleteSubcomponent($id) {
        $deleted = DB::table('fsubcomponent')->where('subid', $id)->delete();
        if ($deleted) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function subcomponentReport() {
        $subcomponents = DB::table('fsubcomponent')->orderBy('subid', 'asc')->get();
        return view('finance.subcomponent_report', compact('subcomponents'));
    }
} 