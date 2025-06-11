@extends('layouts.admin')

@section('title', 'Chi tiết người dùng')

@section('content')

    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Chi tiết người dùng: <span class="fw-bold">{{ $user->name }}</span></div>
                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Tên người dùng</label>
                            <input type="text" class="form-control" readonly value="{{ $user->name }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" readonly value="{{ $user->email }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Quyền</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $user->roles->pluck('name')->join(', ') ?: '---' }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ngày tạo</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $user->created_at->format('d/m/Y H:i:s') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Cập nhật lần cuối</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $user->updated_at->format('d/m/Y H:i:s') }}">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
