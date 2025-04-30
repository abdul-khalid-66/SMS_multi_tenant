<x-tenant-app-layout>
    @push('css')
        <!-- favicon
    ============================================ -->
        <link rel="shortcut icon" type="image/x-icon" href="tenancy/assets/backend/img/favicon.ico">
        <!-- Google Fonts
            ============================================ -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
        <!-- Bootstrap CSS
            ============================================ -->
        <link rel="stylesheet" href=" {{ asset('backend/css/bootstrap.min.css') }} ">
        <!-- Bootstrap CSS
            ============================================ -->
        <link rel="stylesheet" href=" {{ asset('backend/css/font-awesome.min.css') }} ">
        <!-- owl.carousel CSS
            ============================================ -->
        <link rel="stylesheet" href=" {{ asset('backend/css/owl.carousel.css') }} ">
        <link rel="stylesheet" href=" {{ asset('backend/css/owl.theme.css') }} ">
        <link rel="stylesheet" href=" {{ asset('backend/css/owl.transitions.css') }} ">
        <!-- animate CSS
            ============================================ -->
        <link rel="stylesheet" href=" {{ asset('backend/css/animate.css') }} ">
        <!-- normalize CSS
            ============================================ -->
        <link rel="stylesheet" href=" {{ asset('backend/css/normalize.css') }} ">
        <!-- meanmenu icon CSS
            ============================================ -->
        <link rel="stylesheet" href=" {{ asset('backend/css/meanmenu.min.css') }} ">
        <!-- main CSS
            ============================================ -->
        <link rel="stylesheet" href=" {{ asset('backend/css/main.css') }} ">
        <!-- educate icon CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/css/educate-custon-icon.css') }}">
        <!-- morrisjs CSS
            ============================================ -->
        <link rel="stylesheet" href=" {{ asset('backend/css/morrisjs/morris.css') }} ">
        <!-- mCustomScrollbar CSS
            ============================================ -->
        <link rel="stylesheet" href=" {{ asset('backend/css/scrollbar/jquery.mCustomScrollbar.min.css') }} ">
        <!-- metisMenu CSS
            ============================================ -->
        <link rel="stylesheet" href=" {{ asset('backend/css/metisMenu/metisMenu.min.css') }} ">
        <link rel="stylesheet" href=" {{ asset('backend/css/metisMenu/metisMenu-vertical.css') }} ">
        <!-- calendar CSS
            ============================================ -->
        <link rel="stylesheet" href=" {{ asset('backend/css/calendar/fullcalendar.min.css') }} ">
        <link rel="stylesheet" href=" {{ asset('backend/css/calendar/fullcalendar.print.min.css') }} ">
        <!-- style CSS
            ============================================ -->
        <link rel="stylesheet" href="{{ asset('backend/style.css') }} ">
        <!-- responsive CSS
            ============================================ -->
        <link rel="stylesheet" href=" {{ asset('backend/css/responsive.css') }} ">
        <!-- modernizr JS
            ============================================ -->
        <script src=" {{ asset('backend/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    @endpush
    @push('css')

        <!-- Add any additional CSS needed for attendance -->
        {{-- <link rel="stylesheet" href="{{ asset('daterang') asset('backend/css/daterangepicker.css') }}"> --}}
    @endpush
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance Management') }}
        </h2>
    </x-slot>

    <div class="analytics-sparkle-area" style="margin-top: 20px">
        <div class="container-fluid">
            <div class="row">
                <!-- Today's Attendance Summary -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Today's Attendance</h5>
                            <h2><span class="counter">85</span>% <span class="tuition-fees">Present Today</span></h2>
                            <span class="text-success">+2.5% from yesterday</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" style="width:85%">
                                    <span class="sr-only">85% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Monthly Attendance -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Monthly Average</h5>
                            <h2><span class="counter">88</span>% <span class="tuition-fees">This Month</span></h2>
                            <span class="text-info">+1.2% from last month</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-info" role="progressbar" style="width:88%">
                                    <span class="sr-only">88% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Absent Students -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line table-mg-t-pro dk-res-t-pro-30">
                        <div class="analytics-content">
                            <h5>Absent Today</h5>
                            <h2><span class="counter">24</span> <span class="tuition-fees">Students</span></h2>
                            <span class="text-danger">3 Chronic Absentees</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-danger" role="progressbar" style="width:15%">
                                    <span class="sr-only">15% Absent</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Teacher Attendance -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line table-mg-t-pro dk-res-t-pro-30">
                        <div class="analytics-content">
                            <h5>Teacher Attendance</h5>
                            <h2><span class="counter">92</span>% <span class="tuition-fees">Present Today</span></h2>
                            <span class="text-warning">2 Teachers Absent</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-warning" role="progressbar" style="width:92%">
                                    <span class="sr-only">92% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-sales-area mg-tb-30">
        <div class="container-fluid">
            <div class="row">
                <!-- Main Attendance Chart -->
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-sales-chart">
                        <div class="portlet-title">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="caption pro-sl-hd">
                                        <span class="caption-subject"><b>Attendance Trends</b></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="actions graph-rp">
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-sm btn-primary active">
                                                <input type="radio" name="options" id="option1" autocomplete="off" checked> Daily
                                            </label>
                                            <label class="btn btn-sm btn-primary">
                                                <input type="radio" name="options" id="option2" autocomplete="off"> Weekly
                                            </label>
                                            <label class="btn btn-sm btn-primary">
                                                <input type="radio" name="options" id="option3" autocomplete="off"> Monthly
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="list-inline cus-product-sl-rp">
                            <li><h5><i class="fa fa-circle" style="color: #006DF0;"></i>Present</h5></li>
                            <li><h5><i class="fa fa-circle" style="color: #933EC5;"></i>Absent</h5></li>
                            <li><h5><i class="fa fa-circle" style="color: #65b12d;"></i>Late</h5></li>
                        </ul>
                        <div id="attendance-trend-chart" style="height: 356px;"></div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="white-box analytics-info-cs">
                        <h3 class="box-title">Quick Actions</h3>
                        <div class="quick-action-buttons">
                            <a href="#" class="btn btn-primary btn-block mg-b-10">
                                <i class="fa fa-calendar-check-o fa-lg"></i> Take Today's Attendance
                            </a>
                            <a href="#" class="btn btn-success btn-block mg-b-10">
                                <i class="fa fa-file-text-o fa-lg"></i> Generate Monthly Report
                            </a>
                            <a href="#" class="btn btn-info btn-block mg-b-10">
                                <i class="fa fa-search fa-lg"></i> View Attendance History
                            </a>
                            <a href="#" class="btn btn-warning btn-block">
                                <i class="fa fa-bell-o fa-lg"></i> Send Absence Notices
                            </a>
                        </div>
                        
                        <h3 class="box-title mg-t-20">Lowest Attendance Classes</h3>
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Grade 9 - Section B</h5>
                                    <small class="text-danger">72%</small>
                                </div>
                                <p class="mb-1">5 absent today</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Grade 7 - Section A</h5>
                                    <small class="text-warning">78%</small>
                                </div>
                                <p class="mb-1">3 chronic absentees</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Grade 10 - Section C</h5>
                                    <small>80%</small>
                                </div>
                                <p class="mb-1">4 absent today</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Attendance Records -->
    <div class="data-table-area mg-tb-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline13-list">
                        <div class="sparkline13-hd">
                            <div class="main-sparkline13-hd">
                                <h1>Recent Attendance Records</h1>
                            </div>
                        </div>
                        <div class="sparkline13-graph">
                            <div class="datatable-dashv1-list custom-datatable-overright">
                                <div class="table-responsive">
                                    <table id="recent-attendance-table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Present</th>
                                                <th>Absent</th>
                                                <th>Late</th>
                                                <th>Percentage</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2023-06-15</td>
                                                <td>Grade 9</td>
                                                <td>A</td>
                                                <td>32</td>
                                                <td>3</td>
                                                <td>2</td>
                                                <td>86.5%</td>
                                                <td>
                                                    <button class="btn btn-primary btn-xs">View</button>
                                                    <button class="btn btn-warning btn-xs">Edit</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2023-06-15</td>
                                                <td>Grade 8</td>
                                                <td>B</td>
                                                <td>28</td>
                                                <td>5</td>
                                                <td>1</td>
                                                <td>82.4%</td>
                                                <td>
                                                    <button class="btn btn-primary btn-xs">View</button>
                                                    <button class="btn btn-warning btn-xs">Edit</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2023-06-14</td>
                                                <td>Grade 9</td>
                                                <td>A</td>
                                                <td>30</td>
                                                <td>5</td>
                                                <td>2</td>
                                                <td>81.1%</td>
                                                <td>
                                                    <button class="btn btn-primary btn-xs">View</button>
                                                    <button class="btn btn-warning btn-xs">Edit</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2023-06-14</td>
                                                <td>Grade 7</td>
                                                <td>C</td>
                                                <td>35</td>
                                                <td>2</td>
                                                <td>0</td>
                                                <td>94.6%</td>
                                                <td>
                                                    <button class="btn btn-primary btn-xs">View</button>
                                                    <button class="btn btn-warning btn-xs">Edit</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2023-06-13</td>
                                                <td>Grade 10</td>
                                                <td>A</td>
                                                <td>40</td>
                                                <td>1</td>
                                                <td>3</td>
                                                <td>90.9%</td>
                                                <td>
                                                    <button class="btn btn-primary btn-xs">View</button>
                                                    <button class="btn btn-warning btn-xs">Edit</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Section -->
    <div class="calendar-area mg-tb-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="calendar-widget">
                        <div class="cal-head">
                            <h2>Attendance Calendar</h2>

                        </div>
                        <div id="attendance-calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        
        <!-- jquery
            ============================================ -->
        <script src=" {{ asset('backend/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <!-- bootstrap JS
            ============================================ -->
        <script src=" {{ asset('backend/js/bootstrap.min.js') }}"></script>
        <!-- wow JS
            ============================================ -->
        <script src=" {{ asset('backend/js/wow.min.js') }}"></script>
        <!-- price-slider JS
            ============================================ -->
        <script src=" {{ asset('backend/js/jquery-price-slider.js') }}"></script>
        <!-- meanmenu JS
            ============================================ -->
        <script src=" {{ asset('backend/js/jquery.meanmenu.js') }}"></script>
        <!-- owl.carousel JS
            ============================================ -->
        <script src=" {{ asset('backend/js/owl.carousel.min.js') }}"></script>
        <!-- sticky JS
            ============================================ -->
        <script src=" {{ asset('backend/js/jquery.sticky.js') }}"></script>
        <!-- scrollUp JS
            ============================================ -->
        <script src=" {{ asset('backend/js/jquery.scrollUp.min.js') }}"></script>
        <!-- counterup JS
            ============================================ -->
        <script src=" {{ asset('backend/js/counterup/jquery.counterup.min.js') }}"></script>
        <script src=" {{ asset('backend/js/counterup/waypoints.min.js') }}"></script>
        <script src=" {{ asset('backend/js/counterup/counterup-active.js') }}"></script>
        <!-- mCustomScrollbar JS
            ============================================ -->
        <script src=" {{ asset('backend/js/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src=" {{ asset('backend/js/scrollbar/mCustomScrollbar-active.js') }}"></script>
        <!-- metisMenu JS
            ============================================ -->
        <script src=" {{ asset('backend/js/metisMenu/metisMenu.min.js') }}"></script>
        <script src=" {{ asset('backend/js/metisMenu/metisMenu-active.js') }}"></script>
        <!-- morrisjs JS
            ============================================ -->
        <script src=" {{ asset('backend/js/morrisjs/raphael-min.js') }}"></script>
        {{-- <script src=" {{ asset('backend/js/morrisjs/morris.js') }}"></script> --}}
        {{-- <script src=" {{ asset('backend/js/morrisjs/morris-active.js') }}"></script> --}}
        <!-- morrisjs JS
            ============================================ -->
        <script src=" {{ asset('backend/js/sparkline/jquery.sparkline.min.js') }}"></script>
        <script src=" {{ asset('backend/js/sparkline/jquery.charts-sparkline.js') }}"></script>
        <script src=" {{ asset('backend/js/sparkline/sparkline-active.js') }}"></script>
        <!-- calendar JS
            ============================================ -->
        <script src=" {{ asset('backend/js/calendar/moment.min.js') }}"></script>
        <script src=" {{ asset('backend/js/calendar/fullcalendar.min.js') }}"></script>
        <script src=" {{ asset('backend/js/calendar/fullcalendar-active.js') }}"></script>
        <!-- plugins JS
            ============================================ -->
        <script src=" {{ asset('backend/js/plugins.js') }}"></script>
        <!-- main JS
            ============================================ -->
        <script src=" {{ asset('backend/js/main.js') }}"></script>
        <!-- tawk chat JS
            ============================================ -->
        {{-- <!-- <script src=" {{ asset('backend/js/tawk-chat.js') }}"></script> --> --}}
        <!-- ---------------------------------------- -->
    @endpush
    @push('js')
        <!-- Your existing JS imports -->
        
        <!-- Additional JS for attendance -->
        {{-- <script src="{{ asset('backend/js/moment.min.js') }}"></script>
        <script src="{{ asset('backend/js/daterangepicker.js') }}"></script>
        <script src="{{ asset('backend/js/fullcalendar.min.js') }}"></script> --}}
        
        <script>
            $(document).ready(function() {
                // Initialize attendance calendar
                $('#attendance-calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    defaultDate: moment().format('YYYY-MM-DD'),
                    editable: false,
                    eventLimit: true,
                    events: [
                        {
                            title: 'Grade 9 - 85%',
                            start: moment().format('YYYY-MM-DD'),
                            className: 'bg-success'
                        },
                        {
                            title: 'Grade 8 - 78%',
                            start: moment().subtract(1, 'days').format('YYYY-MM-DD'),
                            className: 'bg-warning'
                        },
                        {
                            title: 'Holiday',
                            start: moment().add(5, 'days').format('YYYY-MM-DD'),
                            className: 'bg-danger',
                            allDay: true
                        }
                    ],
                    dayRender: function(date, cell) {
                        // Highlight weekends
                        if (date.day() === 0 || date.day() === 6) {
                            cell.css('background-color', '#f9f9f9');
                        }
                    }
                });
                
                // Initialize data table
                $('#recent-attendance-table').DataTable({
                    dom: 'lfrtip',
                    pageLength: 5,
                    ordering: false
                });
            });
        </script>
    @endpush
</x-tenant-app-layout>