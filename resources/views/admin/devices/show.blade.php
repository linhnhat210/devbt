@extends('layouts.admin')

@section('title', 'Chi tiết thiết bị')

@section('content')

    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <a href="{{ route('admin.devices.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Chi tiết thiết bị: <span class="fw-bold">{{ $device->name }}</span></div>
                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Tên thiết bị</label>
                            <input type="text" class="form-control" readonly value="{{ $device->name }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">IMEI</label>
                            <input type="text" class="form-control" readonly value="{{ $device->imei }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Serial</label>
                            <input type="text" class="form-control" readonly value="{{ $device->serial }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Dự án</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $device->project->name ?? '---' }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Danh mục</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $device->category->name ?? '---' }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kho</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $device->warehouse->name ?? '---' }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Đơn vị bán</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $device->salesUnit->name ?? 'Chưa có' }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ngày sản xuất</label>
                            <input type="text" class="form-control" readonly value="{{ $device->manufactured_at }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ngày hết hạn</label>
                            <input type="text" class="form-control" readonly value="{{ $device->expired_at }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ngày tạo</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $device->created_at->format('d/m/Y H:i:s') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Cập nhật lần cuối</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $device->updated_at->format('d/m/Y H:i:s') }}">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
