@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Model -->
    <div class="col-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span class="fw-semibold">Model</span>
                <button onclick="setModelModal(event)" id="addModelBtn" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addEditModelModal" data-mode="add">Add Model</button>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <input onkeydown="searchModel(event)" type="text" class="form-control" id="searchModelInput" placeholder="Search here...">
                </div>
                <ul class="list-group col" id='modelUL'>
                    @if ($models->count() > 0)
                    @foreach ($models as $model)
                    <div class="dropdown">
                        <li class="list-group-item list-group-item-info model" id="{{ $model->name }}" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                            <span class="dropdown-togle" type="button" title="Click to Open Menu" data-bs-toggle="tooltip" data-bs-placement="right">{{ $model->name }}</span>
                            <ul class="dropdown-menu">
                                <span class="ms-3" style="font-size: 12px; cursor: text; display: block;">{{ $model->name }}</span>
                                <li><button onclick="relatedPart(event)" class="dropdown-item" type="button" data-id="{{ $model->id }}" data-model="{{ $model->name }}">Related Part</button></li>
                                <li><button onclick="setModelModal(event)" class="dropdown-item" type="button" data-id="{{ $model->id }}" data-name="{{ $model->name }}" data-bs-toggle="modal" data-bs-target="#addEditModelModal" data-mode="edit">Edit</button></li>
                                <hr class="my-1">
                                <li><button onclick="deleteModel({{ $model->id }})" class="dropdown-item text-white bg-danger" type="button">Delete</button></li>
                            </ul>
                        </li>
                    </div>
                    @endforeach
                    @else
                    <li class="list-group-item list-group-item-warning text-center">No Data</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- Part -->
    <div class="col-9">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span class="fw-semibold">Part</span>
                <span class="">
                    <input onkeydown="searchPart(event)" type="text" class="py-1 form-control" id="searchPartInput" placeholder="Search here...">
                </span>
                <div>
                    <button onclick="location.reload()" class="mx-1 btn btn-sm btn-danger" style="display: none;" id="cancelSyncPart">Cancel</button>
                    <button onclick="setPartModal(event)" id="partBtn" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addEditPartModal" data-mode="edit">Add Part</button>
                </div>
                
            </div>
            <div class="card-body">
                <div class="row px-3">
                    @if($parts->count() > 0)
                    <ul class="list-group col" id="partData1">
                        @foreach($parts as $key => $part)
                        @if($key%3 == 0)
                        <div class="dropdown">
                            <li class="list-group-item list-group-item-primary" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                <span class="dropdown-togle" type="button" title="Click to Open Menu" data-bs-toggle="tooltip" data-bs-placement="right">{{ $part->name }}</span>
                                <ul class="dropdown-menu">
                                    <span class="ms-3" style="font-size: 12px; cursor: text; display: block;">{{ $part->name }}</span>
                                    <li><button onclick="setPartModal(event)" class="dropdown-item" type="button" data-id="{{ $part->id }}" data-bs-toggle="modal" data-bs-target="#addEditPartModal" data-name="{{ $part->name }}" data-mode="edit">Edit</button></li>
                                    <hr class="my-1">
                                    <li><button onclick="deletePart({{ $part->id }})" class="dropdown-item text-white bg-danger" type="button">Delete</button></li>
                                </ul>
                            </li>
                        </div>
                        @endif
                        @endforeach
                    </ul>
                    <ul class="list-group col" id="partData2">
                        @foreach($parts as $key => $part)
                        @if($key%3 == 1)
                        <div class="dropdown">
                            <li class="list-group-item list-group-item-primary" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                <span class="dropdown-togle" type="button" title="Click to Open Menu" data-bs-toggle="tooltip" data-bs-placement="right">{{ $part->name }}</span>
                                <ul class="dropdown-menu">
                                    <span class="ms-3" style="font-size: 12px; cursor: text; display: block;">{{ $part->name }}</span>
                                    <li><button onclick="setPartModal(event)" class="dropdown-item" type="button" data-id="{{ $part->id }}" data-bs-toggle="modal" data-bs-target="#addEditPartModal" data-name="{{ $part->name }}" data-mode="edit">Edit</button></li>
                                    <hr class="my-1">
                                    <li><button onclick="deletePart({{ $part->id }})" class="dropdown-item text-white bg-danger" type="button">Delete</button></li>
                                </ul>
                            </li>
                        </div>
                        @endif
                        @endforeach
                    </ul>
                    <ul class="list-group col" id="partData3">
                        @foreach($parts as $key => $part)
                        @if($key%3 == 2)
                        <div class="dropdown">
                            <li class="list-group-item list-group-item-primary" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                <span class="dropdown-togle" type="button" title="Click to Open Menu" data-bs-toggle="tooltip" data-bs-placement="right">{{ $part->name }}</span>
                                <ul class="dropdown-menu">
                                    <span class="ms-3" style="font-size: 12px; cursor: text; display: block;">{{ $part->name }}</span>
                                    <li><button onclick="setPartModal(event)" class="dropdown-item" type="button" data-id="{{ $part->id }}" data-bs-toggle="modal" data-bs-target="#addEditPartModal" data-name="{{ $part->name }}" data-mode="edit">Edit</button></li>
                                    <hr class="my-1">
                                    <li><button onclick="deletePart({{ $part->id }})" class="dropdown-item text-white bg-danger" type="button">Delete</button></li>
                                </ul>
                            </li>
                        </div>
                        @endif
                        @endforeach
                    </ul>
                    @else
                    <ul class="list-group col">
                        <li class="list-group-item list-group-item-danger">No Data</li>
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('admins.modals.add-edit-model')
@include('admins.modals.add-edit-part')
<script>
    const modalAddEditModel = document.getElementById('addEditModelModal')
    const modelTitle = document.getElementById('modelTitle')
    const modelID = document.getElementById('modelID')
    const modelInput = document.getElementById('modelInput')
    const modelSaveBtn = document.getElementById('modelSaveBtn')
    const searchModelInput = document.getElementById('searchModelInput')

    const parts = {{ Js::from($parts) }}
    const modalAddEditPart = document.getElementById('addEditPartModal')
    const partTitle = document.getElementById('partTitle')
    const partID = document.getElementById('partID')
    const partInput = document.getElementById('partInput')
    const partBtn = document.getElementById('partBtn');
    const partSaveBtn = document.getElementById('partSaveBtn')
    const searchPartInput = document.getElementById('searchPartInput')
    const partData1 = document.getElementById('partData1')
    const partData2 = document.getElementById('partData2')
    const partData3 = document.getElementById('partData3')

    document.addEventListener('DOMContentLoaded', function() {
        addEditModelModal = new bootstrap.Modal(modalAddEditModel);
        addEditPartModal = new bootstrap.Modal(modalAddEditPart);
    })

    /* -------------------------------------------------------------------------- */
    /*                                    Model                                   */
    /* -------------------------------------------------------------------------- */
    modalAddEditModel.addEventListener('hide.bs.modal', function() {
        modelTitle.innerHTML = ""
        modelID.value = ""
        modelInput.value = ""
        removeValidation()
    })

    function setModelModal(event) {
        const et = event.target
        const mode = et.getAttribute('data-mode')

        if (mode == 'add') {
            modelTitle.innerHTML = "Add New Model"
        } else {
            modelTitle.innerHTML = "Update Current Model"
            modelID.value = et.getAttribute('data-id')
            modelInput.value = et.getAttribute('data-name')
        }
    }

    function modelFormCondition(boolval) {
        const modelCloseBtn = document.getElementById('modelCloseBtn')
        const btnClose = document.querySelector('.btn-close-model')

        modelCloseBtn.disabled = boolval
        btnClose.disabled = boolval
        modelInput.disabled = boolval
        modelSaveBtn.disabled = boolval

        if (boolval) {
            modelSaveBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            `
        } else {
            modelSaveBtn.innerHTML = "Save"
        }
    }

    modelSaveBtn.onclick = () => {
        const url = "{{ route('admin.model.store') }}"
        const data = {
            id: parseInt(modelID.value),
            model_name: modelInput.value
        }
        removeValidation()
        modelFormCondition(true)
        fetchStoreData(url, data, modelData)
        function modelData(data) {
            if (data.success) {
                addEditModelModal.hide()
                sessionStorage.setItem('alertMsg', data.message)
                location.reload()
            } else {
                setValidationError(data.data)
                modelFormCondition(false)
            }
        }
    }

    function deleteModel(id) {
        const url = "{{ route('admin.model.index') }}" + "/" + id
        const userConfirm = confirm("Are you sure delete this data?")
        if (userConfirm) {
            loadingStatus(true)
            fetchDeleteData(url)
        };
    }

    /* -------------------------------------------------------------------------- */
    /*                                    Part                                    */
    /* -------------------------------------------------------------------------- */
    modalAddEditPart.addEventListener('hide.bs.modal', function() {
        partTitle.innerHTML = ""
        partID.value = ""
        partInput.value = ""
        removeValidation()
    })

    function setPartModal(event) {
        const et = event.target
        const mode = et.getAttribute('data-mode')

        if (mode == 'add') {
            partTitle.innerHTML = "Add New Part"
        } else {
            partTitle.innerHTML = "Update Current Part"
            partID.value = et.getAttribute('data-id')
            partInput.value = et.getAttribute('data-name')
        }
    }

    function partFormCondition(boolval) {
        const partCloseBtn = document.getElementById('partCloseBtn')
        const btnClose = document.querySelector('.btn-close-part')

        partCloseBtn.disabled = boolval
        btnClose.disabled = boolval
        partInput.disabled = boolval
        partSaveBtn.disabled = boolval

        if (boolval) {
            partSaveBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            `
        } else {
            partSaveBtn.innerHTML = "Save"
        }
    }

    partSaveBtn.onclick = () => {
        const url = "{{ route('admin.part.store') }}"
        const data = {
            id: parseInt(partID.value),
            part_name: partInput.value
        }
        removeValidation()
        partFormCondition(true)
        fetchStoreData(url, data, partData)
        function partData(data) {
            if (data.success) {
                addEditPartModal.hide()
                sessionStorage.setItem('alertMsg', data.message)
                location.reload()
            } else {
                setValidationError(data.data)
                partFormCondition(false)
            }
        }
    }

    function deletePart(id) {
        const url = "{{ route('admin.part.index') }}" + "/" + id
        const userConfirm = confirm("Are you sure delete this data?")
        if (userConfirm) {
            loadingStatus(true)
            fetchDeleteData(url)
        };
    }

    /* -------------------------------------------------------------------------- */
    /*                               Search Function                              */
    /* -------------------------------------------------------------------------- */
    function attachPartData(data) {
        let html;

        partData1.innerHTML = '';
        partData2.innerHTML = '';
        partData3.innerHTML = '';
        data.forEach((el, index) => {
            html = `
                <div class="dropdown">
                    <li class="list-group-item list-group-item-primary" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                        <span class="dropdown-togle" type="button" title="Click to Open Menu" data-bs-toggle="tooltip" data-bs-placement="right">${el.name}</span>
                        <ul class="dropdown-menu">
                            <span class="ms-3" style="font-size: 12px; cursor: text; display: block;">${el.name}</span>
                            <li><button onclick="setPartModal(event)" class="dropdown-item" type="button" data-id="${el.id}" data-bs-toggle="modal" data-bs-target="#addEditPartModal" data-name="${el.name}" data-mode="edit">Edit</button></li>
                            <hr class="my-1">
                            <li><button onclick="deletePart(${el.id})" class="dropdown-item text-white bg-danger" type="button">Delete</button></li>
                        </ul>
                    </li>
                </div>
            `;
            if (index%3 == 0) {
                partData1.insertAdjacentHTML('beforeend', html);
            } else if (index%3 == 1) {
                partData2.insertAdjacentHTML('beforeend', html);
            } else if (index%3 == 2) {
                partData3.insertAdjacentHTML('beforeend', html);
            }
        });
    }

    function searchPart(event) {
        const keywords = event.target.value;
        const url = '{{ route('admin.search.part') }}'
        let data = {
            keywords: keywords,
        }
        if (event.key === "Enter") {
            loadingStatus(true)
            if (keywords != '') {
                fetchStoreData(url, data, searchPartData)
            } else location.reload();
        };
        function searchPartData(data) {
            // console.log(data);
            loadingStatus(false)
            attachPartData(data.data);
        }
    }

    function searchModel(event) {
        const keywords = event.target.value;
        const url = '{{ route('admin.search.model') }}';
        let data = {
            keywords: keywords,
        }
        if (event.key === "Enter") {
            loadingStatus(true)
            if (keywords != '') {
                fetchStoreData(url, data, searchModelData)
            } else location.reload();
        };
        function searchModelData(data) {
            const modelUL = document.getElementById('modelUL');
            const models = data.data
            let html
            loadingStatus(true)
            modelUL.innerHTML = "";
            models.forEach(el => {
                html = `
                    <div class="dropdown">
                        <li class="list-group-item list-group-item-info model" id="${el.name}" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                            <span class="dropdown-togle" type="button" title="Click to Open Menu" data-bs-toggle="tooltip" data-bs-placement="right">${el.name}</span>
                            <ul class="dropdown-menu">
                                <span class="ms-3" style="font-size: 12px; cursor: text; display: block;">${el.name}</span>
                                <li><button onclick="relatedPart(event)" class="dropdown-item" type="button" data-id="${el.id}" data-model="${el.name}">Related Part</button></li>
                                <li><button onclick="setModelModal(event)" class="dropdown-item" type="button" data-id="${el.id}" data-name="${el.name}" data-bs-toggle="modal" data-bs-target="#addEditModelModal" data-mode="edit">Edit</button></li>
                                <hr class="my-1">
                                <li><button onclick="deleteModel(${el.id})" class="dropdown-item text-white bg-danger" type="button">Delete</button></li>
                            </ul>
                        </li>
                    </div>
                `
                modelUL.insertAdjacentHTML('beforeend', html);
            });
        }
    }
    
    /* -------------------------------------------------------------------------- */
    /*                           Relation Model vs Part                           */
    /* -------------------------------------------------------------------------- */

    function relatedPart(event) {
        /* ----------------------------- DOM Preparation ---------------------------- */
        const et = event.target
        const modelName = et.getAttribute('data-model')
        const modelUL = document.getElementById('modelUL')
        const addModelBtn = document.getElementById('addModelBtn')
        let html

        modelUL.innerHTML = ""
        partBtn.disabled = true
        partBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;&nbsp;Loading...';
        partBtn.setAttribute('onclick', 'syncPart(event)')
        partBtn.removeAttribute('data-bs-toggle')
        partBtn.setAttribute('data-model-id', et.getAttribute('data-id'))
        searchPartInput.disabled = true
        searchModelInput.disabled = true
        addModelBtn.disabled = true

        html = `
            <li class="list-group-item list-group-item-info active">
                ${modelName}
            </li>
        `
        modelUL.insertAdjacentHTML('beforeend', html);

        partData1.innerHTML = "";
        partData2.innerHTML = "";
        partData3.innerHTML = "";

        /* ------------------------ Fetch relation part data ------------------------ */
        const url = '{{ route('admin.part.index') }}' + '/' + et.getAttribute('data-id');
        const cancelSyncPart = document.getElementById('cancelSyncPart')
        let partIdData = [];
        loadingStatus(true)
        fetchGetData(url, syncModelPartData)

        function syncModelPartData(data) {
            let partHTML
            cancelSyncPart.style.display = 'inline-block';
            partBtn.innerHTML = "Sync Part to Model";
            partBtn.disabled = false;
            if (data.length > 0) {
                data.forEach(el => {
                    partIdData.push(el.id)
                });
            }
            parts.forEach((el, index) => {
                let onChecked = false;
                if (partIdData.length > 0) {
                    for (let i = 0; i < partIdData.length; i++) {
                        const partID = partIdData[i];
                        if (partID == el.id) {
                            onChecked = true;
                            break;
                        }
                    }
                }
                partHTML = `
                    <li class="list-group-item ${onChecked ? 'list-group-item-success' : 'list-group-item-primary'}">
                        <div class="form-check">
                            <input class="form-check-input sync-part" type="checkbox" value="${el.id}" id="checkPart_${el.id}" ${onChecked ? 'checked' : ''} style="cursor: pointer;">
                            <label class="form-check-label" for="checkPart_${el.id}" style="cursor: pointer;">
                                ${el.name}
                            </label>
                        </div>
                    </li>
                `;
                if (index%3 == 0) {
                    partData1.insertAdjacentHTML('beforeend', partHTML);
                } else if (index%3 == 1) {
                    partData2.insertAdjacentHTML('beforeend', partHTML);
                } else if (index%3 == 2) {
                    partData3.insertAdjacentHTML('beforeend', partHTML);
                }
            });
            // console.log(parts);
            loadingStatus(false)
        }
    }

    function syncPart(event) {
        const syncPartDOM = document.querySelectorAll('.sync-part');
        const dataModelID = event.target.getAttribute('data-model-id');
        let syncPartData = [];

        partBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;&nbsp;Loading...';
        partBtn.disabled = true
        syncPartDOM.forEach(el => {
            if (el.checked === true) {
                syncPartData.push(parseInt(el.value));
            }
        });
        const data = {
            id: parseInt(dataModelID),
            parts: syncPartData,
        }

        loadingStatus(true)
        syncPartSave(data);

        function syncPartSave(data) {
            const url = '{{ route('admin.model.index') }}' + '/' + data.id;
            fetch(url, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                        .content,
                },
                body: JSON.stringify(data),
            })
                .then((res) => res.json())
                .then((res) => {
                    // sessionStorage.setItem('alertMsg', res.message)
                    // location.reload();
                    loadingStatus(false)
                    alert(res.message)
                    partBtn.disabled = false
                    partBtn.innerHTML = "Sync Part to Model";
                    setTimeout(() => {
                        location.reload()
                    }, 2000);
                })
                .catch((err) => console.warn(err))
        }
    }
</script>
@endsection