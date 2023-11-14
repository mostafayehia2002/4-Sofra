
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sofra-Login</title>
     @include('layouts.head')
    <body>
<script src={{asset('assets/js/hs.theme-appearance.js')}}></script>
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main" class="main">
    <div class="position-fixed top-0 end-0 start-0 bg-img-start" style="height: 32rem; background-image: url(./assets/svg/components/card-6.svg);">
        <!-- Shape -->
        <div class="shape shape-bottom zi-1">
            <svg
                preserveAspectRatio="none"
                xmlns="http://www.w3.org/2000/svg"
                x="0px"
                y="0px"
                viewBox="0 0 1921 273"
            >
                <polygon fill="#fff" points="0,273 1921,273 1921,0 "/>
            </svg>
        </div>
        <!-- End Shape -->
    </div>
    <!-- Content -->
    <div class="container py-5 py-sm-7">
        <a class="d-flex justify-content-center mb-5" href="#">
            <img
                class="zi-2"
                src="{{asset('assets/svg/logos/logo.svg')}}"
                alt="Image Description"
                style="width: 8rem;"
            >
        </a>
        <div class="mx-auto" style="max-width: 30rem;">
            <!-- Card -->
            <div class="card card-lg mb-5">
                <div class="card-body">
                    <!-- Form -->
                    <form class="js-validate needs-validation" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="text-center">
                            <div class="mb-5">
                                <h1 class="display-5">Sign in</h1>
                            </div>
                        </div>
                        <!-- Form -->
                        <div class="mb-4">
                            <label class="form-label" for="signinSrEmail">Your email</label>
                            <input
                                type="email"
                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email')}}"
                                 id="signinSrEmail"
                                 tabindex="1"
                                placeholder="email@address.com"
                                aria-label="email@address.com"
                            >
                            @error('email')
                            <span class="invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>
                        <!-- End Form -->
                        <!-- Form -->
                        <div class="mb-4">
                            <label class="form-label w-100" for="signupSrPassword" tabindex="0">
                                        <span class="d-flex justify-content-between align-items-center">
                                            <span>Password</span>
                                        </span>
                            </label>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    class="js-toggle-password form-control form-control-lg @error('password') is-invalid @enderror"
                                    name="password"
                                    autocomplete="current-password"
                                    id="signupSrPassword"
                                    placeholder="8+ characters required"
                                    aria-label="8+ characters required"
                                >
                            </div>
                            @error('password')
                            <span class="invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>
                        <!-- End Form -->

                        <!-- Form Check -->
                        <div class="form-check mb-4">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                value="{{ old('remember') ? 'checked' : '' }}"
                                id="termsCheckbox"
                                name="remember"
                            >
                            <label class="form-check-label" for="termsCheckbox">
                                Remember me
                            </label>
                        </div>
                        <!-- End Form Check -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
    <!-- End Content -->
</main>
<!-- ========== END MAIN CONTENT ========== -->
<!-- JS Global Compulsory  -->
@include('layouts.script')
<!-- JS Implementing Plugins -->
<script src={{asset('assets/vendor/hs-toggle-password/dist/js/hs-toggle-password.js')}}></script>
<!-- JS Front -->
<script src={{asset('assets/js/theme.min.js')}}></script>
</body>
</html>
