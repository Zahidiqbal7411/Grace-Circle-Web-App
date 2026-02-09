<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Question;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $questions = Question::active()->ordered()->get();
        return view('auth.register', compact('questions'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse|\Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'country' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'in:male,female,other'],
            'birthday' => ['nullable', 'string'],
        ]);

        // Parse birthday if provided (format: m/d/Y h:i A)
        $birthday = null;
        if ($request->birthday) {
            try {
                $birthday = Carbon::parse($request->birthday)->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                $birthday = null;
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country' => $request->country,
            'gender' => $request->gender,
            'birthday' => $birthday,
        ]);

        // Create free trial payment record for the new user
        Payment::create([
            'user_id' => $user->id,
            'valid_till' => Carbon::now()->addDays(Payment::TRIAL_PERIOD_DAYS),
            'status' => 'trial',
            'notes' => 'Free trial - ' . Payment::TRIAL_PERIOD_DAYS . ' days',
        ]);

        // Save question answers if provided
        if ($request->has('questions')) {
            $answers = [];
            foreach ($request->questions as $questionId => $answer) {
                if (!empty($answer)) {
                    $answers[$questionId] = ['answer_text' => $answer];
                }
            }
            $user->questions()->attach($answers);
        }

        event(new Registered($user));

        Auth::login($user);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Registration successful! Please check your email to verify your account.',
                'redirect' => route('verification.notice')
            ]);
        }

        return redirect()->route('verification.notice');
    }
}
