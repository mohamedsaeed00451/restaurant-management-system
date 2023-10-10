<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['employees'] = Employee::query()->orderByDesc('id')->paginate(10);
        $data['employees_count'] = Employee::query()->count();
        $data['employees_total_amount'] = Employee::query()->sum('salary');

        return view('pages.employees.index', $data);
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

            Employee::query()->create([
                'name' => $request->name,
                'phone' => $request->phone,
                'salary' => $request->salary,
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
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $employee = Employee::query()->findOrFail($id);
            $employee->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'salary' => $request->salary,
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

            $employee = Employee::query()->findOrFail($id);
            $employee->delete();

            session()->flash('delete');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
