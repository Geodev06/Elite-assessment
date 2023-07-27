<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body>
    <div class="container">
        <div class="row mt-5 py-5">
            <div class="col-lg-5 mt-5 mx-auto">

                <div class="card">
                    <div class="card-body p-5">
                        <h2>Login</h2>
                        <span class="mb-4 error-text error_login text-danger"></span>
                        <form id="userForm">

                            <div class="form-floating mb-3 mt-2">
                                @csrf
                                <input type="text" id="username" name="username" class="form-control" placeholder="Username" autocomplete="off">
                                <label for="">Username</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                                <label for="">Password</label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block w-100">login</button>

                            <a href="{{ route('register') }}" class="btn btn-link mt-2">Create new account</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- endinject -->
</body>
@include('partials.scripts')
<script>
    function beforeSend() {
        $('.error-text').text('');
        $('#userForm :input').prop("disabled", true);
    }

    function handleSuccess(data) {
        $('.error-text').text('');
        $('#userForm :input').prop("disabled", false);
        if (data.message === 'login success') {
            window.location.assign("{{ route('dashboard') }}")
        }
    }

    function handleError(data) {

        $('#userForm :input').prop("disabled", false);
        $('.error_login').text(data.responseJSON.message)
    }


    $('#userForm').on('submit', function(e) {
        e.preventDefault()
        let data = $(this).serializeArray()

        makeRequest(
            "{{ route('user.auth') }}",
            'post',
            data,
            beforeSend,
            handleSuccess,
            handleError
        )

    })
</script>

</html>