<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trash Users</title>

    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background: #eef2f7;
            margin: 0;
        }

        .container {
            width: 80%;
            margin: 40px auto;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .top-bar {
            text-align: right;
            margin-bottom: 15px;
        }

        .top-bar a {
            text-decoration: none;
            background: #3490dc;
            color: white;
            padding: 8px 14px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #2d3748;
            color: white;
            padding: 10px;
        }

        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background: #f1f1f1;
        }

        .btn-restore {
            background: #38c172;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
        }

        .btn-delete {
            background: #e3342f;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
        }

        .empty {
            text-align: center;
            padding: 20px;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="card">

            <h2>🗑️ Trash Users</h2>

            @if(session('success'))
                <p style="color: green; text-align:center;">
                    {{ session('success') }}
                </p>
            @endif

            <div class="top-bar">
                <a href="{{ route('users.index') }}">⬅ Back</a>
            </div>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Deleted At</th>
                    <th>Action</th>
                </tr>

                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->deleted_at }}</td>
                        <td>

                            <form method="POST" action="{{ route('users.restore', $user->id) }}" style="display:inline;">
                                @csrf
                                <button class="btn-restore">Restore</button>
                            </form>

                            <form method="POST" action="{{ route('users.forceDelete', $user->id) }}"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete">Delete</button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">No deleted users</td>
                    </tr>
                @endforelse

            </table>

        </div>
    </div>

</body>

</html>