<!doctype html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    @stack('styles')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
  </head>
  <body>
    <header>
      <nav>
        <label for="show-menu" class="show-menu">&#x2630;</label>
        <input type="checkbox" id="show-menu" role="button" />
        <ul>
          <li><a href="/">Home</a></li>
          <li><a href="/recipes">Recipes</a></li>
          <li>Reviews
            <ul>
              <li><a href="/movie-ratings">Movies</a></li>
              <li><a href="/track-ratings">Tracks</a></li>
              <li><a href="/episode-ratings">TV Episodes</a></li>
            </ul>
          </li>
          <li>Virtual Game Night
            <ul>
              <li><a href="/whose-turn-is-it">Whose Turn Is It?</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>
    @yield('content')
  </body>
</html>

