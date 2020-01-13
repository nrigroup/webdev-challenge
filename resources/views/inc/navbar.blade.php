<nav class="navbar navbar-expand-md navbar-dar bg-dark">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
    aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link {{Request::route()->getName() === 'home' ? 'active' : ''}}" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{Request::route()->getName() === 'data' ? 'active' : ''}}" href="/data">Data</a>
      </li>
    </ul>
  </div>
</nav>