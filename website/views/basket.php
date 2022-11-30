<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h1>Your basket</h1>
        <hr/>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <table class="table">
                <thead>
                    <tr class="text-center align-middle">
                        <th></th>
                        <th scope="col">Name</th>
                        <th scope="col">Descrition</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Qty</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($products as $product)
                        {
                            echo '<tr class="text-center align-middle">
                                    <td><img src="'. $product['image_url'] .'" class="img-fluid" style="width:150px"></img></td>
                                    <td>'. $product["name"] .'</td>
                                    <td>'. $product["description"] .'</td>
                                    <td>£'. $product["cost"] .'</td>
                                    <td><input type="number" min="1" value="1" step="1" onkeydown="return false" /></td>
                                    <td><div class="text-center mb-2"><a class="btn btn-danger mt-auto" href="#">Delete</a></div></td>
                                </tr>';
                        }
                    ?>
                    <tr class="text-center align-middle">
                        <td></td>
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