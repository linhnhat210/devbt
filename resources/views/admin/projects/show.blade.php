@extends('layouts.admin')

@section('title', 'Chi tiết dự án')

@section('content')

    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <a href="{{ route('admin.projects.index') }}" type="button" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Chi tiết dự án: <span class="fw-bold">{{ $project->ten }}</span></div>
                <div class="card-body">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="ten" class="form-label"><span class="text-danger">*</span> Tên dự án</label>
                            <input type="text" class="form-control" name="ten" readonly placeholder="Nhập tên dự án"
                                value="{{ $project->name }}">
                        </div>

                        <div class="col-md-6">
                            <label for="dia_chi" class="form-label"><span class="text-danger">*</span> Địa chỉ</label>
                            <input type="text" class="form-control" name="dia_chi" readonly placeholder="Nhập địa chỉ"
                                value="{{ $project->address }}">
                        </div>

                        <div class="col-md-6">
                            <label for="ngay_bat_dau" class="form-label"><span class="text-danger">*</span> Ngày bắt
                                đầu</label>
                            <input type="text" class="form-control" name="ngay_bat_dau" readonly
                                placeholder="Nhập ngày bắt đầu" value="{{ $project->warranty_start_date }}">
                        </div>



                        <div class="col-md-6">
                            <label for="trang_thai" class="form-label"><span class="text-danger">*</span> Trạng thái</label>
                            <input type="text" class="form-control" name="trang_thai" readonly placeholder="Trạng thái"
                                value="{{ $project->status }}">
                        </div>

                        <div class="col-md-6">
                            <label for="nguoi_phu_trach" class="form-label">Kinh doanh phụ trách</label>
                            <input type="text" class="form-control" name="nguoi_phu_trach" readonly
                                placeholder="Nhập người phụ trách" value="{{ $project->salesPerson->name }}">
                        </div>
                        <div class="col-md-6">
                            <label for="nguoi_phu_trach" class="form-label">Kế toán phụ trách</label>
                            <input type="text" class="form-control" name="nguoi_phu_trach" readonly
                                placeholder="Nhập người phụ trách" value="{{ $project->accountant->name }}">
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
