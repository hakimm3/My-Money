
<div class="header-area">
    <div class="row align-items-center">
        <!-- nav and search button -->
        <div class="col-md-6 col-sm-8 clearfix">
            <div class="nav-btn pull-left">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <!-- profile info & task notification -->
        <div class="col-md-6 col-sm-4 clearfix">
            <ul class="notification-area pull-right">
                <li id="full-view"><i class="ti-fullscreen"></i></li>
                <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
            </ul>
        </div>
    </div>
</div>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left"> @stack('title-page')</h4>
                <ul class="breadcrumbs pull-left">
                    @stack('breadcrumb')
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right">
                <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ auth()->user()->name }}<i class="fa fa-angle-down"></i></h4>
                <div class="dropdown-menu">
                    <p class="dropdown-item" onclick="logout()">Log Out</p>
                </div>

                <form action="/logout" id="logout-form" hidden method="POST">
                    @csrf
                    {{-- <button class="btn btn-danger">Logout</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function logout() {
        document.getElementById('logout-form').submit();
    }
</script>
