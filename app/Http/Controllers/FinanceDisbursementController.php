<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disbursement;
use Illuminate\Support\Facades\DB;

class FinanceDisbursementController extends Controller
{
    // List all disbursements
    public function index()
    {
        // Use the view to get component and subcomponent names
        $disbursements = DB::table('disbursement_view')->orderByDesc('disburs_id')->get();
        return view('finance.disbursements.index', compact('disbursements'));
    }

    // Show create form
    public function create()
    {
        $years = range(date('Y'), 2020);
        $quarters = ['Q1' => 'Quarter 1', 'Q2' => 'Quarter 2', 'Q3' => 'Quarter 3', 'Q4' => 'Quarter 4'];
        $sources = ['IFAD Grant', 'IFAD Loan', 'AFD', 'GEF', 'GCF'];
        $components = DB::table('component')->orderBy('component_name')->get();
        return view('finance.disbursements.create', compact('years', 'quarters', 'sources', 'components'));
    }

    // Store new disbursement
    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required',
            'quarter' => 'required',
            'disburs_source' => 'required',
            'comp_id' => 'required',
            'subcomp' => 'required',
            'comp_three' => 'nullable',
            'total_budjet' => 'nullable',
            'querter_taeget' => 'required',
            'actual' => 'required',
            'commit' => 'required',
            'perfor' => 'required',
            'execu' => 'required',
        ]);
        $validated['admstatus'] = 'pending';
        Disbursement::create($validated);
        return redirect()->route('finance.disbursements.index')->with('success', 'Disbursement record saved successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $disbursement = Disbursement::findOrFail($id);
        $years = range(date('Y'), 2020);
        $quarters = ['Q1' => 'Quarter 1', 'Q2' => 'Quarter 2', 'Q3' => 'Quarter 3', 'Q4' => 'Quarter 4'];
        $sources = ['IFAD Grant', 'IFAD Loan', 'AFD', 'GEF', 'GCF'];
        $components = DB::table('component')->orderBy('component_name')->get();
        return view('finance.disbursements.edit', compact('disbursement', 'years', 'quarters', 'sources', 'components'));
    }

    // Update disbursement
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'year' => 'required',
            'quarter' => 'required',
            'disburs_source' => 'required',
            'comp_id' => 'required',
            'subcomp' => 'required',
            'comp_three' => 'nullable',
            'total_budjet' => 'nullable',
            'querter_taeget' => 'required',
            'actual' => 'required',
            'commit' => 'required',
            'perfor' => 'required',
            'execu' => 'required',
        ]);
        $disbursement = Disbursement::findOrFail($id);
        $disbursement->update($validated);
        return redirect()->route('finance.disbursements.index')->with('success', 'Disbursement record updated successfully.');
    }

    // Delete disbursement
    public function destroy($id)
    {
        $deleted = Disbursement::destroy($id);
        return response()->json(['success' => (bool)$deleted]);
    }

    // AJAX: Load subcomponents for a component
    public function loadSubcomponents(Request $request)
    {
        $compId = $request->input('cid');
        $subcomponents = DB::table('subcomponent')->where('comid', $compId)->orderBy('sub_name')->get();
        $options = '<option value="">Select Sub-component</option>';
        foreach ($subcomponents as $sub) {
            $options .= '<option value="' . $sub->subId . '">' . htmlspecialchars($sub->sub_name) . '</option>';
        }
        return response($options);
    }
} 