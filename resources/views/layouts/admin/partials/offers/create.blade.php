@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>إضافة عرض جديد</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('layouts.admin.partials.offers.form')
                </div>
            </div>
        </div>
    </section>
</div>
@endsection