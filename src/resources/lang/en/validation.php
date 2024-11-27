<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attributeを承認してください。',
    'accepted_if' => ':otherが:valueの場合、:attributeを承認してください。',
    'active_url' => ':attributeが有効なURLではありません。',
    'after' => ':attributeには:dateより後の日付を指定してください。',
    'after_or_equal' => ':attributeには:date以降の日付を指定してください。',
    'alpha' => ':attributeには文字のみ使用できます。',
    'alpha_dash' => ':attributeには英数字、ダッシュ、アンダースコアのみ使用できます。',
    'alpha_num' => ':attributeには英数字のみ使用できます。',
    'array' => ':attributeには配列を指定してください。',
    'before' => ':attributeには:dateより前の日付を指定してください。',
    'before_or_equal' => ':attributeには:date以前の日付を指定してください。',
    'between' => [
        'numeric' => ':attributeには:minから:maxまでの数値を指定してください。',
        'file' => ':attributeには:minから:max KBまでのファイルを指定してください。',
        'string' => ':attributeには:minから:max文字までの文字列を指定してください。',
        'array' => ':attributeには:minから:max個までの項目を指定してください。',
    ],
    'boolean' => ':attributeにはtrueまたはfalseを指定してください。',
    'confirmed' => ':attributeが確認フィールドと一致しません。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attributeは有効な日付ではありません。',
    'date_equals' => ':attributeには:dateと同じ日付を指定してください。',
    'date_format' => ':attributeの形式は:formatと一致しません。',
    'declined' => ':attributeは辞退する必要があります。',
    'declined_if' => ':otherが:valueの場合、:attributeは辞退する必要があります。',
    'different' => ':attributeと:otherには異なる値を指定してください。',
    'digits' => ':attributeには:digits桁の数値を指定してください。',
    'digits_between' => ':attributeには:minから:max桁の数値を指定してください。',
    'dimensions' => ':attributeの画像サイズが無効です。',
    'distinct' => ':attributeに重複した値があります。',
    'email' => ':attributeには有効なメールアドレスを指定してください。',
    'ends_with' => ':attributeには、:valuesのいずれかで終わる値を指定してください。',
    'enum' => '選択された:attributeが無効です。',
    'exists' => '選択された:attributeが無効です。',
    'file' => ':attributeにはファイルを指定してください。',
    'filled' => ':attributeに値を指定してください。',
    'gt' => [
        'numeric' => ':attributeには:valueより大きな数値を指定してください。',
        'file' => ':attributeには:value KBより大きなファイルを指定してください。',
        'string' => ':attributeには:value文字より多い文字数を指定してください。',
        'array' => ':attributeには:value個より多くの項目を指定してください。',
    ],
    'gte' => [
        'numeric' => ':attributeには:value以上の数値を指定してください。',
        'file' => ':attributeには:value KB以上のファイルを指定してください。',
        'string' => ':attributeには:value文字以上の文字数を指定してください。',
        'array' => ':attributeには:value個以上の項目を指定してください。',
    ],
    'image' => ':attributeには画像ファイルを指定してください。',
    'in' => '選択された:attributeが無効です。',
    'in_array' => ':attributeは:otherに存在しません。',
    'integer' => ':attributeには整数を指定してください。',
    'ip' => ':attributeには有効なIPアドレスを指定してください。',
    'ipv4' => ':attributeには有効なIPv4アドレスを指定してください。',
    'ipv6' => ':attributeには有効なIPv6アドレスを指定してください。',
    'json' => ':attributeには有効なJSON文字列を指定してください。',
    'lt' => [
        'numeric' => ':attributeには:valueより小さな数値を指定してください。',
        'file' => ':attributeには:value KBより小さなファイルを指定してください。',
        'string' => ':attributeには:value文字より少ない文字数を指定してください。',
        'array' => ':attributeには:value個より少ない項目を指定してください。',
    ],
    'lte' => [
        'numeric' => ':attributeには:value以下の数値を指定してください。',
        'file' => ':attributeには:value KB以下のファイルを指定してください。',
        'string' => ':attributeには:value文字以下の文字数を指定してください。',
        'array' => ':attributeには:value個以下の項目を指定してください。',
    ],
    'mac_address' => ':attributeには有効なMACアドレスを指定してください。',
    'max' => [
        'numeric' => ':attributeには:max以下の数値を指定してください。',
        'file' => ':attributeには:max KB以下のファイルを指定してください。',
        'string' => ':attributeには:max文字以下の文字数を指定してください。',
        'array' => ':attributeには:max個以下の項目を指定してください。',
    ],
    'mimes' => ':attributeには:valuesタイプのファイルを指定してください。',
    'mimetypes' => ':attributeには:valuesタイプのファイルを指定してください。',
    'min' => [
        'numeric' => ':attributeには:min以上の数値を指定してください。',
        'file' => ':attributeには:min KB以上のファイルを指定してください。',
        'string' => ':attributeには:min文字以上の文字数を指定してください。',
        'array' => ':attributeには:min個以上の項目を指定してください。',
    ],
    'multiple_of' => ':attributeには:valueの倍数を指定してください。',
    'not_in' => '選択された:attributeが無効です。',
    'not_regex' => ':attributeの形式が無効です。',
    'numeric' => ':attributeには数値を指定してください。',
    'password' => 'パスワードが正しくありません。',
    'present' => ':attributeを指定してください。',
    'prohibited' => ':attributeは入力禁止です。',
    'prohibited_if' => ':otherが:valueの場合、:attributeは入力禁止です。',
    'prohibited_unless' => ':otherが:valuesでない限り、:attributeは入力禁止です。',
    'prohibits' => ':attributeは:otherの入力を禁じています。',
    'regex' => ':attributeの形式が無効です。',
    'required' => ':attributeは必須です。',
    'required_array_keys' => ':attributeには:valuesの項目を含めてください。',
    'required_if' => ':otherが:valueの場合、:attributeは必須です。',
    'required_unless' => ':otherが:valuesでない限り、:attributeは必須です。',
    'required_with' => ':valuesが存在する場合、:attributeは必須です。',
    'required_with_all' => ':valuesがすべて存在する場合、:attributeは必須です。',
    'required_without' => ':valuesが存在しない場合、:attributeは必須です。',
    'required_without_all' => ':valuesがすべて存在しない場合、:attributeは必須です。',
    'same' => ':attributeと:otherが一致していません。',
    'size' => [
        'numeric' => ':attributeには:sizeを指定してください。',
        'file' => ':attributeには:size KBのファイルを指定してください。',
        'string' => ':attributeには:size文字の文字列を指定してください。',
        'array' => ':attributeには:size個の項目を含めてください。',
    ],
    'starts_with' => ':attributeには、:valuesのいずれかで始まる値を指定してください。',
    'string' => ':attributeには文字列を指定してください。',
    'timezone' => ':attributeには有効なタイムゾーンを指定してください。',
    'unique' => ':attributeの値は既に存在しています。',
    'uploaded' => ':attributeのアップロードに失敗しました。',
    'url' => ':attributeには有効なURLを指定してください。',
    'uuid' => ':attributeには有効なUUIDを指定してください。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
