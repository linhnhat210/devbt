@extends('layouts.admin')

@section('title', 'Cập nhật thiết bị')

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
                <div class="card-header">Cập nhật thiết bị</div>
                <div class="card-body">
                    <form action="{{ route('admin.devices.update', $device->id) }}" method="POST">
                        @csrf


                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label"><span class="text-danger">*</span> Tên thiết bị</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $device->name) }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">IMEI</label>
                                <input type="text" class="form-control" name="imei"
                                    value="{{ old('imei', $device->imei) }}">
                                @error('imei')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Serial</label>
                                <input type="text" class="form-control" name="serial"
                                    value="{{ old('serial', $device->serial) }}">
                                @error('serial')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Dự án</label>
                                <select name="project_id" class="form-select select2">
                                    <option value="">Chọn dự án</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            {{ old('project_id', $device->project_id) == $project->id ? 'selected' : '' }}>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('project_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Danh mục</label>
                                <select name="category_id" class="form-select select2">
                                    <option value="">Chọn danh mục</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $device->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kho</label>
                                <select name="warehouse_id" class="form-select select2">
                                    <option value="">Chọn kho</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}"
                                            {{ old('warehouse_id', $device->warehouse_id) == $warehouse->id ? 'selected' : '' }}>
                                            {{ $warehouse->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('warehouse_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Đơn vị bán</label>
                                <select name="sales_unit_id" class="form-select select2">
                                    <option value="">Chọn đơn vị bán</option>
                                    @foreach ($salesUnits as $unit)
                                        <option value="{{ $unit->id }}"
                                            {{ old('sales_unit_id', $device->sales_unit_id) == $unit->id ? 'selected' : '' }}>
                                            {{ $unit->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sales_unit_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Ngày sản xuất</label>
                                <input type="text" name="manufactured_at" class="form-control datepicker"
                                    value="{{ old('manufactured_at', $device->manufactured_at) }}">
                                @error('manufactured_at')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Ngày hết hạn</label>
                                <input type="text" name="expired_at" class="form-control datepicker"
                                    value="{{ old('expired_at', $device->expired_at) }}">
                                @error('expired_at')
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

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vn.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                locale: "vn",
                allowInput: true
            });

            $('.select2').select2({
                placeholder: "Chọn",
                allowClear: true
            });
        });
    </script>
@endsection
