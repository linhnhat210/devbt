<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Project;
use App\Models\Category;
use App\Models\Warranty;
use App\Models\SalesUnit;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        $query = Device::with(['project', 'category', 'warehouse', 'salesUnit']); // Eager Load các quan hệ

        // Thêm điều kiện tìm kiếm nếu có
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        // Tiến hành phân trang
        $devices = $query->paginate(10)->appends(request()->query());

        return view('admin.devices.index', compact('devices'));
    }

    public function show($id)
    {
        $device = Device::with(['project', 'category', 'warehouse', 'salesUnit'])->findOrFail($id);
        return view('admin.devices.show', compact('device'));
    }

    public function create()
    {
        // Lấy các dữ liệu liên quan
        $projects = Project::get(); 
        $categories = Category::get();
        $warehouses = Warehouse::get();
        $salesUnits = SalesUnit::get();

        return view('admin.devices.create', compact('projects', 'categories', 'warehouses', 'salesUnits'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $dataValidate = $request->validate([
            'imei' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'sales_unit_id' => 'nullable|exists:sales_units,id',
            'serial' => 'required|string|max:255',
            'manufactured_at' => 'nullable|date',
            'expired_at' => 'nullable|date',
        ], [
            'imei.required' => 'IMEI không được để trống.',
            'project_id.required' => 'Vui lòng chọn dự án.',
            'project_id.exists' => 'Dự án không hợp lệ.',
            'name.required' => 'Tên thiết bị không được để trống.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
            'warehouse_id.required' => 'Vui lòng chọn kho.',
            'warehouse_id.exists' => 'Kho không hợp lệ.',
            'sales_unit_id.exists' => 'Đơn vị bán không hợp lệ.',
            'serial.required' => 'Serial không được để trống.',
            'manufactured_at.date' => 'Ngày sản xuất không hợp lệ.',
            'expired_at.date' => 'Ngày hết hạn không hợp lệ.',
        ]);

        // Lưu thiết bị vào DB
        Device::create($dataValidate);

        // Chuyển hướng về danh sách với thông báo thành công
        return redirect()->route('admin.devices.index')->with('success', 'Thiết bị đã được thêm thành công!');
    }


    public function edit($id)
    {
        $device = Device::findOrFail($id);
        $projects = Project::all();
        $categories = Category::all();
        $warehouses = Warehouse::all();
        $salesUnits = SalesUnit::all();

        return view('admin.devices.edit', compact('device', 'projects', 'categories', 'warehouses', 'salesUnits'));
    }

    public function update(Request $request, $id)
    {
        $device = Device::findOrFail($id);

        // Validate dữ liệu
        $dataValidate = $request->validate([
            'imei' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'sales_unit_id' => 'required|exists:sales_units,id',
            'serial' => 'required|string|max:255',
            'manufacture_date' => 'nullable|date',
            'expiration_date' => 'nullable|date',
        ], [
            'imei.required' => 'IMEI không được để trống.',
            'project_id.required' => 'Vui lòng chọn dự án.',
            'project_id.exists' => 'Dự án không hợp lệ.',
            'name.required' => 'Tên thiết bị không được để trống.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
            'warehouse_id.required' => 'Vui lòng chọn kho.',
            'warehouse_id.exists' => 'Kho không hợp lệ.',
            'sales_unit_id.required' => 'Vui lòng chọn đơn vị bán.',
            'sales_unit_id.exists' => 'Đơn vị bán không hợp lệ.',
            'serial.required' => 'Serial không được để trống.',
            'manufacture_date.date' => 'Ngày sản xuất không đúng định dạng.',
            'expiration_date.date' => 'Ngày hết hạn không đúng định dạng.',
        ]);

        $device->update($dataValidate);

        return redirect()->route('admin.devices.index')->with('success', 'Cập nhật thiết bị thành công!');
    }
    public function destroy($id)
    {
        $device = Device::findOrFail($id);

        // Kiểm tra xem có đơn bảo hành nào có cùng imei không
        $hasWarranty = Warranty::where('imei', $device->imei)->exists();

        if ($hasWarranty) {
            return redirect()->route('admin.devices.index')
                ->with('error', 'Không thể xóa vì thiết bị đang được sử dụng trong đơn bảo hành!');
        }

        $device->delete();

        return redirect()->route('admin.devices.index')
            ->with('success', 'Xóa thiết bị thành công!');
    }
}
