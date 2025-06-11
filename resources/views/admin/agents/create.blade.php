@extends('layouts.admin')

@section('title', 'Thêm đại lý')

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
                <div class="card-header">Thêm đại lý</div>
                <div class="card-body">
                    <form action="{{ route('admin.agents.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label"><span class="text-danger">*</span> Tên đại lý /
                                    khách hàng</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Nhập Tên đại lý / khách hàng" value="{{ old('name') }}">
                                @error('name')
                                    <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label"><span class="text-danger">*</span> Địa chỉ</label>
                                <input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ"
                                    value="{{ old('address') }}">
                                @error('address')
                                    <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tax_code" class="form-label"><span class="text-danger">*</span> Mã số thuế /
                                    CCCD</label>
                                <input type="text" class="form-control" name="tax_code"
                                    placeholder="Nhập mã số thuế / CCCD" value="{{ old('tax_code') }}">
                                @error('tax_code')
                                    <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label"><span class="text-danger">*</span> Số điện
                                    thoại</label>
                                <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label"><span class="text-danger">*</span> Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Nhập Email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="contact_person" class="form-label">Người liên hệ</label>
                                <input type="text" class="form-control" name="contact_person"
                                    placeholder="Nhập người liên hệ" value="{{ old('contact_person') }}">
                                @error('contact_person')
                                    <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-12 text-end mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Thêm mới <i class="fa-solid fa-square-plus"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
