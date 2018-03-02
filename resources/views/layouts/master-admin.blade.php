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
      <div class="hidden-lg hidden-md">
          @include('includes.navbar')
        </div>
	  <div class="site-output">
        <div id="sidebar-menu" class="col-lg-2 col-md-2 no-padding-left no-padding-right hidden-sm hidden-xs" style="margin-top:5px !important">
          @include('includes.sidebar')  
        </div>
        <div id="all-output" class="col-lg-10 col-md-10">
          @yield('content')
        </div>
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