<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h1><?php echo $products["0"]["name"]; ?></h1>
        <hr/>
        <div class="row justify-content-center">
            <div class="col-sm-6 col-lg-5 mb-5">
                <img src="<?php echo $products["0"]["img_url"] ?>" style="width: 100%" />
            </div>
            <div class="text-center col-sm-6 col-lg-7">
                <h5 class="fw-bolder"><?php echo $products["0"]["name"] ?></h5>
                <p><?php echo $products["0"]["description"] ?></p>
                <h5 class="fw-bolder pb-2">£<?php echo $products["0"]["cost"] ?></h5>
                <form action="/basket/add" method="GET">
                    <input name="product_id" type="hidden" value="<?php echo $products["0"]["id"] ?>">
                    <div class="mb-2"><button class="btn btn-primary mt-auto" type="Submit">Add to Basket</button></div>
                </form>
            </div>
        </div>
    </div>
</section>