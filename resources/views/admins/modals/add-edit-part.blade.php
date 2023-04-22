<!-- Modal -->
<div class="modal fade" id="addEditPartModal" tabindex="-1" aria-labelledby="addEditPart" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-1">
                <h1 class="modal-title fs-5" id="partTitle"></h1>
                <button type="button" class="btn-close btn-close-part" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="partID">
                <div class="input-group part_name">
                    <label class="input-group-text" for="partInput">Part</label>
                    <input type="text" class="form-control" id="partInput" name="name" value="">
                </div>
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" id="partCloseBtn">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="partSaveBtn">Save</button>
            </div>
        </div>
    </div>
</div>