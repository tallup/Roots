<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class FinanceTransactionListController extends Controller
{
    public function index()
    {
        $transactions = DB::table('ftransaction_vw')->orderBy('entdate', 'asc')->get();
        return view('finance.transaction_list.index', compact('transactions'));
    }
} 