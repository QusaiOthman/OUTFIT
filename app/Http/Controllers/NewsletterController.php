<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterVerificationMail;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email'
        ]);

        if (Newsletter::where('email', $request->email)->exists()) {
            return back()->with('error', 'Email already subscribed.');
        }
        $token = Str::random(64);

        $newsletter = Newsletter::create([
            'email' => $validated['email'],
            'token' => $token,
            'is_verified' => false,
        ]);

        $link = route('newsletter.verify', $token);

        try {

            Mail::to($newsletter->email)
                ->send(new NewsletterVerificationMail($link));

            return back()->with(
                'success',
                'Verification email sent successfully!'
            );
        } catch (\Exception $e) {

            dd($e->getMessage());
        }
        return back()->with(
            'success',
            'Verification email sent successfully!'
        );
    }

    public function verify($token)
    {
        $newsletter = Newsletter::where('token', $token)->firstOrFail();

        $newsletter->update([
            'is_verified' => true,
            'token' => null,
        ]);

        return redirect('/')
            ->with('success', 'Email verified successfully!');
    }
}
