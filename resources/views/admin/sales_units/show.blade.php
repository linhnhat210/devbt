@extends('layouts.admin')

@section('title', 'Chi tiết đơn vị bán hàng')

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
                <div class="card-header">
                    Chi tiết đơn vị bán hàng: <span class="fw-bold">{{ $salesUnit->name }}</span>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label"><span class="text-danger">*</span> Tên đơn vị</label>
                            <input type="text" class="form-control" name="name" readonly
                                value="{{ $salesUnit->name }}">
                        </div>

                        <div class="col-md-12">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" name="description" rows="4" readonly>{{ $salesUnit->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
