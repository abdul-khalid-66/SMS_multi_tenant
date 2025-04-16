<x-tenant-app-layout>
    @push('css')
		{{-- ============================================ --> --}}
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/owl.theme.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/owl.transitions.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/meanmenu.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/educate-custon-icon.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/morrisjs/morris.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/scrollbar/jquery.mCustomScrollbar.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/metisMenu/metisMenu.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/metisMenu/metisMenu-vertical.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/calendar/fullcalendar.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/calendar/fullcalendar.print.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/touchspin/jquery.bootstrap-touchspin.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/datapicker/datepicker3.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/form/themesaller-forms.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/colorpicker/colorpicker.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/chosen/bootstrap-chosen.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/ionRangeSlider/ion.rangeSlider.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/ionRangeSlider/ion.rangeSlider.skinFlat.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/style.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/responsive.css') }}">
        <script src="{{ asset('backend/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    
    @endpush
    <x-slot name="header"></x-slot>
        <!-- Advanced Form Start -->
        <div class="advanced-form-area mg-b-15">
           
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcome-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="breadcome-heading" style="margin-top: 10px">
                                        <h3>Teacher Registration Form</h3>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <ul class="breadcome-menu">
                                        <li>
                                            <a href="{{ route('dashboard.teachers') }}"
                                                class="btn btn-primary btn-sm" style="color: white">
                                                <i class="fa fa-arrow-left"></i> Back
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list">
                            <div class="sparkline12-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <form id="teacherForm" method="POST"
                                            action="{{ route('dashboard.store.teacher') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <!-- Personal Information Section -->
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="all-form-element-inner">
                                                    <div class="section-headline">
                                                        <h3>Personal Information</h3>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Full Name*</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="text" class="form-control" name="name"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Email*</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="email" class="form-control" name="email"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Phone Number*</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="text" class="form-control" name="phone"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Address*</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <textarea class="form-control" name="address"
                                                                    required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Gender*</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <select class="form-control" name="gender" required>
                                                                    <option value="">Select Gender</option>
                                                                    <option value="male">Male</option>
                                                                    <option value="female">Female</option>
                                                                    <option value="other">Other</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Date of Birth*</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <div class="input-group date">
                                                                    <span class="input-group-addon"><i
                                                                            class="fa fa-calendar"></i></span>
                                                                    <input type="text" class="form-control" name="dob"
                                                                        required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Select Role*</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <select data-placeholder="Choose a Country..." class="chosen-select"
                                                                    multiple="" tabindex="-1">
                                                                    <option value="United States">Admin</option>
                                                                    <option value="">Teacher</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Professional Information Section -->
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="all-form-element-inner">
                                                    <div class="section-headline">
                                                        <h3>Professional Information</h3>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Employee ID*</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="text" class="form-control"
                                                                    name="employee_id" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Qualification*</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="text" class="form-control"
                                                                    name="qualification" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Specialization*</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="text" class="form-control"
                                                                    name="specialization" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Years of Experience*</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="number" class="form-control"
                                                                    name="experience_years" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Joining Date*</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <div class="input-group date">
                                                                    <span class="input-group-addon"><i
                                                                            class="fa fa-calendar"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        name="joining_date" required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Salary Grade</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="text" class="form-control"
                                                                    name="salary_grade" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Bank Details</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <textarea class="form-control"
                                                                    name="bank_details"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Emergency Contact*</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="text" class="form-control"
                                                                    name="emergency_contact" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Bio</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <textarea class="form-control" name="bio"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Social Links</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="text" class="form-control"
                                                                    name="social_links"
                                                                    placeholder="Comma separated links (e.g., facebook.com, twitter.com)" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Is Class Teacher</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <div class="bt-df-checkbox">
                                                                    <input type="checkbox" name="is_class_teacher"
                                                                        value="1" id="isClassTeacher">
                                                                    <span class="checkmark"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner" id="classTeacherOfContainer"
                                                        style="display:none;">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Class Teacher Of</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <select class="form-control select2_demo_3"
                                                                    name="class_teacher_of">
                                                                    <option value="">Select Class</option>
                                                                    <option value="1">Class 1</option>
                                                                    <option value="2">Class 2</option>
                                                                    <option value="3">Class 3</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Documents Section -->
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="all-form-element-inner">
                                                    <div class="section-headline">
                                                        <h3>Documents</h3>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Qualifications Documents*</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="file" class="form-control"
                                                                    name="qualification_documents" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Signature</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="file" class="form-control"
                                                                    name="signature" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <label class="login2">Other Documents</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <input type="file" class="form-control"
                                                                    name="documents[]" multiple />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group-inner">
                                                    <div class="login-btn-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <div class="login-horizental">
                                                                    <button
                                                                        class="btn btn-sm btn-primary login-submit-cs"
                                                                        type="submit">Register Teacher</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
            <!-- Advanced Form End-->
        </div>
        @push('js')

            <!-- jquery============================================ -->
            <script src="{{ asset('backend/js/vendor/jquery-1.12.4.min.js') }}"></script>
            <!-- bootstrap JS============================================ -->
            <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
            <!-- wow JS============================================ -->
            <script src="{{ asset('backend/js/wow.min.js') }}"></script>
            <!-- price-slider JS============================================ -->
            <script src="{{ asset('backend/js/jquery-price-slider.js') }}"></script>
            <!-- meanmenu JS============================================ -->
            <script src="{{ asset('backend/js/jquery.meanmenu.js') }}"></script>
            <!-- owl.carousel JS============================================ -->
            <script src="{{ asset('backend/js/owl.carousel.min.js') }}"></script>
            <!-- sticky JS============================================ -->
            <script src="{{ asset('backend/js/jquery.sticky.js') }}"></script>
            <!-- scrollUp JS============================================ -->
            <script src="{{ asset('backend/js/jquery.scrollUp.min.js') }}"></script>
            <!-- mCustomScrollbar JS============================================ -->
            <script src="{{ asset('backend/js/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
            <script src="{{ asset('backend/js/scrollbar/mCustomScrollbar-active.js') }}"></script>
            <!-- metisMenu JS============================================ -->
            <script src="{{ asset('backend/js/metisMenu/metisMenu.min.js') }}"></script>
            <script src="{{ asset('backend/js/metisMenu/metisMenu-active.js') }}"></script>
            <!-- touchspin JS============================================ -->
            <script src="{{ asset('backend/js/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
            <script src="{{ asset('backend/js/touchspin/touchspin-active.js') }}"></script>
            <!-- colorpicker JS============================================ -->
            <script src="{{ asset('backend/js/colorpicker/jquery.spectrum.min.js') }}"></script>
            <script src="{{ asset('backend/js/colorpicker/color-picker-active.js') }}"></script>
            <!-- datapicker JS============================================ -->
            <script src="{{ asset('backend/js/datapicker/bootstrap-datepicker.js') }}"></script>
            <script src="{{ asset('backend/js/datapicker/datepicker-active.js') }}"></script>
            <!-- input-mask JS============================================ -->
            <script src="{{ asset('backend/js/input-mask/jasny-bootstrap.min.js') }}"></script>
            <!-- chosen JS============================================ -->
            <script src="{{ asset('backend/js/chosen/chosen.jquery.js') }}"></script>
            <script src="{{ asset('backend/js/chosen/chosen-active.js') }}"></script>
            <!-- select2 JS============================================ -->
            <script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>
            <script src="{{ asset('backend/js/select2/select2-active.js') }}"></script>
            <!-- ionRangeSlider JS============================================ -->
            <script src="{{ asset('backend/js/ionRangeSlider/ion.rangeSlider.min.js') }}"></script>
            <script src="{{ asset('backend/js/ionRangeSlider/ion.rangeSlider.active.js') }}"></script>
            <!-- rangle-slider JS============================================ -->
            <script src="{{ asset('backend/js/rangle-slider/jquery-ui-1.10.4.custom.min.js') }}"></script>
            <script src="{{ asset('backend/js/rangle-slider/jquery-ui-touch-punch.min.js') }}"></script>
            <script src="{{ asset('backend/js/rangle-slider/rangle-active.js') }}"></script>
            <!-- knob JS============================================ -->
            <script src="{{ asset('backend/js/knob/jquery.knob.js') }}"></script>
            <script src="{{ asset('backend/js/knob/knob-active.js') }}"></script>
            <!-- tab JS============================================ -->
            <script src="{{ asset('backend/js/tab.js') }}"></script>
            <!-- plugins JS============================================ -->
            <script src="{{ asset('backend/js/plugins.js') }}"></script>
            <!-- main JS============================================ -->
            <script src="{{ asset('backend/js/main.js') }}"></script>
        
        @endpush
</x-tenant-app-layout>