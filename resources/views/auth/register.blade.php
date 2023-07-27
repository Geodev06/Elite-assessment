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
                        <h2>Register</h2>
                        <form id="userForm">

                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Fullname" autocomplete="off">
                                <label for="">Fullname</label>
                                <span class="error-text error_fullname text-danger"></span>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" id="username" name="username" class="form-control" placeholder="Username" autocomplete="off">
                                <label for="">Username</label>
                                <span class="error-text error_username text-danger"></span>

                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                                <label for="">Password</label>
                                <span class="error-text error_password text-danger"></span>

                            </div>

                            <button type="submit" class="btn btn-success btn-block w-100">Sign up</button>
                        </form>

                        <a href="{{ route('login') }}" class="btn btn-link mt-2">I already have an account</a>
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
        alert(data.message)

        window.location.assign("{{ route('login') }}")
    }

    function handleError(data) {


        $('#userForm :input').prop("disabled", false);
        if (data.status === 422) {

            $.each(data.responseJSON.errors, function(prefix, val) {
                $('.error_' + prefix).text(val[0]);
            })
        }
    }


    $('#userForm').on('submit', function(e) {
        e.preventDefault()
        let data = $(this).serializeArray()

        makeRequest(
            "{{ route('user.store') }}",
            'post',
            data,
            beforeSend,
            handleSuccess,
            handleError
        )

    })
</script>

</html>