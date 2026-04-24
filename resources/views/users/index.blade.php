<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Management</title>

    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background: #f1f5f9;
            margin: 0;
        }

        /* Container */
        .container {
            width: 85%;
            margin: 40px auto;
        }

        /* Card */
        .card {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        /* Search */
        .search-box input {
            padding: 10px;
            width: 220px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .search-box button {
            padding: 10px 15px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
        }

        /* Buttons */
        .btn-trash {
            background: #ef4444;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
            padding: 6px 14px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            min-width: 90px;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

        /* Table */
        .user-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        .user-table th {
            background: #111827;
            color: white;
            padding: 14px;
            text-align: left;
        }

        .user-table td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        .user-table tbody tr:hover {
            background: #f9fafb;
        }

        .user-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .user-table .name {
            font-weight: 600;
        }

        .user-table .email {
            color: #6b7280;
        }

        /* Action Column Fix */
        .action-cell {
            text-align: center;
        }

        .action-cell form {
            display: inline-block;
            margin: 0;
        }

        /* Badge */
        .badge {
            background: #10b981;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        /* Success */
        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
        }

        /* Pagination */
        .pagination-center {
            text-align: center;
            margin-top: 25px;
        }

        .pagination-center a {
            display: inline-block;
            padding: 8px 14px;
            margin: 3px;
            border-radius: 6px;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #333;
        }

        .pagination-center a:hover {
            background: #2563eb;
            color: white;
        }

        .pagination-center a.active {
            background: #2563eb;
            color: white;
        }

        /* Result */
        .result {
            text-align: center;
            margin-top: 10px;
            color: #666;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="card">

            <div class="header">
                <h2>👤 User Management</h2>
                <a href="{{ route('users.trash') }}" class="btn-trash">🗑 Trash</a>
            </div>

            @if(session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Search -->
            <form method="GET" class="search-box" style="margin-bottom:15px;">
                <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}">
                <button>Search</button>
            </form>

            <!-- Table -->
            <table class="user-table">
                <thead>
                    <tr>
                        <th style="width: 8%;">ID</th>
                        <th style="width: 25%;">Name</th>
                        <th style="width: 30%;">Email</th>
                        <th style="width: 15%;">Status</th>
                        <th style="width: 20%; text-align: center;">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="name">{{ $user->name }}</td>
                            <td class="email">{{ $user->email }}</td>
                            <td><span class="badge">Active</span></td>

                            <!-- FIXED ACTION -->
                            <td class="action-cell">
                                <form method="POST" action="{{ route('users.delete', $user->id) }}">
                                    @csrf
                                    <button class="btn-delete" onclick="return confirm('Are you sure delete this user?')">
                                        🗑 Delete
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Result -->
            <div class="result">
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
            </div>

            <!-- Number Pagination -->
            <div class="pagination-center">
                @if ($users->lastPage() > 1)
                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                        <a href="{{ $users->url($i) }}" class="{{ ($users->currentPage() == $i) ? 'active' : '' }}">
                            {{ $i }}
                        </a>
                    @endfor
                @endif
            </div>

        </div>
    </div>

</body>

</html>