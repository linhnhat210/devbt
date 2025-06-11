@extends('layouts.admin')

@section('title', 'Dự án')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center d-flex justify-content-center">
                <form method="GET" action="{{ route('admin.projects.index') }}" class="d-flex">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name" placeholder="Tên dự án..."
                            value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <button style="margin-left: 10px" type="submit" class="btn btn-primary"><i
                                class="fa-solid fa-magnifying-glass"></i> Tìm
                            kiếm</button>
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary"><i
                                class="fa-solid fa-rotate-right"></i> Làm
                            mới</a>
                    </div>


                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.projects.create') }}" type="button" class="btn btn-primary">
                            Thêm mới <i class="fa-solid fa-square-plus"></i>
                        </a>
                    </div>
                </form>
            </div>
            <div class="card mb-4">
                <div class="card-header"> Dự án</div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên dự án</th>
                                    <th>Tên đại lý / khách hàng</th>
                                    <th>Kinh doanh phụ trách</th>
                                    <th>Thời gian bắt đầu bảo hành</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $p)
                                    <tr>
                                        <td>{{ $p->id }}</td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $p->name }}
                                        </td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $p->agent->name }}
                                        </td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $p->salesPerson->name }}
                                        </td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $p->warranty_start_date }}
                                        </td>
                                        <td class="text-truncate"
                                            style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $p->status }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.projects.show', $p->id) }}" class="text-info"><i
                                                    class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('admin.projects.edit', $p->id) }}" class="text-warning"><i
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
                    {{ $projects->links('pagination::bootstrap-5') }}
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
