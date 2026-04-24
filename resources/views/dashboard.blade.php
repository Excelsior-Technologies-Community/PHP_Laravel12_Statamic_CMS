<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .card {
            width: 220px;
            padding: 20px;
            border-radius: 10px;
            color: white;
            text-align: center;
            font-size: 18px;
        }

        .card h3 {
            margin: 10px 0;
            font-size: 28px;
        }

        .total {
            background: #3490dc;
        }

        .deleted {
            background: #e3342f;
        }

        .top-bar {
            text-align: right;
            margin-bottom: 20px;
        }

        .top-bar a {
            text-decoration: none;
            padding: 8px 15px;
            background: #38c172;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <h2>📊 Dashboard</h2>

    <div class="top-bar">
        <a href="{{ route('users.index') }}">👤 Manage Users</a>
    </div>

    <div class="container">

        <!-- Total Users -->
        <div class="card total">
            <p>Total Users</p>
            <h3>{{ $total }}</h3>
        </div>

        <!-- Deleted Users -->
        <div class="card deleted">
            <p>Deleted Users</p>
            <h3>{{ $deleted }}</h3>
        </div>

    </div>

</body>

</html>