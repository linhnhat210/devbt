@extends('layouts.admin')

@section('title', 'Chi tiết bảo hành')

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
                <div class="card-header">
                    Chi tiết bảo hành: <span class="fw-bold">{{ $warranty->code }}</span>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Mã bảo hành</label>
                            <input type="text" class="form-control" readonly value="{{ $warranty->code }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">IMEI</label>
                            <input type="text" class="form-control" readonly value="{{ $warranty->imei }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Thiết bị</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $warranty->device->name ?? '---' }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Người bảo hành</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $warranty->warrantyUser->name ?? '---' }}">
                        </div>

                        {{-- <div class="col-md-6">
                            <label class="form-label">Tên khách hàng</label>
                            <input type="text" class="form-control" readonly value="{{ $warranty->customer_name }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" readonly value="{{ $warranty->customer_phone }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" readonly value="{{ $warranty->customer_email }}">
                        </div> --}}

                        {{-- <div class="col-md-6">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" readonly value="{{ $warranty->customer_address }}">
                        </div> --}}

                        <div class="col-md-6">
                            <label class="form-label">Ngày bắt đầu</label>
                            <input type="text" class="form-control" readonly value="{{ $warranty->start_date }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ngày hết hạn</label>
                            <input type="text" class="form-control" readonly value="{{ $warranty->expired_at }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Trạng thái</label>
                            <input type="text" class="form-control" readonly value="{{ $warranty->status }}">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Mô tả lỗi</label>
                            <textarea class="form-control" readonly rows="3">{{ $warranty->error_description }}</textarea>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Ghi chú</label>
                            <textarea class="form-control" readonly rows="2">{{ $warranty->note }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ngày tạo</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $warranty->created_at->format('d/m/Y H:i:s') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Cập nhật lần cuối</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $warranty->updated_at->format('d/m/Y H:i:s') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
