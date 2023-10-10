<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->is_admin) {

            $data['expenses'] = Expense::query()->orderByDesc('id')->paginate(10);
            $data['expenses_count'] = Expense::query()->count();
            $data['expenses_total_amount'] = Expense::query()->sum('price');
            $data['expenses_day_amount'] = Expense::query()->whereDay('created_at', date('d'))->sum('price');
            $data['expenses_month_amount'] = Expense::query()->whereMonth('created_at', date('m'))->sum('price');
            $data['expenses_day_count'] = Expense::query()->whereDay('created_at', date('d'))->count();
            $data['expenses_month_count'] = Expense::query()->whereMonth('created_at', date('m'))->count();

        } else {

            $data['expenses'] = Expense::query()->where('user_id', auth()->user()->id)->orderByDesc('id')->paginate(10);
            $data['expenses_count'] = Expense::query()->where('user_id', auth()->user()->id)->count();
            $data['expenses_total_amount'] = Expense::query()->where('user_id', auth()->user()->id)->sum('price');
            $data['expenses_day_amount'] = Expense::query()->where('user_id', auth()->user()->id)->whereDay('created_at', date('d'))->sum('price');
            $data['expenses_month_amount'] = Expense::query()->where('user_id', auth()->user()->id)->whereMonth('created_at', date('m'))->sum('price');
            $data['expenses_day_count'] = Expense::query()->where('user_id', auth()->user()->id)->whereDay('created_at', date('d'))->count();
            $data['expenses_month_count'] = Expense::query()->where('user_id', auth()->user()->id)->whereMonth('created_at', date('m'))->count();

        }

        return view('pages.expenses.index', $data);
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
    public function store(Request $request)
    {
        try {

            Expense::query()->create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'price' => $request->price,
            ]);

            session()->flash('save');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expences)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expences)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $expense = Expense::query()->findOrFail($id);
            $expense->update([
                'name' => $request->name,
                'price' => $request->price,
            ]);

            session()->flash('update');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $expense = Expense::query()->findOrFail($id);
            $expense->delete();

            session()->flash('delete');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
