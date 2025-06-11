<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Debt;
use App\Models\User;
use App\Models\Project;
use App\Models\Service;
use App\Models\Warranty;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DevicePayment;

class DebtController extends Controller
{
    public function index(Request $request)
    {
        $query = Debt::with(['project.agent', 'warranty', 'devicePayment', 'service']);

        if ($request->filled('debt_code')) {
            $query->where('debt_code', 'LIKE', '%' . $request->debt_code . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $debts = $query->paginate(10)->appends(request()->query());

        return view('admin.debts.index', compact('debts'));
    }

    public function show($id)
    {
        $debt = Debt::with(['project', 'warranty', 'devicePayment', 'service'])->findOrFail($id);
        return view('admin.debts.show', compact('debt'));
    }

    public function create(Request $request)
    {
        $type = $request->query('type');

        if (!in_array($type, ['warranty', 'device', 'service'])) {
            abort(404, 'Loại công nợ không hợp lệ');
        }
        $projects = Project::all();

        switch ($type) {
            case 'warranty':
                $usedWarrantyIds = Debt::whereNotNull('warranty_id')->pluck('warranty_id')->toArray();

                $warranties = Warranty::where('status', 'Hoàn thành')
                    ->whereNotIn('id', $usedWarrantyIds)
                    ->get(); // hoặc lọc theo điều kiện nếu cần
                

                return view('admin.debts.create_warranty', [
                    'warranties' => $warranties,
                ]);
            
            case 'device':
 
                $users = User::all();

                return view('admin.debts.create_device', [
                    'users' => $users,
                    'projects' => $projects,
                ]);

            case 'service':
                $users = User::all();

                return view('admin.debts.create_service', [
                    'users' => $users,
                    'projects' => $projects
                ]);
        }
    }
    protected function generateUniqueDebtCode()
    {
        do {
            $code = 'CN' . now()->format('Ymd') . strtoupper(Str::random(5));
        } while (Debt::where('debt_code', $code)->exists());

        return $code;
    }

    public function store(Request $request)
    {
        $debtType = $request->input('debt_type');

        $rules = [
            'debt_type' => 'required|in:1,2,3',
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'attachment' => 'nullable|file|max:10240',
        ];

        if ($debtType == 1) {
            $rules['warranty_id'] = 'required|exists:warranties,id';
        }

        if ($debtType == 2) {
            $rules['start_date'] = 'required|date_format:d/m/Y';
        }

        if ($debtType == 3) {
            $rules['start_date'] = 'required|date_format:d/m/Y';
            $rules['service_type'] = 'required|string|max:255';
            $rules['monthly_fee'] = 'required|numeric|min:0';
            $rules['billing_cycle'] = 'required|string|max:255';
            $rules['billing_months'] = 'required|integer|min:1';
        }

        $data = $request->validate($rules);
        $data['debt_code'] = $this->generateUniqueDebtCode();
        $data['status'] = 'Chờ thanh toán';

        // Xử lý đính kèm file nếu có
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment')->store('attachments', 'public');
            $data['attachment'] = $file;
        }

        // Gán due_date tự động
        if ($debtType == 1) {
            // Bảo hành - due_date là ngày hết hạn
            $warranty = Warranty::with('device')->findOrFail($data['warranty_id']);
            $data['project_id'] = $warranty->device->project_id ?? null;
            $data['due_date'] = $warranty->expired_at;
        }

        if ($debtType == 2) {
            // Thiết bị - due_date là ngày bắt đầu thu phí
            $startDate = Carbon::createFromFormat('d/m/Y', $data['start_date'])->format('Y-m-d');
            $devicePayment = DevicePayment::create([
                'start_date' => $startDate,
            ]);
            $data['device_payment_id'] = $devicePayment->id;
            $data['project_id'] = $request->input('project_id');
            $data['due_date'] = $startDate;
        }

        if ($debtType == 3) {
            // Dịch vụ - due_date là kỳ thu đầu tiên
            $startDate = Carbon::createFromFormat('d/m/Y', $data['start_date'])->format('Y-m-d');
            $service = Service::create([
                'start_date' => $startDate,
                'service_type' => $request->input('service_type'),
                'monthly_fee' => $request->input('monthly_fee'),
                'billing_cycle' => $request->input('billing_cycle'),
                'billing_months' => $request->input('billing_months'),
            ]);
            $data['service_id'] = $service->id;
            $data['project_id'] = $request->input('project_id');
            $data['due_date'] = $startDate;
        }

        // Dọn dữ liệu không liên quan
        if ($debtType != 1) unset($data['warranty_id']);
        if ($debtType != 2) unset($data['device_payment_id']);
        if ($debtType != 3) unset($data['service_id']);

        unset($data['start_date'], $data['service_type'], $data['monthly_fee'], $data['billing_cycle'], $data['billing_months']);

        // Tạo công nợ
        Debt::create($data);

        return redirect()->route('admin.debts.index')->with('success', 'Tạo công nợ thành công!');
    }


    public function edit(Debt $debt)
    {
        $projects = Project::all();

        switch ((int) $debt->debt_type) {
            case 1: // Bảo hành
                $warranties = Warranty::all(); // dùng nếu cần hiển thị thêm
                return view('admin.debts.edit_warranty', [
                    'debt' => $debt,
                    'warranties' => $warranties,
                ]);

            case 2: // Thiết bị
                $users = User::all();
                return view('admin.debts.edit_device', [
                    'debt' => $debt,
                    'projects' => $projects,
                    'users' => $users,
                ]);

            case 3: // Dịch vụ
                $users = User::all();
                return view('admin.debts.edit_service', [
                    'debt' => $debt,
                    'projects' => $projects,
                    'users' => $users,
                ]);

            default:
                abort(404, 'Loại công nợ không hợp lệ');
        }
    }


    public function update(Request $request, Debt $debt)
    {
        $rules = [
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:1000',
            'attachment' => 'nullable|file|max:10240', // 10MB
        ];

        // Cập nhật riêng theo loại công nợ
        switch ((int)$debt->debt_type) {
            case 1: // Bảo hành
                // Không cần thêm rule gì nữa
                break;

            case 2: // Thiết bị
                $rules['start_date'] = 'nullable|date';
                break;

            case 3: // Dịch vụ
                $rules['service_type'] = 'required|string|max:255';
                break;

            default:
                abort(400, 'Loại công nợ không hợp lệ.');
        }

        $data = $request->validate($rules);
        // dd($data['note']);

        // Cập nhật attachment nếu có
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        // Cập nhật debt
        $debt->update([
            'amount' => $data['amount'],
            'note' => $data['note'] ?? null,
            'attachment' => $data['attachment'] ?? $debt->attachment,
        ]);
        if ($debt->debt_type == 2 && $debt->devicePayment) {
            if (!empty($data['start_date'])) {
                $debt->devicePayment->update([
                    'start_date' => $data['start_date'],
                ]);
            }
        }

        // Cập nhật bảng liên kết
        if ($debt->debt_type == 3 && $debt->service) {
            $debt->service->update([
                'service_type' => $data['service_type'],
            ]);
        }

        return redirect()->route('admin.debts.index')->with('success', 'Cập nhật công nợ thành công!');
    }

    public function approve(Debt $debt)

    {
        if ($debt->status === 'Hoàn thành') {
            return redirect()->route('admin.debts.index')
                ->with('error', 'Công nợ đã hoàn thành, không thể xác nhận lại.');
        }

        if ($debt->status === 'Hủy') {
            return redirect()->route('admin.debts.index')
                ->with('error', 'Công nợ đã bị hủy, không thể xác nhận thanh toán.');
        }

        $debt->update(['status' => 'Hoàn thành']);

        return redirect()->route('admin.debts.index')->with('success', 'Đã xác nhận thanh toán.');
    }

    public function cancel(Debt $debt)
    {
        if ($debt->status === 'Hủy') {
            return redirect()->route('admin.debts.index')
                ->with('error', 'Công nợ đã bị hủy trước đó.');
        }

        if ($debt->status === 'Hoàn thành') {
            return redirect()->route('admin.debts.index')
                ->with('error', 'Công nợ đã hoàn thành, không thể hủy.');
        }

        $debt->update(['status' => 'Hủy']);

        return redirect()->route('admin.debts.index')->with('success', 'Đã hủy công nợ.');
    }

}

