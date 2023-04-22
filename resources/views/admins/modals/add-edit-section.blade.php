<!-- Modal -->
<div class="modal fade" id="addEditSectionModal" tabindex="-1" aria-labelledby="addEditProcess" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-1">
                <h1 class="modal-title fs-5" id="sectionTitle"></h1>
                <button type="button" class="btn-close btn-close-section" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="sectionID">
                <div class="mb-1 department_id">
                    <label for="sectionInput" class="form-label text-dark fw-normal" id="sectionLabel">Department</label>
                    <select class="form-select py-2 department_id" aria-label="Default select example" id="selectSection">
                        <option selected value="">Select department...</option>
                        @if($departments->count() > 0)
                        @foreach($departments as $key => $department)
                        <option data-key="{{ $key }}" value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="mt-2 mb-1 name">
                    <label for="sectionInput" class="form-label text-dark fw-normal" id="sectionLabel">Section Name</label>
                    <input type="text" class="form-control section_name" id="sectionInput" name="section_name" value="">
                </div>
                
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" id="sectionCloseBtn">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="sectionSaveBtn">Save</button>
            </div>
        </div>
    </div>
</div>