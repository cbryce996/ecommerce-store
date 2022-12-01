<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row justify-content-center">
            <div class="col mb-5">
                <?php
                    if(!isset($message))
                    {
                        echo '<div class="col mb-5">No error message returned</div>';
                    }
                    else
                    {
                        echo '
                            <div class="col mb-5">
                                <h1 class="fw-bolder">
                                Error
                                </h1>
                                <hr/>
                                <h4 class="fw-bolder">
                                '. $code .'
                                </h4>
                            '. $message .'
                            </div>';
                    }
                ?>
            </div>
        </div>
    </div>
</section>