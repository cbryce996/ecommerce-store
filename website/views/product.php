<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <?php
            if (!isset($products))
            {
                echo '<div class="col mb-5">Error retrieving information on product</div>';
            }
            else
            {
                echo '<h1>'. $products[0]["name"] .'</h1>
                <hr/>
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-lg-5 mb-5">
                        <img src="'. $products[0]["img_url"]. '" style="width: 100%" />
                    </div>
                    <div class="text-center col-sm-6 col-lg-7">
                        <h5 class="fw-bolder">'. $products[0]["name"] .'</h5>
                        <p>'. $products[0]["description"] .'</p>
                        <h5 class="fw-bolder pb-2">£'. $products[0]["cost"] .'</h5>
                        <form action="/basket/add" method="GET">
                            <input name="id" type="hidden" value="'. $products[0]["id"] .'">
                            <div class="mb-2"><button class="btn btn-primary mt-auto" type="Submit">Add to Basket</button></div>
                        </form>
                    </div>
                </div>';
            }
        ?>
    </div>
</section>