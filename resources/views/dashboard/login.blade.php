<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    .gradient-custom {
        /* fallback for old browsers */
        background: wheat;

        /* Chrome 10-25, Safari 5.1-6 */
        background: wheat;
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: wheat;
    }
</style>

<body>
    <section class="gradient-custom">
        <div class="container py-5 h-150">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-success text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">


                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('loginError') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ url('/login') }}" method="post">
                                @csrf
                                <div class="mb-md-5 mt-md-4 pb-5">

                                    <h2 class="fw-bold mb-2 text-uppercase">Login PKL</h2>
                                    <p class="text-white-50 mb-5">Masukan NIK dan Password anda dengan benar!!</p>

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="nis">nis</label>
                                        <input type="text" id="nis" class="form-control form-control-lg"
                                            name="nis">
                                        @error('nis')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                                </div>
                            </form>
                            <div>
                                <p class="mb-0">Login Sebagai Operator</p><a href="/loginoperator"
                                    class="text-white-50 fw-bold">Klik Disini</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
