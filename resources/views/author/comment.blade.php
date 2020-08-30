@extends('layouts.backend.app')
@section('tittle', 'Comments ')

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

                <!-- Column selectors with Export Options and print table -->
                <section id="data-thumb-view" class="data-thumb-view-header">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>

                                <th>Comments Info</th>
                                <th>post Info</th>
                                <td>Action</td>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                @foreach($post->comments as $key=>$comment)
                                    <tr>

                                        <td class="product-name">
                                            <div class="row">
                                                <div class="col-lg-10 col-sm-6 col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex align-items-start pb-1">
                                                            <div class="avatar bg-rgba-primary p-50 m-0">
                                                                <div class="avatar-content">
                                                                    <img
                                                                        src="{{ asset('/public/storage/profile')}}/{{$comment->user->image }}"
                                                                        class="rounded" alt="profile image" height="64"
                                                                        width="64">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <p>{{$comment->comment }}</p>
                                                                <p>Commented by <span
                                                                        class="badge badge-pill badge-success">{{$comment->user->name }}</span><span
                                                                        class="badge badge-pill badge-info badge-up">{{$comment->created_at->diffForHumans() }}</span>
                                                                </p>
                                                                <a href="{{route('post.single',$comment->post->slug)}}">Reply</a>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="product-name">
                                            <div class="row">
                                                <div class="col-lg-10 col-sm-6 col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex align-items-start pb-0">
                                                            <div class="avatar bg-rgba-primary p-50 m-0">
                                                                <div class="avatar-content">
                                                                    <img
                                                                        src="{{ asset('/public/storage/profile')}}/{{$comment->post->user->image }}"
                                                                        class="rounded" alt="profile image" height="64"
                                                                        width="64">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <a href="{{route('post.single',$comment->post->slug)}}">{{Str::limit($comment->post->tittle, 30) }}</a>
                                                                <p>Post Created by <span
                                                                        class="badge badge-pill badge-success">{{$comment->post->user->name }}</span><span
                                                                        class="badge badge-pill badge-info badge-up">{{$comment->post->created_at->diffForHumans() }}</span>
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-action">
                                            <div class="row">
                                                <div class="col-lg-8 col-sm-6 col-12">

                                                    <a onclick="deleteid({{$comment->id}})"><i
                                                            class="feather icon-trash"></i></a>
                                                    <form id="delete-id-{{$comment->id}}"
                                                          action="{{route('author.comment.destroy',$comment->id)}}"
                                                          method="post" style="display: none">
                                                        @csrf


                                                    </form>

                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
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
