<?php
// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Route;
use App\Models\Debt;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // Thêm dòng này để dùng Schema::hasTable
use App\Http\Middleware\CheckPermission;
use Spatie\Permission\Middlewares\PermissionMiddleware;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            // Kiểm tra nếu bảng 'debts' đã tồn tại thì mới thực hiện truy vấn
            if (Schema::hasTable('debts')) {
                $today = now()->startOfDay();
                $sevenDaysLater = now()->addDays(7)->endOfDay();

                $debtsSoon = Debt::whereBetween('due_date', [$today, $sevenDaysLater])
                    ->where('status', 'Chờ Thanh Toán')
                    ->get();

                $debtsLate = Debt::where('due_date', '<', $today)
                    ->where('status', 'Chờ Thanh Toán')
                    ->get();

                $view->with('debtsSoon', $debtsSoon)
                     ->with('debtsLate', $debtsLate);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
    