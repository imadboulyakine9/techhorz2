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

    public function unsubscribe($theme_id)
{
    $user = Auth::user();

    $subscription = Subscription::where('user_id', $user->id)->where('theme_id', $theme_id)->first();

    if ($subscription) {
        $subscription->delete();
        return redirect()->back()->with('status', 'Unsubscribed from theme successfully');
    }

    return redirect()->back()->with('error', 'Subscription not found');
}

    public function getSubscriptions()
    {
        $user = Auth::user();
        $subscriptions = Subscription::where('user_id', $user->id)->with('theme')->get();

        return view('subscriptions.index', compact('subscriptions'));
    }
}