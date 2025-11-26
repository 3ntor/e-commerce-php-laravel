@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>تعديل شريحة</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('layouts.admin.partials.sliders.form')
                </div>
            </div>
        </div>
    </section>
</div>
@endsection