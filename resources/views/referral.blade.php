@extends('layout')

@include('nav.navbar')

@section('content')

<h2>Create Referral</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('referral.create') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="referrer_id">Referrer Name</label>
        <input type="text" class="form-control" id="name" name="referrer_name" value="{{ Auth::user()->name }}" readonly>
    </div>
    <div class="form-group">
        <label for="referred_email">Referred Email</label>
        <input type="email" class="form-control" id="referred_email" name="referred_email" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Referral</button>
</form>

@endsection
