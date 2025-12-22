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

     public function standarPelayanan()
    {
        // Taruh gambar di: public/images/standar-pelayanan/
        // Misal: public/images/standar-pelayanan/1.jpg, 2.jpg, dst.

        $items = [
            [
                'image' => asset('images/1.jpg'),
            ],
            [
                'image' => asset('images/2.jpg'),
            ],
            [
                'image' => asset('images/3.jpg'),
            ],
            [
                'image' => asset('images/4.jpg'),
            ],
            [
                'image' => asset('images/5.jpg'),
            ],
            [
                'image' => asset('images/6.jpg'),
            ],
            [
                'image' => asset('images/7.jpg'),
            ],
            [
                'image' => asset('images/8.jpg'),
            ],
            [
                'image' => asset('images/9.jpg'),
            ],
            [
                'image' => asset('images/10.jpg'),
            ],
            [
                'image' => asset('images/11.jpg'),
            ],
            [
                'image' => asset('images/12.jpg'),
            ],
            [
                'image' => asset('images/13.jpg'),
            ],
            [
                'image' => asset('images/14.jpg'),
            ],
            [
                'image' => asset('images/15.jpg'),
            ],
            [
                'image' => asset('images/16.jpg'),
            ],
            [
                'pdf'   => 'https://kominfo.madiunkota.go.id/file/eyJpdiI6IlNGUDdXZ1FpRDMvK2Y0WS9TclVSNmc9PSIsInZhbHVlIjoiNmpiL3VKRkErSXJmL1ZFR1A3cmR0UGJzdy9XUmsvZ0xoamV3OWNObnROUzVnakxsbUpzaHdabVM5MDR1VC9iMEhaS3QvS2QvTXZ0RXdQZFZ0bkcxcGlaeHcrbGs0Y3ZMY1IvaE52ZldZblE9IiwibWFjIjoiNzQ2MGEwOWFjYzNlN2Q1YmY5ZmU5MThjMGQzZTNhM2U4OTM2MTdiMWQ5YjZiOGRmNDE1MDU1MTM1ZmM3NmJmMSIsInRhZyI6IiJ9',
                'image' => asset('images/'),
            ],
        ];

        return view('profil.standar', compact('items'));
    }
}
