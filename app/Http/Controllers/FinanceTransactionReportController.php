<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class FinanceTransactionReportController extends Controller
{
    public function index()
    {
        $transactions = DB::table('ftransaction_vw')->orderBy('entdate', 'asc')->get();
        return view('finance.transaction_report.index', compact('transactions'));
    }
} 