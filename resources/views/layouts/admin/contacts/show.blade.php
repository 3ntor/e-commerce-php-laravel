@extends('layouts.admin.app')

@section('title', 'Message Details')

@section('content')
<div class="content">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Message Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Messages</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Message from {{ $message->name }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-arrow-left"></i> Back to Messages
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Name:</strong></label>
                                        <p>{{ $message->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Email:</strong></label>
                                        <p><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Phone:</strong></label>
                                        <p>{{ $message->phone ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Project:</strong></label>
                                        <p>{{ $message->project ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Date:</strong></label>
                                        <p>{{ $message->created_at->format('Y-m-d H:i:s') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Status:</strong></label>
                                        <p>
                                            @if($message->status === 'new')
                                                <span class="badge badge-warning">New</span>
                                            @else
                                                <span class="badge badge-success">Read</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label><strong>Subject:</strong></label>
                                <p>{{ $message->subject }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>Message:</strong></label>
                                <div class="well p-3 bg-light rounded">
                                    <p style="white-space: pre-wrap;">{{ $message->message }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <form action="{{ route('admin.contacts.destroy', $message->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this message?')">
                                    <i class="fas fa-trash"></i> Delete Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection