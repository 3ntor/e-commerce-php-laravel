@extends('layouts.admin.app')
@section('content')
<div class="content">
    <section class="content-header">
        <h1>تعديل بانر</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('layouts.admin.partials.banners.form')
                </div>
            </div>
        </div>
    </section>
</div>
@endsection