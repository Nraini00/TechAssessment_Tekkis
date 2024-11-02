<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Referral;
use App\Models\Saving;
use App\Models\Transaction;

class SavingController extends Controller
{
    public function deposit()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Get the user's deposits
        $savings = Saving::where('user_id', $user->id)->get();

        // Pass user and savings data to the view
        return view('deposit', compact('user', 'savings'));
    }

    public function storeDeposit(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'bank' => 'required|string|max:255',
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();
        $amount = $request->input('amount');
        $bank = $request->input('bank'); // Capture the bank name
        $bonus = 0;

        // Check for eligible referral bonuses
        $pendingReferrals = $user->referrals()->where('status', 'PENDING')->where('rewarded', false)->get();
        if ($pendingReferrals->count() > 0) {
            $bonus = $pendingReferrals->count() * 25;
            Referral::whereIn('id', $pendingReferrals->pluck('id'))->update(['rewarded' => true, 'status' => 'SUCCESS']);
        }

        // Create a new saving deposit
        Saving::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'bonus' => $bonus,
            'bank' => $bank,
        ]);

        // Record transactions
        Transaction::create([
            'user_id' => $user->id,
            'type' => 'DEPOSIT',
            'amount' => $amount,
            'date' => now(),
        ]);

        if ($bonus > 0) {
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'BONUS',
                'amount' => $bonus,
                'date' => now(),
            ]);
        }

        // Redirect back with a success message
        return redirect()->route('deposit')->with('success', 'Deposit successful! Bonus awarded: RM ' . $bonus);
    }
}
