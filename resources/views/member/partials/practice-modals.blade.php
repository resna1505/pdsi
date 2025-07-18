<!-- Add Practice Modal -->
<div class="modal fade" id="addPracticeModal" tabindex="-1" aria-labelledby="addPracticeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPracticeModalLabel">Add Practice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('practice.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="institution_name" class="form-label">Institution Name *</label>
                                <input type="text" class="form-control" id="institution_name" name="institution_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="practice_type" class="form-label">Practice Type *</label>
                                <select class="form-select" id="practice_type" name="practice_type" required>
                                    <option value="">Select Type</option>
                                    <option value="hospital">Rumah Sakit</option>
                                    <option value="clinic">Klinik</option>
                                    <option value="private">Praktik Pribadi</option>
                                    <option value="government">Pemerintah</option>
                                    <option value="other">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" class="form-control" id="position" name="position" placeholder="e.g., Dokter Spesialis, Dokter Umum">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" class="form-control" id="department" name="department" placeholder="e.g., Penyakit Dalam, IGD">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="terminated">Terminated</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="license_number" class="form-label">License Number</label>
                                <input type="text" class="form-control" id="license_number" name="license_number">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date *</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="2"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="province" class="form-label">Province</label>
                        <input type="text" class="form-control" id="province" name="province">
                    </div>
                    
                    <!-- Schedule Section -->
                    <div class="mb-3">
                        <label class="form-label">Practice Schedule</label>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="monday" class="form-label fs-12">Monday</label>
                                <input type="text" class="form-control" id="monday" name="schedule[monday]" placeholder="e.g., 08:00-12:00">
                            </div>
                            <div class="col-md-4">
                                <label for="tuesday" class="form-label fs-12">Tuesday</label>
                                <input type="text" class="form-control" id="tuesday" name="schedule[tuesday]" placeholder="e.g., 08:00-12:00">
                            </div>
                            <div class="col-md-4">
                                <label for="wednesday" class="form-label fs-12">Wednesday</label>
                                <input type="text" class="form-control" id="wednesday" name="schedule[wednesday]" placeholder="e.g., 08:00-12:00">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="thursday" class="form-label fs-12">Thursday</label>
                                <input type="text" class="form-control" id="thursday" name="schedule[thursday]" placeholder="e.g., 08:00-12:00">
                            </div>
                            <div class="col-md-4">
                                <label for="friday" class="form-label fs-12">Friday</label>
                                <input type="text" class="form-control" id="friday" name="schedule[friday]" placeholder="e.g., 08:00-12:00">
                            </div>
                            <div class="col-md-4">
                                <label for="saturday" class="form-label fs-12">Saturday</label>
                                <input type="text" class="form-control" id="saturday" name="schedule[saturday]" placeholder="e.g., 08:00-12:00">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="sunday" class="form-label fs-12">Sunday</label>
                                <input type="text" class="form-control" id="sunday" name="schedule[sunday]" placeholder="e.g., 08:00-12:00">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Practice</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Practice Modal -->
<div class="modal fade" id="editPracticeModal" tabindex="-1" aria-labelledby="editPracticeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPracticeModalLabel">Edit Practice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPracticeForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_institution_name" class="form-label">Institution Name *</label>
                                <input type="text" class="form-control" id="edit_institution_name" name="institution_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_practice_type" class="form-label">Practice Type *</label>
                                <select class="form-select" id="edit_practice_type" name="practice_type" required>
                                    <option value="">Select Type</option>
                                    <option value="hospital">Rumah Sakit</option>
                                    <option value="clinic">Klinik</option>
                                    <option value="private">Praktik Pribadi</option>
                                    <option value="government">Pemerintah</option>
                                    <option value="other">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_position" class="form-label">Position</label>
                                <input type="text" class="form-control" id="edit_position" name="position">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_department" class="form-label">Department</label>
                                <input type="text" class="form-control" id="edit_department" name="department">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_status" class="form-label">Status *</label>
                                <select class="form-select" id="edit_status" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="terminated">Terminated</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_license_number" class="form-label">License Number</label>
                                <input type="text" class="form-control" id="edit_license_number" name="license_number">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_start_date" class="form-label">Start Date *</label>
                                <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="edit_end_date" name="end_date">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="edit_phone" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_city" class="form-label">City</label>
                                <input type="text" class="form-control" id="edit_city" name="city">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_address" class="form-label">Address</label>
                        <textarea class="form-control" id="edit_address" name="address" rows="2"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_province" class="form-label">Province</label>
                        <input type="text" class="form-control" id="edit_province" name="province">
                    </div>
                    
                    <!-- Schedule Section -->
                    <div class="mb-3">
                        <label class="form-label">Practice Schedule</label>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="edit_monday" class="form-label fs-12">Monday</label>
                                <input type="text" class="form-control" id="edit_monday" name="schedule[monday]" placeholder="e.g., 08:00-12:00">
                            </div>
                            <div class="col-md-4">
                                <label for="edit_tuesday" class="form-label fs-12">Tuesday</label>
                                <input type="text" class="form-control" id="edit_tuesday" name="schedule[tuesday]" placeholder="e.g., 08:00-12:00">
                            </div>
                            <div class="col-md-4">
                                <label for="edit_wednesday" class="form-label fs-12">Wednesday</label>
                                <input type="text" class="form-control" id="edit_wednesday" name="schedule[wednesday]" placeholder="e.g., 08:00-12:00">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="edit_thursday" class="form-label fs-12">Thursday</label>
                                <input type="text" class="form-control" id="edit_thursday" name="schedule[thursday]" placeholder="e.g., 08:00-12:00">
                            </div>
                            <div class="col-md-4">
                                <label for="edit_friday" class="form-label fs-12">Friday</label>
                                <input type="text" class="form-control" id="edit_friday" name="schedule[friday]" placeholder="e.g., 08:00-12:00">
                            </div>
                            <div class="col-md-4">
                                <label for="edit_saturday" class="form-label fs-12">Saturday</label>
                                <input type="text" class="form-control" id="edit_saturday" name="schedule[saturday]" placeholder="e.g., 08:00-12:00">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="edit_sunday" class="form-label fs-12">Sunday</label>
                                <input type="text" class="form-control" id="edit_sunday" name="schedule[sunday]" placeholder="e.g., 08:00-12:00">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Practice</button>
                </div>
            </form>
        </div>
    </div>
</div>