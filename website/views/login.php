<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <h1>Login</h1>
                <hr/>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-5">
                <form action="/login/auth" method="GET">
                    <div class="form-group mt-2">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" placeholder="User Name">
                    </div>
                    <div class="form-group mt-2">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="mt-3 text-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <button type="submit" class="btn btn-secondary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>