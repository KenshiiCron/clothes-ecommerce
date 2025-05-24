<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function dashboard(){

        return view('pages.user.profile.dashboard');
    }
    public function orders(){
        $orders = auth()->user()->orders()->with('orderItems')->paginate(4);
        return view('pages.user.profile.orders',compact('orders'));
    }
    public function details()
    {
        $user = Auth::user();
        return view('pages.user.profile.details', compact('user'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        session()->flash('success', 'Your profile has been updated.');

        return Redirect::route('account.details')->with('status', 'profile-updated');
    }

//    public function updatePassword(Request $request): RedirectResponse{
//        $user = $request->user();
//        $data = $request->validate([
//            'current_password' => ['required','string', 'min:8'],
//            'password' => ['required', 'string', 'min:8', 'confirmed'],
//        ]);
//        if (! Hash::check($data['current_password'], $user->password)) {
//            return back()->withErrors([
//                'password' => ['The provided password does not match our records.']
//            ]);
//        }
//        $user->update(['password' => Hash::make($data['password'])]);
//        $user->save();
//        session()->flash('success', 'password updated successfully');
//        return Redirect::route('account.details')->with('status', 'password-updated');
//    }

    public function wishlist(){
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();

        return view('pages.user.profile.wishlist', compact('wishlist'));
    }
//    public function edit(Request $request): View
//    {
//        return view('profile.edit', [
//            'user' => $request->user(),
//        ]);
//    }

    /**
     * Update the user's profile information.
     */


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
}
