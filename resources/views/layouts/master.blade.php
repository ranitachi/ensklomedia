<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        @yield('title')
        @include('includes.head')

    </head>
    <body>
      <!--======= header =======-->
        @include('includes.header')
      <!-- // header -->
        @include('includes.navbar')
      <!-- // main-category -->

	  <div class="site-output">
        @yield('content')
      </div>

      @include('includes.scripts')

	</body>
</html>
