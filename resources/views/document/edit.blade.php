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
                    <h1 class="h2">Edit document</h1>
                </div>

                <div class="container">
                    <form id="documentForm">
                        <div class="row">
                            @include('partials.flash-message')
                            <div class="col-lg-4">
                                <div class="form-floating  mb-3 mt-2">
                                    @csrf
                                    <input type="text" name="code" value="{{ $doc[0]->code ?? '' }}" class="form-control" placeholder="Document code" autocomplete="off">
                                    <label for="">Code</label>
                                    <span class="error-text error_code text-danger"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-floating  mb-3 mt-2">

                                    <input type="text" name="name" value="{{ $doc[0]->name ?? '' }}" class="form-control" placeholder="Document name" autocomplete="off">
                                    <label for="">Name</label>
                                    <span class="error-text error_name text-danger"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-floating  mb-3 mt-2">

                                    <input type="number" name="document_number" value="{{ $doc[0]->document_number ?? '' }}" class="form-control" placeholder="Document no." autocomplete="off">
                                    <label for="">Document no.</label>
                                    <span class="error-text error_document_number text-danger"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-floating  mb-3 mt-2">

                                    <input type="date" name="issued" value="{{ $doc[0]->issued ?? '' }}" class="form-control" placeholder="Issued at" autocomplete="off">
                                    <label for="">Issued at.</label>
                                    <span class="error-text error_issued text-danger"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-floating  mb-3 mt-2">

                                    <input type="date" name="expiry" value="{{ $doc[0]->expiry ?? '' }}" class="form-control" placeholder="Expiry" autocomplete="off">
                                    <label for="">Expiry.</label>
                                    <span class="error-text error_expiry text-danger"></span>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-floating  mb-3 mt-2">

                                    <input type="text" name="remarks" value="{{ $doc[0]->remarks ?? '' }}" class="form-control" placeholder="Remarks." autocomplete="off">
                                    <label for="">Remarks.</label>
                                    <span class="error-text error_remarks text-danger"></span>
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
        $('#documentForm :input').prop("disabled", true);

        $('#msg-alert-success').css('display', 'none')
        $('#msg').text('')
    }

    function handleSuccess(data) {
        $('.error-text').text('');
        $('#documentForm :input').prop("disabled", false);

        if (data.status === 200) {
            $('#msg-alert-success').show()
            $('#msg').text(data.message)
        }
    }

    function handleError(data) {


        $('#documentForm :input').prop("disabled", false);

        if (data.status === 422) {

            $.each(data.responseJSON.errors, function(prefix, val) {
                $('.error_' + prefix).text(val[0]);
            })
        }
    }


    $('#documentForm').on('submit', function(e) {
        e.preventDefault()
        let data = $(this).serializeArray()
        makeRequest(
            "{{ route('document.update',$doc[0]->id) }}",
            'put',
            data,
            beforeSend,
            handleSuccess,
            handleError
        )

    })
</script>

</html>