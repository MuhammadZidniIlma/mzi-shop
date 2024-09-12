<x-layout-auth>
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-form-title" style="background-image: url(assetLogin/images/bg-01.jpg);">
                <span class="login100-form-title-1">
                    Sign Up
                </span>
            </div>

            <form class="login100-form validate-form" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="wrap-input100 validate-input m-b-26" data-validate="Full Name is required">
                    <span class="label-input100">Full Name</span>
                    <input class="input100" type="text" name="fullname" placeholder="Enter Full Name">
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                    <span class="label-input100">Username</span>
                    <input class="input100" type="text" name="username" placeholder="Enter username">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="email" name="email" placeholder="Enter email">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password" placeholder="Enter password">
                    <span class="focus-input100"></span>
                </div>

                <div class="flex-sb-m w-full p-b-30 d-flex justify-content-end">
                    <div>
                        <a href="{{ route('login') }}" class="txt1">
                            Have an account?
                        </a>
                    </div>

                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout-auth>
