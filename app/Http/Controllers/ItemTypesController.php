<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemType;
use Illuminate\Http\Request;

class ItemTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        $items_types = ItemType::query()->orderByDesc('id')->paginate(10);
        return view('pages.items_types.index', compact('items_types', 'items'));
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

            ItemType::query()->create([
                'item_id' => $request->item_id,
                'name' => $request->name,
                'price' => $request->price
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
    public function show(ItemType $itemTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemType $itemTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $item_type = ItemType::query()->findOrFail($id);
            $item_type->update([
                'item_id' => $request->item_id,
                'name' => $request->name,
                'price' => $request->price
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

            $item_type = ItemType::query()->findOrFail($id);
            $item_type->delete();

            session()->flash('delete');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
