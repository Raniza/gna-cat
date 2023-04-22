<!-- Modal -->
<div class="modal fade" id="detailToolModal" tabindex="-1" aria-labelledby="detailToolLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-1">
                <h4 class="modal-title fs-5" id="detailToolTitle">Tool Detail</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-3">
                        <span style="font-size: 14px;"><b>E-proc Code</b> </span><br>
                        <span id="detailCode" style="font-size: 16px;"></span>
                    </div>
                    <div class="col-9">
                        <span style="font-size: 14px;"><b>Description</b> </span><br>
                        <span id="detailDesc" style="font-size: 16px;"></span>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-3">
                        <span style="font-size: 14px;"><b>Created</b> </span><br>
                        <span id="detailCreated" style="font-size: 16px;"></span>
                    </div><div class="col-3">
                        <span style="font-size: 14px;"><b>Last Update</b> </span><br>
                        <span id="detailUpdated" style="font-size: 16px;"></span>
                    </div>
                </div>
                <hr>
                <span style="font-size: 14px;"><b>Drawing Histrories</b> </span>
                <div class="row px-2">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr class="text-center" style="background-color: #ade8f4;">
                                <th style="width: 80px;">Rev No.</th>
                                <th>Reason / Note</th>
                                <th>Update At</th>
                                <th class="text-center">PIC</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody id="toolDwgData">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer p-1">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>