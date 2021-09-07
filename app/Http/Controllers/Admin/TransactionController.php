<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function active()
    {
        return view('pages.transaction.active', ['transaction' => Transaction::class]);
    }

    public function history()
    {
        return view('pages.transaction.history', ['transaction' => Transaction::class]);
    }

    public function payment($id)
    {
        return view('pages.transaction.payment', compact('id'));
    }

    public function create()
    {
        return view('pages.transaction.create');
    }

    public function edit($id)
    {
        return view('pages.transaction.show', compact('id'));
    }

    public function show($id)
    {
        return view('pages.transaction.show', compact('id'));
    }

    public function return($id)
    {
        return view('pages.transaction.return', compact('id'));
    }
}
