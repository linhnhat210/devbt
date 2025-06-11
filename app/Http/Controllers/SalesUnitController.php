<?php

namespace App\Http\Controllers;

use App\Models\SalesUnit;
use Illuminate\Http\Request;

class SalesUnitController extends Controller
{
    public function index(Request $request)
    {
        $query = SalesUnit::query();

        // Tìm kiếm theo tên nếu có
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        $salesUnits = $query->paginate(10)->appends(request()->query());

        return view('admin.sales_units.index', compact('salesUnits'));
    }

    public function show($id)
    {
        $salesUnit = SalesUnit::findOrFail($id);
        return view('admin.sales_units.show', compact('salesUnit'));
    }

    public function create()
    {
        return view('admin.sales_units.create');
    }

    public function store(Request $request)
    {
        $dataValidate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Tên đơn vị không được để trống.',
        ]);

        SalesUnit::create($dataValidate);

        return redirect()->route('admin.sales_units.index')->with('success', 'Thêm đơn vị bán hàng thành công!');
    }

    public function edit($id)
    {
        $salesUnit = SalesUnit::findOrFail($id);
        return view('admin.sales_units.edit', compact('salesUnit'));
    }

    public function update(Request $request, $id)
    {
        $salesUnit = SalesUnit::findOrFail($id);

        $dataValidate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $salesUnit->update($dataValidate);

        return redirect()->route('admin.sales_units.index')->with('success', 'Cập nhật đơn vị bán hàng thành công!');
    }

    public function destroy($id)
    {
        $salesUnit = SalesUnit::findOrFail($id);
        $salesUnit->delete();

        return redirect()->route('admin.sales_units.index')->with('success', 'Xóa đơn vị bán hàng thành công!');
    }
}
