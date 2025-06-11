@extends('layouts.admin')

@section('title', 'Thêm danh mục')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <a href="{{ route('admin.categories.index') }}" type="button" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Thêm thiết bị</div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label"><span class="text-danger">*</span> Tên thiết bị /
                                    Chủng loại</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên danh mục"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="code" class="form-label"><span class="text-danger">*</span> Mã Chủng
                                    Loại</label>
                                <input type="text" class="form-control" name="code" placeholder="Nhập mã danh mục"
                                    value="{{ old('code') }}">
                                @error('code')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="internal_price" class="form-label">Giá nội bộ</label>
                                <input type="number" class="form-control" name="internal_price"
                                    placeholder="Nhập giá nội bộ" value="{{ old('internal_price') }}">
                                @error('internal_price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="warranty_period" class="form-label">Thời gian bảo hành (tháng)</label>
                                <input type="number" class="form-control" name="warranty_period" placeholder="VD: 12"
                                    value="{{ old('warranty_period') }}">
                                @error('warranty_period')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea class="form-control" name="description" rows="4" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
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
