@extends('layouts.master')

{{-- @section('title')
    404   
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection --}}

@section('content')
    <section class="content">
        <div class="error-page">
        <h2 class="headline text-warning"> <span class="fa fa-lock"></span></h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Access Denied.</h3>

            <p>
                You don't have permission to access this page.
                Meanwhile, you may <a href="{{route('dashboard')}}">return to dashboard.</a>
            </p>
        </div>
        <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
@endsection