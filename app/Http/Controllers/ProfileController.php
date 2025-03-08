<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function date() {
        $this->getWeekRange('29-03-2024');
    }

    public function getWeekRange($date)
    {
        $carbonDate = \Carbon\Carbon::parse($date);
        $year = $carbonDate->year;
        $month = $carbonDate->month;
        $day = $carbonDate->day;



        // Determine the week number (starting from 1)
        $weekNumber = ceil($day / 7);

        // Calculate start and end date of the week
        $weekStart = (($weekNumber - 1) * 7) + 1;
        $weekEnd = min($weekStart + 6, $carbonDate->daysInMonth); // Ensure end doesn't exceed month days

        $data = [
            'start' => "{$year}-{$month}-" . str_pad($weekStart, 2, '0', STR_PAD_LEFT),
            'end' => "{$year}-{$month}-" . str_pad($weekEnd, 2, '0', STR_PAD_LEFT)
        ];

        dd($data);
    }
}
