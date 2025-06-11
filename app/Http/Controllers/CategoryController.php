<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        // Tìm kiếm theo tên nếu có
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        $categories = $query->paginate(10)->appends(request()->query());

        return view('admin.categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $dataValidate = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:categories,code',
            'internal_price' => 'required|numeric|min:0',
            'warranty_period' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'Tên thiết bị không được để trống.',
            'code.required' => 'Mã chủng loại không được để trống.',
            'code.unique' => 'Mã chủng loại đã tồn tại.',
            'internal_price.required' => 'Giá nội bộ không được để trống.',
            'warranty_period.required' => 'Thời gian bảo hành không được để trống.',
        ]);

        Category::create($dataValidate);

        return redirect()->route('admin.categories.index')->with('success', 'Thêm chủng loại thiết bị thành công!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $dataValidate = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:categories,code,' . $category->id,
            'internal_price' => 'required|numeric|min:0',
            'warranty_period' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $category->update($dataValidate);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật chủng loại thiết bị thành công!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Xóa chủng loại thiết bị thành công!');
    }
}
