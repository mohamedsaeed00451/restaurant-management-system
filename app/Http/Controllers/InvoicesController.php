<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Item;
use App\Models\ItemType;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['invoices'] = Invoice::query()->orderByDesc('id')->paginate(10);
        $data['invoices_count'] = Invoice::query()->count();
        $data['invoices_total_amount'] = Invoice::query()->sum('total');
        $data['invoices_day_amount'] = Invoice::query()->whereDay('created_at', date('d'))->sum('total');
        $data['invoices_month_amount'] = Invoice::query()->whereMonth('created_at', date('m'))->sum('total');
        $data['invoices_day_count'] = Invoice::query()->whereDay('created_at', date('d'))->count();
        $data['invoices_month_count'] = Invoice::query()->whereMonth('created_at', date('m'))->count();

        return view('pages.invoices.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();
        $item = Item::query()->first();
        if ($item) {
            $item_types = ItemType::query()->where('item_id', $item->id)->get();
        } else {
            $item_types = [];
        }

        return view('pages.invoices.create', compact('items', 'item_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $invoice = Invoice::query()->create([
                'total' => $request->total_price,
                'user_id' => auth()->user()->id
            ]);

            return ['id' => $invoice->id];

        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $invoice = Invoice::query()->findOrFail($id);
            $invoice->delete();

            session()->flash('delete');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getItemTypes(Request $request)
    {
        $item_types = ItemType::query()->where('item_id', $request->item_id)->get();
        return view('pages.invoices.items_types')->with(['item_types' => $item_types]);
    }
}
