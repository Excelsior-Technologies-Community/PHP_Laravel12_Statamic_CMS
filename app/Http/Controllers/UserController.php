<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where('name', 'like', "%$request->search%")
                ->orWhere('email', 'like', "%$request->search%");
        }

        $users = $query->orderBy('created_at', 'asc')->paginate(4);

        return view('users.index', compact('users'));
    }

    public function trash()
    {
        $users = User::onlyTrashed()->get();
        return view('users.trash', compact('users'));
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return back()->with('success', 'User deleted successfully');
    }

    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();
        return back()->with('success', 'User restored successfully');
    }

    public function forceDelete($id)
    {
        User::withTrashed()->find($id)->forceDelete();
        return back()->with('success', 'User permanently deleted');
    }
}
