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
        
        .badge-notification {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            background: var(--dole-red);
            color: white;
            border-radius: 50%;
            font-size: 0.6rem;
            display: flex;
            align-items: center;
            justify-content: center;
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
        
        .stat-card .stat-icon.followup {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
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
        }
        
        .document-title .badge {
            margin-left: 0.5rem;
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
        
        .badge-followup {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-regional {
            background-color: #cce5ff;
            color: #004085;
        }
        
        .badge-central {
            background-color: #e2e3e5;
            color: #383d41;
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
                grid-template-columns: 1fr;
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
        }

        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 2rem auto;
            max-width: 900px;
        }
        
        .form-header {
            background: linear-gradient(135deg, var(--dole-dark-blue) 0%, var(--dole-blue) 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        
        .form-header h2 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .form-section {
            margin-bottom: 2rem;
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
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-container {
                padding: 1.5rem;
                margin: 1rem;
            }
            
            .form-section {
                padding: 1rem;
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
            
            <div class="sidebar-item">
                <a href="#" class="sidebar-link dropdown-toggle">
                    <i class="fas fa-folder"></i>
                    <span>Documents</span>
                    <i class="fas fa-angle-down ms-auto"></i>
                </a>
                <div class="sidebar-dropdown">
                    <a href="{{ route('documents.index') }}" class="sidebar-link @if(request()->routeIs('documents.index') && request('type') === 'all') active @endif">All Documents</a>
                    <a href="#" class="sidebar-link">Upload New</a>
                    <a href="#" class="sidebar-link">My Documents</a>
                    <a href="#" class="sidebar-link">Shared With Me</a>
                </div>
            </div>
            
            {{-- <div class="sidebar-item">
                <a href="#" class="sidebar-link dropdown-toggle">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Workflows</span>
                    <i class="fas fa-angle-down ms-auto"></i>
                </a>
                <div class="sidebar-dropdown">
                    <a href="#" class="sidebar-link">Pending Approval</a>
                    <a href="#" class="sidebar-link">Approved</a>
                    <a href="#" class="sidebar-link">Rejected</a>
                    <a href="#" class="sidebar-link">Completed</a>
                </div>
            </div> --}}
            
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
                    <a href="#" class="topbar-link">
                        <i class="fas fa-bell"></i>
                        <span class="badge-notification">3</span>
                    </a>
                </div>
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
        
        <div class="dashboard-content">
            <div class="page-header">
                <div class="page-title">
                    <h1>New Outgoing Documents</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Outgoing Documents</li>
                            <li class="breadcrumb-item active" aria-current="page">New</li>
                        </ol>
                    </nav>
                </div>
                
                <div class="page-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i> New Document
                    </button>
                    <button class="btn btn-outline-secondary ms-2">
                        <i class="fas fa-download me-2"></i> Export
                    </button>
                </div>
            </div>
            
            <div class="form-section">
                <div class="form-container">
                    <div class="form-header">
                        <h2><i class="fas fa-file-alt me-2"></i>Document Entry</h2>
                        <p>Please fill out all required fields for document tracking</p>
                    </div>
                    
                    <form id="documentTrackingForm">
                        @csrf
                        
                        <div class="form-section">
                            <h5 class="section-title"><i class="fas fa-info-circle"></i>Document Information</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="controlNumber" class="form-label">Control Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        <input type="text" class="form-control" id="controlNumber" name="control_number" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="dateTimeReceived" class="form-label">Date & Time Received</label>
                                    <div class="input-group datetime-picker">
                                        <input type="datetime-local" class="form-control" id="dateTimeReceived" name="date_time_received" required>
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="external" name="external">
                                        <label class="form-check-label" for="external">External Document</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="modeOfDelivery" class="form-label">Mode of Delivery</label>
                                    <select class="form-select" id="modeOfDelivery" name="mode_of_delivery" required>
                                        <option value="" selected disabled>Select mode</option>
                                        <option value="pd">Personal Delivery (PD)</option>
                                        <option value="jrs">JRS Courier</option>
                                        <option value="email">Email</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="sourceOfDocument" class="form-label">Source of Document</label>
                                <input type="text" class="form-control" id="sourceOfDocument" name="source_of_document" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="particulars" class="form-label">Particulars</label>
                                <textarea class="form-control" id="particulars" name="particulars" rows="3" required></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="particularsLink" class="form-label">Particulars Link (URL)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    <input type="url" class="form-control" id="particularsLink" name="particulars_link" placeholder="https://example.com">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h5 class="section-title"><i class="fas fa-clipboard-check"></i>Receipt Information</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="copiesReceivedBy" class="form-label">Copies Received By</label>
                                    <input type="text" class="form-control" id="copiesReceivedBy" name="copies_received_by" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="dateTimeReceivedBy" class="form-label">Date & Time Received By</label>
                                    <div class="input-group datetime-picker">
                                        <input type="datetime-local" class="form-control" id="dateTimeReceivedBy" name="date_time_received_by" required>
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="button" class="btn btn-outline-secondary me-md-2">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
        });
        
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
        
        document.querySelectorAll('.document-item').forEach(item => {
            item.addEventListener('click', function(e) {
                if (!e.target.closest('.document-actions')) {
                    console.log('View document:', this.querySelector('.document-title').textContent.trim());
                }
            });
        });
        
        document.querySelectorAll('.btn-outline-warning').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                alert('Follow-up request sent for this document');
            });
        });
        
        document.querySelectorAll('.btn-outline-success').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const item = this.closest('.document-item');
                item.querySelector('.badge-followup, .badge-sent').classList.replace('badge-followup', 'badge-acknowledged');
                item.querySelector('.badge-followup, .badge-sent').textContent = 'Acknowledged';
                this.classList.replace('btn-outline-success', 'btn-outline-info');
                this.innerHTML = '<i class="fas fa-receipt"></i>';
                this.title = 'View Acknowledgement';
                alert('Document marked as acknowledged');
            });
        });
    </script>
</body>
</html>