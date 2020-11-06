
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">LEADBOX MANAGEMENT SYSTEM </a>
 
<span class="no-icon mr-2 nav-link"> Logged in as: {{ \Auth::user()->name }} </span>
    <button class=" btn btn-danger" >
       
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <a class="text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Log out') }} </a>
            </form>
     
    </button>
</nav>


