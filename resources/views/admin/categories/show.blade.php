@extends('layouts.admin')

@section('title', 'Chi tiết danh mục')

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
                <div class="card-header">Chi tiết danh mục: <span class="fw-bold">{{ $category->name }}</span></div>
                <div class="card-body">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label"><span class="text-danger">*</span> Tên danh mục</label>
                            <input type="text" class="form-control" name="name" readonly
                                placeholder="Nhập tên danh mục" value="{{ $category->name }}">
                        </div>

                        <div class="col-md-6">
                            <label for="code" class="form-label"><span class="text-danger">*</span> Mã danh mục</label>
                            <input type="text" class="form-control" name="code" readonly
                                placeholder="Nhập mã danh mục" value="{{ $category->code }}">
                        </div>

                        <div class="col-md-6">
                            <label for="internal_price" class="form-label">Giá nội bộ</label>
                            <input type="text" class="form-control" name="internal_price" readonly
                                placeholder="Nhập giá nội bộ" value="{{ $category->internal_price }}">
                        </div>

                        <div class="col-md-6">
                            <label for="warranty_period" class="form-label">Thời gian bảo hành (tháng)</label>
                            <input type="text" class="form-control" name="warranty_period" readonly
                                placeholder="Nhập thời gian bảo hành" value="{{ $category->warranty_period }}">
                        </div>

                        <div class="col-md-12">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" name="description" rows="4" readonly>{{ $category->description }}</textarea>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
