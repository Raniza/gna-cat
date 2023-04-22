<!-- Modal -->
<div class="modal fade" id="addEditProcessModal" tabindex="-1" aria-labelledby="addEditProcess" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-1">
                <h1 class="modal-title fs-5" id="processTitle"></h1>
                <button type="button" class="btn-close btn-close-process" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="processID">
                <input type="hidden" name="mode" id="modeProcess">
                
                <select class="form-select main_process_id" id="selectMainProcess" aria-label="Default select example">
                    <option class="opt-main-process" selected>Select Main Process</option>
                    @if ($main_process->count() > 0)
                    @foreach ($main_process as $mp)
                        <option class="opt-main-process" value="{{ $mp->id }}">{{ $mp->name }}</option>
                    @endforeach
                    @endif
                </select>
                <div class="input-group mt-2 process_name" id="divProcessInput">
                    <label class="input-group-text" for="processInput" id="processLabel"></label>
                    <input type="text" class="form-control" id="processInput" name="process_name" value="">
                </div>
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" id="processCloseBtn">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="processSaveBtn">Save</button>
            </div>
        </div>
    </div>
</div>