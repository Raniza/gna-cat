<!-- Modal -->
<div class="modal fade" id="addEditDepartmentModal" tabindex="-1" aria-labelledby="addEditProcess" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-1">
                <h1 class="modal-title fs-5" id="departmentTitle"></h1>
                <button type="button" class="btn-close btn-close-department" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="departmentID">
                <div class="mb-1" id="divDepartmentInput">
                    <label for="departmentInput" class="form-label text-dark fw-normal" id="departmentLabel">Department</label>
                    <input type="text" class="form-control department_name" id="departmentInput" name="department_name" value="">
                </div>
                
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" id="departmentCloseBtn">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="departmentSaveBtn">Save</button>
            </div>
        </div>
    </div>
</div>