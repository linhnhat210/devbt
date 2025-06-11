@extends('layouts.admin')

@section('title', 'Cập nhật bảo hành')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <a href="{{ route('admin.warranties.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Cập nhật bảo hành</div>
                <div class="card-body">
                    <form action="{{ route('admin.warranties.update', $warranty->id) }}" method="POST">
                        @csrf


                        <div class="row g-3">
                            {{-- Mã bảo hành (không sửa) --}}
                            <div class="col-md-6">
                                <label for="code" class="form-label">Mã bảo hành</label>
                                <input type="text" class="form-control" name="code" value="{{ $warranty->code }}"
                                    readonly> {{-- ✅ readonly --}}
                            </div>

                            {{-- IMEI thiết bị (hiển thị dưới dạng text, không sửa được) --}}
                            <div class="col-md-6">
                                <label class="form-label"><span class="text-danger">*</span> IMEI thiết bị</label>
                                <input type="text" class="form-control bg-light"
                                    value="{{ $warranty->imei }} - {{ $warranty->device->name ?? '' }}" readonly disabled>

                                {{-- Trường hidden để giữ giá trị --}}
                                <input type="hidden" name="imei" value="{{ $warranty->imei }}">
                                <input type="hidden" name="device_id" value="{{ $warranty->device_id }}">
                            </div>

                            {{-- Hidden device_id --}}
                            <input type="hidden" id="device_id" name="device_id"
                                value="{{ old('device_id', $warranty->device_id) }}"> {{-- ✅ --}}

                            {{-- Ngày bắt đầu (chỉ xem) --}}
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Ngày bắt đầu bảo hành</label>
                                <input type="text" class="form-control bg-light" value="{{ $warranty->start_date }}"
                                    readonly>
                            </div>

                            {{-- Ngày hết hạn (chỉ xem) --}}
                            <div class="col-md-6">
                                <label for="expired_at" class="form-label">Ngày hết hạn bảo hành</label>
                                <input type="text" class="form-control bg-light" value="{{ $warranty->expired_at }}"
                                    readonly>
                            </div>

                            {{-- Người bảo hành --}}
                            <div class="col-md-6">
                                <label for="warranty_user_id" class="form-label">Người bảo hành</label>
                                <select class="form-control select2 @error('warranty_user_id') is-invalid @enderror"
                                    id="warranty_user_id" name="warranty_user_id">
                                    <option value="">Chọn người dùng</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('warranty_user_id', $warranty->warranty_user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('warranty_user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Mô tả lỗi --}}
                            <div class="col-md-12">
                                <label for="error_description" class="form-label">Mô tả lỗi</label>
                                <textarea class="form-control" name="error_description" rows="3" placeholder="Nhập mô tả lỗi">{{ old('error_description', $warranty->error_description) }}</textarea>
                                @error('error_description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Trạng thái --}}
                            <div class="col-md-6">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="Chờ khách hàng xác nhận"
                                        {{ old('status', $warranty->status) == 'Chờ khách hàng xác nhận' ? 'selected' : '' }}>
                                        Chờ khách hàng xác nhận</option>
                                    <option value="Đã tạo đơn"
                                        {{ old('status', $warranty->status) == 'Đã tạo đơn' ? 'selected' : '' }}>Đã tạo đơn
                                    </option>
                                    <option value="Đang bảo hành"
                                        {{ old('status', $warranty->status) == 'Đang bảo hành' ? 'selected' : '' }}>Đang
                                        bảo hành</option>
                                    <option value="Hoàn thành"
                                        {{ old('status', $warranty->status) == 'Hoàn thành' ? 'selected' : '' }}>Hoàn thành
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Nút submit --}}
                            <div class="col-12 text-end mt-3">
                                <button type="submit" class="btn btn-success">
                                    Cập nhật <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vn.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                locale: "vn",
                allowInput: false
            });

            $('#imei, #warranty_user_id').select2({
                placeholder: "Chọn",
                allowClear: true
            });

            $('#imei').on('change', function() {
                const selected = $(this).find('option:selected');
                const deviceId = selected.data('device-id') ?? '';
                $('#device_id').val(deviceId);
            });
        });
    </script>
@endsection
