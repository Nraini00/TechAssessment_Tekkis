<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Referral;

class ReferralController extends Controller
{
    // Method to handle referral creation
    public function createReferral(Request $request)
    {
        $request->validate([
            'referred_email' => 'required|email',
        ]);

        $referrer = Auth::user();  // Ensure the user is authenticated
        $referred = User::where('email', $request->referred_email)->first();

        if ($referred && !$referrer->referrals()->where('referred_id', $referred->id)->exists()) {
            Referral::create([
                'referrer_id' => $referrer->id,
                'referred_email' => $referred->email,
                'referred_name' => $referred->name,
                'status' => 'PENDING'
            ]);

            return redirect()->route('referral')->with('success', 'Referral created successfully');
        }

        return redirect()->route('referral')->with('error', 'Referred user not found or already referred');
    }
}
