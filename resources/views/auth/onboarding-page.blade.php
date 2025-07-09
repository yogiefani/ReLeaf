<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white overflow-hidden sm:rounded-lg">

            <div class="flex flex-col items-center mb-6">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Airbook Logo" class="w-20 h-auto">
                </a>
                <p class="text-md text-[#987554] mt-4">Create your account</p>
            </div>
            <form method="POST" action="{{ route('onboarding.submit') }}">
                @csrf

                <div>
                    <x-input-label class="text-[#664229]"  for="name" :value="__('Full Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label class="text-[#664229]"  for="email" :value="__('Email Address')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label class="text-[#664229]"  for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label class="text-[#664229]"  for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                
                <div class="mt-4">
                    <label for="terms" class="inline-flex items-center">
                        <input id="terms" type="checkbox" class="rounded border-gray-300 text-brand-primary shadow-sm focus:ring-brand-primary" name="terms" required>
                        <span class="ms-2 text-sm text-[#987554]">I agree to the <a href="#" class="underline">terms and conditions</a></span>
                    </label>
                </div>

                <div class="mt-6">
                    <x-primary-button class="w-full justify-center bg-brand-primary hover:bg-brand-primary-hover">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>

                <div class="text-center mt-6">
                    <p class="text-sm text-[#987554]">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-medium text-brand-primary hover:underline">
                            Sign In
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>