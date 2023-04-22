<!-- Modal -->
<div class="modal fade" id="uploadToolModal" tabindex="-1" aria-labelledby="uploadToolLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="uploadToolForm">
                <div class="modal-header py-1">
                    <h1 class="modal-title fs-5" id="uploadToolLabel">Upload - Tool Drawing</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="tool_id" id="uploadToolId">
                    <div class="input-group">
                        <input type="file" class="form-control" id="toolDrawing" name="tool_drawing" required>
                        <label class="input-group-text" for="toolDrawing">Upload</label>
                    </div>
                    
                    <div class="row">
                        <div class="col-4">
                            <div class="mt-2">
                                <label class="form-label" for="toolRevNo">Rev No</label>
                                <input type="number" class="form-control" id="toolRevNo" name="tool_rev_no" value="0" min='0'>
                            </div>
                            
                        </div>
                        <div class="col-8">
                            <div class="mt-2">
                                <label class="form-label" for="toolNote">Reason</label>
                                <input type="text" class="form-control" id="toolNote" name="tool_note" required>
                            </div>
                            <span class="text-muted" style="font-size: 14px;">&nbsp;Reason of revision</span><br>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-1">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="toolDwgUploadBtn">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>