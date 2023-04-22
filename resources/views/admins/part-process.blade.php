@extends('layouts.app')

@section('content')
<div class="col p-2">
    <!-- Selection menu for Model and Part -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span class="fw-semibold">Part and Process Selection</span>
                    <button class="btn btn-sm btn-success" data-bs-toggle="tooltip" title="Save and synchronization Model, Part & Process" id="partProcessSaveBtn">Save Data</button>
                </div>
                <div class="card-body">
                    <!-- Selection menu -->
                    <div class="row">
                        <div class="col-3" name="model_id">
                            <select class="form-select" aria-label="Default select example" id="selectForModel">
                                <option selected>Choose Model...</option>
                                
                            </select>
                        </div>
                        <div class="col-4" name="part_id">
                            <select class="form-select" aria-label="Default select example" id="selectForPart" disabled>
                                <option selected>Choose Part...</option>
                                
                            </select>
                        </div>
                        <div class="col-5" name="main_process_id">
                            <select class="form-select" aria-label="Default select example" id="selectForMainProcess" disabled>
                                <option selected>Choose Main Process...</option>
                                
                            </select>
                        </div>
                    </div>
                    <!-- Relationship Part and Process -->
                    <div class="row mt-2">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Relation with Process
                                </div>
                                <div class="card-body" name="process_id">
                                    <div class="row px-3">
                                        <ul class="list-group col" id="mainProcessData1">
                                            
                                        </ul>
                                        <ul class="list-group col" id="mainProcessData2">

                                        </ul>
                                        <ul class="list-group col" id="mainProcessData3">

                                        </ul>
                                        <ul class="list-group col" id="mainProcessData4">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
    const models = {{ Js::from($models) }}
    const mainProcesses = {{ Js::from($main_processes) }}
    const selectForModel = document.getElementById('selectForModel');
    const selectForPart = document.getElementById('selectForPart');
    const selectForMainProcess = document.getElementById('selectForMainProcess');
    const partProcessSaveBtn = document.getElementById('partProcessSaveBtn');

    document.addEventListener("DOMContentLoaded", function() {
        loadModelData();
        loadMainProcessesData();
        
    });
    const loadMainProcessesData = () => {
        let html;
        mainProcesses.forEach((el, index) => {
            html = `
                <option key="${index}" value="${el.id}">${el.name}</option>
            `
            selectForMainProcess.insertAdjacentHTML('beforeend', html);
        });
    }
    const loadModelData = () => {
        let html;
        models.forEach((el, index) => {
            html = `
                <option key="${index}" value="${el.id}">${el.name}</option>
            `
            selectForModel.insertAdjacentHTML('beforeend', html);
        });
    }
    selectForModel.onchange = () => {
        const modelIndex = selectForModel.options[selectForModel.selectedIndex].getAttribute('key')
        selectForPart.innerHTML = '<option selected">Choose Part...</option>'
        if (modelIndex !== null) {
            const parts = models[modelIndex].parts;
            if(parts.length > 0) {
                // console.log(parts);
                let html;
                parts.forEach((el, index) => {
                    html = `
                    <option key="${index}" value="${el.id}">${el.name}</option>
                    `
                    selectForPart.insertAdjacentHTML('beforeend', html);
                });
                selectForPart.disabled = false;
            } else {
                selectForPart.disabled = true;
                alert(`No parts data on ${models[modelIndex].name}\nPlease add parts on Master Part menu or contact your Administrator`)
            }
        };
        for (i = 1; i < 5; i++) {
            const tempData = document.getElementById(`mainProcessData${i}`)
            tempData.innerHTML = ""
        }
        selectForPart.focus()
    }
    selectForPart.addEventListener('change', function() {
        
        selectForMainProcess.disabled = false;
        selectForMainProcess.focus()
        attachProcessData()
    })
    /**
    * DOM for filling up process name to display
    */
    function attachProcessData() {
        const mainProcessData1 = document.getElementById('mainProcessData1');
        const mainProcessData2 = document.getElementById('mainProcessData2');
        const mainProcessData3 = document.getElementById('mainProcessData3');
        const mainProcessData4 = document.getElementById('mainProcessData4');
        const mainProcessIndex = selectForMainProcess.options[selectForMainProcess.selectedIndex].getAttribute('key');
        const processData = mainProcessIndex != null ? mainProcesses[mainProcessIndex].processes : [];
        const partId = selectForPart.options[selectForPart.selectedIndex].value;
        
        if (selectForModel.selectedIndex !== 0 && selectForPart.selectedIndex !== 0 && selectForMainProcess.selectedIndex !== 0) {
            mainProcessData1.innerHTML = '';
            mainProcessData2.innerHTML = '';
            mainProcessData3.innerHTML = '';
            mainProcessData4.innerHTML = '';
            let processID = [];
            let processIndex = [];
            if (processData.length > 0) {
                let html, onChecked;
                const modelSelected = models[selectForModel.options[selectForModel.selectedIndex].getAttribute('key')]
                const partSelected = modelSelected.parts[selectForPart.options[selectForPart.selectedIndex].getAttribute('key')];
                const selectedProcesses = modelSelected.processes
                const mainProcess = selectForMainProcess.value;

                selectedProcesses.forEach((el, index) => {
                    const processPivot = el.pivot;
                    if (processPivot.main_process_id == mainProcess && processPivot.model_id == modelSelected.id && processPivot.part_id == partSelected.id) {
                        processID.push(el.id)
                        // processIndex.push(index)
                    }
                });
                // console.log(processID);
                // console.log(processIndex);
                processData.forEach((el, index) => {
                    if (processID.length > 0) {
                        onChecked = false;
                        for (i = 0; i < processID.length; i++){
                            if (processID[i] == el.id) {
                                onChecked = true;
                                break;
                            }
                        }
                    }
                    html = `
                        <li class="list-group-item ${onChecked ? 'list-group-item-warning' : 'list-group-item-success'}">
                            <div class="form-check">
                                <input class="form-check-input process" type="checkbox" value="${el.id}" id="checkPart_${el.id}" style="cursor: pointer;" ${onChecked ? 'checked' : ''}>
                                <label class="form-check-label" for="checkPart_${el.id}" style="cursor: pointer;">
                                    ${el.name}
                                </label>
                            </div>
                        </li>
                    `
                    if (index%4 == 0) {
                        mainProcessData1.insertAdjacentHTML('beforeend', html);
                    } else if (index%4 == 1) {
                        mainProcessData2.insertAdjacentHTML('beforeend', html);
                    } else if (index%4 == 2) {
                        mainProcessData3.insertAdjacentHTML('beforeend', html);
                    } else if (index%4 == 3) {
                        mainProcessData4.insertAdjacentHTML('beforeend', html);
                    }
                });
            } else {
                mainProcessData1.innerHTML = `<span>-No Data-</span>`;
                mainProcessData2.innerHTML = '';
                mainProcessData3.innerHTML = '';
                mainProcessData4.innerHTML = '';
                if (mainProcessIndex != null) {
                    alert(`No process data for ${mainProcesses[mainProcessIndex].name}\nPlease add process on Master Process Menu or contact your Administrator`)
                }
            }
        }
    }
    selectForMainProcess.addEventListener('change', function() {
        attachProcessData()
    })
    partProcessSaveBtn.addEventListener('click', function() {
        removeValidation();
        this.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
        `
        this.disabled = true;
        const url = '{{ route('admin.part-process.store') }}'
        const data = {
                model_id: parseInt(selectForModel.value),
                part_id: parseInt(selectForPart.value),
                main_process_id: parseInt(selectForMainProcess.value),
                process_id: getProcessDataId()
        }
        loadingStatus(true)
        fetchStoreData(url, data, partProcessStructureSync);
        function partProcessStructureSync(data) {
            partProcessSaveBtn.innerHTML = 'Save data';
            partProcessSaveBtn.disabled = false;
            loadingStatus(false)
            if(!data.success) { // validation error
                const errorNames = Object.keys(data.data)
                const errorMessages = data.data
                // console.log(errorNames);
                for (i = 0; i < errorNames.length; i++) {
                    const divForError = document.querySelector(`div[name="${errorNames[i]}"]`);
                    const html1 = `
                        <span class="error" style="color: red; font-size: 14px;">${errorMessages[errorNames[i]]}</span>
                    `
                    const errorPos = errorNames[i] != 'process_id' ? 'beforeend' : 'afterbegin';
                    divForError.insertAdjacentHTML(errorPos, html1)
                }
            } else {
                // console.log(data);
                alert(data.message)
                setTimeout(() => {
                    location.reload()
                }, 2000);
            }
        }
    })
    function getProcessDataId() {
        const processDataAll = document.querySelectorAll('.process');
        let arrayProcess = [];
        if (processDataAll.length > 0) {
            processDataAll.forEach((el, index) => {
                if (el.checked === true) {
                    arrayProcess.push(parseInt(el.value));
                }
            });
        }
        return arrayProcess;
    }
    
</script>
@endsection