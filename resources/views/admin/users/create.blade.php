@extends('layouts.admin')

@section('title', 'Thêm người dùng')

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
                <div class="card-header">Thêm người dùng</div>
                <div class="card-body">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="name" class="form-label"><span class="text-danger">*</span> Họ tên</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label"><span class="text-danger">*</span> Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label"><span class="text-danger">*</span> Mật khẩu</label>
                                <input type="password" class="form-control" name="password">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="roles" class="form-label"><span class="text-danger">*</span> Vai trò</label>
                                <select name="roles[]" id="roles" class="form-control select2 @error('roles') is-invalid @enderror" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ (collect(old('roles'))->contains($role->id)) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('roles')
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

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#roles').select2({
                placeholder: "Chọn vai trò",
                allowClear: true
            });
        });
    </script>
@endsection
