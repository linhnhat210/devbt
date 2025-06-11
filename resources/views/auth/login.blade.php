@extends('layouts.auth')

@section('title', 'Đăng nhập')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 text-center py-4">
                    <h3 class="fw-bold mb-0 text-primary">Chào mừng trở lại</h3>
                    <p class="text-muted small">Vui lòng đăng nhập để tiếp tục</p>
                </div>
                <div class="card-body px-4">
                    @if (session('error'))
                        <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('login.process') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fa-solid fa-envelope text-secondary"></i>
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                                    required>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fa-solid fa-lock text-secondary"></i>
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Nhập mật khẩu" required>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-pill py-2 fw-semibold">
                                <i class="fa-solid fa-right-to-bracket me-2"></i> Đăng nhập
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
