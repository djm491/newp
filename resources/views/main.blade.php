<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    @include('layout.head')
</head>
<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
</body>

@include('layout.navbar')
@include('layout.sidebar')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>
@include('layout.footer')


</html>