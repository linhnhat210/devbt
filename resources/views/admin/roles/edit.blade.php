@extends('layouts.admin')

@section('title', 'Cập nhật vai trò')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Cập nhật vai trò</div>
                <div class="card-body">
                    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                        @csrf


                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label"><span class="text-danger">*</span> Tên vai trò</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $role->name) }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label"><span class="text-danger">*</span> Phân quyền</label>
                                <div class="row">
                                    @forelse ($permissions as $permission)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="{{ $permission->id }}" id="perm-{{ $permission->id }}"
                                                    {{ (is_array(old('permissions')) && in_array($permission->id, old('permissions'))) || $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">Không có phân quyền nào để chọn.</p>
                                    @endforelse
                                </div>
                                @error('permissions')
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
