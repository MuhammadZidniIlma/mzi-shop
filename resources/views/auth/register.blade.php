<x-layout-auth>
    <style>
        .error {
            color: #50110f;
            /* Warna merah terang untuk pesan error */
            font-size: 12px;
            /* Ukuran font sedikit lebih kecil dari teks normal */
            margin-top: -20px;
            /* Jarak atas untuk memberi spasi antara field dan pesan error */
            display: inline-block;
            /* Pastikan pesan error muncul di baris baru */
        }
    </style>

    </style>
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
                    <input class="input100" type="text" name="fullname" value="{{ old('fullname') }}"
                        placeholder="Enter Full Name">
                    <span class="focus-input100"></span>
                </div>
                @error('fullname')
                    <span class="error text-danger text-xs">{{ $message }}</span>
                @enderror

                <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                    <span class="label-input100">Username</span>
                    <input class="input100" type="text" name="username" value="{{ old('username') }}"
                        placeholder="Enter username">
                    <span class="focus-input100"></span>
                </div>
                @error('username')
                    <span class="error text-danger text-xs">{{ $message }}</span>
                @enderror

                <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="email" name="email" value="{{ old('email') }}"
                        placeholder="Enter email">
                    <span class="focus-input100"></span>
                </div>
                @error('email')
                    <span class="error text-danger text-xs">{{ $message }}</span>
                @enderror

                <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password" placeholder="Enter password">
                    <span class="focus-input100"></span>
                </div>
                @error('password')
                    <span class="error text-danger text-xs">{{ $message }}</span>
                @enderror

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
