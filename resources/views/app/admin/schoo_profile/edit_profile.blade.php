<x-tenant-app-layout>
    @push('css')
    <style>
        .logo-preview {
            max-width: 200px;
            max-height: 200px;
            margin-bottom: 15px;
        }
        .form-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .form-section h3 {
            margin-bottom: 20px;
            color: #333;
        }
    </style>
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit School Profile') }}
        </h2>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>Edit School Profile</h1>
                            <div class="pull-right">
                                <a href="{{ route('schools.show', $school->id) }}" class="btn btn-default btn-sm">
                                    <i class="fa fa-arrow-left"></i> Back to Profile
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <form action="{{ route('schools.update', $school->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="form-section">
                                            <h3>Basic Information</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>School Name *</label>
                                                        <input type="text" name="name" class="form-control" value="{{ old('name', $school->name) }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Academic Session *</label>
                                                        <input type="text" name="session_year" class="form-control" value="{{ old('session_year', $school->session_year) }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>School Type</label>
                                                        <select name="type" class="form-control">
                                                            <option value="">Select Type</option>
                                                            <option value="public" {{ old('type', $school->type) == 'public' ? 'selected' : '' }}>Public School</option>
                                                            <option value="private" {{ old('type', $school->type) == 'private' ? 'selected' : '' }}>Private School</option>
                                                            <option value="international" {{ old('type', $school->type) == 'international' ? 'selected' : '' }}>International School</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Affiliation Number</label>
                                                        <input type="text" name="affiliation" class="form-control" value="{{ old('affiliation', $school->affiliation) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>About School</label>
                                                <textarea name="about" class="form-control" rows="3">{{ old('about', $school->about) }}</textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-section">
                                            <h3>Contact Information</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Address *</label>
                                                        <textarea name="address" class="form-control" rows="3" required>{{ old('address', $school->address) }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone Number *</label>
                                                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $school->phone) }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email Address *</label>
                                                        <input type="email" name="email" class="form-control" value="{{ old('email', $school->email) }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Website</label>
                                                        <input type="url" name="website" class="form-control" value="{{ old('website', $school->website) }}" placeholder="https://">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Principal Name</label>
                                                        <input type="text" name="principal" class="form-control" value="{{ old('principal', $school->principal) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-section">
                                            <h3>School Logo</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @if($school->logo)
                                                    <div class="current-logo">
                                                        <p>Current Logo:</p>
                                                        <img src="{{ asset('storage/'.$school->logo) }}" alt="Current School Logo" class="logo-preview">
                                                    </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <label>Upload New Logo</label>
                                                        <input type="file" name="logo" class="form-control">
                                                        <small class="text-muted">Recommended size: 300x300 pixels, max 2MB</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Social Media Links</label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="url" name="social_links[facebook]" class="form-control mb-2" value="{{ old('social_links.facebook', optional(json_decode($school->social_links))->facebook ?? "" )}}" placeholder="Facebook URL">
                                                            </div>
                                                            <div class="col-md-6">
                                                                 <input type="url" name="social_links[twitter]" class="form-control mb-2" value="{{ old('social_links.twitter', optional(json_decode($school->social_links))->twitter ?? '' ) }}" placeholder="Twitter URL">
                                                            </div>
                                                            <div class="col-md-6">
                                                                 <input type="url" name="social_links[instagram]" class="form-control mb-2" value="{{ old('social_links.instagram', optional(json_decode($school->social_links))->instagram ?? '') }}" placeholder="Instagram URL">
                                                            </div>
                                                            <div class="col-md-6">
                                                                 <input type="url" name="social_links[youtube]" class="form-control mb-2" value="{{ old('social_links.youtube', optional(json_decode($school->social_links))->youtube ?? '') }}" placeholder="YouTube URL">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-section">
                                            <h3>Additional Information</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Established Year</label>
                                                        <input type="number" name="established_year" class="form-control" value="{{ old('established_year', $school->established_year) }}" min="1900" max="{{ date('Y') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Working Hours</label>
                                                        <input type="text" name="working_hours" class="form-control" value="{{ old('working_hours', $school->working_hours) }}" placeholder="e.g. 8:00 AM - 3:00 PM">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="text-right">
                                            <button type="reset" class="btn btn-default">Reset</button>
                                            <button type="submit" class="btn btn-primary">Update Profile</button>
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

    @push('js')
    <script>
        $(document).ready(function() {
            // Preview logo before upload
            $('input[name="logo"]').change(function(e) {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        if ($('.current-logo').length) {
                            $('.current-logo img').attr('src', e.target.result);
                        } else {
                            $('input[name="logo"]').before('<div class="current-logo"><p>New Logo Preview:</p><img src="'+e.target.result+'" class="logo-preview"></div>');
                        }
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
    @endpush
</x-tenant-app-layout>