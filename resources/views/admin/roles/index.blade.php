@extends('layouts.admin')

@section('title', 'Vai trò')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center d-flex justify-content-center">
                <form method="GET" action="{{ route('admin.roles.index') }}" class="d-flex">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name" placeholder="Tên vai trò..."
                            value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <button style="margin-left: 10px" type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-rotate-right"></i> Làm mới
                        </a>
                    </div>

                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.roles.create') }}" type="button" class="btn btn-primary">
                            Thêm mới <i class="fa-solid fa-square-plus"></i>
                        </a>
                    </div>
                </form>
            </div>

            <div class="card mb-4">
                <div class="card-header">Danh sách vai trò</div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Quyền</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $index => $role)
                                    <tr>
                                        <td>{{ $loop->iteration + ($roles->currentPage() - 1) * $roles->perPage() }}</td>
                                        <td class="text-truncate" style="max-width: 150px;">
                                            {{ $role->name }}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary open-permission-modal"
                                                    data-role="{{ $role->name }}"
                                                    data-role-id="{{ $role->id }}"
                                                    data-permissions='@json($role->permissions->pluck("name"))'>
                                                Xem quyền <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.roles.show', $role->id) }}" class="text-info me-2">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="text-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <nav aria-label="Page navigation">
                <div class="d-flex justify-content-center">
                    {{ $roles->links('pagination::bootstrap-5') }}
                </div>
            </nav>
        </div>
    </div>

    <!-- Modal Xem quyền -->
    <div id="permission-modal" class="modal-overlay d-none">
        <div class="modal-content">
            <h5 id="modal-role-name" class="mb-3"></h5>
            <form id="permission-form">
                <div id="modal-permissions-list" class="overflow-auto" style="max-height: 300px;">
                    <!-- Các quyền sẽ được thêm vào đây -->
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-secondary mt-3 close-modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1050;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            width: 400px;
            max-width: 90%;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.3s ease-in-out;
        }

        .overflow-auto {
            overflow-y: auto;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('permission-modal');
            const roleName = document.getElementById('modal-role-name');
            const permissionList = document.getElementById('modal-permissions-list');
            const closeModalBtn = modal.querySelector('.close-modal');

            document.querySelectorAll('.open-permission-modal').forEach(button => {
                button.addEventListener('click', function() {
                    const permissions = JSON.parse(this.getAttribute('data-permissions'));
                    const role = this.getAttribute('data-role');
                    const roleId = this.getAttribute('data-role-id');

                    roleName.textContent = `Quyền của vai trò: ${role}`;
                    permissionList.innerHTML = '';

                    // Tạo danh sách quyền trong modal bằng cách lặp qua permissions
                    permissions.forEach(permissionId => {
                        const li = document.createElement('div');
                        li.classList.add('form-check');
                        li.innerHTML = `
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="${permissionId}" ${permissions.includes(permissionId) ? 'checked' : ''}>
                            <label class="form-check-label">
                                 ${permissionId}
                            </label>
                        `;
                        permissionList.appendChild(li);
                    });

                    modal.classList.remove('d-none');
                });
            });

            closeModalBtn.addEventListener('click', () => {
                modal.classList.add('d-none');
            });

            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('d-none');
                }
            });
        });
    </script>
@endpush
