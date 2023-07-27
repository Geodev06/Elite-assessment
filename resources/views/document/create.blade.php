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
                    <h1 class="h2">Create Documents for {{ $crew[0]->firstname ?? '' . ' ' . $crew[0]->middlename ?? '' . ' ' . $crew[0]->lastname ?? '' }}</h1>
                </div>

                <div class="container">
                    <form id="documentForm">
                        <div class="row">
                            @include('partials.flash-message')
                            <div class="col-lg-4">
                                <div class="form-floating  mb-3 mt-2">
                                    @csrf
                                    <input type="text" name="code" class="form-control" placeholder="Document code" autocomplete="off">
                                    <label for="">Code</label>
                                    <span class="error-text error_code text-danger"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-floating  mb-3 mt-2">

                                    <input type="text" name="name" class="form-control" placeholder="Document name" autocomplete="off">
                                    <label for="">Name</label>
                                    <span class="error-text error_name text-danger"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-floating  mb-3 mt-2">

                                    <input type="number" name="document_number" class="form-control" placeholder="Document no." autocomplete="off">
                                    <label for="">Document no.</label>
                                    <span class="error-text error_document_number text-danger"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-floating  mb-3 mt-2">

                                    <input type="date" name="issued" class="form-control" placeholder="Issued at" autocomplete="off">
                                    <label for="">Issued at.</label>
                                    <span class="error-text error_issued text-danger"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-floating  mb-3 mt-2">

                                    <input type="date" name="expiry" class="form-control" placeholder="Expiry" autocomplete="off">
                                    <label for="">Expiry.</label>
                                    <span class="error-text error_expiry text-danger"></span>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-floating  mb-3 mt-2">

                                    <input type="text" name="remarks" class="form-control" placeholder="Remarks." autocomplete="off">
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
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class=" small">
                                <table class="table table-striped table-sm" id="table-document">
                                    <thead>
                                        <tr>
                                            <th scope="col">Code</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Document no.</th>
                                            <th scope="col">Issued at</th>
                                            <th scope="col">Expiry</th>

                                            <th scope="col">Created at</th>

                                            <th scope="col">Updated at</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($documents as $document)
                                        <tr>
                                            <td>{{$document->code}}</td>
                                            <td>{{$document->name}}</td>
                                            <td>{{$document->document_number}}</td>
                                            <td>{{$document->issued}}</td>
                                            <td>{{$document->expiry}}</td>

                                            <td>{{$document->created_at->format('Y-m-d')}}</td>

                                            <td>{{$document->updated_at->format('Y-m-d')}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Option</button>
                                                    <ul class="dropdown-menu">

                                                        <li>
                                                            <button type="button" class="dropdown-item btn-view" data-id="{{ $document->id }}">View document details</button>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('document.edit',$document->id) }}" class="dropdown-item">Edit document</a>
                                                        </li>
                                                        <li>
                                                            <button data-id="{{$document->id}}" class="btn-delete dropdown-item">Delete</button>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>
                            {{ $documents->links() }}
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="view-detail-modal" tabindex=" -1" aria-labelledby="detail" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body p-5">
                    <h4 class="mb-3">Document details</h4>
                    <ul>
                        <li>Code : <span id="v-code"></span></li>
                        <li>Name : <span id="v-name"></span></li>
                        <li>Document no #: <span id="v-docu-no"></span></li>
                        <li>Issued at : <span id="v-issued"></span></li>
                        <li>Expiry : <span id="v-expiry"></span></li>
                        <li>Created_At : <span id="v-created"></span></li>
                        <li>Updated_At : <span id="v-updated"></span></li>
                    </ul>
                </div>


            </div>
        </div>
    </div>
    <!-- end modal -->

    @include('partials.scripts')
</body>
<script>
    function handlesuccessload(data) {

        if (data.status === 200) {
            $('#v-code').text(data.document[0].code)
            $('#v-name').text(data.document[0].name)
            $('#v-docu-no').text(data.document[0].document_no)
            $('#v-issued').text(data.document[0].issued)
            $('#v-expiry').text(data.document[0].expiry)
            $('#v-created').text(data.document[0].created_at)
            $('#v-updated').text(data.document[0].updated_at)

        }
    }

    function handlefailload(data) {

        alert('error loading data')
    }

    $('#table-document tbody').on('click', '.btn-view', function() {

        let route = "{{ route('document.show',':id') }}"
        let data = {}
        makeRequest(
            route.replace(':id', $(this)[0].dataset.id),
            'get',
            data,
            beforeSend,
            handlesuccessload,
            handlefailload
        )

        $('#view-detail-modal').modal('show')
    })


    $('#table-document tbody').on('click', '.btn-delete', function() {

        if (confirm('Are you sure you want to delete this document?')) {

            let route = "{{ route('document.destroy',':id') }}"
            let data = {
                _token: "{{ csrf_token() }}"
            }
            makeRequest(
                route.replace(':id', $(this)[0].dataset.id),
                'delete',
                data,
                beforeSend,
                handleSuccess,
                handleError
            )
        }
    })


    function beforeSend() {
        $('.error-text').text('');
        $('#documentForm :input').prop("disabled", true);

        $('#msg-alert-success').css('display', 'none')
        $('#msg').text('')

        $('#v-code').text('loading...')
        $('#v-name').text('loading...')
        $('#v-docu-no').text('loading...')
        $('#v-issued').text('loading...')
        $('#v-expiry').text('loading...')
        $('#v-created').text('loading...')
        $('#v-updated').text('loading...')
    }

    function handleSuccess(data) {
        $('.error-text').text('');
        $('#documentForm :input').prop("disabled", false);

        if (data.status === 200) {
            $('#msg-alert-success').show()
            $('#msg').text(data.message)

            $('#documentForm')[0].reset()
            window.location.reload()
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
            "{{ route('document.store',$crew[0]->id) }}",
            'post',
            data,
            beforeSend,
            handleSuccess,
            handleError
        )

    })
</script>

</html>