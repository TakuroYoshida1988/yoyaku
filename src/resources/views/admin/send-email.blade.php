<!-- resources/views/admin/send-email.blade.php -->

@extends('layouts.app2')

@section('content')
<link rel="stylesheet" href="{{ asset('css/send-email.css') }}">

<div class="container">
    <h2>メール送信</h2>
    
    <form action="{{ route('admin.sendEmail') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="recipient_id">宛先</label>
            <select name="recipient_id" id="recipient_id" class="form-control" required>
                <option value="">-- 選択してください --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="subject">件名</label>
            <input type="text" name="subject" id="subject" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="content">内容</label>
            <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">送信</button>
    </form>
</div>
@endsection