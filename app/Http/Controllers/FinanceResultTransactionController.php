<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FTransaction;
use App\Models\FComponent;
use App\Models\FSubcomponent;
use Carbon\Carbon;

class FinanceResultTransactionController extends Controller
{
    // List all result transactions (from ComSubComView)
    public function index()
    {
        $transactions = DB::table('comsubcom_vw')->orderBy('comid', 'asc')->get();
        return view('finance.result_transactions.index', compact('transactions'));
    }

    // Show the edit form for a subcomponent transaction
    public function edit($subid)
    {
        $row = DB::table('comsubcom_vw')->where('subid', $subid)->first();
        if (!$row) {
            return redirect()->route('finance.result-transactions.index')->with('error', 'Record not found.');
        }
        // Get project_freq and flookup for dropdowns
        $quarters = DB::table('project_freq')->pluck('Rep_frequency');
        $outputs = DB::table('flookup')->pluck('output');
        $years = range(date('Y'), 2020);
        return view('finance.result_transactions.edit', compact('row', 'quarters', 'outputs', 'years'));
    }

    // Update the transaction and balances
    public function update(Request $request, $subid)
    {
        $request->validate([
            'year' => 'required',
            'qrts' => 'required',
            'outp' => 'required',
            'oamt' => 'required|numeric',
            'bal' => 'required|numeric',
            'cbalance' => 'required|numeric',
        ]);
        $row = DB::table('ComSubComView')->where('subid', $subid)->first();
        if (!$row) {
            return redirect()->route('finance.result-transactions.index')->with('error', 'Record not found.');
        }
        // Insert into ftransaction
        FTransaction::create([
            'comid' => $row->comid,
            'compid' => $row->compid,
            'comdesc' => $row->component_desc,
            'subcom' => $row->sub_desc,
            'yr' => $request->year,
            'qtr' => $request->qrts,
            'outp' => $request->outp,
            'outAm' => $request->oamt,
            'bal' => $request->bal,
            'usr' => session('clientmsuid'),
            'entdate' => Carbon::now()->toDateString(),
        ]);
        // Update fsubcomponent balance
        FSubcomponent::where('subid', $subid)->update([
            'sub_allocation_balance' => $request->bal
        ]);
        // Update fcomponent balance
        FComponent::where('comid', $row->comid)->update([
            'C_allocation_balance' => $request->cbalance
        ]);
        return redirect()->route('finance.result-transactions.index')->with('success', 'Output Transaction Successful.');
    }
} 