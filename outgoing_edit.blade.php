@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Edit Document</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('outgoing.update', $document->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="control_num" class="form-label">Control Number</label>
                                <input type="text" class="form-control" id="control_num" name="control_num" 
                                       value="{{ old('control_num', $document->control_num) }}">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="date_time" class="form-label">Date & Time</label>
                                <input type="datetime-local" class="form-control" id="date_time" name="date_time" 
                                       value="{{ old('date_time', str_replace(' ', 'T', $document->date_time)) }}">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="docu_for" class="form-label">Document For</label>
                                <select class="form-select" id="docu_for" name="docu_for">
                                    <option value="external" {{ old('docu_for', $document->docu_for) == 'external' ? 'selected' : '' }}>External Document</option>
                                    <option value="internal" {{ old('docu_for', $document->docu_for) == 'internal' ? 'selected' : '' }}>Internal Document</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Delivery Method(s)</label>
                                <div class="delivery-methods">
                                    @php
                                        $deliveryMethods = $document->delivery ? explode(', ', $document->delivery) : [];
                                    @endphp
                                    
                                    @foreach(['Personal Delivery', 'Courier', 'Email'] as $method)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="delivery_methods[]" 
                                               id="delivery{{ str_replace(' ', '', $method) }}" 
                                               value="{{ $method }}"
                                               {{ in_array($method, $deliveryMethods) ? 'checked' : '' }}>
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
                            <input type="text" class="form-control" id="source" name="source" 
                                   value="{{ old('source', $document->source) }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="particulars" class="form-label">Particulars</label>
                            <textarea class="form-control" id="particulars" name="particulars" rows="3">{{ old('particulars', $document->particulars) }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="links" class="form-label">Document Link (URL)</label>
                            <input type="url" class="form-control" id="links" name="links" 
                                   value="{{ old('links', $document->links) }}" placeholder="https://example.com">
                        </div>
                        
                        <div class="card mt-4">
                            <div class="card-header bg-secondary text-white">
                                <h5>Receipt Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="received" class="form-label">Received By</label>
                                        <input type="text" class="form-control" id="received" name="received" 
                                               value="{{ old('received', $document->received) }}">
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="date_received" class="form-label">Date Received</label>
                                        <input type="datetime-local" class="form-control" id="date_received" name="date_received" 
                                               value="{{ old('date_received', $document->date_received ? str_replace(' ', 'T', $document->date_received) : '') }}">
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="2">{{ old('notes', $document->notes) }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Document
                            </button>
                            <a href="{{ route('outgoing.view', $document->id) }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection