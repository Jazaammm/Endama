<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">

    <!-- Sidebar -->
    @include('auth.admin.sidebar')

    <!-- Main Content -->
    <div class="flex-1 p-10">
        <h1 class="text-4xl font-bold text-left mb-10">ADMIN DASHBOARD</h1>

        <div class="grid grid-cols-2 gap-8">
            <!-- Left Side: Students and Professors Cards in Column -->
            <div class="flex flex-col gap-8">
                <!-- Total Students Card -->
                <a href="/student-list" class="bg-white shadow-xl rounded-2xl p-8 flex flex-col justify-between items-start hover:shadow-2xl transition duration-200 relative h-[300px]">
                    <div class="flex flex-col justify-center items-start w-full">
                        <p class="text-4xl font-bold mt-2" style="font-size: 70px">1,234</p>
                        <h2 class="text-4xl font-semibold mt-40">Total of Students</h2>
                    </div>
                    <svg class="w-24 h-24 absolute top-1/2 right-4 transform -translate-y-1/2 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-8 0v2h5M9 20h5v-2a4 4 0 00-8 0v2h5M3 9a4 4 0 108 0 4 4 0 00-8 0zM17 9a4 4 0 108 0 4 4 0 00-8 0z"></path>
                    </svg>
                </a>

                <!-- Total Professors Card -->
                <a href="{{ route('proflist') }}" class="bg-white shadow-xl rounded-2xl p-8 flex flex-col justify-between items-start hover:shadow-2xl transition duration-200 relative h-[300px]">
                    <div class="flex flex-col justify-center items-start w-full">
                        <p class="text-4xl font-bold mt-2" style="font-size: 70px">{{ $totalProfessors}}</p>
                        <h2 class="text-4xl font-semibold mt-40">Total of Professors</h2>
                    </div>
                    <svg class="w-24 h-24 absolute top-1/2 right-4 transform -translate-y-1/2 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l-2-2m0 0l-2-2m2 2h8m-6 2a9 9 0 11-9-9 9 9 0 019 9z"></path>
                    </svg>
                </a>
            </div>

            <!-- Right Side: Chart with Combined Height of Cards -->
            <div class="bg-white shadow-xl rounded-2xl p-6 flex justify-center items-center h-[635px]">
                <canvas id="chart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Professor', 'Students'],
                datasets: [{
                    label: 'Count',
                    data: [567, 1234],
                    backgroundColor: ['#445a7c', '#002860']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>

</body>
</html>
