<!-- Add Education Modal -->
<div class="modal fade" id="addEducationModal" tabindex="-1" aria-labelledby="addEducationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEducationModalLabel">Add Education</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('education.store') }}" method="POST" enctype="multipart/form-data">
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
                                <label for="degree_type" class="form-label">Degree Type *</label>
                                <select class="form-select" id="degree_type" name="degree_type" required>
                                    <option value="">Select Degree</option>
                                    <option value="S1 Kedokteran Umum">S1 Kedokteran Umum</option>
                                    <option value="Program Profesi Dokter">Program Profesi Dokter (Koas)</option>
                                    <option value="Sp.PD">Spesialis Penyakit Dalam (Sp.PD)</option>
                                    <option value="Sp.A">Spesialis Anak (Sp.A)</option>
                                    <option value="Sp.OG">Spesialis Obstetri & Ginekologi (Sp.OG)</option>
                                    <option value="Sp.B">Spesialis Bedah (Sp.B)</option>
                                    <option value="Sp.An">Spesialis Anestesi (Sp.An)</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="major" class="form-label">Major/Specialization</label>
                                <input type="text" class="form-control" id="major" name="major">
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="dropped">Dropped</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="degree_type" class="form-label">Status *</label>
                                <select class="form-select" id="degree_type" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="dropped">Dropped</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_year" class="form-label">Start Year *</label>
                                <input type="number" class="form-control" id="start_year" name="start_year" min="1980" max="2030" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_year" class="form-label">End Year</label>
                                <input type="number" class="form-control" id="end_year" name="end_year" min="1980" max="2030">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="gpa" class="form-label">GPA</label>
                                <input type="number" class="form-control" id="gpa" name="gpa" step="0.01" min="0" max="4">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="graduation_date" class="form-label">Graduation Date</label>
                                <input type="date" class="form-control" id="graduation_date" name="graduation_date">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="certificate_number" class="form-label">Certificate Number</label>
                        <input type="text" class="form-control" id="certificate_number" name="certificate_number">
                    </div>
                    
                    <div class="mb-3">
                        <label for="institution_logo" class="form-label">Institution Logo</label>
                        <input type="file" class="form-control" id="institution_logo" name="institution_logo" accept="image/*">
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Education</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Education Modal -->
<div class="modal fade" id="editEducationModal" tabindex="-1" aria-labelledby="editEducationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEducationModalLabel">Edit Education</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editEducationForm" method="POST" enctype="multipart/form-data">
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
                                <label for="edit_degree_type" class="form-label">Degree Type *</label>
                                <select class="form-select" id="edit_degree_type" name="degree_type" required>
                                    <option value="">Select Degree</option>
                                    <option value="S1 Kedokteran Umum">S1 Kedokteran Umum</option>
                                    <option value="Program Profesi Dokter">Program Profesi Dokter (Koas)</option>
                                    <option value="Sp.PD">Spesialis Penyakit Dalam (Sp.PD)</option>
                                    <option value="Sp.A">Spesialis Anak (Sp.A)</option>
                                    <option value="Sp.OG">Spesialis Obstetri & Ginekologi (Sp.OG)</option>
                                    <option value="Sp.B">Spesialis Bedah (Sp.B)</option>
                                    <option value="Sp.An">Spesialis Anestesi (Sp.An)</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_major" class="form-label">Major/Specialization</label>
                                <input type="text" class="form-control" id="edit_major" name="major">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_status" class="form-label">Status *</label>
                                <select class="form-select" id="edit_status" name="status" required>
                                    <option value="progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="dropped">Dropped</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_start_year" class="form-label">Start Year *</label>
                                <input type="number" class="form-control" id="edit_start_year" name="start_year" min="1980" max="2030" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_end_year" class="form-label">End Year</label>
                                <input type="number" class="form-control" id="edit_end_year" name="end_year" min="1980" max="2030">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_gpa" class="form-label">GPA</label>
                                <input type="number" class="form-control" id="edit_gpa" name="gpa" step="0.01" min="0" max="4">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_graduation_date" class="form-label">Graduation Date</label>
                                <input type="date" class="form-control" id="edit_graduation_date" name="graduation_date">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_certificate_number" class="form-label">Certificate Number</label>
                        <input type="text" class="form-control" id="edit_certificate_number" name="certificate_number">
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_institution_logo" class="form-label">Institution Logo</label>
                        <input type="file" class="form-control" id="edit_institution_logo" name="institution_logo" accept="image/*">
                        <small class="text-muted">Leave empty to keep current logo</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Education</button>
                </div>
            </form>
        </div>
    </div>
</div>