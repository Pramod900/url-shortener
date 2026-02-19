<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Mail\InvitationMail;
use App\Models\Company;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationController extends Controller
{

    public function store(InvitationRequest $request)
    {
        $token = Str::random(10);

        while (Invitation::where('token', $token)->exists()) {
            $token = Str::random(10);
        }

        $companyName = $request->company;

        if (auth()->user()->role === 'admin') {
            $companyName = Company::with('users')->where('id', auth()->user()?->company_id)->value('name');
        }


        Invitation::create([
            'email' => $request->email,
            'token' => $token,
            'role' => $request->role,
            'company_name' => $companyName,
            'invited_by_user_id' => auth()->id(),
        ]);

        $url = url('invitation/' . $token);
        $sender = auth()->user()->name;
        $post = $request->role;
        $company = $companyName;

        try {
            Mail::to($request->email)->send(new InvitationMail($url, $sender, $company));

            return back()->with('success', 'An invitation link is sent to ' . $request->email);
        } catch (\Exception $e) {
            Log::error('--- invitation error ---', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return back()->withErrors(['error' => "Failed to send the invitation, please try again!"]);
        }
    }

    public function showRegistration($token)
    {
        $invitation = Invitation::where('token', $token)->first();

        if (!$invitation) {
            return back()->with('error', 'Invalid invitation url');
        }

        $companyName = $invitation->company_name;
        return view('invitee-registration', compact('token', 'companyName'));
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'companyName' => 'required',
            'full_name' => 'required|max:255|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $invitation = Invitation::where('token', $request->token)->first();

        if (!$invitation) {
            return redirect()->route('login-page')->withErrors(['invitation' => "Invalid invitation link!"]);
        }

        if ($request->email !== $invitation->email) {
            return back()->withErrors(['email' => 'Invalid email!']);
        }

        $company = Company::where('name', $request->companyName)->first();
        if (!$company) {
            $company = Company::create(['name' => $request->companyName]);
        }

        User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $invitation->role,
            'company_id' => $company->id
        ]);

        $invitation->delete();

        return redirect()->route('login-page');
    }
}
