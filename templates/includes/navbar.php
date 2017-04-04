<nav class="navbar" id="navbar--signedout">
    <div class="container container--nav">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">Schmedium</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/create" class="nav-link--story">Write a Story</a></li>
                <li><a href="#" class="nav-link--signin-signup" data-toggle="modal" data-target="#signin-modal">Sign in</a></li>
                <li><a href="#" class="nav-link--signin-signup" data-toggle="modal" data-target="#signup-modal">Sign up</a></li>
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar hidden" id="navbar--signedin">
    <div class="container container--nav">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapsed" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">Schmedium</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapsed">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/create" class="nav-link--story">Write a Story</a></li>
                <li><a href="#" class="nav-link--signin-signup" id="nav-link--signout">Sign Out</a></li>
            </ul>
        </div>
    </div>
</nav>