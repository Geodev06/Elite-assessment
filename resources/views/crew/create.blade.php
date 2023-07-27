<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>

    @include('partials.head')

</head>

<body>

    @include('partials.header')

    <div class="container-fluid">
        <div class="row">
            @include('partials.nav')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Create crew</h1>
                </div>

                <div class="container">
                    <form id="crewForm">
                        <div class="row">
                            @include('partials.flash-message')
                            <div class="col-lg-4">
                                <div class="form-floating  mb-3 mt-2">
                                    @csrf
                                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="firstname" autocomplete="off">
                                    <label for="">Firstname</label>
                                    <span class="error-text error_firstname text-danger"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-floating mb-3 mt-2">

                                    <input type="text" id="middlename" name="middlename" class="form-control" placeholder="middlename" autocomplete="off">
                                    <label for="">Middlename</label>
                                    <span class="error-text error_middlename text-danger"></span>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-floating mb-3 mt-2">

                                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="lastname" autocomplete="off">
                                    <label for="">Lastname</label>
                                    <span class="error-text error_lastname text-danger"></span>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating mb-3 mt-2">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="email" autocomplete="off">
                                    <label for="">Email</label>
                                    <span class="error-text error_email text-danger"></span>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating mb-3 mt-2">
                                    <input type="text" id="address" name="address" class="form-control" placeholder="address" autocomplete="off">
                                    <label for="">Address</label>
                                    <span class="error-text error_address text-danger"></span>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating mb-3 mt-2">
                                    <input type="text" id="education" name="education" class="form-control" placeholder="education" autocomplete="off">
                                    <label for="">Education</label>
                                    <span class="error-text error_education text-danger"></span>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating mb-3 mt-2">
                                    <input type="text" id="contact" name="contact" class="form-control" placeholder="contact" autocomplete="off">
                                    <label for="">Contact</label>
                                    <span class="error-text error_contact text-danger"></span>

                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary float-end"><i class="bx bx-save"></i> Save</button>
                            </div>

                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    @include('partials.scripts')
</body>
<script>
    function beforeSend() {
        $('.error-text').text('');
        $('#crewForm :input').prop("disabled", true);

        $('#msg-alert-success').css('display', 'none')
        $('#msg').text('')
    }

    function handleSuccess(data) {
        $('.error-text').text('');
        $('#crewForm :input').prop("disabled", false);

        if (data.status === 200) {
            $('#msg-alert-success').show()
            $('#msg').text(data.message)

            $('#crewForm')[0].reset()
        }
    }

    function handleError(data) {


        $('#crewForm :input').prop("disabled", false);

        if (data.status === 422) {

            $.each(data.responseJSON.errors, function(prefix, val) {
                $('.error_' + prefix).text(val[0]);
            })
        }
    }


    $('#crewForm').on('submit', function(e) {
        e.preventDefault()
        let data = $(this).serializeArray()
        makeRequest(
            "{{ route('crew.store') }}",
            'post',
            data,
            beforeSend,
            handleSuccess,
            handleError
        )

    })
</script>

</html>