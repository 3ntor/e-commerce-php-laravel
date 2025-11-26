@extends('layouts.admin.app')
@section('content')
<div class="content">
    <section class="content-header">
        <h1>إضافة خدمة جديدة</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('layouts.admin.partials.services.form')
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
