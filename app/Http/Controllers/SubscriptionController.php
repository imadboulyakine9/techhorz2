<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function subscribe($theme_id)
    {
        $user = Auth::user();

        $subscription = Subscription::create([
            'user_id' => $user->id,
            'theme_id' => $theme_id,
        ]);

        return redirect()->back()->with('status', 'Subscribed to theme successfully');
    }

    public function getSubscriptions()
    {
        $user = Auth::user();
        $subscriptions = Subscription::where('user_id', $user->id)->with('theme')->get();

        return view('subscriptions.index', compact('subscriptions'));
    }
}