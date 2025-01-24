<x-admin1-layout>
@php
$role=auth()->user()->role_id;
@endphp
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <a href="#">
                        <div class="row align-items-center">
                            <div class="col-icon">
                            <div
                                class="icon-big text-center icon-primary bubble-shadow-small"
                            >
                                <i class="fas fa-users"></i>
                            </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Memberships</p>
                                <h4 class="card-title"></h4>
                            </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <a href="#">
                        <div class="row align-items-center">
                            <div class="col-icon">
                            <div
                                class="icon-big text-center icon-info bubble-shadow-small"
                            >
                                <i class="fas fa-briefcase"></i>
                            </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Business Categories</p>
                                <h4 class="card-title"></h4>
                            </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <a href="">
                        <div class="row align-items-center">
                            <div class="col-icon">
                            <div
                                class="icon-big text-center icon-success bubble-shadow-small"
                            >
                                <i class="fas fa-book"></i>
                            </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Chapters</p>
                                <h4 class="card-title"></h4>
                            </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <a href="">
                        <div class="row align-items-center">
                            <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="fa fa-bullhorn"></i>
                            </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Cities</p>
                                <h4 class="card-title"></h4>
                            </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-admin1-layout>