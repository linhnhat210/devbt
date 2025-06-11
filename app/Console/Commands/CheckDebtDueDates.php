<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Debt;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CheckDebtDueDates extends Command
{
    protected $signature = 'debt:check-due-dates'; // phải đúng dòng này
    protected $description = 'Thông báo công nợ đến hạn và quá hạn';

    public function handle()
    {
        Log::info("✅ Đã chạy command vào lúc: " . now());

        $today = now();
        $near = now()->addDays(3);

        $soon = Debt::whereBetween('due_date', [$today, $near])->get();
        $late = Debt::where('due_date', '<', $today)->get();

        foreach ($soon as $debt) {
            Log::info("🟡 Nợ sắp đến hạn: ID {$debt->id}, hạn: {$debt->due_date}");
        }

        foreach ($late as $debt) {
            Log::warning("🔴 Nợ quá hạn: ID {$debt->id}, hạn: {$debt->due_date}");
        }

        $this->info("✅ Đã kiểm tra công nợ.");
    }
}
