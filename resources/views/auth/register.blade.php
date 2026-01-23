<x-guest-layout>
    <div class="mb-4 text-center">
        <h4 class="fw-bold text-dark">Create Account</h4>
        <p class="text-muted text-sm">Join us and start your journey</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label fw-bold small text-uppercase text-muted">Full Name</label>
            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe">
            <x-input-error :messages="$errors->get('name')" class="text-danger small mt-1" />
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label fw-bold small text-uppercase text-muted">Email Address</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="name@example.com">
            <x-input-error :messages="$errors->get('email')" class="text-danger small mt-1" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-bold small text-uppercase text-muted">Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Min. 8 characters">
            <x-input-error :messages="$errors->get('password')" class="text-danger small mt-1" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-bold small text-uppercase text-muted">Confirm Password</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger small mt-1" />
        </div>

        <button type="submit" class="btn btn-primary-custom">
            Register
        </button>

        <div class="text-center mt-4">
            <p class="text-muted small mb-0">Already have an account? 
                <a href="{{ route('login') }}" class="text-link fw-bold">Log in</a>
            </p>
        </div>
    </form>
</x-guest-layout>
