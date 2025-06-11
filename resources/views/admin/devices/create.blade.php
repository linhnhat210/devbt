@extends('layouts.admin')

@section('title', 'Thêm thiết bị')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <a href="{{ route('admin.devices.index') }}" type="button" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Thêm thiết bị</div>
                <div class="card-body">
                    <form action="{{ route('admin.devices.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="imei" class="form-label"><span class="text-danger">*</span> IMEI</label>
                                <input type="text" class="form-control" name="imei" placeholder="Nhập IMEI"
                                    value="{{ old('imei') }}">
                                @error('imei')
                                    <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="project_id" class="form-label"><span class="text-danger">*</span> Dự án</label>
                                <select class="form-control select2 @error('project_id') is-invalid @enderror"
                                    id="project_id" name="project_id">
                                    <option value="">Chọn dự án</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('project_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="name" class="form-label"><span class="text-danger">*</span> Tên thiết
                                    bị</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên thiết bị"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="category_id" class="form-label"><span class="text-danger">*</span> Loại thiết
                                    bị</label>
                                <select class="form-control select2 @error('category_id') is-invalid @enderror"
                                    id="category_id" name="category_id">
                                    <option value="">Chọn loại thiết bị</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="serial" class="form-label">Số serial</label>
                                <input type="text" class="form-control" name="serial" placeholder="Nhập số serial"
                                    value="{{ old('serial') }}">
                                @error('serial')
                                    <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>



                            <div class="col-md-6">
                                <label for="sales_unit_id" class="form-label">Đơn vị kinh doanh</label>
                                <select class="form-control select2 @error('sales_unit_id') is-invalid @enderror"
                                    id="sales_unit_id" name="sales_unit_id">
                                    <option value="">Chọn đơn vị kinh doanh</option>
                                    @foreach ($salesUnits as $salesUnit)
                                        <option value="{{ $salesUnit->id }}"
                                            {{ old('sales_unit_id') == $salesUnit->id ? 'selected' : '' }}>
                                            {{ $salesUnit->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sales_unit_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="manufactured_at" class="form-label">Ngày sản xuất</label>
                                <input type="text"
                                    class="form-control rounded datepicker @error('manufactured_at') is-invalid @enderror"
                                    id="manufactured_at" name="manufactured_at" value="{{ old('manufactured_at') }}"
                                    placeholder="YYYY-MM-DD">
                                @error('manufactured_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="warehouse_id" class="form-label"><span class="text-danger">*</span> Kho lưu
                                    trữ</label>
                                <select class="form-control select2 @error('warehouse_id') is-invalid @enderror"
                                    id="warehouse_id" name="warehouse_id">
                                    <option value="">Chọn kho lưu trữ</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}"
                                            {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                            {{ $warehouse->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('warehouse_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label for="expired_at" class="form-label">Ngày hết hạn</label>
                                <input type="text"
                                    class="form-control rounded datepicker @error('expired_at') is-invalid @enderror"
                                    id="expired_at" name="expired_at" value="{{ old('expired_at') }}"
                                    placeholder="YYYY-MM-DD">
                                @error('expired_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
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

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vn.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                locale: "vn",
                allowInput: true,
            });

            // Khởi tạo select2 cho các dropdown
            $('#project_id').select2({
                placeholder: "Chọn dự án",
                allowClear: true
            });

            $('#category_id').select2({
                placeholder: "Chọn loại thiết bị",
                allowClear: true
            });

            $('#warehouse_id').select2({
                placeholder: "Chọn kho lưu trữ",
                allowClear: true
            });

            $('#sales_unit_id').select2({
                placeholder: "Chọn đơn vị kinh doanh",
                allowClear: true
            });

        });
    </script>
@endsection
