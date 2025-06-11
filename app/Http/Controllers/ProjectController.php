<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agent;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Project::with(['agent', 'salesPerson', 'accountant']); // Eager Load các quan hệ

        // Thêm điều kiện tìm kiếm nếu có
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        // Tiến hành phân trang
        $projects = $query->paginate(10)->appends(request()->query());

        return view('admin.projects.index', compact('projects'));
    }


    public function show($id)
    {
        $project = Project::with(['agent', 'salesPerson', 'accountant'])->findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }
    public function create(){
        $agents = Agent::get();
        $users = User::get();
        return view('admin.projects.create', compact('agents', 'users'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $dataValidate = $request->validate([
            'name' => 'required|string|max:255',
            'agent_id' => 'required|exists:agents,id',
            'address' => 'required|string|max:255',
            'sales_user_id' => 'required|exists:users,id',
            'warranty_start_date' => 'nullable|date',
            'accountant_user_id' => 'required|exists:users,id',
            'status' => 'required|string|in:Đã triển khai,Đang triển khai,Hủy,Tạm dừng,Tạo mới',
        ], [
            'name.required' => 'Tên dự án không được để trống.',
            'agent_id.required' => 'Vui lòng chọn đại lý.',
            'agent_id.exists' => 'Đại lý không hợp lệ.',
            'address.required' => 'Địa chỉ không được để trống.',
            'sales_user_id.required' => 'Vui lòng chọn người kinh doanh phụ trách.',
            'sales_user_id.exists' => 'Người kinh doanh không hợp lệ.',
            'warranty_start_date.date' => 'Ngày bắt đầu bảo hành không đúng định dạng.',
            'accountant_user_id.required' => 'Vui lòng chọn kế toán phụ trách.',
            'accountant_user_id.exists' => 'Kế toán không hợp lệ.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ]);

        // Lưu dự án vào DB
        Project::create($dataValidate);

        // Chuyển hướng về danh sách với thông báo thành công
        return redirect()->route('admin.projects.index')->with('success', 'Dự án đã được thêm thành công!');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $agents = Agent::all();
        $users = User::all();

        return view('admin.projects.edit', compact('project', 'agents', 'users'));
    }
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $dataValidate = $request->validate([
            'name' => 'required|string|max:255',
            'agent_id' => 'required|exists:agents,id',
            'address' => 'required|string|max:255',
            'sales_user_id' => 'required|exists:users,id',
            'warranty_start_date' => 'nullable|date',
            'accountant_user_id' => 'required|exists:users,id',
            'status' => 'required|string|in:Đã triển khai,Đang triển khai,Hủy,Tạm dừng,Tạo mới',
        ], [
            'name.required' => 'Tên dự án không được để trống.',
            'agent_id.required' => 'Vui lòng chọn đại lý.',
            'agent_id.exists' => 'Đại lý không hợp lệ.',
            'address.required' => 'Địa chỉ không được để trống.',
            'sales_user_id.required' => 'Vui lòng chọn người kinh doanh phụ trách.',
            'sales_user_id.exists' => 'Người kinh doanh không hợp lệ.',
            'warranty_start_date.date' => 'Ngày bắt đầu bảo hành không đúng định dạng.',
            'accountant_user_id.required' => 'Vui lòng chọn kế toán phụ trách.',
            'accountant_user_id.exists' => 'Kế toán không hợp lệ.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ]);

        $project->update($dataValidate);

        return redirect()->route('admin.projects.index')->with('success', 'Cập nhật dự án thành công!');
    }


}
