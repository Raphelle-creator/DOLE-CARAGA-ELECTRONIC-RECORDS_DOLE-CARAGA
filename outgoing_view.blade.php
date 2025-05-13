<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Details | DOLE CARAGA Electronic Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --dole-blue: #0056b3;
            --dole-dark-blue: #003366;
            --dole-secondary: #6c757d;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        
        .document-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .document-header {
            background: linear-gradient(135deg, var(--dole-dark-blue) 0%, var(--dole-blue) 100%);
            color: white;
            padding: 15px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .document-header h4 {
            margin: 0;
            font-weight: 600;
        }
        
        .document-body {
            padding: 20px;
        }
        
        .detail-row {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: var(--dole-dark-blue);
            margin-bottom: 5px;
        }
        
        .detail-value {
            color: #495057;
        }
        
        .receipt-card {
            margin-top: 25px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .receipt-header {
            background-color: var(--dole-secondary);
            color: white;
            padding: 12px 20px;
        }
        
        .receipt-body {
            padding: 20px;
        }
        
        .action-buttons {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }
        
        .btn-primary {
            background-color: var(--dole-blue);
            border-color: var(--dole-blue);
        }
        
        .btn-primary:hover {
            background-color: #004494;
            border-color: #004494;
        }
        
        .btn-secondary {
            background-color: var(--dole-secondary);
            border-color: var(--dole-secondary);
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }
        
        .document-link {
            color: var(--dole-blue);
            text-decoration: none;
        }
        
        .document-link:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .detail-row {
                flex-direction: column;
            }
            
            .col-md-6 {
                width: 100%;
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="document-container">
        <div class="document-header">
            <h4><i class="fas fa-file-alt me-2"></i>Document Details</h4>
        </div>
        
        <div class="document-body">
            <div class="row detail-row">
                <div class="col-md-6">
                    <div class="detail-label">Control Number:</div>
                    <div class="detail-value">{{ $document->control_num }}</div>
                </div>
                <div class="col-md-6">
                    <div class="detail-label">Date & Time:</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($document->date_time)->format('M d, Y H:i') }}</div>
                </div>
            </div>

            <div class="row detail-row">
                <div class="col-md-6">
                    <div class="detail-label">Document For:</div>
                    <div class="detail-value">{{ ucfirst($document->docu_for) }}</div>
                </div>
                <div class="col-md-6">
                    <div class="detail-label">Delivery Method(s):</div>
                    <div class="detail-value">{{ $document->delivery }}</div>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Source:</div>
                <div class="detail-value">{{ $document->source }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Particulars:</div>
                <div class="detail-value">{{ $document->particulars }}</div>
            </div>

            @if($document->links)
            <div class="detail-row">
                <div class="detail-label">Document Link:</div>
                <div class="detail-value">
                    <a href="{{ $document->links }}" target="_blank" class="document-link">{{ $document->links }}</a>
                </div>
            </div>
            @endif

            <div class="receipt-card">
                <div class="receipt-header">
                    <h5><i class="fas fa-clipboard-check me-2"></i>Receipt Information</h5>
                </div>
                <div class="receipt-body">
                    <div class="row detail-row">
                        <div class="col-md-6">
                            <div class="detail-label">Received By:</div>
                            <div class="detail-value">{{ $document->received ?? 'Not received yet' }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-label">Date Received:</div>
                            <div class="detail-value">
                                {{ $document->date_received ? \Carbon\Carbon::parse($document->date_received)->format('M d, Y H:i') : 'Not received yet' }}
                            </div>
                        </div>
                    </div>

                    @if($document->notes)
                    <div class="detail-row">
                        <div class="detail-label">Notes:</div>
                        <div class="detail-value">{{ $document->notes }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('outgoing.edit', $document->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Document
                </a>
                <a href="{{ route('outgoing') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>