@extends('layouts.backend.app')
@section('tittle', 'Dashboard')
@push('css')
    <!------------------------PAGE: Custom CSS START------------------------------->
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/pages/data-list-view.css">
    <!-- END: Page CSS-->



    <!------------------------PAGE: Custom CSS END------------------------------->
@endpush

@section('content')
    <!-- BEGIN Content-->
    <div class="app-content content">
        <div class="content-wrapper">

            <section id="statistics-card">

                <div class="row">
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                        <div class="avatar-content">
                                            <i class="feather icon-eye text-info font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700">{{$all_posts->count()}}</h2>
                                    <p class="mb-0 line-ellipsis">Total Posts</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                        <div class="avatar-content">
                                            <i class="feather icon-eye text-info font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700">{{$total_pending_posts}}</h2>
                                    <p class="mb-0 line-ellipsis">Pending Posts</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                        <div class="avatar-content">
                                            <i class="feather icon-eye text-info font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700">{{$total_views}}</h2>
                                    <p class="mb-0 line-ellipsis">total_views</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                        <div class="avatar-content">
                                            <i class="feather icon-eye text-info font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700">{{$total_fav}}</h2>
                                    <p class="mb-0 line-ellipsis">total_fav</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                        <div class="avatar-content">
                                            <i class="feather icon-eye text-info font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700">{{$total_comments}}</h2>
                                    <p class="mb-0 line-ellipsis">Total Comments</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12">
                        <div class="card text-center">
                            <div class="card-content">
                                <div class="card-body">
                                    <h2 class="">Most Popular Post</h2>
                                    <section id="data-list-view" class="data-list-view-header">
                                        <div class="table-responsive">
                                            <table class="table data-list-view">
                                                <thead>
                                                <tr>
                                                    <th>Rank List</th>
                                                    <th>Tittle</th>
                                                    <th>Views</th>
                                                    <th>Comments</th>
                                                    <th>Favourite</th>
                                                    <th>Publish Status</th>
                                                    <th>Approved Status</th>
                                                    <th>Created At</th>
                                                    <td>Action</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($popular_posts as $key=>$row)
                                                    <tr>
                                                        <td class="product-name">{{ $key + 1 }}</td>
                                                        <td class="product-name"><a target="_blank"
                                                                href="{{route('post.single',$row->slug)}}">{{Str::limit($row->tittle, 30) }}</a>
                                                        </td>
                                                        <td class="product-name">{{ $row->view_count }}</td>
                                                        <td class="product-name">{{ $row->comments_count }}</td>
                                                        <td class="product-name">{{ $row->favourite_to_users_count }}</td>

                                                        <td>@if ( $row->status === 1)
                                                                <div class="chip chip-success">
                                                                    <div class="chip-body">
                                                                        <div
                                                                            class="chip-text">Published
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="chip chip-warning">
                                                                    <div class="chip-body">
                                                                        <div
                                                                            class="chip-text">Not Published
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>@if ($row->is_approved === 1)
                                                                <div class="chip chip-success">
                                                                    <div class="chip-body">
                                                                        <div
                                                                            class="chip-text">Approved
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="chip chip-warning">
                                                                    <div class="chip-body">
                                                                        <div
                                                                            class="chip-text">Pending
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td class="product-name">{{ $row->created_at->diffForHumans() }}</td>
                                                        <td class="product-action">
                                                            <a href="{{route('admin.post.show',$row->id)}}"
                                                               target="_blank"><i
                                                                    class="feather icon-eye"> </i></a>
                                                            <a href="{{route('admin.post.edit',$row->id)}}"><i
                                                                    class="feather icon-edit"> </i></a>

                                                            <a onclick="deleteid({{$row->id}})"><i
                                                                    class="feather icon-trash"></i></a>
                                                            <form id="delete-id-{{$row->id}}"
                                                                  action="{{route('admin.post.destroy',$row->id)}}"
                                                                  method="post" style="display: none">
                                                                @csrf
                                                                @method('DELETE')
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

                    </div>


                </div>

            </section>
        </div>
    </div>
    <!-- END Content-->
@endsection

@push('js')
    <!------------------------PAGE: Custom JS START------------------------------->
    <!-- BEGIN: Page Vendor JS-->
    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>

    <script
        src="{{asset('public/assets/backend')}}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/js/scripts/ui/data-list-view.js"></script>
    <!-- END: Page JS-->



    <!------------------------PAGE: Custom JS END------------------------------->
@endpush
