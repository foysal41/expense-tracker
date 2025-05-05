<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\IncomeRequest;
use App\Http\Requests\ExpenseRequest;
use App\Http\Requests\LiabilitieRequest;
use App\Models\Income;
use App\Models\Expense;
use App\Models\Liabilitie;
use App\Models\Category;

class TrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.income');
    }

    public function filter(Request $request)
    {
       $month  = $request->month;
       $year = $request->year;

       $income = Income::whereMonth('income_date', $month)
                    ->whereYear('income_date', $year)
                    ->get();

    $expense = Expense::whereMonth('expense_date', $month)
                      ->whereYear('expense_date', $year)
                      ->get();

    $liability = Liabilitie::whereMonth('liabilities_date', $month)
                          ->whereYear('liabilities_date', $year)
                          ->get();

    return response()->json([
        'income' => $income,
        'expense' => $expense,
        'liability' => $liability,
    ]);

    }


    public function dashboard()
    {
        $totalIncome = Income::sum('income_amount');
        $totalExpense = Expense::sum('expense_amount');
        $totalLiabilitie = Liabilitie::sum('liabilities_amount');
        $balance = $totalIncome - $totalExpense;
        return view('dashboard' , compact('totalIncome','totalExpense', 'totalLiabilitie', 'balance'));
    }

    public function income()
    {
        $incomes = Income::latest()->get();
        //dd($incomes);
        return view('pages.income' , compact('incomes'));

    }

    public function expense()
    {

        $expenses = Expense::all();
        return view('pages.expense' , compact('expenses'));
    }

    public function liabilitie()
    {
        $liabilities = Liabilitie::all();

        return view('pages.liabilities' , compact('liabilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeincome(IncomeRequest $request)
    {
        Income::create($request->only('income_name' , 'income_amount' , 'income_date'));
        return redirect()->back()->with('success', 'Income added successfully!');
    }

    public function storeexpense(ExpenseRequest $request)
    {

        Expense::create($request->only('expense_name' , 'expense_amount' , 'expense_date'));
        return redirect()->back()->with('success', 'Expense added successfully!');
    }

    public function storeliabilitie(LiabilitieRequest $request)
    {


        Liabilitie::create($request->only('liabilities_name' , 'liabilities_amount' , 'liabilities_date'));
        return redirect()->back()->with('success', 'Liabilitie added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function destroyLiabilitie(string $id)
    {
        $liability = Liabilitie::find($id);

        if ($liability) {
            $liability->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
