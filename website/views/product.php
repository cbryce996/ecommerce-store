<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
                foreach ($products as $product)
                {
                    echo '<div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top p-2" src="'. $product["img_url"] .'" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">'. $product["name"] .'</h5>
                                    <!-- Product description-->
                                    <p>'. $product["description"] .'</p>
                                    <!-- Product price-->
                                    '. $product["cost"] .'
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center mb-2"><a class="btn btn-primary mt-auto" href="#">Add to Cart</a></div>
                                <form action="/product" method="GET">
                                    <input name="id" type="hidden" value="'. $product["id"] .'">
                                    <div class="text-center"><button class="btn btn-secondary mt-auto" type="Submit">More Info</button></div>
                                </form>
                            </div>
                        </div>
                    </div>';
                }
            ?>
        </div>
    </div>
</section>