@extends('layouts.admin')

@section('title', 'Thiết bị')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center d-flex justify-content-center">
                <form method="GET" action="{{ route('admin.devices.index') }}" class="d-flex">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name" placeholder="Tên thiết bị..."
                            value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <button style="margin-left: 10px" type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-magnifying-glass"></i> Tìm
                            kiếm</button>
                        <a href="{{ route('admin.devices.index') }}" class="btn btn-secondary"><i
                                class="fa-solid fa-rotate-right"></i> Làm
                            mới</a>
                    </div>

                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.devices.create') }}" type="button" class="btn btn-primary">
                            Thêm mới <i class="fa-solid fa-square-plus"></i>
                        </a>
                    </div>
                </form>
            </div>
            <div class="card mb-4">
                <div class="card-header"> Thiết bị</div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên thiết bị</th>
                                    <th>Dự án</th>
                                    <th>Loại thiết bị</th>
                                    <th>Kho</th>
                                    <th>Đơn vị bán</th>
                                    <th>Serial</th>
                                    <th>Ngày sản xuất</th>
                                    <th>Ngày hết hạn</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($devices as $device)
                                    <tr>
                                        <td>{{ $device->id }}</td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $device->name }}
                                        </td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $device->project->name }}
                                        </td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $device->category->name }}
                                        </td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $device->warehouse->name }}
                                        </td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $device->salesUnit->name }}
                                        </td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $device->serial }}
                                        </td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $device->manufactured_at }}
                                        </td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $device->expired_at }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.devices.show', $device->id) }}"
                                                class="text-info me-2">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.devices.edit', $device->id) }}"
                                                class="text-warning me-2">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('admin.devices.destroy', $device->id) }}" method="POST"
                                                style="display: inline;"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa thiết bị này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0"
                                                    title="Xóa thiết bị">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
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
                    {{ $devices->links('pagination::bootstrap-5') }}
                </div>
            </nav>

            <style>
                .pagination .page-link {
                    transition: all 0.3s ease;
                }

                .pagination .page-link:hover {
                    background-color: #513ede;
                    /* màu xanh dương Bootstrap */
                    color: #fff;
                    border-color: #513ede;
                    /* viền cũng đổi màu */
                }
            </style>

        </div>
    </div>
@endsection
