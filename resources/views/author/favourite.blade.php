@extends('layouts.backend.app')
@section('tittle', 'Post ')

@push('css')
    <!------------------------PAGE: Custom CSS START------------------------------->
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/pages/data-list-view.css">
    <!-- END: Page CSS-->



    <!------------------------PAGE: Custom CSS END------------------------------->
@endpush

@section('content')


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{route('admin.post.create')}}"
                                   class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light">Add New
                                    Post</a>


                                <div class="position-relative d-inline-block mr-2">
                                    Total Posts
                                    <span class="badge badge-pill badge-info badge-up">{{count($favourite_posts)}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column selectors with Export Options and print table -->
                <section id="data-thumb-view" class="data-thumb-view-header">
                    <div class="table-responsive">
                        <table class="table data-thumb-view dataex-html5-selectors">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Author Name</th>
                                <th>Tittle</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Views</th>
                                <th>Favourite Count</th>
                                <th>Created At</th>
                                <td>Action</td>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($favourite_posts as $key=>$row)
                                <tr>
                                    <td class="product-name">{{ $key + 1 }}</td>
                                    <td class="product-name">{{ $row->user->name }}</td>
                                    <td class="product-name">{{ Str::limit($row->tittle,10)}}</td>
                                    <td class="product-name">@foreach($row->categories as $postcat)
                                            {{$postcat->name.(!$postcat->count()  == 0 ? ',' : ' ')}}
                                        @endforeach</td>
                                    <td><img
                                            src="{{ asset('/public/storage/post')}}/{{$row->image }}"
                                            class="rounded mr-75" alt="profile image" height="64"
                                            width="64"></td>
                                    <td class="product-name">{{ $row->view_count }}</td>

                                    <td>
                                        <span class="badge badge-pill badge-info">{{$row->favourite_to_users->count()}}</span>

                                    </td>

                                    <td class="product-name">{{ $row->created_at->diffForHumans() }}</td>
                                    <td class="product-action">
                                        <a href="{{route('author.post.show',$row->id)}}"
                                           target="_blank"><i
                                                class="feather icon-eye"> </i></a>
                                        <a onclick="deleteid({{$row->id}})"><i
                                                class="feather icon-trash"></i></a>
                                        <form id="delete-id-{{$row->id}}"
                                              action="{{route('post.favourite.add',$row->id)}}"
                                              method="post" style="display: none">
                                            @csrf

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </section>
            </div>
        </div>
    </div>

    <!-- END: Content-->

@endsection

@push('js')
    <!------------------------PAGE: Custom JS START------------------------------->
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
{{--    <script--}}
{{--        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>--}}
{{--    <script--}}
{{--        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>--}}
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/dataTables.select.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/js/scripts/extensions/dropzone.js"></script>

    <script src="{{asset('public/assets/backend')}}/app-assets/js/scripts/ui/data-list-view.js"></script>
    <!-- END: Page JS-->

    {{--    sweet alert--}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@sweetalert2/themes@3.2.0/wordpress-admin/wordpress-admin.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.0/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        function deleteid(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-id-' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        }


    </script>



    <!------------------------PAGE: Custom JS END------------------------------->
@endpush
