<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">
    @include('auth.admin.sidebar')
    <div class="flex-1 p-10">
        <h2 class="text-3xl font-bold mb-6">PROFESSOR LIST</h2>
        <div class="bg-white shadow-xl rounded-2xl p-6 border" style="background-color:#CDCDCD; border-color: #002860;">
            <div class="flex justify-between items-center mb-4 border-b pb-2">
                <h3 class="text-lg font-bold uppercase">EDIT</h3>
                <button class="text-gray-600 hover:text-gray-800">&larr;</button> <!-- Back Button -->
            </div>

            <form action="{{ route('updateprof', ['id' => $professor->id]) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-semibold">Name: <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $professor->name) }}" class="w-full border px-3 py-2 rounded" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold">Email: <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $professor->email ) }}" class="w-full border px-3 py-2 rounded" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold">Password: <span class="text-red-500">*</span></label>
                    <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold">Confirm Password: <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="submit" class="bg-[#002860] text-white px-4 py-2 rounded hover:bg-[#001d4e]">Confirm Edit</button>
                    <button
                    type="button"
                    class="bg-gray-400 px-4 py-2 rounded hover:bg-gray-500"
                    onclick="window.location='{{ route('proflist') }}';"
                >
                    Cancel
                </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
