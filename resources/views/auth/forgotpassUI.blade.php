<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Add TailwindCSS CDN if not using a build process -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F6F6F6] flex items-center justify-center min-h-screen">

    <div class="relative z-10 flex flex-col md:flex-row items-top justify-between w-[90%] lg:w-[90%] min-h-[90vh] bg-opacity-0 p-8 rounded-[50px]">

        <!-- Left Card: Informational Text -->
        <div class="w-full md:w-1/2 p-10 text-[#001840] font-bold bg-opacity-0">
            <h1 class="text-6xl ml-24 mt-12 leading-tight mb-12">Set new<br>password<br></h1>
        </div>

        <!-- Right Card: Reset Password Form -->
        <div class="w-full max-w-2xl bg-[#D9D9D9] bg-opacity-90 backdrop-blur-md p-8 rounded-xl shadow-md border border-gray-300 m-10 min-h-[400px] flex flex-col">

            <!-- Heading at the top -->
            <h2 class="text-3xl font-bold text-center text-[#001840] mt-12">Forgot Your Password?</h2>

            <!-- Success Message -->
            @if (session('status'))
            <div class="p-3 my-2 text-sm text-green-600 bg-green-100 rounded">
                {{ session('status') }}
            </div>
            @endif

            <!-- Error Message -->
            @if ($errors->any())
            <div class="p-3 my-2 text-sm text-red-600 bg-red-100 rounded">
                {{ $errors->first() }}
            </div>
            @endif

            <!-- Form -->
            <div class="flex flex-grow items-center justify-center">
                <form action="{{ route('resetpasswordPost') }}" method="POST" class="w-full flex flex-col items-center">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Field -->
                    <div class="mb-12">
                        <input type="email" name="email" placeholder="Email"
                            class="w-[500px] px-4 min-h-[90px] border rounded-lg focus:ring focus:ring-blue-300 text-gray-700 placeholder-gray-400 placeholder:text-3xl" required>
                    </div>

                    <!-- New Password Field -->
                    <div class="mb-12">
                        <input type="password" name="password" placeholder="New Password"
                            class="w-[500px] px-4 min-h-[90px] border rounded-lg focus:ring focus:ring-blue-300 text-gray-700 placeholder-gray-400 placeholder:text-3xl" required>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-12">
                        <input type="password" name="password_confirmation" placeholder="Confirm Password"
                            class="w-[500px] px-4 min-h-[90px] border rounded-lg focus:ring focus:ring-blue-300 text-gray-700 placeholder-gray-400 placeholder:text-3xl" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4">
                        <button type="submit" class="w-[450px] px-4 py-4 bg-[#143B8E] text-white rounded-lg hover:bg-gray-400 font-semibold text-center block text-[30px]">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>

            <!-- Back to Login Link -->
            <div class="text-center mt-4">
                <a href="/login" class="text-blue-600 hover:underline">Back to Login</a>
            </div>
        </div>
    </div>

</body>

</html>
