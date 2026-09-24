<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::latest()->get();

        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'code'=>'required|unique:vouchers',

            'name'=>'required',

            'type'=>'required',

            'discount_amount'=>'required|numeric',

            'minimum_purchase'=>'required|numeric',

            'quota'=>'required|integer',

            'start_date'=>'required|date',

            'expired_date'=>'required|date',

            'status'=>'required'

        ]);

        Voucher::create($request->all());

        return redirect()
            ->route('admin.vouchers.index')
            ->with('success','Voucher berhasil ditambahkan.');
    }

    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit',compact('voucher'));
    }

    public function update(Request $request,Voucher $voucher)
    {
        $request->validate([

            'code'=>'required',

            'name'=>'required',

            'type'=>'required',

            'discount_amount'=>'required|numeric',

            'minimum_purchase'=>'required|numeric',

            'quota'=>'required|integer',

            'start_date'=>'required|date',

            'expired_date'=>'required|date',

            'status'=>'required'

        ]);

        $voucher->update($request->all());

        return redirect()
            ->route('admin.vouchers.index')
            ->with('success','Voucher berhasil diubah.');
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();

        return back()->with('success','Voucher berhasil dihapus.');
    }
}