<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin Panel')</title>

  {{-- Head layout --}}
  @include('layouts.admin.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  {{-- Navbar --}}
  @include('layouts.admin.navbar')

  {{-- Main Sidebar Container --}}
  @include('layouts.admin.sidebar')

  {{-- Content Wrapper. Contains page content --}}
  <div class="content-wrapper">
    {{-- Page header (اختياري) --}}
    <div class="content-header">
      <div class="container-fluid">
        @yield('page-header')
      </div>
    </div>

    {{-- Main content --}}
    <section class="content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </section>
  </div>
  {{-- /.content-wrapper --}}

  {{-- Footer --}}
  @include('layouts.admin.footer')

</div>
{{-- ./wrapper --}}

{{-- Scripts --}}
@include('layouts.admin.scripts')
</body>
</html>
