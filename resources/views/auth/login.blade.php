<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPCC VoPoll</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-cover bg-center relative" style="background-image: url('/img/court.jpg');">

 <div class="relative z-10 flex flex-col md:flex-row items-top justify-between w-[90%] lg:w-[90%]
 min-h-[90vh] bg-opacity-90  p-8 rounded-[50px] shadow-lg border border-[#204493] bg-[#001840] "> <!--backdrop-blur-lg -->

        <div class="w-full md:w-1/2 p-10 text-[#FCA319] font-bold">
    <h1 class="text-8xl text-justify-center ml-24 mt-12 leading-tight mb-12">Systems Plus<br>Computer<br>College</h1>
</div>

        <div class="w-full max-w-2xl bg-[#E9E9E9] bg-opacity-90 backdrop-blur-md p-8 rounded-xl shadow-md border border-gray-300 m-10 min-h-[400px] flex flex-col justify-center" >

            @if (session('success'))
                <div class="p-3 my-2 text-sm text-green-600 bg-green-100 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-3 my-2 text-sm text-red-600 bg-red-100 rounded">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('error'))
                <div class="p-3 my-2 text-sm text-black-600 bg-red-100 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('authLogin') }}" method="POST">
                @csrf
                <div class="mt-4">
                    <input type="email" name="email" placeholder="Email"
                        class="w-full px-4 min-h-[80px] border rounded-lg focus:ring focus:ring-blue-300 text-gray-700 placeholder-gray-400 placeholder:text-3xl" required>
                </div>

                <div class="mt-4">
                    <input type="password" name="password" placeholder="Password"
                        class="w-full px-4 min-h-[80px] border rounded-lg focus:ring focus:ring-blue-300 text-gray-700 placeholder-gray-400 placeholder:text-3xl" required>
                </div>

                <div class="mt-4 flex items-center justify-between py-6">
                    <div>
                        <input type="checkbox" id="remember" name="remember" class="mr-2">
                        <label for="remember" class="text-lg text-gray-700">Remember me</label>
                    </div>
                    <a href="{{ route('forgotpasswordForm') }}" class="text-sm text-blue-500 hover:underline">Forgot Password?</a>
                </div>

                <div class="flex justify-center">
                <button type="submit" class="w-[350px] px-2 py-6 mb-8 text-white bg-[#001840] rounded-lg hover:bg-blue-800 font-bold ">LOGIN</button>
                </div>

            </form>

            <div class="flex justify-center">
    <a href="/verify-student" class="w-[450px] px-4 py-6 mt-4 bg-[#143B8E] text-white rounded-lg hover:bg-gray-400 font-bold text-center block">
        REGISTER ACCOUNT
    </a>
</div>


        </div>
    </div>

</body>
</html>
