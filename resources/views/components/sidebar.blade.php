<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">
                <img class="d-inline-block" width="32px" height="30.61px" src="" alt="">
            </a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="">
                <a class="nav-link" href=""><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Managemen Kas</li>
            @php($productTypes = \App\Models\ProductType::get())
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Laporan kas</span></a>
                <ul class="dropdown-menu">
                    @foreach($productTypes as $productType)
                        <li><a class="nav-link"
                               href="{{route('admin.cash-note.index',$productType->id)}}">{{ $productType->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Buku kas</span></a>
                <ul class="dropdown-menu">
                    @foreach($productTypes as $productType)
                        <li><a class="nav-link"
                               href="{{route('admin.cash-book.index',$productType->id)}}">{{ $productType->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="menu-header">Managemen Produk</li>
            <li class="">
                <a class="nav-link" href="{{route('admin.product-type.index')}}">
                    <i class="fas fa-fire"></i><span>UMKM</span>
                </a>
            </li>
            <li class="">
                <a class="nav-link" href="{{route('admin.product.index')}}">
                    <i class="fas fa-fire"></i><span>Produk</span>
                </a>
            </li>
            {{--            <li class="">--}}
            {{--                <a class="nav-link" href=""><i class="fas fa-fire"></i><span>HPP Proyeksi</span></a>--}}
            {{--            </li>--}}
            <li class="menu-header">Transaksi</li>
            <li class="">
                <a class="nav-link" href="{{route('admin.transaction.create')}}"><i class="fas fa-fire"></i><span>Buat transaksi</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="{{route('admin.transaction.history')}}"><i class="fas fa-fire"></i><span>Riwayat transaksi</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="{{route('admin.transaction.active')}}"><i class="fas fa-fire"></i><span>Transaksi aktif</span></a>
            </li>
        </ul>
    </aside>
</div>
