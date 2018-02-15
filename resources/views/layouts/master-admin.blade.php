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
     
	  <div class="site-output">
        @yield('content')
      </div>

      @include('includes.scripts')
      @yield('footscript')
	</body>
</html>
@include('includes.modal')

<script type="text/javascript">
  var APP_URL = {!! json_encode(url('/')) !!}
  $.ajaxSetup({
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
	});
</script>