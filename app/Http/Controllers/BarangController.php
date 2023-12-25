<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Item;
use App\Models\Request as ModelsRequest;
use App\Models\RequestItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = ModelsRequest::with('employee', 'items')->get();

        return view('barang.request', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $items = Item::all();

        return view('barang.create', compact('employees', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Simpan permintaan
            $newRequest = ModelsRequest::create([
                'employee_id' => $request->employee_id,
                'request_date' => now(),
                'status' => 'pending',
            ]);

            // Simpan item permintaan
            foreach ($request->items as $item) {
                RequestItem::create([
                    'request_id' => $newRequest->id,
                    'item_id' => $item['item_id'],
                    'quantity' => $item['quantity'],
                ]);

                // Kurangi stok barang
                $itemModel = Item::find($item['item_id']);

                $itemModel->decrement('jumlah_stok', $item['quantity']);
            }

            // Commit transaksi
            DB::commit();
            Session::flash('success', 'Permintaan barang berhasil disimpan.');

            return redirect()->route('barang.index')->with('success', 'Permintaan barang berhasil disimpan.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();
            Session::flash('error', 'Permintaan barang gagal disimpan.');

            return redirect()->route('barang.create')->with('error', 'Gagal menyimpan permintaan barang. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request = ModelsRequest::with('employee')->find($id);

        return view('barang.show', compact('request'));
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
}
