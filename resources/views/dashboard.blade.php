@extends('layout')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@include('nav.navbar')

@section('content')
<h2>Dashboard</h2>



<p>Welcome, {{ Auth::user()->name }}!</p>

@endsection
