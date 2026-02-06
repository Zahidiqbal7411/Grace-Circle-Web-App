@push('styles')
    <link href="{{ asset('vendors/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <style>
        .input-group-addon {
            padding: 6px 12px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px;
            border-left: 0;
            display: table-cell;
            width: 1%;
            white-space: nowrap;
            vertical-align: middle;
        }
        .input-group {
            position: relative;
            display: table !important;
            border-collapse: separate;
            width: 100% !important;
        }
        .bootstrap-datetimepicker-widget {
            z-index: 999999 !important;
            background-color: #fff !important;
            border: 1px solid #ccc !important;
            box-shadow: 0 5px 10px rgba(0,0,0,.2) !important;
        }
    </style>
@endpush

<x-guest-layout>
    <div class="mb-4">
        <h2 class="text-2xl font-bold">Registration</h2>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Country -->
        <div class="mt-4">
            <x-input-label for="country" :value="__('Country')" />
            <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')" />
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="mt-4 p-3 rounded" style="background-color: #f3f4f6;">
            <x-input-label :value="__('Gender')" />
            <div class="mt-2 flex gap-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="gender" value="male" class="form-radio" {{ old('gender') == 'male' ? 'checked' : '' }}>
                    <span class="ml-2">Male</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="gender" value="female" class="form-radio" {{ old('gender') == 'female' ? 'checked' : '' }}>
                    <span class="ml-2">Female</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="gender" value="other" class="form-radio" {{ old('gender') == 'other' ? 'checked' : '' }}>
                    <span class="ml-2">Other</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- Birthday -->
        <div class="mt-4">
            <x-input-label for="birthday" :value="__('Birthday')" />
            <div class="input-group date" id="birthday-wrapper-page">
                <input type='text' class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                    name="birthday" id="birthday-page" placeholder="Birthday" value="{{ old('birthday') }}" 
                    autocomplete="off" readonly style="background-color: #fff; cursor: pointer;">
                <span class="input-group-addon" style="cursor: pointer; background: #fff; border-left: none;">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                </span>
            </div>
            <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
        </div>

        <!-- Profile Questions -->
        @if(isset($questions) && $questions->count() > 0)
            <div class="mt-6 p-4 rounded border border-gray-200" style="background-color: #f9fafb;">
                <h3 class="text-lg font-semibold mb-4 border-bottom pb-2">Profile Questions</h3>
                <div style="max-height: 300px; overflow-y: auto;">
                    @foreach($questions as $question)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                {{ $question->question_text }} @if($question->is_required) <span class="text-red-500">*</span> @endif
                            </label>
                            
                            @if($question->question_type === 'select' && $question->options)
                                <select name="questions[{{ $question->id }}]" class="block mt-1 w-full rounded-md border-gray-300">
                                    <option value="">Select an option</option>
                                    @foreach($question->options as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                            @elseif($question->question_type === 'textarea')
                                <textarea name="questions[{{ $question->id }}]" class="block mt-1 w-full rounded-md border-gray-300" rows="3"></textarea>
                            @elseif($question->question_type === 'radio' && $question->options)
                                <div class="mt-2 space-x-4">
                                    @foreach($question->options as $option)
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="questions[{{ $question->id }}]" value="{{ $option }}">
                                            <span class="ml-2 text-sm">{{ $option }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @else
                                <input type="text" name="questions[{{ $question->id }}]" class="block mt-1 w-full rounded-md border-gray-300">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

@push('scripts')
    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datepicker/js/moment-with-locales.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        (function($) {
            $(document).ready(function() {
                function initPicker() {
                    var $wrapper = $('#birthday-wrapper-page');
                    if ($wrapper.length && typeof $.fn.datetimepicker !== 'undefined') {
                        $wrapper.datetimepicker({
                            format: 'DD-MM-YYYY',
                            icons: {
                                time: "fa fa-clock-o",
                                date: "fa fa-calendar",
                                up: "fa fa-chevron-up",
                                down: "fa fa-chevron-down",
                                previous: 'fa fa-chevron-left',
                                next: 'fa fa-chevron-right',
                                today: 'fa fa-screenshot',
                                clear: 'fa fa-trash',
                                close: 'fa fa-remove'
                            },
                            allowInputToggle: true,
                            useCurrent: false,
                            ignoreReadonly: true
                        });
                        console.log("Datetimepicker initialized on register page");
                    } else if ($wrapper.length) {
                        console.log("Datetimepicker plugin not found, retrying...");
                        setTimeout(initPicker, 100);
                    }
                }
                initPicker();
            });
        })(jQuery);
    </script>
@endpush
