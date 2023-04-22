@extends('layouts.app')

@section('content')   
<div class="col p-2">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <button onclick="addMainProcess(event)" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addEditProcessModal" id="addMainProcess" data-mode="main">Add Main Process</button>
                </div>
                <div class="card-body">
                    <ul class="list-group col" id="processData1">
                        @if ($main_process->count() > 0)
                        @foreach ($main_process as $key => $mp)
                        <div class="dropdown">
                            <li class="list-group-item list-group-item-info {{ str_replace(' ', '', $mp->name) }} main-process" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                <span class="dropdown-togle" type="button" title="Click to Open Menu" data-bs-toggle="tooltip" data-bs-placement="right">{{ $mp->name }}</span>
                                <ul class="dropdown-menu">
                                    <span class="ms-3" style="font-size: 12px; cursor: text; display: block;">{{ $mp->name }}</span>
                                    <li><button onclick="relatedProcess(event)" class="dropdown-item" type="button" data-id="{{ $mp->id }}" data-mainprocess="{{ $mp->name }}">Related Process</button></li>
                                    <li><button onclick="editMainProcess(event)" class="dropdown-item" type="button" data-id="{{ $mp->id }}" data-main="{{ $mp->name }}" data-bs-toggle="modal" data-bs-target="#addEditProcessModal" data-mode="main">Edit</button></li>
                                    <hr class="my-1">
                                    <li><button onclick="deleteProcess(event)" class="dropdown-item text-white bg-danger" type="button" data-id="{{ $mp->id }}" data-mode="main">Delete</button></li>
                                </ul>
                            </li>
                        </div>
                        @endforeach
                        @else
                        <li class="list-group-item list-group-item-danger" style="cursor: pointer;">No Data</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <button onclick="addMainProcess(event)" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addEditProcessModal" id="addProcess" data-mode="process">Add Process</button>
                    <span>
                        <input onkeydown="searchProcess(event)" type="text" class="form-control" id="searchMainProcess" placeholder="Search here...">
                    </span>
                </div>
                <div class="card-body">
                    <div class="row px-3" id="cardPart">
                        @if($process->count() > 0)
                        <ul class="list-group col" id="processData2">
                            @foreach($process as $key => $proc)
                                @if($key %3 == 0)
                                <div class="dropdown">
                                    <li class="list-group-item list-group-item-primary" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                        <span class="dropdown-togle" type="button" title="Click to Open Menu" data-bs-toggle="tooltip">{{ $proc->name }}</span>
                                        <ul class="dropdown-menu">
                                            <span class="ms-3" style="font-size: 12px; cursor: text; display: block;">{{ $proc->name }}</span>
                                            <li><button onclick="editMainProcess(event)" class="dropdown-item" type="button" data-id="{{ $proc->id }}" data-mainprocess-id="{{ $proc->main_process_id }}" data-bs-toggle="modal" data-bs-target="#addEditProcessModal" data-mode="process" data-process="{{ $proc->name }}">Edit</button></li>
                                            <hr class="my-1">
                                            <li><button onclick="deleteProcess(event)" class="dropdown-item text-white bg-danger" type="button" data-id="{{ $proc->id }}" data-mode="process">Delete</button></li>
                                        </ul>
                                    </li>
                                </div>
                                @endif
                            @endforeach
                        </ul>
                        <ul class="list-group col" id="processData3">
                            @foreach($process as $key => $proc)
                                @if($key %3 == 1)
                                <div class="dropdown">
                                    <li class="list-group-item list-group-item-primary" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                        <span class="dropdown-togle" type="button" title="Click to Open Menu" data-bs-toggle="tooltip">{{ $proc->name }}</span>
                                        <ul class="dropdown-menu">
                                            <span class="ms-3" style="font-size: 12px; cursor: text; display: block;">{{ $proc->name }}</span>
                                            <li><button onclick="editMainProcess(event)" class="dropdown-item" type="button" data-id="{{ $proc->id }}" data-mainprocess-id="{{ $proc->main_process_id }}" data-bs-toggle="modal" data-bs-target="#addEditProcessModal" data-mode="process" data-process="{{ $proc->name }}">Edit</button></li>
                                            <hr class="my-1">
                                            <li><button onclick="deleteProcess(event)" class="dropdown-item text-white bg-danger" type="button" data-id="{{ $proc->id }}" data-mode="process">Delete</button></li>
                                        </ul>
                                    </li>
                                </div>
                                @endif
                            @endforeach
                        </ul>
                        <ul class="list-group col" id="processData4">
                            @foreach($process as $key => $proc)
                                @if($key %3 == 2)
                                <div class="dropdown">
                                    <li class="list-group-item list-group-item-primary" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                        <span class="dropdown-togle" type="button" title="Click to Open Menu" data-bs-toggle="tooltip">{{ $proc->name }}</span>
                                        <ul class="dropdown-menu">
                                            <span class="ms-3" style="font-size: 12px; cursor: text; display: block;">{{ $proc->name }}</span>
                                            <li><button onclick="editMainProcess(event)" class="dropdown-item" type="button" data-id="{{ $proc->id }}" data-mainprocess-id="{{ $proc->main_process_id }}" data-bs-toggle="modal" data-bs-target="#addEditProcessModal" data-mode="process" data-process="{{ $proc->name }}">Edit</button></li>
                                            <hr class="my-1">
                                            <li><button onclick="deleteProcess(event)" class="dropdown-item text-white bg-danger" type="button" data-id="{{ $proc->id }}" data-mode="process">Delete</button></li>
                                        </ul>
                                    </li>
                                </div>
                                @endif
                            @endforeach
                        </ul>
                        @else
                        <ul class="list-group col">
                            <li class="list-group-item list-group-item-danger" style="cursor: pointer;">No Data</li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admins.modals.add-edit-process')
