
<x-app>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">{{__('register.reg')}}</h2>
      <p class="mb-4">{{__('register.createacc')}}</p>
    </header>

    <form method="POST" action="/users">
      @csrf
      <div class="mb-6">
        <label for="name" class="inline-block text-lg mb-2"> {{__('register.name')}} </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{old('name')}}" />

        @error('name')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>
      <div class="mb-6">
        <label for="name" class="inline-block text-lg mb-2"> {{__('register.sur')}} </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="surname" value="{{old('surname')}}" />

        @error('surname')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="email" class="inline-block text-lg mb-2">{{__('register.mail')}}</label>
        <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{old('email')}}" />

        @error('email')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="password" class="inline-block text-lg mb-2">
            {{__('register.pass')}}
        </label>
        <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password"
          value="{{old('password')}}" />

        @error('password')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="password2" class="inline-block text-lg mb-2">
            {{__('register.passcon')}}
        </label>
        <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation"
          value="{{old('password_confirmation')}}" />

        @error('password_confirmation')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
            {{__('register.signup')}}
        </button>
      </div>

      <div class="mt-8">
        <p>
            {{__('register.haveacc')}}
          <a href="/login" class="text-laravel">{{__('register.login')}}</a>
        </p>
      </div>
    </form>
  </x-card>
</x-app>
