@extends('layouts.admin.app')

@section('title', 'Contact Messages')

@section('content')
<div class="content">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contact Messages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Contact Messages</li>
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
                            <h3 class="card-title">All Messages ({{ $messages->total() }})</h3>
                            @if($newCount > 0)
                                <span class="badge badge-danger ml-2">{{ $newCount }} New</span>
                            @endif
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th style="width: 150px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($messages as $message)
                                        <tr class="{{ $message->status === 'new' ? 'table-warning' : '' }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $message->name }}
                                                @if($message->status === 'new')
                                                    <span class="badge badge-danger">New</span>
                                                @endif
                                            </td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ Str::limit($message->subject, 30) }}</td>
                                            <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                @if($message->status === 'new')
                                                    <span class="badge badge-warning">New</span>
                                                @else
                                                    <span class="badge badge-success">Read</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.contacts.show', $message->id) }}" 
                                                   class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <form action="{{ route('admin.contacts.destroy', $message->id) }}" 
                                                      method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No messages found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer clearfix">
                            {{ $messages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection