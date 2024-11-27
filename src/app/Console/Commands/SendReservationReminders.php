<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Mail\ReservationReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendReservationReminders extends Command
{
    protected $signature = 'send:reservation-reminders';
    protected $description = '予約日の朝にリマインダーメールを送信する';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // 本日が予約日の予約を取得
        $today = Carbon::today()->startOfDay();
        $reservations = Reservation::whereDate('reservation_date', $today)->get();

        foreach ($reservations as $reservation) {
            // リマインダーメールを送信
            Mail::to($reservation->user->email)->send(new ReservationReminderMail($reservation));
        }

        $this->info('リマインダーメールが送信されました。');
    }
}