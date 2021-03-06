<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        @yield('title')
        @include('includes.head')

    </head>
    <body>
      <!--======= header =======-->
        @include('includes.header')

        <div class="hidden-lg hidden-md">
          @include('includes.navbar')
        </div>

	    <div class="site-output" style="margin-top:55px;position:relative;">
        <div id="sidebar-menu" alt="menu-sidebar" class="no-padding-left no-padding-right hidden-lg hidden-md hidden-sm hidden-xs" style="position:fixed;width:22%;height:100%;z-index:20000;overflow:auto;background:#f8f8f8;padding-bottom:50px !important;">
          @include('includes.sidebar')  
        </div>
        <div id="all-output" class="col-lg-12 col-md-12 all-output-m">
          <div id="latar" class="hidden-sm hidden-xs" style="width:100%;height:100%;background:#111;opacity:0.6;position:fixed;z-index:10000"></div>
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
    //   $(window).click(function( event ) {
    //     var t=event.target.nodeName;
    //     alert();
    //   });
      document.addEventListener("click", (evt) => {
          const flyoutElement = document.getElementById("sidebar-menu");
          let targetElement = evt.target; // clicked element

          do {
              if (targetElement == flyoutElement) {
                  // Do nothing, just return.
                  
                  return;
              }
              // Go up the DOM.
              targetElement = targetElement.parentNode;
          } while (targetElement);
          
          // alert();
          if(evt.target.getAttribute("id")!='2-icon-menu' && evt.target.getAttribute("id")!='icon-menu')
          {
            $('#latar').hide();
                $('#hide-menu').val(0);
                // $('#sidebar-menu').hide();
                $('#sidebar-menu').removeClass();
                $('#sidebar-menu').addClass("hidden-lg hidden-md hidden-sm hidden-xs");
            }
          // Do something useful here.
          // document.getElementById("flyout-debug").textContent = "Clicked outside!";
      });
      var height=$(window).height();
      $('#latar').hide();
      
      $(".chosen-select").chosen();
      var path = "{{ route('search.auto') }}";
        $('#icon-menu').click(function(){
            var hidemenu=$('#hide-menu').val();
            if(hidemenu==0)
            {
              $('#hide-menu').val(1);
              // $('#sidebar-menu').show();
              $('#latar').show();
              $('#sidebar-menu').removeClass();
              // $('#sidebar-menu').addClass("col-lg-12 col-md-12");
            }
            else if(hidemenu==1)
            {
              $('#latar').hide();
              $('#hide-menu').val(0);
              // $('#sidebar-menu').hide();
              $('#sidebar-menu').removeClass();
              $('#sidebar-menu').addClass("hidden-lg hidden-md hidden-sm hidden-xs");
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