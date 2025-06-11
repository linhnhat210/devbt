<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class AgentController extends Controller
{
    //
    public function index(Request $request)
    {
        $querry = Agent::query(); // Tạo một query builder

        // Thêm điều kiện tìm kiếm nếu có
        if ($request->filled('name')) {
            $querry->where('name', 'LIKE', '%' . $request->name . '%');
        }

        // Tiến hành phân trang
        $agents = $querry->paginate(10)->appends(request()->query());

        return view('admin.agents.index', compact('agents'));

    }

    public function show($id){
        // lấy ra dữ liệu chi tiết theo id
        $agent = Agent::findOrFail($id);
        
        // đổ thông tin chi tiết ra giao diện 
        return view('admin.agents.show', compact('agent'));
    }
    public function create()
    {
        return view('admin.agents.create');
    }


    public function store(Request $request)
    {
        // Lấy danh sách danh mục để hiển thị trong dropdown
        $agnets = new Agent();
        // lấy dữ liệu từ form
        $agnets->name = $request->name;
        $agnets->address = $request->address;
        $agnets->tax_code = $request->tax_code;
        $agnets->phone = $request->phone;
        $agnets->email = $request->email;
        $agnets->contact_person = $request->contact_person;

        
        
        // validate
        $dataValidate = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'tax_code' => 'required|string|max:50|unique:agents,tax_code',
            'phone' => 'required|string|regex:/^[0-9]{9,15}$/',
            'email' => 'required|email|max:255|unique:agents,email',
            'contact_person' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Tên đại lý / khách hàng không được để trống.',
            'name.string' => 'Tên đại lý / khách hàng phải là chuỗi.',
            'name.max' => 'Tên đại lý / khách hàng không được vượt quá 255 ký tự.',

            'address.required' => 'Địa chỉ không được để trống.',
            'address.string' => 'Địa chỉ phải là chuỗi.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

            'tax_code.required' => 'Mã số thuế / CCCD không được để trống.',
            'tax_code.string' => 'Mã số thuế / CCCD phải là chuỗi.',
            'tax_code.max' => 'Mã số thuế / CCCD không được vượt quá 50 ký tự.',
            'tax_code.unique' => 'Mã số thuế / CCCD đã tồn tại.',

            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.string' => 'Số điện thoại phải là chuỗi.',
            'phone.regex' => 'Số điện thoại không đúng định dạng (9-15 số).',

            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email đã tồn tại.',

            'contact_person.string' => 'Người liên hệ phải là chuỗi.',
            'contact_person.max' => 'Người liên hệ không được vượt quá 255 ký tự.',
        ]);

        
        Agent::create($dataValidate);
        
        
        
        return redirect()->route('admin.agents.index')->with('success', 'Thêm Đại lý thành công!');
        
    }
    public function edit($id)
    {

        $agent = Agent::findOrFail($id);
        return view('admin.agents.edit', compact('agent'));
    }


    public function update(Request $request, $id)
    {
     
        $agent = Agent::findOrFail($id);
        
        
        // validate
        $dataValidate = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'tax_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('agents', 'tax_code')->ignore($id),
            ],
            'phone' => 'required|string|regex:/^[0-9]{9,15}$/',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('agents', 'email')->ignore($id),
            ],
            'contact_person' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Tên đại lý / khách hàng không được để trống.',
            'name.string' => 'Tên đại lý / khách hàng phải là chuỗi.',
            'name.max' => 'Tên đại lý / khách hàng không được vượt quá 255 ký tự.',

            'address.required' => 'Địa chỉ không được để trống.',
            'address.string' => 'Địa chỉ phải là chuỗi.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

            'tax_code.required' => 'Mã số thuế / CCCD không được để trống.',
            'tax_code.string' => 'Mã số thuế / CCCD phải là chuỗi.',
            'tax_code.max' => 'Mã số thuế / CCCD không được vượt quá 50 ký tự.',
            'tax_code.unique' => 'Mã số thuế / CCCD đã tồn tại.',

            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.string' => 'Số điện thoại phải là chuỗi.',
            'phone.regex' => 'Số điện thoại không đúng định dạng (9-15 số).',

            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email đã tồn tại.',

            'contact_person.string' => 'Người liên hệ phải là chuỗi.',
            'contact_person.max' => 'Người liên hệ không được vượt quá 255 ký tự.',
        ]);

        
        $agent->update($dataValidate);
        
        return redirect()->route('admin.agents.index')->with('success', 'Cập nhật Đại lý thành công!');
        
    }
    public function search(Request $request)
    {
        // dd($request);
        $query = $request->get('q');
        $agents = Agent::where('name', 'like', '%' . $query . '%')
            ->select('id', 'name')
            ->limit(20)
            ->get();

        return response()->json($agents);
    }



}
