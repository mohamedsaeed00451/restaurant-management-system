<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('pages.users.index', compact('users'));
    }

    public function dashboard()
    {
        $data['items'] = Item::all()->count();
        $data['items_types'] = ItemType::all()->count();
        $data['employees'] = Employee::all()->count();
        $data['invoices'] = Invoice::all()->count();
        $data['expenses'] = Expense::all()->count();

        return view('pages.dashboard', $data);
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
        //
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

    public function login(Request $request)
    {
        $credentials = $request->only(['username', 'password']);
        if (!Auth::guard('web')->attempt($credentials)) {
            return redirect()->back();
        }

        $user = Auth::guard('web')->user();

        session()->flash('login');
        if ($user->is_admin) {
            return redirect(RouteServiceProvider::HOME);
        }

        return redirect(RouteServiceProvider::CASHIER);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->flash('logout');
        return redirect('/');
    }

    public function getUserInvoices($id)
    {
        $data['user'] = User::query()->findOrFail($id);
        $data['invoices'] = Invoice::query()->where('user_id', $id)->orderByDesc('id')->paginate(10);
        $data['invoices_count'] = Invoice::query()->where('user_id', $id)->count();
        $data['invoices_total_amount'] = Invoice::query()->where('user_id', $id)->sum('total');
        $data['invoices_day_amount'] = Invoice::query()->where('user_id', $id)->whereDay('created_at', date('d'))->sum('total');
        $data['invoices_month_amount'] = Invoice::query()->where('user_id', $id)->whereMonth('created_at', date('m'))->sum('total');
        $data['invoices_day_count'] = Invoice::query()->where('user_id', $id)->whereDay('created_at', date('d'))->count();
        $data['invoices_month_count'] = Invoice::query()->where('user_id', $id)->whereMonth('created_at', date('m'))->count();

        return view('pages.users.invoices', $data);
    }

    public function getUserExpenses($id)
    {
        $data['user'] = User::query()->findOrFail($id);
        $data['expenses'] = Expense::query()->where('user_id', $id)->orderByDesc('id')->paginate(10);
        $data['expenses_count'] = Expense::query()->where('user_id', $id)->count();
        $data['expenses_total_amount'] = Expense::query()->where('user_id', $id)->sum('price');
        $data['expenses_day_amount'] = Expense::query()->where('user_id', $id)->whereDay('created_at', date('d'))->sum('price');
        $data['expenses_month_amount'] = Expense::query()->where('user_id', $id)->whereMonth('created_at', date('m'))->sum('price');
        $data['expenses_day_count'] = Expense::query()->where('user_id', $id)->whereDay('created_at', date('d'))->count();
        $data['expenses_month_count'] = Expense::query()->where('user_id', $id)->whereMonth('created_at', date('m'))->count();

        return view('pages.users.expenses', $data);
    }

}
