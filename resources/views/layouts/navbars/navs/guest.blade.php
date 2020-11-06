
<div class="navbar navbar-transparent  navbar-absolute mb-4" style="background-color: transparent!important; padding-top: 0!important;">
    <a class="navbar-brand" href="/">
        <img style=" width:100% !important;max-width: 230px !important;"  src="/light-bootstrap/img/logo.png">
    </a>
    <ul class="navbar-nav">
        <li class="nav-item @if($activePage == 'login') active @endif">
            <a href="{{ route('login') }}" class="nav-link">
                <i class="nc-icon nc-mobile"></i> {{ __('Login') }}
            </a>
        </li>   
    </ul>
</div> 