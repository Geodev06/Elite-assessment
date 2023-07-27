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
                    <h1 class="h2 text-uppercase">Welcome!, @if(Auth::check()) {{Auth::user()->fullname }} @endif</h1>
                    <form action="{{ route('user.destroy') }}" method="post" id="delete-account">
                        @method('delete')
                        @csrf
                        <button type="button" id="btn-delete-account" class="btn btn-danger" data-id="{{ Auth::user()->id }}">Delete account</button>
                    </form>
                </div>

                <h6>Table crew</h6>
                <span>Total no. of rows. {{ $rowcount }}</span>
                <div class=" small">
                    <table class="table table-striped table-sm" id="table-crew">
                        <thead>
                            <tr>
                                <th scope="col">Firstname</th>
                                <th scope="col">Middlename</th>
                                <th scope="col">Lastname</th>
                                <th scope="col">Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($crews as $crew)
                            <tr>
                                <td>{{$crew->firstname}}</td>
                                <td>{{$crew->middlename}}</td>
                                <td>{{$crew->lastname}}</td>
                                <td>{{$crew->email}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Option</button>
                                        <ul class="dropdown-menu">

                                            <li>
                                                <button type="button" class="dropdown-item btn-view" data-id="{{ $crew->id }}">View crew details</button>
                                            </li>
                                            <li>
                                                <a href="{{ route('crew.edit',$crew->id) }}" class="dropdown-item">Edit</a>
                                            </li>
                                            <li>
                                                <button data-id="{{ $crew->id}}" data-fullname="{{$crew->firstname . ' ' .$crew->middlename . ' ' .$crew->lastname }}" class="btn-delete dropdown-item">Delete</button>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                                </hr>
                                            </li>
                                            <li>
                                                <a href="{{ route('document.create',$crew->id) }}" class="dropdown-item">Create document</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
                {{ $crews->links() }}

            </main>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="view-detail-modal" tabindex=" -1" aria-labelledby="detail" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body p-5">
                    <h4 class="mb-3">Crew details</h4>
                    <ul>
                        <li>Firstname : <span id="v-firstname"></span></li>
                        <li>Middlename : <span id="v-middlename"></span></li>
                        <li>Lastname : <span id="v-lastname"></span></li>
                        <li>Email : <span id="v-email"></span></li>
                        <li>Address : <span id="v-address"></span></li>
                        <li>Education : <span id="v-education"></span></li>
                        <li>Contact : <span id="v-contact"></span></li>
                    </ul>
                </div>


            </div>
        </div>
    </div>
    <!-- end modal -->
    @include('partials.scripts')
</body>

<script>
    $(document).ready(function() {


        function beforeSend() {

            $('#msg-alert-success').css('display', 'none')
            $('#msg').text('')

            $('#v-firstname').text('loading...')
            $('#v-middlename').text('loading...')
            $('#v-lastname').text('loading...')
            $('#v-email').text('loading...')
            $('#v-address').text('loading...')
            $('#v-education').text('loading...')
            $('#v-contact').text('loading...')
        }

        function handleSuccess(data) {

            if (data.status === 200) {
                alert('record has been succesfully in deleted')
                window.location.reload()
            }
        }

        function handleError(data) {
            alert('error in deleting data')
        }


        function handlesuccessload(data) {

            if (data.status === 200) {
                $('#v-firstname').text(data.crew[0].firstname)
                $('#v-middlename').text(data.crew[0].middlename)
                $('#v-lastname').text(data.crew[0].lastname)
                $('#v-email').text(data.crew[0].email)
                $('#v-address').text(data.crew[0].address)
                $('#v-education').text(data.crew[0].education)
                $('#v-contact').text(data.crew[0].contact)
            }
        }

        function handlefailload(data) {

            if (data.status === 200) {
                $('#v-firstname').text(data.crew[0].firstname)
            }
        }
        $('#table-crew tbody').on('click', '.btn-view', function() {

            let route = "{{ route('crew.show',':id') }}"
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

        $('#table-crew tbody').on('click', '.btn-delete', function() {
            if (confirm('Are you sure you want to delete this record? of ' + $(this)[0].dataset.fullname) == true) {

                let route = "{{ route('crew.destroy',':id') }}"
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

        $('#btn-delete-account').on('click', function() {

            if (confirm('Are you sure you want to delete this admin account') == true) {
                $('#delete-account').submit()
            }
        })
    })
</script>

</html>