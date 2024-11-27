<?php  

namespace App\Actions\Fortify;

use App\Models\User;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Auth\Events\Registered;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' を追加
        ], [
            'name.required' => 'ユーザー名を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '有効なメールアドレスの形式で入力してください。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.confirmed' => 'パスワードと確認用パスワードが一致しません。',
        ])->validate();

        // ユーザーの作成
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        // カスタムの認証URLを生成（idとhashを含める）
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify', now()->addMinutes(60), [
                'id' => $user->id,
                'hash' => sha1($user->email), // ユーザーのメールアドレスからhashを生成
            ]
        );

        // 認証メールを送信
        Mail::to($user->email)->send(new VerifyEmail($verificationUrl));

        return $user;
    }
}