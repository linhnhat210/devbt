@extends('layouts.admin')

@section('title', 'Cập nhật danh mục')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Cập nhật danh mục</div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label"><span class="text-danger">*</span> Tên danh
                                    mục</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $category->name) }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="code" class="form-label"><span class="text-danger">*</span> Mã danh
                                    mục</label>
                                <input type="text" class="form-control" name="code"
                                    value="{{ old('code', $category->code) }}">
                                @error('code')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="internal_price" class="form-label">Giá nội bộ</label>
                                <input type="number" class="form-control" name="internal_price"
                                    value="{{ old('internal_price', $category->internal_price) }}">
                                @error('internal_price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="warranty_period" class="form-label">Thời gian bảo hành (tháng)</label>
                                <input type="number" class="form-control" name="warranty_period"
                                    value="{{ old('warranty_period', $category->warranty_period) }}">
                                @error('warranty_period')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea class="form-control" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

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
