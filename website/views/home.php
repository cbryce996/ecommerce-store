<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row justify-content-center">
            <?php
                if (!isset($products))
                {
                    echo '<div class="col mb-5">No products returned from server</div>';
                }
                else
                {
                    foreach ($products as $product)
                    {
                        if (!isset($product["img_url"]) ||
                        !isset($product["name"]) ||
                        !isset($product["description"]) ||
                        !isset($product["cost"]) ||
                        !isset($product["id"]))
                        {
                            echo '<div class="col mb-5">Missing information from server</div>';
                        }
                        else
                        {
                            echo '<div class="col-sm-6 col-lg-3 mb-5">
                                <div class="card h-100">
                                    <!-- Product image-->
                                    <img class="card-img-top p-2" src="'. $product["img_url"] .'" alt="..." />
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">'. $product["name"] .'</h5>
                                            <!-- Product price-->
                                            <h5>£'. $product["cost"] .'</h5>
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <form action="/product" method="GET">
                                            <input name="id" type="hidden" value="'. $product["id"] .'">
                                            <div class="text-center"><button class="btn btn-primary mt-auto" type="Submit">More Info</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                }
            ?>
        </div>
    </div>
</section>