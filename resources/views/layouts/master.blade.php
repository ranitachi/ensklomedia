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
        <div id="sidebar-menu" class="col-lg-2 col-md-2 no-padding-left no-padding-right hidden-sm hidden-xs" style="margin-top:5px !important">
          @include('includes.sidebar')  
        </div>
        <div id="all-output" class="col-lg-10 col-md-10">
          @yield('content')
        </div>
    </div>

      @include('includes.scripts')
      @include('includes.modal')
	</body>
  <input type="hidden" id="hide-menu" value="0">
  <script type="text/javascript" src="{{asset('js/typeahead.js')}}"></script>
  <script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!}
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    
    $(document).ready(function(){
      $(".chosen-select").chosen();
      var path = "{{ route('search.auto') }}";
        $('#icon-menu').click(function(){
            var hidemenu=$('#hide-menu').val();
            if(hidemenu==0)
            {
              $('#hide-menu').val(1);
              $('#sidebar-menu').hide();
              $('#all-output').removeClass();
              $('#all-output').addClass("col-lg-12 col-md-12");
            }
            else if(hidemenu==1)
            {
              $('#hide-menu').val(0);
              $('#sidebar-menu').show();
              $('#all-output').removeClass();
              $('#all-output').addClass("col-lg-10 col-md-10");
            }
        });
        var wdth_search_form=$('.search-form').width();
        // alert(wdth_search_form);
        $('input#search-form').typeahead({
            name : 'name',
            display : 'name',
            source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                    return process(data);
                });
            },
            updater: function(item) { 
              //alert(item.id)
              $('#video_id').val(item.id);
              $('#search-form').val(item.name);
              return item.name;
            }
        });
        $('input#search-reviewer').typeahead({
            name : 'name',
            display : 'name',
            source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                    return process(data);
                });
            },
            updater: function(item) { 
              //alert(item.id)
              $('#reviewer_id').val(item.id);
              $('#search-reviewer').val(item.name);
              return item.name;
            }
        });
       
      });
  </script>
  <style>
    ul.typeahead
    {
      width:100% !important;
    }
  </style>
  @yield('footscript')
</html>