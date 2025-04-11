<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    private function checkIncoming()
    {
        if (auth()->user()->type !== 'incoming') {
            abort(403, 'Unauthorized action.');
        }
    }

    private function checkOutgoing()
    {
        if (auth()->user()->type !== 'outgoing') {
            abort(403, 'Unauthorized action.');
        }
    }

    public function dashboard()
    {
        $user = auth()->user();
    
        if (!$user) {
            abort(403, 'Unauthorized action.');
        }
    
        if ($user->type === 'super_admin') {
            return redirect('/super_admin/dashboard');
        }
    
        return view('dashboard', compact('user'));
    }
    

    public function showLoginForm()
    {
        return view('login');
    }

    public function incomingRecords()
    {
        $this->checkIncoming();
        return view('incoming');
    }

    public function outgoingRecords()
    {
        $this->checkOutgoing();
        return view('outgoing');
    }

    public function showSuperAdminLoginForm()
    {
        return view('super_admin.auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $validated['username'])
                  ->where('password', $validated['password'])
                  ->where('type', '!=', 'super_admin')
                  ->where('status', 'active')
                  ->first();

        if ($user !== null && ($user->type === 'incoming' || $user->type === 'outgoing' || $user->type === 'user')) {
        Auth::login($user);
        return redirect('/dashboard');
    }

        return back()->withErrors([
            'username' => 'Invalid credentials or account is not active'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function allDocuments(Request $request)
    {
        $type = $request->query('type', 'all');
        $search = $request->query('search');
        
        // Mock data - replace with your actual data source when ready
        $mockDocuments = [
            [
                'id' => 1,
                'title' => 'Q2 Regional Labor Report',
                'description' => 'Quarterly report on labor statistics for the region',
                'type' => 'incoming',
                'status' => 'pending',
                'date' => 'May 22, 2023'
            ],
            [
                'id' => 2,
                'title' => 'Employee Benefits Proposal',
                'description' => 'Proposal for new employee benefits package',
                'type' => 'incoming',
                'status' => 'processed',
                'date' => 'May 21, 2023'
            ],
            [
                'id' => 3,
                'title' => 'Monthly Employment Statistics',
                'description' => 'Monthly statistics on employment in the region',
                'type' => 'outgoing',
                'status' => 'pending',
                'date' => 'May 20, 2023'
            ],
            [
                'id' => 4,
                'title' => 'Training Program Guidelines',
                'description' => 'Guidelines for the new employee training program',
                'type' => 'outgoing',
                'status' => 'processed',
                'date' => 'May 18, 2023'
            ],
        ];
        
        // Filter by type if not 'all'
        $documents = collect($mockDocuments);
        
        if ($type !== 'all') {
            $documents = $documents->filter(function ($document) use ($type) {
                return $document['type'] === $type;
            });
        }
        
        // Apply search if provided
        if ($search) {
            $documents = $documents->filter(function ($document) use ($search) {
                return str_contains(strtolower($document['title']), strtolower($search)) || 
                    str_contains(strtolower($document['description']), strtolower($search));
            });
        }
        
        return view('alldocu', [
            'documents' => $documents,
            'currentType' => $type,
            'searchTerm' => $search
        ]);
    }
}