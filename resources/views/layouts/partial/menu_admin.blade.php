<!-- Nav Item -->
<li class="nav-item {{ Nav::isRoute('user.index') }}">
    <a class="nav-link" href="{{ route('user.index') }}">
        <i class="fas fa-id-card"></i>
        <span>{{ __('User') }}</span>
    </a>
</li>

<!-- Nav Item -->
<li class="nav-item {{ Nav::isRoute('member.index') }}">
    <a class="nav-link" href="{{ route('member.index') }}">
        <i class="fas fa-users"></i>
        <span>{{ __('Member') }}</span>
    </a>
</li>

<!-- Nav Item -->
<li class="nav-item {{ Nav::isRoute('paket.index') }}">
    <a class="nav-link" href="{{ route('paket.index') }}">
        <i class="fas fa-shopping-basket"></i>
        <span>{{ __('Paket') }}</span>
    </a>
</li>

<!-- Nav Item -->
<li class="nav-item {{ Nav::isRoute('transaksi.index') }}">
    <a class="nav-link" href="{{ route('transaksi.index') }}">
        <i class="fas fa-coins"></i>
        <span>{{ __('Transaksi') }}</span>
    </a>
</li>