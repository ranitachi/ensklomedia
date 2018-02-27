<div id="main-category">
        <div class="container-full">
        	<div class="row">
                <div class="col-md-12">
                    <ul class="main-category-menu">
                    @php
                        $cat=App\Model\Category::orderBy('name')->get();
                        foreach($cat as $k => $v)
                        {
                            $first_letter = substr($v->name,0,1);
                            echo '<li class="color-1" style="width:100% !important;"><a href="'.route('video.bycategory', $v->slug).'"><span data-letters="'.$first_letter.'">'.$v->name.'</span></a></li>';
                        }
                    @endphp
                    </ul>
                </div><!-- // col-md-14 -->
              </div><!-- // row -->
          </div><!-- // container-full -->
      </div>