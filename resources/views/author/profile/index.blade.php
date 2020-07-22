@extends('layouts.backend.app')
@section('tittle', 'Profile')

@push('css')
@endpush

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Account Settings</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Pages</a>
                                    </li>
                                    <li class="breadcrumb-item active"> Account Settings
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- account setting page start -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill"
                                       href="#account-vertical-general" aria-expanded="true">
                                        <i class="feather icon-globe mr-50 font-medium-3"></i>
                                        General
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill"
                                       href="#account-vertical-password" aria-expanded="false">
                                        <i class="feather icon-lock mr-50 font-medium-3"></i>
                                        Change Password
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                                 aria-labelledby="account-pill-general" aria-expanded="true">
                                                <form method="POST" action="{{ route('author.profile.update') }}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="media">
{{--                                                        <img--}}
{{--                                                            src="{{asset('public/assets/backend')}}/app-assets/images/portrait/small/avatar-s-11.jpg"--}}
{{--                                                            class="rounded mr-75" alt="profile image" height="64"--}}
{{--                                                            width="64">--}}
                                                        <img
                                                            src="{{ asset('/public/storage/profile')}}/{{Auth::user()->image }}"
                                                            class="rounded mr-75"  alt="profile image" height="64"
                                                            width="64">
                                                        <div class="media-body mt-75">
                                                            <div
                                                                class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                                <label
                                                                    class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer"
                                                                    for="account-upload">Upload new photo</label>
                                                                <input type="file" id="account-upload" name="image"
                                                                       hidden>
                                                                <button class="btn btn-sm btn-outline-warning ml-50">
                                                                    Reset
                                                                </button>
                                                            </div>
                                                            <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF or
                                                                    PNG. Max
                                                                    size of
                                                                    800kB</small></p>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">Name</label>
                                                                    <input type="text" class="form-control"
                                                                           id="account-name" placeholder="Name"
                                                                           name="name" value="{{ Auth::user()->name }}"
                                                                           required
                                                                           data-validation-required-message="This name field is required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-e-mail">E-mail</label>
                                                                    <input type="email" name="email"
                                                                           class="form-control" id="account-e-mail"
                                                                           placeholder="Email"
                                                                           value="{{ Auth::user()->email }}" required
                                                                           data-validation-required-message="This email field is required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="accountTextarea">Bio</label>
                                                                <textarea class="form-control" name="about"
                                                                          id="accountTextarea" rows="3"
                                                                          placeholder="Your Bio data here...">{{ Auth::user()->about }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="alert alert-warning alert-dismissible mb-2"
                                                                 role="alert">
                                                                <button type="button" class="close" data-dismiss="alert"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                                <p class="mb-0">
                                                                    Your email is not confirmed. Please check your
                                                                    inbox.
                                                                </p>
                                                                <a href="javascript: void(0);">Resend confirmation</a>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit"
                                                                    class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                                changes
                                                            </button>
                                                            <button type="reset" href="{{ route('author.dashboard') }}"
                                                                    class="btn btn-outline-warning">Cancel
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade " id="account-vertical-password" role="tabpanel"
                                                 aria-labelledby="account-pill-password" aria-expanded="false">
                                                <form method="POST" action="{{ route('author.password.update') }}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-old-password">Old
                                                                        Password</label>
                                                                    <input type="password" class="form-control"
                                                                           id="account-old-password"
                                                                           placeholder="Old Password"
                                                                           name="old_password"
                                                                           data-validation-required-message="This old password field is required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-new-password">New
                                                                        Password</label>
                                                                    <input type="password" name="password"
                                                                           id="account-new-password"
                                                                           class="form-control"
                                                                           placeholder="New Password"
                                                                           data-validation-required-message="The password field is required"
                                                                           minlength="6">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-retype-new-password">Retype New
                                                                        Password</label>
                                                                    <input type="password" name="password_confirmation"
                                                                           class="form-control"
                                                                           id="account-retype-new-password"
                                                                           data-validation-match-match="password"
                                                                           placeholder="New Password"
                                                                           data-validation-required-message="The Confirm password field is required"
                                                                           minlength="6">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit"
                                                                    class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                                changes
                                                            </button>
                                                            <button type="reset" class="btn btn-outline-warning">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- account setting page end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
@endsection

@push('js')
@endpush
