@extends('layouts.backend.app')
@section('tittle', 'Dashboard')
@push('css')
@endpush
@section('content')



    You are logged in! as <strong>{{Auth::user()->name}}</strong>

@endsection

@push('js')
@endpush
