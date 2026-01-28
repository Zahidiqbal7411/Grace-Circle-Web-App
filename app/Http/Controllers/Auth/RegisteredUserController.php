<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'country' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'in:male,female'],
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

        return redirect(route('dashboard', absolute: false));
    }
}
