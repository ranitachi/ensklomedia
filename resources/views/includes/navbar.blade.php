<div id="main-category">
        <div class="container-full">
        	<div class="row">
                <div class="col-md-12">
                    <ul class="main-category-menu">
                    @php
                        $cat=App\Model\Category::orderBy('name')->get();
                        foreach($cat as $k => $v)
                        {
                            echo '<li class="color-1"><a href="02-category.html"><i class="fa fa-th-large"></i>'.$v->category.'</a></li>';
                        }
                    @endphp
                    </ul>
                </div><!-- // col-md-14 -->
              </div><!-- // row -->
          </div><!-- // container-full -->
      </div>