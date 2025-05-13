<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Documents | DOLE CARAGA Electronic Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --dole-blue: #0056b3;
            --dole-dark-blue: #003366;
            --dole-yellow: #ffc107;
            --dole-red: #dc3545;
            --sidebar-width: 250px;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            overflow-x: hidden;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--dole-dark-blue);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .sidebar-brand {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
        }
        
        .sidebar-brand img {
            height: 40px;
            margin-right: 10px;
        }
        
        .sidebar-brand h4 {
            font-size: 1.1rem;
            margin-bottom: 0;
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .sidebar-item {
            margin-bottom: 5px;
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .sidebar-link:hover, .sidebar-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .sidebar-link i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }
        
        .sidebar-dropdown {
            padding-left: 50px;
            background: rgba(0, 0, 0, 0.1);
            display: none;
        }
        
        .sidebar-dropdown.show {
            display: block;
        }
        
        .sidebar-dropdown .sidebar-link {
            padding: 8px 20px;
        }
        
        /* Topbar Styles */
        .topbar {
            height: 70px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        
        .topbar-menu {
            display: flex;
            align-items: center;
            margin-left: auto;
        }
        
        .topbar-item {
            margin-left: 1.5rem;
            position: relative;
        }
        
        .topbar-link {
            color: #495057;
            display: flex;
            align-items: center;
        }
        
        .topbar-link:hover {
            color: var(--dole-blue);
        }
        
        .topbar-link i {
            font-size: 1.3rem;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
        }
        
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }
        
        .user-profile .user-info {
            line-height: 1.2;
        }
        
        .user-profile .user-name {
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .user-profile .user-role {
            font-size: 0.8rem;
            color: #6c757d;
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        /* Dashboard Content */
        .dashboard-content {
            padding: 2rem;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .page-title h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dole-dark-blue);
            margin-bottom: 0.5rem;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 0;
        }
        
        .breadcrumb-item a {
            color: var(--dole-blue);
            text-decoration: none;
        }
        
        /* Document List Section */
        .document-section {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            overflow: hidden;
        }
        
        .section-header {
            background-color: #f8f9fa;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .section-header h5 {
            margin-bottom: 0;
            font-weight: 600;
            color: var(--dole-dark-blue);
        }
        
        .section-body {
            padding: 1rem;
        }
        
        /* Filter Controls */
        .filter-controls {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            align-items: center;
        }
        
        .filter-group {
            display: flex;
            align-items: center;
        }
        
        .filter-label {
            margin-right: 0.5rem;
            font-weight: 500;
            white-space: nowrap;
            font-size: 0.9rem;
        }
        
        /* Document List Items */
        .document-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .document-item {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e9ecef;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .document-item:last-child {
            border-bottom: none;
        }
        
        .document-item:hover {
            background-color: #f0f7ff;
        }
        
        .document-type {
            width: 8px;
            height: 40px;
            border-radius: 4px;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }
        
        .type-incoming {
            background-color: #4facfe;
        }
        
        .type-outgoing {
            background-color: #00b09b;
        }
        
        .document-content {
            flex-grow: 1;
            min-width: 0;
        }
        
        .document-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            font-size: 0.95rem;
        }
        
        .document-title-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .document-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            font-size: 0.8rem;
            color: #6c757d;
        }
        
        .document-meta-item {
            display: flex;
            align-items: center;
        }
        
        .document-meta-item i {
            margin-right: 0.25rem;
            font-size: 0.8rem;
        }
        
        /* Badge Styles */
        .badge-status {
            font-size: 0.65rem;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
        }
        
        .badge-incoming {
            background-color: #cce5ff;
            color: #004085;
        }
        
        .badge-outgoing {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-completed {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-local {
            background-color: #e2f9f0;
            color: #006341;
        }
        
        .badge-co {
            background-color: #f0e6ff;
            color: #5a2d9a;
        }
        
        /* Pagination Styles */
        .pagination {
            margin-bottom: 0;
        }
        
        .page-item.active .page-link {
            background-color: var(--dole-blue);
            border-color: var(--dole-blue);
        }
        
        .page-link {
            color: var(--dole-blue);
        }
        
        /* Document Modal Styles */
        .document-modal .modal-header {
            background: var(--dole-dark-blue);
            color: white;
            border-bottom: none;
        }
        
        .document-modal .modal-header .btn-close {
            filter: invert(1);
            opacity: 0.8;
        }
        
        .document-modal .modal-body {
            padding: 1.5rem;
        }
        
        .document-detail-group {
            margin-bottom: 1rem;
        }
        
        .document-detail-label {
            font-weight: 600;
            color: var(--dole-dark-blue);
            margin-bottom: 0.25rem;
        }
        
        .document-detail-value {
            padding: 0.5rem;
            background: #f8f9fa;
            border-radius: 4px;
            border-left: 3px solid var(--dole-blue);
        }
        
        .document-attachments {
            margin-top: 1.5rem;
        }
        
        .attachment-item {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            margin-bottom: 0.5rem;
        }
        
        .attachment-icon {
            width: 40px;
            height: 40px;
            background: rgba(0, 86, 179, 0.1);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: var(--dole-blue);
        }
        
        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                left: -var(--sidebar-width);
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
        }
        
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .filter-controls {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            
            .filter-group {
                width: 100%;
            }
            
            .filter-group select, 
            .filter-group input {
                width: 100% !important;
            }
            
            .document-meta {
                gap: 0.5rem;
            }
            
            .document-modal .modal-body {
                padding: 1rem;
            }
            
            .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('storage/images/logo.png') }}" alt="DOLE CARAGA Logo">
            <h4>E-Records</h4>
        </div>
        
        <div class="sidebar-menu">
            <div class="sidebar-item">
                <a href="/dashboard" class="sidebar-link @if(request()->is('dashboard')) active @endif">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            @if(auth()->user()->type === 'incoming')
            <div class="sidebar-item">
                <a href="/incoming" class="sidebar-link @if(request()->is('incoming')) active @endif">
                    <i class="fas fa-inbox"></i>
                    <span>Incoming</span>
                </a>
            </div>
            @endif

            @if(auth()->user()->type === 'outgoing')
            <div class="sidebar-item">
                <a href="/outgoing" class="sidebar-link @if(request()->is('outgoing')) active @endif">
                    <i class="fas fa-paper-plane"></i>
                    <span>Outgoing</span>
                </a>
            </div>
            @endif
            
            @if(auth()->user()->type === 'incoming' || auth()->user()->type === 'outgoing')
            <div class="sidebar-item has-dropdown">
                <a href="{{ route('documents.index') }}" class="sidebar-link active">
                    <i class="fas fa-folder"></i>
                    <span>All Documents</span>
                </a>
            </div>
            @endif
            
            @if(auth()->user()->type === 'user')
            <div class="sidebar-item">
                <a href="{{ route('documents.index') }}" class="sidebar-link @if(request()->is('documents*')) active @endif">
                    <i class="fas fa-folder"></i>
                    <span>Documents</span>
                </a>
            </div>
            @endif
            
            <div class="sidebar-item">
                <a href="{{ route('reports') }}" class="sidebar-link">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reports</span>
                </a>
            </div>
            
            <div class="sidebar-item">
                <a href="/settings" class="sidebar-link">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <button class="btn btn-link d-lg-none" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="topbar-menu">
                <div class="topbar-item">
                    <div class="user-profile dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('storage/images/default-avatar.png') }}" alt="User Profile">
                            <div class="user-info d-none d-md-inline-block">
                                <p class="user-name mb-0">{{ auth()->user()->name }}</p>
                                <p class="user-role">{{ ucfirst(auth()->user()->type) }} User</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <div class="page-header">
                <div class="page-title">
                    <h1>All Documents</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Documents</li>
                        </ol>
                    </nav>
                </div>
            </div>
            
            <!-- Document Section -->
            <div class="document-section">
                <div class="section-header">
                    <h5>Document List</h5>
                    <div>
                        <span class="badge bg-primary">{{ $documents->total() }} Documents</span>
                    </div>
                </div>
                
                <div class="section-body">
                    <!-- Filter Controls -->
                    <div class="filter-controls">
                        <div class="filter-group">
                            <span class="filter-label">Type:</span>
                            <select class="form-select form-select-sm" id="docTypeFilter" style="width: 120px;">
                                <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All</option>
                                <option value="outgoing" {{ request('type') == 'outgoing' ? 'selected' : '' }}>Outgoing</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <span class="filter-label">Office:</span>
                            <select class="form-select form-select-sm" id="officeFilter" style="width: 120px;">
                                <option value="all" {{ request('office') == 'all' ? 'selected' : '' }}>All</option>
                                <option value="local" {{ request('office') == 'local' ? 'selected' : '' }}>Local</option>
                                <option value="co" {{ request('office') == 'co' ? 'selected' : '' }}>Central Office</option>
                            </select>
                        </div>
    
                        <div class="filter-group">
                            <span class="filter-label">Month:</span>
                            <select class="form-select form-select-sm" id="monthFilter" style="width: 150px;">
                                <option value="all" {{ request('month') == 'all' ? 'selected' : '' }}>All Months</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <span class="filter-label">Status:</span>
                            <select class="form-select form-select-sm" id="statusFilter" style="width: 120px;">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                        
                        <div class="filter-group ms-auto">
                            <form id="searchForm" method="GET" action="{{ route('documents.index') }}">
                                <input type="hidden" name="type" id="typeFilterInput" value="{{ request('type', 'all') }}">
                                <input type="hidden" name="office" id="officeFilterInput" value="{{ request('office', 'all') }}">
                                <input type="hidden" name="status" id="statusFilterInput" value="{{ request('status', 'all') }}">
                                <input type="hidden" name="month" id="monthFilterInput" value="{{ request('month', 'all') }}">
                                <div class="input-group input-group-sm" style="width: 200px;">
                                    <input type="text" 
                                           class="form-control" 
                                           id="searchInput" 
                                           name="search"
                                           placeholder="Search..." 
                                           value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Document List -->
                    <ul class="document-list" id="documentsList">
                        @if($documents->count() > 0)
                            @foreach($documents as $document)
                            <li class="document-item" 
                                data-doc-type="outgoing"
                                data-office-type="{{ $document->docu_type ?? 'local' }}"
                                data-status="{{ $document->status }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#documentModal"
                                data-document-data="{{ json_encode([
                                    'particulars' => $document->particulars ?? 'No title',
                                    'control_num' => $document->control_num,
                                    'date_time' => \Carbon\Carbon::parse($document->date_time)->format('M d, Y H:i'),
                                    'status' => $document->status,
                                    'docu_type' => $document->docu_type ?? 'local',
                                    'source' => $document->source ?? 'N/A',
                                    'received' => $document->received ?? 'N/A',
                                    'date_received' => $document->date_received ? \Carbon\Carbon::parse($document->date_received)->format('M d, Y H:i') : 'N/A',
                                    'notes' => $document->notes ?? 'No notes',
                                    'links' => $document->links ?? null,
                                    'user_name' => $document->user->name
                                ]) }}">
                                
                                <div class="document-type type-outgoing"></div>
                                
                                <div class="document-content">
                                    <div class="document-title">
                                        <span class="document-title-text">{{ $document->particulars ?? 'No title' }}</span>
                                        
                                        <span class="badge-status 
                                            @if($document->status === 'completed') badge-completed
                                            @elseif($document->status === 'pending') badge-pending
                                            @endif">
                                            {{ ucfirst($document->status) }}
                                        </span>
                                        
                                        <span class="badge-status @if($document->docu_type === 'co') badge-co @else badge-local @endif">
                                            {{ $document->docu_type === 'co' ? 'CO' : 'Local' }}
                                        </span>
                                    </div>
                                    
                                    <div class="document-meta">
                                        <span class="document-meta-item">
                                            <i class="fas fa-hashtag"></i> {{ $document->control_num }}
                                        </span>
                                        <span class="document-meta-item">
                                            <i class="fas fa-calendar-alt"></i> 
                                            {{ \Carbon\Carbon::parse($document->date_time)->format('M d, Y') }}
                                        </span>
                                        <span class="document-meta-item">
                                            <i class="fas fa-user"></i> {{ $document->user->name }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        @else
                            <li class="text-center py-4">
                                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No documents found</h5>
                                <p class="text-muted small">Try adjusting your filters or search term</p>
                            </li>
                        @endif
                    </ul>
    
                    <!-- Pagination -->
                    @if($documents->count() > 0)
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            Showing {{ $documents->firstItem() }} to {{ $documents->lastItem() }} of {{ $documents->total() }} documents
                        </div>
                        <div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm mb-0">
                                    @if ($documents->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $documents->appends(request()->query())->previousPageUrl() }}" rel="prev">&laquo;</a>
                                        </li>
                                    @endif
    
                                    @foreach ($documents->getUrlRange(1, $documents->lastPage()) as $page => $url)
                                        @if ($page == $documents->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $documents->appends(request()->query())->url($page) }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
    
                                    @if ($documents->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $documents->appends(request()->query())->nextPageUrl() }}" rel="next">&raquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Document Details Modal -->
    <div class="modal fade document-modal" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="documentModalLabel">Document Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="document-detail-group">
                                <div class="document-detail-label">Particulars</div>
                                <div class="document-detail-value" id="modal-particulars">-</div>
                            </div>
                            
                            <div class="document-detail-group">
                                <div class="document-detail-label">Control Number</div>
                                <div class="document-detail-value" id="modal-control-num">-</div>
                            </div>
                            
                            <div class="document-detail-group">
                                <div class="document-detail-label">Date & Time</div>
                                <div class="document-detail-value" id="modal-date-time">-</div>
                            </div>
                            
                            <div class="document-detail-group">
                                <div class="document-detail-label">Source</div>
                                <div class="document-detail-value" id="modal-source">-</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="document-detail-group">
                                <div class="document-detail-label">Status</div>
                                <div class="document-detail-value">
                                    <span class="badge-status" id="modal-status-badge">-</span>
                                </div>
                            </div>
                            
                            <div class="document-detail-group">
                                <div class="document-detail-label">Office Type</div>
                                <div class="document-detail-value">
                                    <span class="badge-status" id="modal-office-badge">-</span>
                                </div>
                            </div>
                            
                            <div class="document-detail-group">
                                <div class="document-detail-label">Received By</div>
                                <div class="document-detail-value" id="modal-received">-</div>
                            </div>
                            
                            <div class="document-detail-group">
                                <div class="document-detail-label">Date Received</div>
                                <div class="document-detail-value" id="modal-date-received">-</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="document-detail-group">
                        <div class="document-detail-label">Notes</div>
                        <div class="document-detail-value" id="modal-notes" style="min-height: 80px;">-</div>
                    </div>
                    
                    <div class="document-attachments" id="modal-attachments">
                        <div class="document-detail-label">Attachments</div>
                        <div class="attachment-item">
                            <div class="attachment-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <div class="fw-bold" id="modal-attachment-name">Document File</div>
                                <a href="#" class="text-decoration-none" id="modal-attachment-link" target="_blank">Download</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="document-detail-group mt-3">
                        <div class="document-detail-label">Received By</div>
                        <div class="document-detail-value" id="modal-user">-</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
        });
        
        // Document filtering with preserved pagination
        function filterDocuments() {
            const form = document.getElementById('searchForm');
            
            // Update hidden inputs with current filter values
            document.getElementById('typeFilterInput').value = document.getElementById('docTypeFilter').value;
            document.getElementById('officeFilterInput').value = document.getElementById('officeFilter').value;
            document.getElementById('statusFilterInput').value = document.getElementById('statusFilter').value;
            document.getElementById('monthFilterInput').value = document.getElementById('monthFilter').value;
            
            // Submit the form
            form.submit();
        }

        // Initialize filters from URL on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Set initial filter values from URL
            const urlParams = new URLSearchParams(window.location.search);
            
            if (urlParams.has('type')) {
                document.getElementById('docTypeFilter').value = urlParams.get('type');
            }
            
            if (urlParams.has('office')) {
                document.getElementById('officeFilter').value = urlParams.get('office');
            }
            
            if (urlParams.has('status')) {
                document.getElementById('statusFilter').value = urlParams.get('status');
            }
            
            if (urlParams.has('month')) {
                document.getElementById('monthFilter').value = urlParams.get('month');
            }
            
            // Add event listeners for filter changes
            document.getElementById('docTypeFilter').addEventListener('change', filterDocuments);
            document.getElementById('officeFilter').addEventListener('change', filterDocuments);
            document.getElementById('statusFilter').addEventListener('change', filterDocuments);
            document.getElementById('monthFilter').addEventListener('change', filterDocuments);
            
            // Handle search form submission
            document.getElementById('searchForm').addEventListener('submit', function(e) {
                e.preventDefault();
                filterDocuments();
            });
            
            // Initialize modal with document data
            document.getElementById('documentModal').addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const documentData = JSON.parse(button.getAttribute('data-document-data'));
                const modal = this;
                
                // Set basic document info
                modal.querySelector('#documentModalLabel').textContent = documentData.particulars;
                modal.querySelector('#modal-particulars').textContent = documentData.particulars;
                modal.querySelector('#modal-control-num').textContent = documentData.control_num;
                modal.querySelector('#modal-date-time').textContent = documentData.date_time;
                modal.querySelector('#modal-source').textContent = documentData.source;
                modal.querySelector('#modal-received').textContent = documentData.received;
                modal.querySelector('#modal-date-received').textContent = documentData.date_received;
                modal.querySelector('#modal-notes').textContent = documentData.notes;
                modal.querySelector('#modal-user').textContent = documentData.user_name;
                
                // Set status badge
                const statusBadge = modal.querySelector('#modal-status-badge');
                statusBadge.textContent = documentData.status.charAt(0).toUpperCase() + documentData.status.slice(1);
                statusBadge.className = 'badge-status ' + (
                    documentData.status === 'completed' ? 'badge-completed' :
                    documentData.status === 'pending' ? 'badge-pending' : ''
                );
                
                // Set office badge
                const officeBadge = modal.querySelector('#modal-office-badge');
                officeBadge.textContent = documentData.docu_type === 'co' ? 'Central Office' : 'Local';
                officeBadge.className = 'badge-status ' + (documentData.docu_type === 'co' ? 'badge-co' : 'badge-local');
                
                // Set attachment
                const attachmentsDiv = modal.querySelector('#modal-attachments');
                if (documentData.links) {
                    attachmentsDiv.style.display = 'block';
                    
                    // Get file extension and set appropriate icon
                    const fileExt = documentData.links.split('.').pop().toLowerCase();
                    let fileIcon = 'fa-file-alt';
                    if (['pdf'].includes(fileExt)) fileIcon = 'fa-file-pdf';
                    else if (['doc', 'docx'].includes(fileExt)) fileIcon = 'fa-file-word';
                    else if (['xls', 'xlsx'].includes(fileExt)) fileIcon = 'fa-file-excel';
                    else if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) fileIcon = 'fa-file-image';
                    
                    modal.querySelector('.attachment-icon i').className = 'fas ' + fileIcon;
                    modal.querySelector('#modal-attachment-link').href = documentData.links;
                    
                    // Extract filename from URL if possible
                    const filename = documentData.links.split('/').pop();
                    modal.querySelector('#modal-attachment-name').textContent = filename.length < 30 ? 
                        filename : filename.substring(0, 27) + '...';
                } else {
                    attachmentsDiv.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>