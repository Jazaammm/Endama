<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-blue-600 p-4 text-white">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold">ADMIN Dashboard</h1>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-500 rounded hover:bg-red-600">Logout</button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 container mx-auto mt-6 p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold">Welcome ADMIN!</h2>
            <p class="mt-2 text-gray-600">This is your ADMIN dashboard. Here you can view your voting status, upcoming polls, and other important information.</p>

            <!-- Example Student Content -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800">Upcoming Elections</h3>
                <ul class="mt-2 space-y-2">
                    <li class="p-4 bg-gray-200 rounded">🗳️ Student Council Elections - <span class="text-blue-600">March 25, 2025</span></li>
                    <li class="p-4 bg-gray-200 rounded">📢 Class Representative Voting - <span class="text-blue-600">April 10, 2025</span></li>
                </ul>
            </div>
        </div>
    </div>

</body>
</html>
