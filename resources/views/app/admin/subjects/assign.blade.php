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
                                    <h3>Assign Teacher to Subject</h3>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <ul class="breadcome-menu">
                                    <li>
                                        <a href="{{ route('admin.academic.subjects.index') }}"
                                            class="btn btn-primary btn-sm" style="color: white">
                                            <i class="fa fa-arrow-left"></i> Back to Subjects
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
                                    <form id="assignTeacherForm" method="POST" action="{{ route('admin.academic.subjects.assign-teacher', $subject->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="all-form-element-inner">
                                                <div class="section-headline">
                                                    <h3>Subject Information</h3>
                                                </div>
                                                <div class="form-group-inner">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                            <label class="login2">Subject Name</label>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                            <input type="text" class="form-control" value="{{ $subject->name }}" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group-inner">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                            <label class="login2">Subject Code</label>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                            <input type="text" class="form-control" value="{{ $subject->code }}" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="all-form-element-inner">
                                                <div class="section-headline">
                                                    <h3>Teacher Assignment</h3>
                                                </div>
                                                <div class="form-group-inner {{ $errors->has('teacher_id') ? 'has-error' : '' }}">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                            <label class="login2">Select Teacher*</label>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                            <select name="teacher_id" class="form-control chosen-select" required>
                                                                <option value="">-- Select Teacher --</option>
                                                                @foreach($teachers as $teacher)
                                                                    <option value="{{ $teacher->id }}" {{ old('teacher_id', $subject->teacher_id ?? '') == $teacher->id ? 'selected' : '' }}>
                                                                        {{ $teacher->name }} ({{ $teacher->email }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('teacher_id'))
                                                                <span class="help-block text-danger">{{ $errors->first('teacher_id') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group-inner {{ $errors->has('class_id') ? 'has-error' : '' }}">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                            <label class="login2">Class*</label>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                            <select name="class_id" id="class_id" class="form-control chosen-select" required>
                                                                <option value="">-- Select Class --</option>
                                                                @foreach($classes as $class)
                                                                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                                                        {{ $class->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('class_id'))
                                                                <span class="help-block text-danger">{{ $errors->first('class_id') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group-inner {{ $errors->has('section_id') ? 'has-error' : '' }}">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                            <label class="login2">Section*</label>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                            <select name="section_id" id="section_id" class="form-control chosen-select" required>
                                                                <option value="">-- Select Section --</option>
                                                                @if(old('class_id'))
                                                                    @foreach($sections as $section)
                                                                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                                                            {{ $section->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @if($errors->has('section_id'))
                                                                <span class="help-block text-danger">{{ $errors->first('section_id') }}</span>
                                                            @endif
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
                                                                <button class="btn btn-sm btn-primary login-submit-cs" type="submit">
                                                                    <i class="fa fa-check"></i> Assign Teacher
                                                                </button>
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
    </div>
    <!-- Advanced Form End-->

    @push('js')
        <!-- jquery============================================ -->
        <script src="{{ asset('backend/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <!-- bootstrap JS============================================ -->
        <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
        <!-- chosen JS============================================ -->
        <script src="{{ asset('backend/js/chosen/chosen.jquery.js') }}"></script>
        <script src="{{ asset('backend/js/chosen/chosen-active.js') }}"></script>
        
        <script>
            $(document).ready(function() {
                // Initialize chosen select
                $(".chosen-select").chosen();
                
                // Load sections when class is selected
                $('#class_id').change(function() {
                    var classId = $(this).val();
                    if (classId) {
                        $.ajax({
                            url: "{{ route('admin.academic.sections.by-class') }}",
                            type: "GET",
                            data: {class_id: classId},
                            success: function(data) {
                                $('#section_id').empty();
                                $('#section_id').append('<option value="">-- Select Section --</option>');
                                $.each(data, function(key, value) {
                                    $('#section_id').append('<option value="'+key+'">'+value+'</option>');
                                });
                                $('#section_id').trigger("chosen:updated");
                            }
                        });
                    } else {
                        $('#section_id').empty();
                        $('#section_id').append('<option value="">-- Select Section --</option>');
                        $('#section_id').trigger("chosen:updated");
                    }
                });

                // Initialize sections if class is already selected
                @if(old('class_id'))
                    $('#class_id').trigger('change');
                    // Set the previously selected section if available
                    @if(old('section_id'))
                        setTimeout(function() {
                            $('#section_id').val('{{ old("section_id") }}').trigger("chosen:updated");
                        }, 500);
                    @endif
                @endif
            });
        </script>
    @endpush
</x-tenant-app-layout>