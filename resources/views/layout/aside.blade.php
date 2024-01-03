<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            {{-- <a href="index.html"><img src="assets/images/icon/logo.png" alt="logo"></a> --}}
            <h2 class="text-white">Welcome</h2>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li><a href="{{ route('home') }}"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>
                    @can('index-pengeluaran')
                        <li class="@if (true)  @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i
                                    class="ti-export"></i><span>Pengeluaran</span></a>
                            <ul class="collapse">
                                <li class=""><a href="{{ route('spending.index') }}">Data Pengeluaran</a></li>
                                <li><a href="{{ route('spending-categories.index') }}">Kategori Pengeluaran</a></li>
                            </ul>
                        </li>
                    @endcan
                    
                    @can('index-pemasukan')
                        <li class="@if (true)  @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i
                                    class="ti-import"></i><span>Pemasukan</span></a>
                            <ul class="collapse">
                                <li class=""><a href="{{ route('income.index') }}">Data Pemasukan</a></li>
                                <li><a href="{{ route('income-categories.index') }}">Kategori Pemasukan</a></li>
                            </ul>
                        </li>
                    @endcan

                    <li class="@if (true)  @endif">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>User
                                Management</span></a>
                        <ul class="collapse">
                            <li class=""><a href="{{ route('user-management.role.index') }}">Roles and
                                    Permission</a></li>
                            <li><a href="{{ route('user-management.user.index') }}">User</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('pricing.index') }}"><i class="ti ti-money"></i><span>Priecing</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
