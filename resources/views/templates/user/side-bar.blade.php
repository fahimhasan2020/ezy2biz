<ul class="sidebar navbar-nav">
    <li class="nav-item {{ $accountActive }}">
        <a class="nav-link" href="/u/account">
            <i class="fas fa-dollar-sign"></i>
            <span>My Account</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/products">
            <i class="fas fa-shopping-bag"></i>
            <span>Products</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/bulletins">
            <i class="fas fa-newspaper"></i>
            <span>Bulletins</span>
        </a>
    </li>

    <li class="nav-item dropdown {{ $treeActive }}">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-sitemap"></i>
            <span>Referral Tree</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="/u/tree">My Tree</a>
            <a class="dropdown-item" href="/u/ref-link">Referral Links</a>
        </div>
    </li>
</ul>