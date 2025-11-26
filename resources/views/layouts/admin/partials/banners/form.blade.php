<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ isset($banner) ? 'تعديل بانر' : 'إضافة بانر جديد' }}</h3>
    </div>

    <form action="{{ isset($banner) ? route('admin.banners.update', $banner->id) : route('admin.banners.store') }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @if(isset($banner))
            @method('PUT')
        @endif

        <div class="card-body">
            <div class="form-group">
                <label for="title">العنوان <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" 
                       value="{{ old('title', $banner->title ?? '') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">الصورة <span class="text-danger">*</span></label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                       id="image" name="image" accept="image/*" {{ !isset($banner) ? 'required' : '' }}>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                @if(isset($banner) && $banner->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $banner->image) }}" 
                             alt="{{ $banner->title }}" 
                             class="img-thumbnail" 
                             style="max-width: 200px;">
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="offer_text">نص العرض (مثل: Save $48.00)</label>
                        <input type="text" class="form-control" 
                               id="offer_text" name="offer_text" 
                               value="{{ old('offer_text', $banner->offer_text ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="offer_label">تسمية العرض (مثل: Special Offer)</label>
                        <input type="text" class="form-control" 
                               id="offer_label" name="offer_label" 
                               value="{{ old('offer_label', $banner->offer_label ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="product_name">اسم المنتج</label>
                <input type="text" class="form-control" 
                       id="product_name" name="product_name" 
                       value="{{ old('product_name', $banner->product_name ?? '') }}">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="old_price">السعر القديم</label>
                        <input type="number" class="form-control" step="0.01"
                               id="old_price" name="old_price" 
                               value="{{ old('old_price', $banner->old_price ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="new_price">السعر الجديد</label>
                        <input type="number" class="form-control" step="0.01"
                               id="new_price" name="new_price" 
                               value="{{ old('new_price', $banner->new_price ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="button_text">نص الزر</label>
                        <input type="text" class="form-control" 
                               id="button_text" name="button_text" 
                               value="{{ old('button_text', $banner->button_text ?? 'Add To Cart') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="button_link">رابط الزر</label>
                        <input type="url" class="form-control" 
                               id="button_link" name="button_link" 
                               value="{{ old('button_link', $banner->button_link ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="order">الترتيب</label>
                        <input type="number" class="form-control" 
                               id="order" name="order" 
                               value="{{ old('order', $banner->order ?? 0) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="is_active" name="is_active" value="1" 
                                   {{ old('is_active', $banner->is_active ?? true) ? 'checked' : '' }}>
                            مفعل
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ isset($banner) ? 'تحديث' : 'إضافة' }}
            </button>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">إلغاء</a>
        </div>
    </form>
</div>