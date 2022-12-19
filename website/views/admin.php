<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row justify-content-center">
            <div class="col">
                <h1>Products</h1>
                <hr/>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($products as $product)
                            {
                                echo '<tr>
                                <th scope="row">'.$product["id"].'</th>
                                <td>'.$product["name"].'</td>
                                <td>'.$product["description"].'</td>
                                <td>'.$product["qty"].'</td>
                                <td>£'.$product["cost"].'</td>
                                <td>
                                    <div class="btn-group">
                                        <form action="/product/edit" method="GET">
                                            <input name="id" type="hidden" value="'. $product["id"] .'">
                                            <button class="btn btn-sm btn-outline-dark me-1" type="submit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </form>
                                        <form action="/product/delete" method="GET">
                                            <input name="id" type="hidden" value="'. $product["id"] .'">
                                            <button class="btn btn-sm btn-outline-dark" type="submit">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <a class="btn btn-outline-dark me-2" href="/product/add">
                    <i class="bi bi-person me-1"></i>
                    Add Product
                </a>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col">
                <h1>Transactions</h1>
                <hr/>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>