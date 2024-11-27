<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // trueにすることで認可を有効にします
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
public function rules()
{
    // 日時の取得部分のデバッグ

    return [
        'reservation_date' => ['required', 'date', function ($attribute, $value, $fail) {
            // 取得した日付と時刻を元にCarbonインスタンスを作成
            $reservationDateTime = Carbon::parse($value . ' ' . $this->reservation_time);

            // 日時のデバッグ
            //dd("Parsed datetime", $reservationDateTime);

            // 過去日時の場合のエラーメッセージ
            if ($reservationDateTime->isPast()) {
                $fail('予約日時は現在または未来の日時を選択してください。');
                //dd("timeNG");
            } 
            
        }],

        'reservation_time' => 'required|date_format:H:i',
        'number_of_people' => 'required|integer|min:1',
        'shop_id' => 'required|exists:shops,id',
        'course_name' => 'required|string',
    ];
}
    /**
     * カスタムメッセージ
     */
    public function messages()
    {
        return [
            'reservation_date.required' => '予約日を選択してください。',
            'reservation_time.required' => '予約時間を選択してください。',
            'number_of_people.required' => '人数を選択してください。',
            'course_name.required' => 'コースを選択してください。',
        ];
    }
}