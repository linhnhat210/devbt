<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Device;
use App\Models\Warranty;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarrantyController extends Controller
{
    public function index(Request $request)
    {
        $query = Warranty::with(['device', 'warrantyUser']);

        if ($request->filled('imei')) {
            $query->where('imei', 'LIKE', '%' . $request->imei . '%');
        }

        $warranties = $query->paginate(10)->appends(request()->query());

        return view('admin.warranties.index', compact('warranties'));
    }

    public function show($id)
    {
        $warranty = Warranty::with(['device', 'warrantyUser'])->findOrFail($id);
        // dd($warranty->start_date);
        return view('admin.warranties.show', compact('warranty'));
    }

    public function create()
    {
        $users = User::all();
        $usedImei = Warranty::pluck('imei')->toArray();
        $devices = Device::whereNotIn('imei', $usedImei)->get();

        return view('admin.warranties.create', compact('users', 'devices'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'imei' => 'required|string|max:255|unique:warranties,imei',
            'device_id' => 'nullable|exists:devices,id',
            'type' => 'nullable|string|max:255',
            'warranty_user_id' => 'required|exists:users,id',
            'error_description' => 'nullable|string',
            'note' => 'nullable|string',
            'attachment' => 'nullable|string|max:255',
            'status' => 'required|string|in:Chờ khách hàng xác nhận,Đã tạo đơn,Đang bảo hành,Hoàn thành',
        ]);

        $data['code'] = 'BH-' . strtoupper(Str::random(6));
        $data['start_date'] = now();
        $data['expired_at'] = now()->addYear();
        $data['created_by'] = Auth::id();

        Warranty::create($data);

        return redirect()->route('admin.warranties.index')->with('success', 'Tạo bảo hành thành công!');
    }

    public function edit($id)
    {
        $warranty = Warranty::findOrFail($id);
        $devices = Device::where(function ($query) use ($warranty) {
            $query->whereNotIn('imei', Warranty::where('id', '!=', $warranty->id)->pluck('imei')->toArray())
                  ->orWhere('imei', $warranty->imei);
        })->get();
        // dd($warranty);
        $users = User::all();

        return view('admin.warranties.edit', compact('warranty', 'devices', 'users'));
    }

    public function update(Request $request, $id)
    {
        $warranty = Warranty::findOrFail($id);

        $data = $request->validate([
            'imei' => 'required|string|max:255|unique:warranties,imei,' . $warranty->id,
            'device_id' => 'nullable|exists:devices,id',
            'type' => 'nullable|string|max:255',
            'warranty_user_id' => 'required|exists:users,id',
            'error_description' => 'nullable|string',
            'note' => 'nullable|string',
            'attachment' => 'nullable|string|max:255',
            'status' => 'required|string|in:Chờ khách hàng xác nhận,Đã tạo đơn,Đang bảo hành,Hoàn thành',
        ]);

        // Không cho sửa các trường cố định
        unset($data['code'], $data['created_by'], $data['start_date'], $data['expired_at']);

        $warranty->update($data);

        return redirect()->route('admin.warranties.index')->with('success', 'Cập nhật bảo hành thành công!');
    }

    public function destroy($id)
    {
        $warranty = Warranty::findOrFail($id);
        $warranty->delete();

        return redirect()->route('admin.warranties.index')->with('success', 'Xóa bảo hành thành công!');
    }
}
