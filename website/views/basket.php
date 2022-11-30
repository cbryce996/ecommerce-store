<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Your basket</h1>
                <hr/>
            </div>
        </div>
        <div class="row justify-content-center">
            <table class="table col-12">
                <thead>
                    <tr class="text-center align-middle">
                        <th class="col-3" style="min-width: 150px"></th>
                        <th>Name</th>
                        <th>Cost</th>
                        <th>Qty</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (!isset($products))
                        {
                            echo '<div class="col mb-5">No products in your basket</div>';
                        }
                        foreach ($products as $product)
                        {
                            echo '<tr class="text-center align-middle">
                                    <td><img src="'. $product['img_url'] .'" class="img-fluid" style="width:100%"></img></td>
                                    <td>'. $product["name"] .'</td>
                                    <td>£'. $product["cost"] .'</td>
                                    <td><input type="number" min="1" value="1" step="1" onkeydown="return false" /></td>
                                    <td>
                                        <form action="/basket/delete" method="GET">
                                            <input name="product_id" type="hidden" value="'. $product["id"] .'">
                                            <div class="text-center"><button class="btn btn-danger mt-auto" type="Submit">Delete</button></div>
                                        </form>
                                    </td>
                                </tr>';
                        }
                    ?>
                    <tr class="text-center align-middle">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><div class="text-center mb-2"><a class="btn btn-primary mt-auto" href="#">Checkout</a></div></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>