@include('component.admin.layout.head')
<div class="wrapper">
    @include('component.admin.layout.header')
    @include('component.admin.layout.sidebar')
    @yield('content')
    @include('component.admin.layout.footer')
</div>
@include('component.admin.layout.bottom')
