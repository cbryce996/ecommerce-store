<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row justify-content-center">
            <div class="col">
                <h1>Add Product</h1>
                <hr/>
            </div>
        </div>
        <form action="/product/add/submit" method="GET">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group mt-2">
                        <label>Product</label>
                        <input type="text" name="name" class="form-control" placeholder="Product name">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mt-2">
                        <label>Description</label>
                        <input type="text" name="description" class="form-control" placeholder="Description of the product">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group mt-2">
                        <label>Qty</label>
                        <input type="number" min="1" value="1" step="1" name="qty" class="form-control">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group mt-2">
                        <label>Cost</label>
                        <div class="input-group">
                            <div class="input-group-text">£</div>
                            <input type="number" min="1" value="1" step="1" name="cost" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group mt-2">
                        <label>Image</label>
                        <input type="text" name="img_url" class="form-control" placeholder="Product image url">
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="submit" class="btn btn-secondary">Clear</button>
                </div>
            </div>
        </form>
    </div>
</section>