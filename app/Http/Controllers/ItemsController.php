<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::query()->orderByDesc('id')->paginate(10);
        return view('pages.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $item = Item::query()->create([
                'name' => $request->name
            ]);

            if ($request->options && $request->options != null) {

                if (count($request->options) == count($request->prices)) {

                    for ($i = 0; $i < count($request->options); $i++) {

                        ItemType::query()->create([
                            'item_id' => $item->id,
                            'name' => $request->options[$i],
                            'price' => $request->prices[$i]
                        ]);

                    }

                }
            }

            DB::commit();

            session()->flash('save');
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Item::query()->findOrFail($id);
        $items = Item::all();
        $items_types = $item->itemTypes()->orderByDesc('id')->paginate(10);
        return view('pages.items.items_types', compact('items_types', 'items', 'item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Item::query()->findOrFail($id);
        return view('pages.items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $item = Item::query()->findOrFail($id);

            $item->update([
                'name' => $request->name
            ]);

            $item->itemTypes()->delete();

            if ($request->options && $request->options != null) {

                if (count($request->options) == count($request->prices)) {

                    for ($i = 0; $i < count($request->options); $i++) {

                        ItemType::query()->create([
                            'item_id' => $item->id,
                            'name' => $request->options[$i],
                            'price' => $request->prices[$i]
                        ]);

                    }

                }
            }

            DB::commit();

            session()->flash('update');
            return redirect()->route('items.index');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $item = Item::query()->findOrFail($id);
            $item->itemTypes()->delete();
            $item->delete();

            DB::commit();

            session()->flash('delete');
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
