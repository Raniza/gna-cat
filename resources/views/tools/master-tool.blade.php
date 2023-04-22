@extends('layouts.app')

@section('content')
<div class="col p-2">
    <div class="card">
        <div class="card-header d-flex justify-content-between py-1 px-2">
            <h6><span class="align-middle">Master Tool Table</span></h6>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addEditToolModal" id="addMasterTool">Add Master Tool Data</button>
        </div>
        <div class="card-body">
            <table class="table table-sm mastertool-datatable">
                <thead class="bg-light" style="font-size: 14px;">
                    <tr>
                        <th>#</th>
                        <th>Code E-Proc</th>
                        <th>Description</th>
                        <th class="text-center">Drawing</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14px;">

                </tbody>
            </table>
        </div>
    </div>
</div>
@include('tools.modals.detail-tool')
@include('tools.modals.upload-dwg')
<script>
    const modalDetailTool = document.getElementById('detailToolModal')
    const detailCode = document.getElementById('detailCode')
    const detailDesc = document.getElementById('detailDesc')
    const detailCreated = document.getElementById('detailCreated')
    const detailUpdated = document.getElementById('detailUpdated')
    const toolDwgData = document.getElementById('toolDwgData')

    const modalUploadTool = document.getElementById('uploadToolModal')
    const uploadToolId = document.getElementById('uploadToolId')
    const uploadToolForm = document.getElementById('uploadToolForm')
    let detailToolModal, uploadToolModal

    document.addEventListener('DOMContentLoaded', () => {
        detailToolModal = new bootstrap.Modal(document.getElementById('detailToolModal'))
        uploadToolModal = new bootstrap.Modal(document.getElementById('uploadToolModal'))
    })

    modalDetailTool.addEventListener('hidden.bs.modal', () => {
        detailCode.innerHTML = ''
        detailDesc.innerHTML = ''
        toolDwgData.innerHTML = ''
    })

    modalUploadTool.addEventListener('hidden.bs.moda', () => {
        uploadToolId.value = ''
    })
    $(function () {
        let table = $(".mastertool-datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('tools.get.data') }}",
            pageLength: 50,
            createdRow: function( row, data, dataIndex ) {
                for (let i = 1; i < 3; i++) {
                    $( row ).find(`td:eq(${i})`).attr('data-bs-toggle', 'tooltip');
                    $( row ).find(`td:eq(${i})`).attr('data-bs-title', 'Click to view detail');
                    $( row ).find(`td:eq(${i})`).attr('onclick', `toolDetails(${data.id})`);
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },
                {
                    data: "code",
                    name: "code",
                    className: "text-nowrap text-center",
                },
                {
                    data: "desc",
                    name: "desc",
                },
                {
                    data: "drawing",
                    name: "drawing",
                    className: "text-center"
                },
                {
                    data: "action",
                    name: "action",
                    className: "text-nowrap text-center",
                    orderable: true,
                    searchable: true,
                },
            ],
        });
        $('table').on('draw.dt', function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
        })
    })
    function toolDetails(id) {
        const url = '{{ route('tools.master.index') }}' + '/' + id
        loadingStatus(true)
        fetchGetData(url, toolData)
        function toolData(data) {
            loadingStatus(false)
            detailCode.innerHTML = data.code
            detailDesc.innerHTML = data.desc
            detailCreated.innerHTML = data.create
            detailUpdated.innerHTML = data.update
            detailToolModal.show()
            if (!data.drawings.length > 0) {
                const html = `
                    <tr>
                        <td colspan="6" class="text-center">No Drawing Data Found</td>
                    </tr>
                `
                toolDwgData.insertAdjacentHTML('beforeend', html)
            } else {
                const dwg = data.drawings;
                let html = ''
                for (let i = 0; i < dwg.length; i++) {
                    html += `
                    <tr>
                        <td class="text-center">${dwg[i].rev_no}</td>
                        <td>${dwg[i].note}</td>
                        <td class="text-center">${dwg[i].updated_at.split('T')[0]}</td>
                        <td class="text-center">${dwg[i].uploader}</td>
                        <td class="text-center">
                            <button type="button" class="btn badge rounded-pill text-bg-primary">Edit</button>
                            <button type="button" class="btn badge rounded-pill text-bg-danger">Delete</button>
                        </td>
                    </tr>
                `
                }
                if (html) {
                    toolDwgData.insertAdjacentHTML('beforeend', html)
                }
            }
            // console.log(data);
        }
    }
    function openUploadDwg(event) {
        uploadToolId.value = event.target.getAttribute('data-id')
    }

    uploadToolForm.addEventListener('submit', (event) => {
        event.preventDefault()
        const toolFormData = new FormData()
        const toolFile = document.querySelector('input[type="file"]')
        const toolRevNo = document.getElementById('toolRevNo')
        const toolNote = document.getElementById('toolNote')
        const url = '{{ route('tools.dwg.upload') }}'

        const data = {
            tool_drawing: toolFile.files[0],
            tool_rev_no: toolRevNo.value,
            tool_note: toolNote.value
        }
        
        toolFormData.append('tool_drawing', toolFile.files[0])
        toolFormData.append('tool_rev_no', parseInt(toolRevNo.value))
        toolFormData.append('tool_note', toolNote.value)
        toolFormData.append('tool_id', parseInt(uploadToolId.value))
        fetch(url, {
            method: 'POST',
            headers: {
                // "Content-Type": "multipart/form-data",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                    .content,
            },
            body: toolFormData
        })
            .then((res) => res.json())
            .then((res) => {
                console.log(res);
        })
            .catch(error => {
                console.error(error);
        });
    })
</script>
@endsection