<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {
        $query = Warehouse::query();

        // Tìm kiếm theo tên nếu có
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        $warehouses = $query->paginate(10)->appends(request()->query());

        return view('admin.warehouses.index', compact('warehouses'));
    }

    public function show($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return view('admin.warehouses.show', compact('warehouse'));
    }

    public function create()
    {
        return view('admin.warehouses.create');
    }

    public function store(Request $request)
    {
        $dataValidate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Tên kho không được để trống.',
        ]);

        Warehouse::create($dataValidate);

        return redirect()->route('admin.warehouses.index')->with('success', 'Thêm kho thành công!');
    }

    public function edit($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return view('admin.warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);

        $dataValidate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $warehouse->update($dataValidate);

        return redirect()->route('admin.warehouses.index')->with('success', 'Cập nhật kho thành công!');
    }

    public function destroy($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->delete();

        return redirect()->route('admin.warehouses.index')->with('success', 'Xóa kho thành công!');
    }
}