<script>
    const modalAddEditProcess = document.getElementById('addEditProcessModal')
    const processTitle = document.getElementById('processTitle');
    const processInput = document.getElementById('processInput');
    const processLabel = document.getElementById('processLabel');
    const processID = document.getElementById('processID');
    const processSaveBtn = document.getElementById('processSaveBtn')

    document.addEventListener('DOMContentLoaded', function() {
        addEditProcessModal = new bootstrap.Modal(addEditProcessModal)
    })

    function addMainProcess(event) { // both for main process and process
        const mode = event.target.getAttribute('data-mode');
        processFormData(mode, true);
    }

    function processFormData(mode, addMode) {
        let title, label;
        const msg = addMode ? "Add" : "Update";
        const input = addMode ? "" : event.target.getAttribute(`data-${mode}`);
        switch (mode) {
            case 'main':
                title = msg + " Main Process";
                label = 'Main Process Name';
                selectMainProcess.style.display = 'none';
                break;
        
            case 'process':
                title = msg + " Process";
                label = 'Process Name';
                selectMainProcess.style.display = 'block';
                break;
        }
        modeProcess.value = mode;
        processTitle.innerHTML = title;
        processInput.value = input;
        processLabel.innerHTML = label;
    }

    function editMainProcess(event) { // both for main process and process
        const mode = event.target.getAttribute('data-mode');
        processID.value = event.target.getAttribute('data-id');
        const mainProcessID = event.target.getAttribute('data-mainprocess-id');
        const optMainProcess = document.querySelectorAll('.opt-main-process');
        optMainProcess.forEach(el => {
            el.value == mainProcessID ? el.selected = true : el.selected = false;
        });
        processFormData(mode, false);
    }

    modalAddEditProcess.addEventListener('hide.bs.modal', event => {
        processInput.value = '';
        selectMainProcess.selectedIndex = 0;
        processFormCondition(false)
        removeValidation()
    })

    function processFormCondition(boolval) {
        const partCloseBtn = document.getElementById('processCloseBtn') // Modal close button
        const btnClose = document.querySelector('.btn-close-process')

        partCloseBtn.disabled = boolval
        btnClose.disabled = boolval
        processSaveBtn.disabled = boolval
        selectMainProcess.disabled = boolval
        processInput.disabled = boolval

        if (boolval) {
            processSaveBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
            `
        } else processSaveBtn.innerHTML = 'Save';
    }

    processSaveBtn.onclick = () => {
        processFormCondition(true)
        removeValidation()
        const data = {
            id: processID.value,
            process_name: processInput.value,
            mode: modeProcess.value,
            main_process_id: selectMainProcess.selectedIndex !== 0 ? parseInt(selectMainProcess.value) : '',
        }
        const url = "{{ route('admin.process.store') }}"
        fetchStoreData(url, data, addEditProcess);
        function addEditProcess (data) {
            if (data.success) {
                addEditProcessModal.hide();
                sessionStorage.setItem('alertMsg', data.message)
                location.reload();
            } else {
                setValidationError(data.data)
                processFormCondition(false)
            }
        }
    }

    function deleteProcess(event) {
        const userConfirm = confirm('Are you sure to delete this data?');
        if (userConfirm) {
            const mode = event.target.getAttribute('data-mode');
            const id = parseInt(event.target.getAttribute('data-id'));
            const url = '{{ route('admin.process.index') }}' + '/' + id;
            loadingStatus(true)
            fetch(url, {
                method: 'DELETE',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                        .content,
                },
                body: JSON.stringify({
                    mode: mode,
                }),
            })
                .then((res) => res.json())
                .then((res) => {
                    sessionStorage.setItem('alertMsg', res.message)
                    location.reload();
                })
                .catch((err) => console.warn(err));
        }
    }

    function attachProcessData(data) {
        const cardPart = document.getElementById('cardPart')
        const backProcess = document.getElementById('backProcess')
        processData2.innerHTML = '';
        processData3.innerHTML = '';
        processData4.innerHTML = '';
        if (data.length > 0) {
            data.forEach((el, index) => {
                html = `
                    <div class="dropdown">
                        <li class="list-group-item list-group-item-primary" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                            <span class="dropdown-togle" type="button" title="Click to Open Menu">${el.name}</span>
                            <ul class="dropdown-menu">
                                <span class="ms-3" style="font-size: 12px; cursor: text; display: block;">${el.name}</span>
                                <li><button onclick="editMainProcess(event)" class="dropdown-item" type="button" data-id="${el.id}" data-mainprocess-id="${el.main_process_id}" data-bs-toggle="modal" data-bs-target="#addEditProcessModal" data-mode="process" data-process="${el.name}">Edit</button></li>
                                <hr class="my-1">
                                <li><button onclick="deleteProcess(event)" class="dropdown-item text-white bg-danger" type="button" data-id="${el.id}" data-mode="process">Delete</button></li>
                            </ul>
                        </li>
                    </div>
                `;
                if (index%3 == 0) {
                    processData2.insertAdjacentHTML('beforeend', html);
                } else if (index%3 == 1) {
                    processData3.insertAdjacentHTML('beforeend', html);
                } else if (index%3 == 2) {
                    processData4.insertAdjacentHTML('beforeend', html);
                }
                    
            });
        } else {
            const html = '<li class="list-group-item list-group-item-danger">No Data</li>'
            processData2.insertAdjacentHTML('beforeend', html);
        }

        if (!backProcess) {
            cardPart.insertAdjacentHTML('afterbegin', '<span id="backProcess" class="row" onclick="location.reload()" style="cursor: pointer; color: blue; text-decoration: underline;">Back</span>')
        }
        
    }

    function relatedProcess(event) {
        const et = event.target
        const mainProcessName = et.getAttribute('data-mainprocess').replace(' ', '');
        const mainProcessDOM = document.querySelectorAll(`.main-process`);
        const mainProcessActive = document.querySelector(`.${mainProcessName}`)
        const id = et.getAttribute('data-id');
        const url = '{{ route('admin.process.index') }}' + '/' + id;
        mainProcessDOM.forEach(el => {
            el.classList.remove('active');
        });
        loadingStatus(true)
        fetchGetData(url, relatedProcessData);
        function relatedProcessData(data) {
            // console.log(data);
            loadingStatus(false)
            const processes = data.processes;
            attachProcessData(processes);
            mainProcessActive.classList.add('active');
        }
    }

    function searchProcess(event) {
        const keywords = event.target.value;
        const url = '{{ route('admin.search.process') }}'
        let data = {
            keywords: keywords,
        }
        if (event.key === "Enter") {
            loadingStatus(true)
            if (keywords != '') {
                fetchStoreData(url, data, searchProcessData)
            } else location.reload();
        };
        function searchProcessData(data) {
            loadingStatus(false)
            attachProcessData(data.data);
        }
    }
</script>
@endsection