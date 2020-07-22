@extends('layouts.backend.app')
@section('tittle', 'Category -')

@push('css')
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->
@endpush

@section('content')


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Column selectors with Export Options and print table -->
                <section id="column-selectors">
                    <div class="row">

                        <div class="col-3">
                            <div class="card">
                                <div class="card-header">
                                    Add New Category
                                </div>
                                <div class="card-body">
                                    <form action="{{route('admin.category.store')}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name"
                                                   placeholder="Enter Your Tag">
                                        </div>
                                        <div class="form-group">
                                            <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer"
                                                   for="account-upload">Upload new photo</label>
                                            <input type="file" id="account-upload" name="image" hidden>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">ADD</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Category List</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table table-striped dataex-html5-selectors">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Category Name</th>
                                                    <th>Category images</th>
                                                    <th>Created At</th>
                                                    <td>Action</td>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($category as $key=>$row)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $row->id }}</td>
                                                        <td><img
                                                                src="{{ asset('/public/storage/category')}}/{{$row->images }}"
                                                                class="rounded mr-75" alt="profile image" height="64"
                                                                width="64"></td>
                                                        <td class="text-info">{{ $row->created_at->diffForHumans() }}</td>
                                                        <td>
                                                            <a href="{{route('admin.category.edit',$row->id)}}"><i
                                                                    class="feather icon-check-circle font-medium-5 info"> </i></a>

                                                            <a href="{{route('admin.category.destroy',$row->id)}}"><i
                                                                    class="feather icon-delete font-medium-5 danger"></i></a>
{{--                                                            <form id=""--}}
{{--                                                                  action="{{route('admin.category.destroy',$row->id)}}"--}}
{{--                                                                  method="post">--}}
{{--                                                                @csrf--}}
{{--                                                                @method('DELETE')--}}
{{--                                                            </form>--}}
{{--                                                        </td>--}}

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Category Name</th>
                                                    <th>Category images</th>
                                                    <th>Created At</th>
                                                    <td>Action</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Column selectors with Export Options and print table -->

            </div>

        </div>
    </div>

    <!-- END: Content-->

@endsection

@push('js')


    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/js/scripts/datatables/datatable.js"></script>
    <!-- END: Page JS-->

 
@endpush
