@extends('layouts.admin.app')

@section('content')
<div class="content">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Website Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
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
                            <h3 class="card-title">Edit Website Settings</h3>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row">
                                    <!-- Website Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="website_name">Website Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('website_name') is-invalid @enderror" 
                                                   id="website_name" name="website_name" 
                                                   value="{{ old('website_name', $setting->website_name) }}" required>
                                            @error('website_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Telephone -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telephone">Telephone</label>
                                            <input type="text" class="form-control @error('telephone') is-invalid @enderror" 
                                                   id="telephone" name="telephone" 
                                                   value="{{ old('telephone', $setting->telephone) }}">
                                            @error('telephone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" name="email" 
                                                   value="{{ old('email', $setting->email) }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" 
                                                   id="address" name="address" 
                                                   value="{{ old('address', $setting->address) }}">
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Website Link -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="website_link">Website Link</label>
                                            <input type="url" class="form-control @error('website_link') is-invalid @enderror" 
                                                   id="website_link" name="website_link" 
                                                   value="{{ old('website_link', $setting->website_link) }}" 
                                                   placeholder="https://example.com">
                                            @error('website_link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Facebook Link -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="facebook_link">Facebook Link</label>
                                            <input type="url" class="form-control @error('facebook_link') is-invalid @enderror" 
                                                   id="facebook_link" name="facebook_link" 
                                                   value="{{ old('facebook_link', $setting->facebook_link) }}" 
                                                   placeholder="https://facebook.com/yourpage">
                                            @error('facebook_link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Instagram Link -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="instagram_link">Instagram Link</label>
                                            <input type="url" class="form-control @error('instagram_link') is-invalid @enderror" 
                                                   id="instagram_link" name="instagram_link" 
                                                   value="{{ old('instagram_link', $setting->instagram_link) }}" 
                                                   placeholder="https://instagram.com/yourpage">
                                            @error('instagram_link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Twitter Link -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="twitter_link">Twitter Link</label>
                                            <input type="url" class="form-control @error('twitter_link') is-invalid @enderror" 
                                                   id="twitter_link" name="twitter_link" 
                                                   value="{{ old('twitter_link', $setting->twitter_link) }}" 
                                                   placeholder="https://twitter.com/yourpage">
                                            @error('twitter_link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- YouTube Link -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="youtube_link">YouTube Link</label>
                                            <input type="url" class="form-control @error('youtube_link') is-invalid @enderror" 
                                                   id="youtube_link" name="youtube_link" 
                                                   value="{{ old('youtube_link', $setting->youtube_link) }}" 
                                                   placeholder="https://youtube.com/yourchannel">
                                            @error('youtube_link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                                      id="description" name="description" rows="3">{{ old('description', $setting->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Logo -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="logo">Logo</label>
                                            <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                                   id="logo" name="logo" accept="image/*">
                                            @error('logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            
                                            @if($setting->logo)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $setting->logo) }}" 
                                                         alt="Logo" class="img-thumbnail" style="max-width: 200px;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Save Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection