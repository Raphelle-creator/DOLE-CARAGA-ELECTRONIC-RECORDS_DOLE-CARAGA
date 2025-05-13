<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\OutDocument;
use App\Models\InDocument;
use App\Models\Department;

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

        if ($user->type === 'outgoing') {
            $documents = OutDocument::with('user')
                ->where('user_id', $user->id)
                ->orderBy('date_time', 'desc')
                ->get();

            $stats = [
                'total' => $documents->count(),
                'acknowledged' => $documents->where('status', 'completed')->count(),
                'pending' => $documents->where('status', 'pending')->count(),
            ];

            return view('dashboard', compact('user', 'stats', 'documents'));
        }

        return view('dashboard', compact('user'));
    }

    public function showLoginForm()
    {
        return view('login');
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

        if ($user !== null && in_array($user->type, ['incoming', 'outgoing', 'user'])) {
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

    public function settings()
    {
        return view('settings');
    }

    public function reports()
    {
        return view('reports');
    }



    // OUTGOING SECTION

    public function createOutgoingRecord()
    {
        $this->checkOutgoing();
        return view('create_outgoing');
    }

    public function outgoingRecords(Request $request)
    {
        $this->checkOutgoing();
    
        $query = OutDocument::with('user')
            ->where('user_id', auth()->id())
            ->orderBy('date_time', 'desc');
    
        // Search filter
        if ($request->search) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('control_num', 'like', $searchTerm)
                  ->orWhere('particulars', 'like', $searchTerm)
                  ->orWhere('source', 'like', $searchTerm)
                  ->orWhere('received', 'like', $searchTerm)
                  ->orWhere('notes', 'like', $searchTerm);
            });
        }
    
        // Other filters
        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
    
        if ($request->doc_type && $request->doc_type !== 'all') {
            $query->where('docu_type', $request->doc_type);
        }
    
        if ($request->month && $request->month !== 'all') {
            $query->whereMonth('date_time', $request->month);
        }
    
        $documents = $query->paginate(10);
    
        // Get total counts for stats (unfiltered)
        $stats = [
            'total' => OutDocument::where('user_id', auth()->id())->count(),
            'acknowledged' => OutDocument::where('user_id', auth()->id())->where('status', 'completed')->count(),
            'pending' => OutDocument::where('user_id', auth()->id())->where('status', 'pending')->count(),
        ];
    
        return view('outgoing', compact('documents', 'stats'));
    }

    public function viewOutgoingDocument($id)
    {
        $this->checkOutgoing();
        $document = OutDocument::findOrFail($id);
        return view('outgoing_view', compact('document'));
    }
    
    public function editOutgoingDocument($id)
    {
        $this->checkOutgoing();
        $document = OutDocument::findOrFail($id);
        return view('outgoing_edit', compact('document'));
    }
    
    public function updateOutgoingDocument(Request $request, $id)
    {
        $this->checkOutgoing();
    
        $validated = $request->validate([
            'control_num' => 'nullable|string',
            'date_time' => 'nullable|date',
            'docu_for' => 'nullable|string|in:internal,external',
            'delivery_methods' => 'nullable|array',
            'delivery_methods.*' => 'string|in:Personal Delivery,Courier,Email',
            'source' => 'nullable|string',
            'particulars' => 'nullable|string',
            'links' => 'nullable|url',
            'received' => 'nullable|string',
            'date_received' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);
    
        // Combine delivery methods
        $delivery = implode(', ', $validated['delivery_methods']);
    
        // Determine status
        $status = 'completed';
        if (empty($validated['received']) || empty($validated['date_received']) || empty($validated['control_num']) || empty($validated['date_time']) || empty($validated['docu_for']) || empty($delivery) || empty($validated['source']) || empty($validated['particulars']) || empty($validated['links'])) {
            $status = 'pending';
        }
    
        $document = OutDocument::findOrFail($id);
        $document->update([
            'control_num' => $validated['control_num'],
            'date_time' => $validated['date_time'],
            'docu_for' => $validated['docu_for'],
            'delivery' => $delivery,
            'source' => $validated['source'],
            'particulars' => $validated['particulars'],
            'links' => $validated['links'] ?? null,
            'received' => $validated['received'] ?? null,
            'date_received' => $validated['date_received'] ?? null,
            'status' => $status,
            'notes' => $validated['notes'] ?? null,
        ]);
    
        return redirect()->route('outgoing')->with('success', 'Document updated successfully!');
    }

    public function storeOutgoingDocumentLocal(Request $request)
    {
        $this->checkOutgoing();
    
        $validated = $request->validate([
            'control_num' => 'nullable|string',
            'date_time' => 'nullable|date',
            'docu_for' => 'nullable|string',
            'delivery_methods' => 'nullable|array',
            'delivery_methods.*' => 'string|in:Personal Delivery,Courier,Email',
            'source' => 'nullable|string',
            'particulars' => 'nullable|string',
            'links' => 'nullable|url',
            'received' => 'nullable|string',
            'date_received' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);
    
        $delivery = implode(', ', $validated['delivery_methods'] ?? []);
    
        // Determine status
        $status = 'completed';
        if (empty($validated['received']) || empty($validated['date_received']) || empty($validated['control_num']) || empty($validated['date_time']) || empty($validated['docu_for']) || empty($delivery) || empty($validated['source']) || empty($validated['particulars']) || empty($validated['links'])) {
            $status = 'pending';
        }
    
        OutDocument::create([
            'user_id' => auth()->id(),
            'control_num' => $validated['control_num'],
            'date_time' => $validated['date_time'],
            'docu_for' => $validated['docu_for'],
            'delivery' => $delivery,
            'source' => $validated['source'],
            'particulars' => $validated['particulars'],
            'links' => $validated['links'] ?? null,
            'received' => $validated['received'] ?? null,
            'date_received' => $validated['date_received'] ?? null,
            'status' => $status,
            'notes' => $validated['notes'] ?? null,
            'docu_type' => 'local',
        ]);
    
        return redirect()->route('outgoing')->with('success', 'Document created successfully!');
    }

    public function storeOutgoingDocumentCO(Request $request)
    {
        $this->checkOutgoing();
    
        $validated = $request->validate([
            'control_num' => 'nullable|string',
            'date_time' => 'nullable|date',
            'docu_for' => 'nullable|string',
            'delivery_methods' => 'nullable|array',
            'delivery_methods.*' => 'string|in:Personal Delivery,Courier,Email',
            'source' => 'nullable|string',
            'particulars' => 'nullable|string',
            'links' => 'nullable|url',
            'received' => 'nullable|string',
            'date_received' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);
    
        // Combine delivery methods
        $delivery = implode(', ', $validated['delivery_methods'] ?? []);
    
        // Determine status
        $status = 'completed';
        if (empty($validated['received']) || empty($validated['date_received']) || empty($validated['control_num']) || empty($validated['date_time']) || empty($validated['docu_for']) || empty($delivery) || empty($validated['source']) || empty($validated['particulars']) || empty($validated['links'])) {
            $status = 'pending';
        }
    
        OutDocument::create([
            'user_id' => auth()->id(),
            'control_num' => $validated['control_num'],
            'date_time' => $validated['date_time'],
            'docu_for' => $validated['docu_for'],
            'delivery' => $delivery,
            'source' => $validated['source'],
            'particulars' => $validated['particulars'],
            'links' => $validated['links'] ?? null,
            'received' => $validated['received'] ?? null,
            'date_received' => $validated['date_received'] ?? null,
            'status' => $status,
            'notes' => $validated['notes'] ?? null,
            'docu_type' => 'co',
        ]);
    
        return redirect()->route('outgoing')->with('success', 'Document created successfully!');
    }

    public function update(Request $request, $id)
    {
        $this->checkOutgoing();
    
        $validated = $request->validate([
            'control_num' => 'nullable|string',
            'date_time' => 'required|date',
            'docu_for' => 'required|string|in:internal,external',
            'delivery_methods' => 'required|array',
            'delivery_methods.*' => 'string|in:Personal Delivery,Courier,Email',
            'source' => 'required|string',
            'particulars' => 'required|string',
            'links' => 'nullable|url',
            'received' => 'nullable|string',
            'date_received' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);
    
        $delivery = implode(', ', $validated['delivery_methods']);

        // Determine status
        $status = 'completed';
        if (empty($validated['received']) || empty($validated['date_received'])) {
            $status = 'pending';
        }
    
        $document = OutDocument::findOrFail($id);
        $document->update([
            'control_num' => $validated['control_num'],
            'date_time' => $validated['date_time'],
            'docu_for' => $validated['docu_for'],
            'delivery' => $delivery,
            'source' => $validated['source'],
            'particulars' => $validated['particulars'],
            'links' => $validated['links'] ?? null,
            'received' => $validated['received'] ?? null,
            'date_received' => $validated['date_received'] ?? null,
            'status' => $status,
            'notes' => $validated['notes'] ?? null,
        ]);
    
        return response()->json(['success' => true]);
    }
// ---------------------------------------------------------------
    
    // INCOMING SECTION

    public function incomingRecords(Request $request)
    {
        $this->checkIncoming();

        $query = InDocument::with('user')
            ->where('user_id', auth()->id())
            ->orderBy('date_time', 'desc');

        // Search filter
        if ($request->search) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('control_num', 'like', $searchTerm)
                ->orWhere('particulars', 'like', $searchTerm)
                ->orWhere('source', 'like', $searchTerm)
                ->orWhere('received_by', 'like', $searchTerm);
            });
        }

        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->source && $request->source !== 'all') {
            $query->where('source', $request->source);
        }

        if ($request->month && $request->month !== 'all') {
            $query->whereMonth('date_time', $request->month);
        }

        $documents = $query->paginate(10);

        // Get stats (unfiltered)
        $stats = [
            'total' => InDocument::count(),
            'pending' => InDocument::where('status', 'pending')->count(),
            'processed' => InDocument::where('status', 'processed')->count(),
        ];

        return view('incoming', compact('documents', 'stats'));
    }


// -------------------------------------------------------------------------

    public function allDocuments(Request $request)
    {
        $user = auth()->user();

        $region = Department::findOrFail($user->department_id)->region;
        $departmentIds = Department::where('region', $region)->pluck('id');
        $userIds = User::whereIn('department_id', $departmentIds)->pluck('id');

        $query = OutDocument::with('user')->whereIn('user_id', $userIds)->orderBy('date_time', 'desc');
    
        // Search functionality
        if ($request->search) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('control_num', 'like', $searchTerm)
                  ->orWhere('particulars', 'like', $searchTerm)
                  ->orWhere('source', 'like', $searchTerm)
                  ->orWhere('received', 'like', $searchTerm)
                  ->orWhere('notes', 'like', $searchTerm);
            });
        }
    
        // Document type filter
        if ($request->type && $request->type !== 'all') {
        }
    
        // Office type filter
        if ($request->office && $request->office !== 'all') {
            $query->where('docu_type', $request->office);
        }
    
        // Status filter
        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
    
        // Month filter
        if ($request->month && $request->month !== 'all') {
            $query->whereMonth('date_time', $request->month);
        }
    
        $documents = $query->paginate(10);
    
        return view('alldocu', [
            'documents' => $documents,
        ]);
    }
}
