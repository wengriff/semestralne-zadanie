<!-- a base layout for the application that includes navigation, language switching, and other common elements. -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="images/favicon.ico" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="//unpkg.com/mathlive"></script>
  <script src="https://unpkg.com/htmx.org@1.9.2"></script>
  <script src="https://unpkg.com/hyperscript.org@0.9.8"></script>

  <script>
    tailwind.config = {
        theme: {
          extend: {
            colors: {
              laravel: '#ef3b2d',
            },
          },
        },
      }
  </script>
  <title>{{__('app.solver')}}</title>
</head>

<body class="mb-48">
  <nav class="flex justify-between items-center mb-4">
    <ul class="flex space-x-6 mr-6 text-lg">
      @auth
      <li>
        <span class="font-bold uppercase">
          {{__('app.welcome')}}{{auth()->user()->name}}
        </span>
      </li>
 
      <li>
        <form class="inline" method="POST" action="/logout">
          @csrf
          <button type="submit">
            <i class="fa-solid fa-door-closed"></i> {{__('app.logout')}}
          </button>
        </form>
      </li>
            <li class="nav-item dropdown">
                <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="flag-icon flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}"></span> {{ Config::get('languages')[App::getLocale()]['display'] }}
                </button>
                <ul class="dropdown-menu">
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <li><a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"><span class="flag-icon flag-icon-{{$language['flag-icon']}}"></span> {{$language['display']}}</a></li>
                        @endif
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="/tutorial" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> {{__('app.tutorial')}}</a>
            </li>
      @else
      <li>
        <a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> {{__('app.register')}}</a>
      </li>
      <li>
        <a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i>{{__('app.login')}}</a>
      </li>
        <li class="nav-item dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="flag-icon flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}"></span> {{ Config::get('languages')[App::getLocale()]['display'] }}
            </button>
            <ul class="dropdown-menu">
                @foreach (Config::get('languages') as $lang => $language)
                    @if ($lang != App::getLocale())
                        <li><a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"><span class="flag-icon flag-icon-{{$language['flag-icon']}}"></span> {{$language['display']}}</a></li>
                    @endif
                @endforeach
            </ul>
        </li>
        <li>
            <a href="/tutorial" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> {{__('app.tutorial')}}</a>
        </li>

      @endauth
    </ul>
  </nav>

  <main>
    {{$slot}}
  </main>
  <footer
    class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-16 mt-24 opacity-90 md:justify-center">
    <p class="ml-2">Copyright &copy; 2023, All Rights reserved</p>
  </footer>

</body>

</html>
