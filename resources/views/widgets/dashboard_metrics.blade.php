<div class="card p-0 img-thumbnail setup-widget bg-white shadow-sm rounded-lg overflow-hidden">
    <div class="p-4">
        <h2 class="mb-4 text-xl font-bold text-gray-800">📊 Live System Statistics</h2>
        <div style="display: grid; grid-template-cols: repeat(3, 1fr); gap: 1rem;">
            <div style="background-color: #ebf8ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                <div style="font-size: 0.875rem; color: #2b6cb0; font-weight: 600;">Total Users</div>
                <div style="font-size: 1.875rem; font-weight: bold; color: #2c5282;">{{ $totalUsers }}</div>
            </div>
            <div style="background-color: #f0fff4; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                <div style="font-size: 0.875rem; color: #38a169; font-weight: 600;">Total Projects</div>
                <div style="font-size: 1.875rem; font-weight: bold; color: #276749;">{{ $totalProjects }}</div>
            </div>
            <div style="background-color: #faf5ff; padding: 1rem; border-radius: 0.5rem; text-align: center;">
                <div style="font-size: 0.875rem; color: #805ad5; font-weight: 600;">Active Projects</div>
                <div style="font-size: 1.875rem; font-weight: bold; color: #553c9a;">{{ $activeProjects }}</div>
            </div>
        </div>
    </div>
</div>