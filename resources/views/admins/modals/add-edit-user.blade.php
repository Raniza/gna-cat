<!-- Modal -->
<div class="modal fade" id="addEditUserModal" tabindex="-1" aria-labelledby="addEditUserModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h1 class="modal-title fs-5" id="addEditUserModalLabel">Modal title</h1>
                <button type="button" class="btn-close user" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control form-control-sm" id="userId">
                <div class="row mb-3">
                    <div class="col-2">
                        <label for="nik" class="form-label fs-7 fw-semibold text-dark text-dark">NIK</label>
                        <input type="text" class="form-control form-control-sm user nik" id="nik" placeholder="XN12345">
                    </div>
                    <div class="col-4">
                        <label for="userName" class="form-label fs-7 fw-semibold text-dark">Name</label>
                        <input type="text" class="form-control form-control-sm user userName" id="userName" placeholder="Name">
                    </div>
                    <div class="col-6">
                        <label for="email" class="form-label fs-7 fw-semibold text-dark">Email</label>
                        <input type="email" class="form-control form-control-sm user email" id="email" placeholder="name@example.com">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-3">
                        <label for="position" class="form-label fs-7 fw-semibold text-dark">Position</label>
                        <select class="form-select form-select-sm user position" aria-label="Default select example" id="position">
                            <option class="opt-position" selected value="">Open this menu</option>
                            @if ($positions->count() > 0)
                                @foreach ($positions as $key => $position)
                                <option class="opt-position" value="{{ $position->id }}" key="{{ $key }}">{{ $position->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-5">
                        <label for="department" class="form-label fs-7 fw-semibold text-dark">Department</label>
                        <select class="form-select form-select-sm user department" aria-label="Default select example" id="department">
                            <option class="opt-department" selected value="">Open this menu</option>
                            @if ($departments->count() > 0)
                                @foreach ($departments as $key => $department)
                                <option class="opt-department" value="{{ $department->id }}" key="{{ $key }}">{{ $department->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="section" class="form-label fs-7 fw-semibold text-dark">Section</label>
                        <select class="form-select form-select-sm user section" aria-label="Default select example" id="section" disabled>
                            <option class="opt-section" value="">Open this menu</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2 d-flex justify-content-between">
                <div class="form-check form-switch pointer">
                    <input class="form-check-input user" type="checkbox" role="switch" id="isAdmin">
                    <label class="form-check-label text-dark fw-normal" for="isAdmin" id="labelIsAdmin">User</label>
                </div>
                <div>
                    <button type="button" class="btn btn-secondary btn-sm user" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" id="btnSaveUser">Save</button>
                </div>
                
            </div>
        </div>
    </div>
</div>