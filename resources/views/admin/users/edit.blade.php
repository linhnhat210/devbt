@extends('layouts.admin')

@section('title', 'Cập nhật người dùng')

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
                <div class="card-header">Cập nhật người dùng</div>
                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf


                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label"><span class="text-danger">*</span> Họ tên</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"><span class="text-danger">*</span> Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mật khẩu mới (nếu muốn đổi)</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Vai trò</label>
                                <select name="roles[]" class="form-select select2" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ in_array($role->id, old('roles', $user->roles->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Trạng thái</label>
                                <select name="status" class="form-select">
                                    <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>Hoạt
                                        động</option>
                                    <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>Tạm
                                        khóa</option>
                                </select>
                                @error('status')
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.select2').select2({
                placeholder: "Chọn",
                allowClear: true
            });
        });
    </script>
@endsection
