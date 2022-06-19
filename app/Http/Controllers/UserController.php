<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $items = Inventory::with('theCategory')->get();
        return view('dashboard.index', compact('items', 'categories'));
    }

    public function addItem(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:inventories'
        ]);

        if ($validated) {
            $today = date('d M Y, H:i');
            $store = Inventory::create([
                'category_id' => $request->category_id,
                'division' => $request->division,
                'name' => $request->name,
                'stock' => $request->stock,
                'capital' => $request->capital,
                'price' => $request->price,
                'lastupdate' => $today,
            ]);
            if ($store) {
                return back()->with('success', 'Item Stocked');
            } else {
                return back()->with('error', 'Failed to add item');
            }
        } else {
            return back()->with('error', 'Failed to add item');
        }
    }

    public function sells($id)
    {
        $data = Inventory::where('id', $id)->first();
        return json_encode($data);
    }

    public function addinvoice(Request $request)
    {
        $today = date('d M Y, H:i');
        $whosthere = Auth::user()->id;
        $checker = Inventory::where('id', $request->theid)->value('stock');
        if ($request->qty > $checker) {
            return back()->with('error', 'Jumlah yang anda masukan melebihi stok');
        } else {
            $post = Transaction::create([
                'inventory_id' => $request->theid,
                'user_id' => $whosthere,
                'quantity' => $request->qty,
                'invoice' => $request->invoice,
                'date' => $today,
            ]);
            if ($post) {
                $sell = Inventory::where('id', $request->theid)->update([
                    'stock' => $checker - $request->qty
                ]);
                return back()->with('success', 'Transaction Successfully');
            }
        }
    }

    public function inventoryedit(Request $request)
    {
        $update = Inventory::where('id', $request->theids)->update([
            'name' => $request->thename,
            'stock' => $request->thestock,
        ]);
        if ($update) {
            return back()->with('success', 'Updated');
        } else {

            return back()->with('error', 'Update Error');
        }
    }
}
