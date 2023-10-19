@extends('layouts.user')
@section('css')
    <link rel="stylesheet" href="{{ asset('/client/css/dashboard.css') }}">
@endsection
@section('breadcrumb')
    <div class="breadcrumb">
        <span class="nav-link home d-flex align-content-center"><a href="{{ route('userDashboard') }}"><i
                    class="bi bi-house-fill"></i> <span>Hệ thống</span></a>
        </span>
        <span class="nav-link d-flex align-content-center"><a href="{{ route('userDashboard') }}"><i
                    class="bi bi-caret-right-fill center"></i> <span>Dashboard</span></a>
        </span>
    </div>
@endsection
@section('content')
    <div class="row gx-3">
        <div class="col-3 content-01 d-none d-lg-block">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex">
                            <x-info-user01></x-info-user01>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="text-center mb-0 level-user btn btn-primary w-100 my-3">Cấp đại lý:
                                {{ $userLevel }}</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <ul class="list-nav-user">
                                <x-menu-user></x-menu-user>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="title-section mb-0">Blog</h2>
                        <a href="" class="btn btn-sm btn-secondary"><i class="bi bi-eye-fill"></i> Xem tất cả</a>
                    </div>
                    <div class="small-list-posts">
                        <div class="small-list-posts">
                            <x-list-post01></x-list-post01>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 content-02">
            <x-notication-admin></x-notication-admin>
        </div>
        <div class="col-12 col-md-6 col-lg-5 h-100 content-03">
            <x-report></x-report>
            <x-statistical></x-statistical>
            <x-level></x-level>
            <div class="card shadow mb-3 d-block d-lg-none">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="title-section mb-0">Blog</h2>
                        <a href="" class="btn btn-sm btn-secondary"><i class="bi bi-eye-fill"></i> Xem tất cả</a>
                    </div>
                    <div class="small-list-posts">
                        <x-list-post01></x-list-post01>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            //Render-report
            // Function to calculate height based on data-traffic
            function calculateHeight(traffic, maxTraffic, wpReportHeight) {
                return (traffic / maxTraffic) * wpReportHeight;
            }
            const data = [{
                    traffic: 2000,
                    date: '01/07'
                }, {
                    traffic: 1200,
                    date: '02/07'
                }, {
                    traffic: 950,
                    date: '03/07'
                }, {
                    traffic: 800,
                    date: '04/07'
                }, {
                    traffic: 500,
                    date: '05/07'
                }, {
                    traffic: 400,
                    date: '06/07'
                }, {
                    traffic: 700,
                    date: '07/07'
                }, {
                    traffic: 200,
                    date: '08/07'
                }, {
                    traffic: 300,
                    date: '09/07'
                }, {
                    traffic: 1200,
                    date: '10/07'
                }, {
                    traffic: 1800,
                    date: '11/07'
                }, {
                    traffic: 560,
                    date: '12/07'
                }, {
                    traffic: 400,
                    date: '13/07'
                }, {
                    traffic: 600,
                    date: '14/07'
                }, {
                    traffic: 700,
                    date: '15/07'
                }, {
                    traffic: 1000,
                    date: '16/07'
                }

            ];
            const reportContainer = $('#report-container');
            const maxTraffic = Math.max(...data.map(item => item.traffic));
            const wpReportHeight = 400;
            // Function to create and append elements for each data item
            function createColumnElement(traffic, date) {
                const column = $('<div>').addClass('col-report d-flex flex-colum');

                const barElement = $('<div>').addClass('bar')
                    .attr('data-traffic', traffic)
                    .css('height', calculateHeight(traffic, maxTraffic, wpReportHeight) + 'px');

                const dateElement = $('<div>').addClass('date')
                    .text(date);

                column.append(barElement);
                column.append(dateElement);
                return column;
            }
            // Loop through the data and append each column element to the container
            data.forEach(item => {
                const columnElement = createColumnElement(item.traffic, item.date);
                reportContainer.append(columnElement);
            });
        });
    </script>
@endsection
