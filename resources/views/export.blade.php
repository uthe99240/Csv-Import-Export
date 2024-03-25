<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Products</title>
</head>
<body>
    
    <a href="{{ url('/import') }}" style="margin-right:5px" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Import</a>
    <h1>Export Products</h1>
    <form action="{{ route('export.csv') }}" method="GET">
        @csrf
        <button type="submit">Export CSV</button>
    </form>
</body>
</html>