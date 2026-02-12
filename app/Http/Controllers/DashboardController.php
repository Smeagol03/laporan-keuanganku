<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total saldo (pemasukan - pengeluaran)
        $totalIncome = $user->transactions()
            ->whereHas('category', function ($query) {
                $query->where('type', 'income');
            })
            ->sum('amount');

        $totalExpense = $user->transactions()
            ->whereHas('category', function ($query) {
                $query->where('type', 'expense');
            })
            ->sum('amount');

        $totalBalance = $totalIncome - $totalExpense;

        // Ringkasan bulanan
        $currentMonthIncome = $user->transactions()
            ->whereHas('category', function ($query) {
                $query->where('type', 'income');
            })
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount');

        $currentMonthExpense = $user->transactions()
            ->whereHas('category', function ($query) {
                $query->where('type', 'expense');
            })
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount');

        return view('dashboard', compact('totalBalance', 'totalIncome', 'totalExpense', 'currentMonthIncome', 'currentMonthExpense'));
    }
}
