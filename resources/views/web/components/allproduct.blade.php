<div class="all-product-view-area margin-bottom-80">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="all-product-view">
          <div class="row">
            <div class="col-md-7 col-sm-8 col-xs-12 col-sm-offset-1 col-md-offset-2">
              <div class="all-product-brief">
                <?php
                  $product = DB::table('headerproduct')->where('id', '1')->first();
                  $title = $product->title;
                  $subtitle = $product->subtitle;
                ?>
                <h2>{{$title}}</h2>
                <p>{{$subtitle}}</p>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="all-product-view-link">
                <a href="/products" class="shop-now">View All</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
