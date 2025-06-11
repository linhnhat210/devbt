@extends('layouts.admin')

@section('title', 'Chi tiết đại lý')

@section('content')

    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <a href="{{ route('admin.agents.index') }}" type="button" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Chi tiết đại lý: <span class="fw-bold">{{ $agent->name }}</span></div>
                <div class="card-body">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label"><span class="text-danger">*</span> Tên đại lý /
                                khách hàng</label>
                            <input type="text" class="form-control" name="name" readonly
                                placeholder="Nhập Tên đại lý / khách hàng" value="{{ $agent->name }}">

                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label"><span class="text-danger">*</span> Địa chỉ</label>
                            <input type="text" class="form-control" name="address" readonly placeholder="Nhập địa chỉ"
                                value="{{ $agent->address }}">

                        </div>

                        <div class="col-md-6">
                            <label for="tax_code" class="form-label"><span class="text-danger">*</span> Mã số thuế /
                                CCCD</label>
                            <input type="text" class="form-control" name="tax_code" readonly
                                placeholder="Nhập mã số thuế / CCCD" value="{{ $agent->tax_code }}">

                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label"><span class="text-danger">*</span> Số điện
                                thoại</label>
                            <input type="text" class="form-control" name="phone" readonly
                                placeholder="Nhập số điện thoại" value="{{ $agent->phone }}">

                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label"><span class="text-danger">*</span> Email</label>
                            <input type="email" class="form-control" name="email" readonly placeholder="Nhập Email"
                                value="{{ $agent->email }}">

                        </div>
                        <div class="col-md-6">
                            <label for="contact_person" class="form-label">Người liên hệ</label>
                            <input type="text" class="form-control" name="contact_person" readonly
                                placeholder="Nhập người liên hệ" value="{{ $agent->contact_person }}">

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
