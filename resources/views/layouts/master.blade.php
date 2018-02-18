<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('title')
        @include('includes.head')

    </head>
    <body>
      <!--======= header =======-->
        @include('includes.header')

        <div class="hidden-lg hidden-md">
          @include('includes.navbar')
        </div>

	  <div class="site-output">
        @include('includes.sidebar')  
        @yield('content')
      </div>

      @include('includes.scripts')
      @yield('footscript')
	</body>
</html>
<script type="text/javascript">
  var APP_URL = {!! json_encode(url('/')) !!}
  $.ajaxSetup({
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
	});
</script>