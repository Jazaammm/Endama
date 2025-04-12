<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">
    @include('auth.professor.sidebar')

    <div class="flex-1 p-10">
        <h1 class="text-4xl font-bold text-left mb-10">PROFESSOR'S DASHBOARD</h1>

        <div class="grid grid-cols-3 gap-6">
            <!-- Card 1 -->
            <a href="" class="bg-white shadow-xl rounded-2xl p-6 flex flex-col justify-between hover:shadow-2xl transition duration-200 relative h-[300px]">
                <img src="{{ asset('img/students.png') }}" alt="Icon" class="w-40 h-40 absolute top-1/2 right-6 transform -translate-y-1/2">
                <p class="text-4xl font-bold mt-2" style="font-size: 70px">{{$totalStudents}}</p>
                <h2 class="text-3xl font-bold mt-auto">Total of <br> Students</h2>
            </a>

            <!-- Card 2 -->
            <a href="" class="bg-white shadow-xl rounded-2xl p-6 flex flex-col justify-between hover:shadow-2xl transition duration-200 relative h-[300px]">
                <img src="{{ asset('img/onpoll.png') }}" alt="Icon" class="w-40 h-40 absolute top-1/2 right-6 transform -translate-y-1/2">
                <h2 class="text-3xl font-bold mt-auto">Total of <br> Ongoing Polls</h2>
            </a>

            <!-- Card 3: Chart -->
            <div class="bg-white shadow-xl rounded-2xl p-4 hover:shadow-2xl transition duration-200 relative h-[300px] flex flex-col justify-between">
                <canvas id="chart" class="w-full h-full"></canvas>
                <h2 class="text-4xl font-bold mt-2"></h2>
            </div>

            <!-- Card 4 -->
            <a href="#" class="bg-white shadow-xl rounded-2xl p-6 flex flex-col justify-between hover:shadow-2xl transition duration-200 relative h-[300px]">
                <img src="{{ asset('img/onvote.png') }}" alt="Votes" class="w-40 h-40 absolute top-1/2 right-6 transform -translate-y-1/2">
                <h2 class="text-3xl font-bold mt-auto">Total of <br> Ongoing Voting</h2>
            </a>

            <!-- Card 5 -->
            <a href="#" class="bg-white shadow-xl rounded-2xl p-6 flex flex-col justify-between hover:shadow-2xl transition duration-200 relative h-[300px]">
                <img src="{{ asset('img/compoll.png') }}" alt="Finished" class="w-40 h-40 absolute top-1/2 right-6 transform -translate-y-1/2">
                <h2 class="text-3xl font-bold mt-auto">Total of <br>Completed Polls</h2>
            </a>

            <!-- Card 6 -->
            <a href="#" class="bg-white shadow-xl rounded-2xl p-6 flex flex-col justify-between hover:shadow-2xl transition duration-200 relative h-[300px]">
                <img src="{{ asset('img/comvote.png') }}" alt="Users" class="w-40 h-40 absolute top-1/2 right-6 transform -translate-y-1/2">
                <h2 class="text-3xl font-bold mt-auto">Total of <br> Completed Votings</h2>
            </a>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Professors', 'Students'],
                datasets: [{
                    label: 'Count',
                    data: [3, 1234],
                    backgroundColor: ['#445a7c', '#002860']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
