<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        {{-- Anything you want --}}
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ date('Y') }} <a style="color: #007bff"
            href="{{ auth()->user()->role == 1 ? route('admin.dashboard') : route('user.dashboard') }}">{{ config('app.name') }}</a>.</strong>
    All rights
    reserved.
</footer>
