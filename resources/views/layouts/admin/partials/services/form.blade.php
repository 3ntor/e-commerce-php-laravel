<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ isset($service) ? 'تعديل خدمة' : 'إضافة خدمة جديدة' }}</h3>
    </div>

    <form action="{{ isset($service) ? route('admin.services.update', $service->id) : route('admin.services.store') }}" 
          method="POST">
        @csrf
        @if(isset($service))
            @method('PUT')
        @endif

        <div class="card-body">
            <div class="form-group">
                <label for="title">العنوان <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" 
                       value="{{ old('title', $service->title ?? '') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">الوصف <span class="text-danger">*</span></label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="3" required>{{ old('description', $service->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="icon">الأيقونة <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                       id="icon" name="icon" 
                       placeholder="مثل: fa-sync-alt أو fa-shipping-fast"
                       value="{{ old('icon', $service->icon ?? '') }}" required>
                <small class="form-text text-muted">استخدم أيقونات FontAwesome</small>
                @error('icon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="order">الترتيب</label>
                        <input type="number" class="form-control" 
                               id="order" name="order" 
                               value="{{ old('order', $service->order ?? 0) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="is_active" name="is_active" value="1" 
                                   {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
                            مفعل
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ isset($service) ? 'تحديث' : 'إضافة' }}
            </button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">إلغاء</a>
        </div>
    </form>
</div>