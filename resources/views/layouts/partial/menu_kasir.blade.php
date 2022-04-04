<!-- Nav Item -->
<li class="nav-item {{ Nav::isRoute('member.index') }}">
    <a class="nav-link" href="{{ route('member.index') }}">
        <i class="fas fa-users"></i>
        <span>{{ __('Member') }}</span>
    </a>
</li>

<!-- Nav Item -->
<li class="nav-item {{ Nav::isRoute('transaksi.index') }}">
    <a class="nav-link" href="{{ route('transaksi.index') }}">
        <i class="fas fa-coins"></i>
        <span>{{ __('Transaksi') }}</span>
    </a>
</li>