@extends('front.layouts.front')
@section('title')
    تعديل حساب بنكي
@endsection

@section('content')
    @livewire('bank-accounts.edit', ['bank_account' => $bankAccounts])
@endsection
