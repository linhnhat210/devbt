@extends('layouts.admin')

@section('title', 'Cập nhật đơn vị bán hàng')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <a href="{{ route('admin.sales_units.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Cập nhật đơn vị bán hàng</div>
                <div class="card-body">
                    <form action="{{ route('admin.sales_units.update', $salesUnit->id) }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label"><span class="text-danger">*</span> Tên đơn
                                    vị</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $salesUnit->name) }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea class="form-control" name="description" rows="4">{{ old('description', $salesUnit->description) }}</textarea>
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
