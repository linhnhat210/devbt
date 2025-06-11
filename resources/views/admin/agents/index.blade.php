@extends('layouts.admin')

@section('title', 'Đại lý')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center d-flex justify-content-center">
                <form method="GET" action="{{ route('admin.agents.index') }}" class="d-flex">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name" placeholder="Tên đại lý..."
                            value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <button style="margin-left: 10px" type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-magnifying-glass"></i> Tìm
                            kiếm</button>
                        <a href="{{ route('admin.agents.index') }}" class="btn btn-secondary"><i
                                class="fa-solid fa-rotate-right"></i> Làm
                            mới</a>
                    </div>


                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.agents.create') }}" type="button" class="btn btn-primary">
                            Thêm mới <i class="fa-solid fa-square-plus"></i>
                        </a>
                    </div>
                </form>
            </div>
            <div class="card mb-4">
                <div class="card-header"> Đại lý</div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên đại lý / khách hàng</th>
                                    <th>Địa chỉ</th>
                                    <th>Mã số thuế / CCCD</th>
                                    <th>Số điện thoại</th>
                                    <th>Người liên hệ</th>
                                    <th>Thời gian tạo</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agents as $a)
                                    <tr>
                                        <td>{{ $a->id }}</td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $a->name }}
                                        </td>
                                        <td class="text-truncate"
                                            style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $a->address }}
                                        </td>
                                        <td class="text-truncate"
                                            style="max-width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $a->tax_code }}
                                        </td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $a->phone }}
                                        </td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $a->contact_person }}
                                        </td>
                                        <td>{{ $a->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.agents.show', $a->id) }}" class="text-info"><i
                                                    class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('admin.agents.edit', $a->id) }}" class="text-warning"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
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
                    {{ $agents->links('pagination::bootstrap-5') }}
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
