<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outgoing Documents | DOLE CARAGA Electronic Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --dole-blue: #0056b3;
            --dole-yellow: #ffc107;
            --dole-red: #dc3545;
            --dole-dark-blue: #003366;
            --sidebar-width: 250px;
            --outgoing-highlight: #e6f7ee;
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

        
        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        /* Top Navigation */
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
        
        /* Dashboard Content */
        .dashboard-content {
            padding: 2rem;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
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
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card .stat-title {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }
        
        .stat-card .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dole-dark-blue);
            margin-bottom: 0.5rem;
        }
        
        .stat-card .stat-change {
            display: flex;
            align-items: center;
            font-size: 0.85rem;
        }
        
        .stat-card .stat-change.up {
            color: #28a745;
        }
        
        .stat-card .stat-change.down {
            color: #dc3545;
        }
        
        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }
        
        .stat-card .stat-icon.outgoing {
            background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
        }
        
        .stat-card .stat-icon.acknowledged {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        .stat-card .stat-icon.pending {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        /* Outgoing Documents Section */
        .outgoing-section {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            overflow: hidden;
        }
        
        .section-header {
            background-color: var(--outgoing-highlight);
            padding: 1.25rem 1.5rem;
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
            padding: 1.5rem;
        }
        
        .filter-controls {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        
        .filter-group {
            display: flex;
            align-items: center;
        }
        
        .filter-label {
            margin-right: 0.5rem;
            font-weight: 500;
            white-space: nowrap;
        }
        
        .document-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .document-item {
            padding: 1.25rem;
            border-bottom: 1px solid #e9ecef;
            transition: background-color 0.2s;
            display: flex;
            align-items: flex-start;
            position: relative;
            padding-left: 15px;
        }
        
        .document-item:last-child {
            border-bottom: none;
        }
        
        .document-item:hover {
            background-color: #f8f9fa;
        }
        
        .document-priority {
            width: 8px;
            height: 100%;
            border-radius: 4px 0 0 4px;
            position: absolute;
            left: 0;
            top: 0;
        }
        
        .priority-high {
            background-color: #dc3545;
        }
        
        .priority-medium {
            background-color: #fd7e14;
        }
        
        .priority-low {
            background-color: #28a745;
        }
        
        .document-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: rgba(0, 86, 179, 0.1);
            color: var(--dole-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            margin-right: 1rem;
            flex-shrink: 0;
        }
        
        .document-details {
            flex-grow: 1;
        }
        
        .document-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        
        .document-title .badge {
            font-size: 0.65rem;
            padding: 0.25rem 0.5rem;
        }
        
        .document-meta {
            font-size: 0.85rem;
            color: #6c757d;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .document-meta-item {
            display: flex;
            align-items: center;
        }
        
        .document-meta-item i {
            margin-right: 0.3rem;
            font-size: 0.9rem;
        }
        
        .document-actions {
            display: flex;
            gap: 0.5rem;
            margin-left: 1rem;
        }
        
        .badge-sent {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        
        .badge-acknowledged {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-regional {
            background-color: #cce5ff;
            color: #004085;
        }
        
        .badge-central {
            background-color: #e2e3e5;
            color: #383d41;
        }
        
        .badge-local {
            background-color: #e2f9f0;
            color: #006341;
        }
        
        .badge-co {
            background-color: #f0e6ff;
            color: #5a2d9a;
        }
        
        /* Modal Form Styles */
        .modal-header {
            background: linear-gradient(135deg, var(--dole-dark-blue) 0%, var(--dole-blue) 100%);
            color: white;
        }
        
        .modal-header .btn-close {
            filter: invert(1);
        }
        
        .form-section {
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            border: 1px solid #e9ecef;
            border-radius: 8px;
        }
        
        .section-title {
            color: var(--dole-dark-blue);
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--dole-blue);
            box-shadow: 0 0 0 0.25rem rgba(0, 86, 179, 0.25);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dole-dark-blue);
        }
        
        .btn-primary {
            background-color: var(--dole-blue);
            border-color: var(--dole-blue);
        }
        
        .btn-primary:hover {
            background-color: #004494;
            border-color: #004494;
        }
        
        .input-group-text {
            background-color: #f8f9fa;
        }
        
        .form-check-input:checked {
            background-color: var(--dole-blue);
            border-color: var(--dole-blue);
        }
        
        /* Date time picker styling */
        .datetime-picker {
            position: relative;
        }
        
        .datetime-picker .form-control {
            padding-right: 2.5rem;
        }
        
        .datetime-picker .input-group-text {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            z-index: 5;
            border: none;
            background: transparent;
        }

        .pagination {
            display: flex;
            gap: 0.25rem;
        }

        .page-item {
            display: flex;
        }

        .page-link {
            padding: 0.375rem 0.75rem;
            border: 1px solid #dee2e6;
            color: var(--dole-blue);
            text-decoration: none;
            transition: all 0.2s;
        }

        .page-link:hover {
            background-color: #f8f9fa;
        }

        .page-item.active .page-link {
            background-color: var(--dole-blue);
            border-color: var(--dole-blue);
            color: white;
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            background-color: #fff;
            border-color: #dee2e6;
        }

        .delivery-methods {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 0.75rem;
        }

        .delivery-methods .form-check {
            margin-bottom: 0.5rem;
        }

        .delivery-methods .form-check:last-child {
            margin-bottom: 0;
        }

        .delivery-methods .form-check-label {
            display: flex;
            align-items: center;
        }

        .delivery-methods .form-check-input {
            margin-top: 0;
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
            
            .topbar-menu {
                margin-left: 0;
            }
        }
        
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .page-actions {
                margin-top: 1rem;
                width: 100%;
            }
            
            .stats-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
            
            .filter-controls {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .document-item {
                flex-direction: column;
            }
            
            .document-actions {
                margin-left: 0;
                margin-top: 1rem;
                justify-content: flex-end;
            }
            
            .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('storage/images/logo.png') }}" alt="DOLE CARAGA Logo">
            <h4>E-Records</h4>
        </div>
        
        <div class="sidebar-menu">
            <div class="sidebar-item">
                <a href="/dashboard" class="sidebar-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </div>
        
            <div class="sidebar-item">
                <a href="/outgoing" class="sidebar-link active">
                    <i class="fas fa-paper-plane"></i>
                    <span>Outgoing</span>
                </a>
            </div>
            
            <div class="sidebar-item has-dropdown">
                <a href="{{ route('documents.index') }}" class="sidebar-link">
                    <i class="fas fa-folder"></i>
                    <span>All Documents</span>
                </a>
            </div>
            
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
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="dashboard-content">
            <div class="page-header">
                <div class="page-title">
                    <h1>Outgoing Documents</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Outgoing Documents</li>
                        </ol>
                    </nav>
                </div>
                
                <div class="page-actions">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createLocalOutgoingModal">
                        <i class="fas fa-plus me-2"></i> New Document (LOCAL)
                    </button>
                    <button class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#createCoOutgoingModal">
                        <i class="fas fa-plus me-2"></i> New Document (CO)
                    </button>
                </div>
            </div>
            
            <!-- Stats Cards Section -->
            <div class="stats-grid" style="grid-template-columns: repeat(3, 1fr);">
                <div class="stat-card">
                    <div class="stat-icon outgoing">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <h3 class="stat-value">{{ $stats['total'] }}</h3>
                    <p class="stat-title">Total Sent</p>
                    <div class="stat-change up">
                        <i class="fas fa-arrow-up me-1"></i> {{ $stats['total'] }} total
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon acknowledged">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <h3 class="stat-value">{{ $stats['acknowledged'] }}</h3>
                    <p class="stat-title">Completed</p>
                    <div class="stat-change up">
                        <i class="fas fa-arrow-up me-1"></i> 
                        {{ $stats['total'] > 0 ? round(($stats['acknowledged']/$stats['total'])*100) : 0 }}% rate
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon pending">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="stat-value">{{ $stats['pending'] }}</h3>
                    <p class="stat-title">Pending Response</p>
                    <div class="stat-change down">
                        <i class="fas fa-arrow-down me-1"></i> 
                        {{ $stats['pending'] }} waiting
                    </div>
                </div>
            </div>

            <!-- Documents List Section -->
            <div class="outgoing-section">
                <div class="section-header">
                    <h5>Recent Outgoing Documents</h5>
                    <div>
                        <span class="badge bg-primary">{{ $stats['pending'] }} Pending Response</span>
                    </div>
                </div>
                
                <div class="section-body">
                    @if(request()->hasAny(['search', 'status', 'source', 'month']))
                    <div class="alert alert-info alert-dismissible fade show mb-3" role="alert">
                        Showing filtered results
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="filter-controls">
                        <div class="filter-group">
                            <span class="filter-label">Filter by:</span>
                            <select class="form-select form-select-sm" id="statusFilter" style="width: 150px;">
                                <option value="all" selected>All Documents</option>
                                <option value="pending">Pending Response</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <span class="filter-label">Document Type:</span>
                            <select class="form-select form-select-sm" id="docTypeFilter" style="width: 150px;">
                                <option value="all" selected>All Types</option>
                                <option value="local">Local</option>
                                <option value="co">Central Office</option>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <span class="filter-label">Month:</span>
                            <select class="form-select form-select-sm" id="monthFilter" style="width: 150px;">
                                <option value="all" selected>All Months</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        
                        <div class="filter-group ms-auto">
                            <form id="searchForm" method="GET" action="{{ route('outgoing') }}">
                                <input type="hidden" name="status" value="{{ request('status', 'all') }}">
                                <input type="hidden" name="doc_type" value="{{ request('doc_type', 'all') }}">
                                <input type="hidden" name="month" value="{{ request('month', 'all') }}">
                                <div class="input-group">
                                    <input type="text" 
                                           class="form-control form-control-sm" 
                                           id="searchInput" 
                                           name="search"
                                           placeholder="Search documents..." 
                                           value="{{ request('search') }}"
                                           style="width: 200px;">
                                    <button class="btn btn-outline-secondary btn-sm" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    @if($documents->isEmpty())
                    <div class="alert alert-info">
                        No documents found matching your criteria.
                    </div>
                    @else

                    <ul class="document-list" id="documentsList">
                        @foreach($documents as $document)
                        <li class="document-item" data-status="{{ $document->status }}" data-doc-type="{{ $document->docu_type ?? 'local'  }}" data-month="{{ \Carbon\Carbon::parse($document->date_time)->format('n') }}">
                            <div class="document-priority priority-{{ $document->priority ?? 'medium' }}"></div>
                            <div class="document-icon">
                                @php
                                    $fileType = strtolower(pathinfo($document->links, PATHINFO_EXTENSION));
                                    $icon = 'fa-file-alt';
                                    if(in_array($fileType, ['pdf'])) $icon = 'fa-file-pdf';
                                    elseif(in_array($fileType, ['doc', 'docx'])) $icon = 'fa-file-word';
                                    elseif(in_array($fileType, ['xls', 'xlsx'])) $icon = 'fa-file-excel';
                                @endphp
                                <i class="fas {{ $icon }}"></i>
                            </div>
                            <div class="document-details">
                                <div class="document-title">
                                    {{ $document->particulars ?: 'No title' }}
                                    <span class="badge 
                                        @if($document->status === 'completed') badge-acknowledged
                                        @elseif($document->status === 'pending') badge-sent
                                        @else badge-followup @endif">
                                        {{ ucfirst($document->status) }}
                                    </span>
                                    <span class="badge @if($document->docu_type === 'co') badge-co @else badge-local @endif">
                                        {{ $document->docu_type === 'co' ? 'Central Office' : 'Local' }}
                                    </span>
                                </div>
                                <div class="document-meta">
                                    <span class="document-meta-item">
                                        <i class="fas fa-hashtag"></i> {{ $document->control_num }}
                                    </span>
                                    <span class="document-meta-item">
                                        <i class="fas fa-calendar-alt"></i> 
                                        {{ \Carbon\Carbon::parse($document->date_time)->format('M d, Y H:i') }}
                                    </span>
                                    @if($document->received)
                                    <span class="document-meta-item">
                                        <i class="fas fa-user-check"></i> Received by: {{ $document->received }}
                                    </span>
                                    @endif
                                    @if($document->date_received)
                                    <span class="document-meta-item">
                                        <i class="fas fa-calendar-check"></i> 
                                        Received on: {{ \Carbon\Carbon::parse($document->date_received)->format('M d, Y H:i') }}
                                    </span>
                                    @endif
                                    @if($document->notes)
                                    <span class="document-meta-item">
                                        <i class="fas fa-sticky-note"></i> 
                                        {{ Str::limit($document->notes, 30) }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="document-actions">
                                <a href="{{ route('outgoing.view', $document->id) }}" class="btn btn-sm btn-outline-primary" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            Showing {{ $documents->firstItem() }} to {{ $documents->lastItem() }} of {{ $documents->total() }} documents
                        </div>
                        <nav>
                            <ul class="pagination pagination-sm mb-0">
                                @if ($documents->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $documents->appends(request()->query())->previousPageUrl() }}" rel="prev">&laquo;</a>
                                    </li>
                                @endif
                        
                                @foreach ($documents->getUrlRange(1, $documents->lastPage()) as $page => $url)
                                    @if ($page == $documents->currentPage())
                                        <li class="page-item active" aria-current="page">
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
                                    <li class="page-item disabled" aria-disabled="true">
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

    <!-- Create Local Outgoing Document Modal -->
    <div class="modal fade" id="createLocalOutgoingModal" tabindex="-1" aria-labelledby="createOutgoingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createOutgoingModalLabel">
                        <i class="fas fa-file-alt me-2"></i>New Local Outgoing Document
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('outgoing.local_store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-section">
                            <h5 class="section-title"><i class="fas fa-info-circle"></i>Document Information</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="control_num" class="form-label">Control Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        <input type="text" class="form-control" id="control_num" name="control_num">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="date_time" class="form-label">Date & Time</label>
                                    <div class="input-group datetime-picker">
                                        <input type="datetime-local" class="form-control" id="date_time" name="date_time">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="docu_for" class="form-label">Document For</label>
                                    <select class="form-select" id="docu_for" name="docu_for">
                                        <option value="external">External Document</option>
                                        <option value="internal">Internal Document</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="delivery" class="form-label">Delivery Method(s)</label>
                                    <div class="delivery-methods">
                                        @foreach(['Personal Delivery', 'Courier', 'Email'] as $method)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="delivery_methods[]" 
                                                   id="delivery{{ str_replace(' ', '', $method) }}" 
                                                   value="{{ $method }}">
                                            <label class="form-check-label" for="delivery{{ str_replace(' ', '', $method) }}">
                                                <i class="fas 
                                                    @if($method == 'Personal Delivery') fa-user 
                                                    @elseif($method == 'Courier') fa-truck 
                                                    @elseif($method == 'Email') fa-envelope @endif me-1"></i> 
                                                {{ $method }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('delivery_methods')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="source" class="form-label">Source</label>
                                <input type="text" class="form-control" id="source" name="source">
                            </div>
                            
                            <div class="mb-3">
                                <label for="particulars" class="form-label">Particulars</label>
                                <textarea class="form-control" id="particulars" name="particulars" rows="3"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="links" class="form-label">Document Link (URL)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    <input type="url" class="form-control" id="links" name="links" placeholder="https://example.com">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h5 class="section-title"><i class="fas fa-clipboard-check"></i>Receipt Information</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="received" class="form-label">Received By</label>
                                    <input type="text" class="form-control" id="received" name="received">
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="date_received" class="form-label">Date Received</label>
                                    <div class="input-group datetime-picker">
                                        <input type="datetime-local" class="form-control" id="date_received" name="date_received">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes (Optional)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Document
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create CO Outgoing Document Modal -->
    <div class="modal fade" id="createCoOutgoingModal" tabindex="-1" aria-labelledby="createOutgoingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createOutgoingModalLabel">
                        <i class="fas fa-file-alt me-2"></i>New Central Office Outgoing Document
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('outgoing.co_store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-section">
                            <h5 class="section-title"><i class="fas fa-info-circle"></i>Document Information</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="control_num" class="form-label">Control Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        <input type="text" class="form-control" id="control_num" name="control_num">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="date_time" class="form-label">Date & Time</label>
                                    <div class="input-group datetime-picker">
                                        <input type="datetime-local" class="form-control" id="date_time" name="date_time">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="docu_for" class="form-label">Document For</label>
                                    <select class="form-select" id="docu_for" name="docu_for">
                                        <option value="external">External Document</option>
                                        <option value="internal">Internal Document</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="delivery" class="form-label">Delivery Method(s)</label>
                                    <div class="delivery-methods">
                                        @foreach(['Personal Delivery', 'Courier', 'Email'] as $method)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="delivery_methods[]" 
                                                   id="delivery{{ str_replace(' ', '', $method) }}" 
                                                   value="{{ $method }}">
                                            <label class="form-check-label" for="delivery{{ str_replace(' ', '', $method) }}">
                                                <i class="fas 
                                                    @if($method == 'Personal Delivery') fa-user 
                                                    @elseif($method == 'Courier') fa-truck 
                                                    @elseif($method == 'Email') fa-envelope @endif me-1"></i> 
                                                {{ $method }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('delivery_methods')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="source" class="form-label">Source</label>
                                <input type="text" class="form-control" id="source" name="source">
                            </div>
                            
                            <div class="mb-3">
                                <label for="particulars" class="form-label">Particulars</label>
                                <textarea class="form-control" id="particulars" name="particulars" rows="3"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="links" class="form-label">Document Link (URL)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    <input type="url" class="form-control" id="links" name="links" placeholder="https://example.com">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h5 class="section-title"><i class="fas fa-clipboard-check"></i>Receipt Information</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="received" class="form-label">Received By</label>
                                    <input type="text" class="form-control" id="received" name="received">
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="date_received" class="form-label">Date Received</label>
                                    <div class="input-group datetime-picker">
                                        <input type="datetime-local" class="form-control" id="date_received" name="date_received">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes (Optional)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Document
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
          const params = new URLSearchParams(window.location.search);
          let newDocModal;
          
          if (params.get('new_local') == '1') {
              newDocModal = new bootstrap.Modal(document.getElementById('createLocalOutgoingModal'));
          } else if (params.get('new_co') == '1') {
              newDocModal = new bootstrap.Modal(document.getElementById('createCoOutgoingModal'));
          }

          newDocModal.show();
        })

        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
        });

        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            const timezoneOffset = now.getTimezoneOffset() * 60000;
            const localISOTime = (new Date(now - timezoneOffset)).toISOString().slice(0, 16);
            
            document.getElementById('date_time').value = localISOTime;
        });
        
        // Toggle dropdown menus in sidebar
        document.querySelectorAll('.sidebar-link').forEach(link => {
            if (link.nextElementSibling && link.nextElementSibling.classList.contains('sidebar-dropdown')) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const dropdown = this.nextElementSibling;
                    dropdown.classList.toggle('show');
                    
                    const icon = this.querySelector('.fa-angle-down');
                    if (icon) {
                        icon.classList.toggle('fa-rotate-180');
                    }
                });
            }
        });
        
        // Document filtering
        document.getElementById('statusFilter')?.addEventListener('change', function() {
            filterDocuments();
        });

        document.getElementById('docTypeFilter')?.addEventListener('change', function() {
            filterDocuments();
        });

        document.getElementById('monthFilter')?.addEventListener('change', function() {
            filterDocuments();
        });

        function filterDocuments() {
            const status = document.getElementById('statusFilter').value;
            const docType = document.getElementById('docTypeFilter').value;
            const month = document.getElementById('monthFilter').value;
            
            // Get current pagination page
            const url = new URL(window.location.href);
            const currentPage = url.searchParams.get('page') || 1;
            
            // Build new URL with filters
            let newUrl = '/outgoing?';
            if (status !== 'all') newUrl += `status=${status}&`;
            if (docType !== 'all') newUrl += `doc_type=${docType}&`;
            if (month !== 'all') newUrl += `month=${month}&`;
            newUrl += `page=${currentPage}`;
            
            window.location.href = newUrl;
        }

        function getMonthName(monthNumber) {
            const months = [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ];
            return months[parseInt(monthNumber) - 1];
        }

        // Search functionality
        // Replace the current search functionality with this:
        document.getElementById('searchForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const params = new URLSearchParams(formData);
            window.location.href = `${this.action}?${params.toString()}`;
        });

        // Update filterDocuments function to include search term
        function filterDocuments() {
            const form = document.getElementById('searchForm');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);
            
            // Update the form data with current filter values
            formData.set('status', document.getElementById('statusFilter').value);
            formData.set('doc_type', document.getElementById('docTypeFilter').value);
            formData.set('month', document.getElementById('monthFilter').value);
            
            window.location.href = `${form.action}?${new URLSearchParams(formData).toString()}`;
        }

        // Set initial filter values from URL
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            
            if (urlParams.has('status')) {
                document.getElementById('statusFilter').value = urlParams.get('status');
            }
            
            if (urlParams.has('doc_type')) {
                document.getElementById('docTypeFilter').value = urlParams.get('doc_type');
            }
            
            if (urlParams.has('month')) {
                document.getElementById('monthFilter').value = urlParams.get('month');
            }
        });
    </script>
</body>
</html>