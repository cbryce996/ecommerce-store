<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col mb-5">
                <?php
                    if(!isset($message))
                    {
                        echo '<div class="col mb-5">No error message returned</div>';
                    }
                    else
                    {
                        echo '<div class="col mb-5">'. $message .'</div>';
                    }
                ?>
            </div>
        </div>
    </div>
</section>