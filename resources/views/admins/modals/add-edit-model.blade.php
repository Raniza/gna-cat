<!-- Modal -->
<div class="modal fade" id="addEditModelModal" tabindex="-1" aria-labelledby="addEditModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-1">
                <h1 class="modal-title fs-5" id="modelTitle"></h1>
                <button type="button" class="btn-close btn-close-model" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="modelID">
                <div class="input-group model_name">
                    <label class="input-group-text" for="modelInput">Model</label>
                    <input type="text" class="form-control" id="modelInput" name="name" value="">
                </div>
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" id="modelCloseBtn">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="modelSaveBtn">Save</button>
            </div>
        </div>
    </div>
</div>