<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Verification Checkbox</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Test Verification Checkbox Logic</h1>

        <form id="verificationForm" class="bg-white rounded-lg shadow p-6">
            @csrf
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                @foreach(VerificationCheckboxService::getCheckboxPositions() as $field => $position)
                    <div class="flex items-center space-x-2">
                        <input type="checkbox"
                               name="{{ $field }}"
                               id="{{ $field }}"
                               value="Yes"
                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="{{ $field }}" class="text-sm font-medium text-gray-700">
                            {{ ucfirst(str_replace('_', ' ', $field)) }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pendingin Ruangan:</label>
                <select name="pendingin" id="pendingin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">-- Select --</option>
                    <option value="1/2pk">1/2 PK</option>
                    <option value="3/4pk">3/4 PK</option>
                    <option value="1pk">1 PK</option>
                    <option value="1,5pk">1.5 PK</option>
                    <option value="kipas">Kipas Angin / Kipas Blower</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Test Validation
            </button>
        </form>

        <div id="result" class="mt-6 hidden">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Result:</h2>
                <pre id="resultContent" class="bg-gray-100 p-4 rounded text-sm overflow-auto"></pre>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('verificationForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());

            // Convert checkbox values
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                if (!checkbox.checked) {
                    delete data[checkbox.name];
                }
            });

            try {
                const response = await fetch('/test-verification', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                document.getElementById('result').classList.remove('hidden');
                document.getElementById('resultContent').textContent = JSON.stringify(result, null, 2);

                // Highlight result based on validation
                const resultDiv = document.querySelector('#result > div');
                if (result.is_valid) {
                    resultDiv.classList.add('border-l-4', 'border-green-500');
                } else {
                    resultDiv.classList.add('border-l-4', 'border-red-500');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error occurred during validation');
            }
        });
    </script>

    @csrf
</body>
</html>