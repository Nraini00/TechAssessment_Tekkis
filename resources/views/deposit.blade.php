@extends('layout')

@include('nav.navbar')


@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h2>Deposit Savings</h2>
<form id="depositForm" method="POST" action="{{ route('deposit.post') }}">
    @csrf
    <div class="form-group">
        <label for="user_id">User ID</label>
        <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $user->id }}" readonly>
    </div>
    <div class="form-group">
        <label for="amount">Amount (RM)</label>
        <input type="number" class="form-control" id="amount" name="amount" required>
    </div>
    <div class="form-group">
        <label for="bank">Choose your Bank:</label>
        <select class="form-control" id="bank" name="bank" required>
            <option value="" disabled selected>Select your bank</option>
            <option value="Maybank">Maybank</option>
            <option value="CIMB">CIMB</option>
            <option value="Public Bank">Public Bank</option>
            <option value="RHB Bank">RHB Bank</option>
            <option value="Hong Leong Bank">Hong Leong Bank</option>
            <option value="Bank Islam">Bank Islam</option>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Deposit</button>
</form>

<!-- Savings List Table -->
<h3 class="mt-4">Your Savings</h3>
@if($savings->isEmpty())
    <p>No savings records found.</p>
@else
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Amount (RM)</th>
                <th>Bank</th>
                <th>Bonus (RM)</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($savings as $index => $saving)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $saving->amount }}</td>
                    <td>{{ $saving->bank }}</td>
                    <td>{{ $saving->bonus }}</td>
                    <td>{{ $saving->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection
