@extends('layouts.app')

@section('content')
<div class="row">
        <!-- Department -->
        <div class="col-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span class="fw-semibold">Department</span>
                    <button onclick="setDepartmentModal(event)" id="addDepartmentBtn" class="btn btn-success btn-sm" data-mode="add" data-bs-toggle="modal" data-bs-target="#addEditDepartmentModal">Add Department</button>
                </div>
                <div class="card-body">
                    <ul class="list-group col" id="departmentList">
                        @if($departments->count() > 0)
                        @foreach($departments as $department)
                        <div class="dropdown">
                            <li class="list-group-item list-group-item-info department" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                <span class="dropdown-togle" type="button" title="Click to Open Menu" data-bs-toggle="tooltip" data-bs-placement="right">{{ $department->name }}</span>
                                <ul class="dropdown-menu">
                                    <span style="font-size: 12px; padding: 0px 15px; cursor: text;">{{ $department->name }}</span>
                                    
                                    <li><button onclick="setDepartmentModal(event)" class="dropdown-item" type="button" data-id="{{ $department->id }}" data-name="{{ $department->name }}" data-mode="edit" data-bs-toggle="modal" data-bs-target="#addEditDepartmentModal" data-edit-mode="edit">Edit</button></li>
                                    <hr class="my-1">
                                    <li><button onclick="deleteDepartment({{ $department->id }})" class="dropdown-item text-white bg-danger" type="button" data-id="{{ $department->id }}">Delete</button></li>
                                </ul>
                            </li>
                        </div>
                        @endforeach
                        @else
                        <h6>No Data</h6>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <!-- Section -->
        <div class="col-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span class="fw-semibold">Section</span>
                    <button onclick="setSectionModal(event)" id="addSectionBtn" class="btn btn-success btn-sm" data-mode="add" data-bs-toggle="modal" data-bs-target="#addEditSectionModal">Add Section</button>
                </div>
                <div class="card-body" id="sectionList">
                    <div class="row">
                        @if($departments->count() > 0)
                        @foreach($departments as $department)
                        <div class="col-6 mb-3">
                            <div class="card">
                                <div class="card-header bg-primary" style="color: white; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#addEditSectionModal">
                                    <span onclick="setSectionModal(event)" data-department-id="{{ $department->id }}" data-mode="add" title="Click to add section" data-bs-toggle="tooltip">{{ $department->name}}</span>
                                </div>
                                <ul class="list-group list-group-flush">
                                    @if($department->sections->count() > 0)
                                    @foreach($department->sections as $section)
                                    <div class="dropdown">
                                        <li class="list-group-item" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                            <span class="dropdown-togle" type="button" title="Click to Open Menu" data-bs-toggle="tooltip" data-bs-placement="right">{{ $section->name }}</span>
                                            <ul class="dropdown-menu">
                                                <span style="font-size: 12px; padding: 0px 15px; cursor: text;">{{ $section->name }}</span>
                                                
                                                <li><button onclick="setSectionModal(event)" class="dropdown-item" type="button" data-department-id="{{ $department->id }}" data-id="{{ $section->id }}" data-name="{{ $section->name }}" data-mode="edit" data-bs-toggle="modal" data-bs-target="#addEditSectionModal" data-edit-mode="edit">Edit</button></li>
                                                <hr class="my-1">
                                                <li><button onclick="deleteSection({{ $section->id }})" class="dropdown-item text-white bg-danger" type="button" data-id="{{ $section->id }}">Delete</button></li>
                                            </ul>
                                        </li>
                                    </div>
                                    @endforeach
                                    @else
                                    <li class="list-group-item list-group-item-danger">No Data</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <h6>No Data</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('admins.modals.add-edit-department')
@include('admins.modals.add-edit-section')
<script>
    const modalAddEditDepartment = document.getElementById('addEditDepartmentModal')
    const departmentTitle = document.getElementById('departmentTitle')
    const departmentID = document.getElementById('departmentID')
    const departmentInput = document.getElementById('departmentInput')
    const departmentSaveBtn = document.getElementById('departmentSaveBtn')

    const modaladdEditSection = document.getElementById('addEditSectionModal')
    const sectionTitle = document.getElementById('sectionTitle')
    const sectionID = document.getElementById('sectionID')
    const sectionInput = document.getElementById('sectionInput')
    const selectSection = document.getElementById('selectSection')
    const sectionSaveBtn = document.getElementById('sectionSaveBtn')

    document.addEventListener('DOMContentLoaded', function() {
        addEditDepartmentModal = new bootstrap.Modal(modalAddEditDepartment);
        addEditSectionModal = new bootstrap.Modal(modaladdEditSection);
    })

    /* -------------------------------------------------------------------------- */
    /*                                 Department                                 */
    /* -------------------------------------------------------------------------- */
    modalAddEditDepartment.addEventListener('hide.bs.modal', function() {
        departmentTitle.innerHTML = ""
        departmentID.value = ""
        departmentInput.value = ""
        departmentSaveBtn.disabled = false
        departmentSaveBtn.innerHTML = "Save"
        departmentFormCondition(false)
        removeValidation()
    })

    function setDepartmentModal(event) {
        const mode = event.target.getAttribute('data-mode')
        
        if (mode == 'add') {
            departmentTitle.innerHTML = "Add New Department"
        } else {
            departmentTitle.innerHTML = `Update Current Department`
            departmentID.value = event.target.getAttribute('data-id')
            departmentInput.value = event.target.getAttribute('data-name')
        }
    }

    function departmentFormCondition(boolval) {
        const departmentCloseBtn = document.getElementById('departmentCloseBtn')
        const btnClose = document.querySelector('.btn-close-department')
        departmentInput.disabled = boolval
        departmentSaveBtn.disabled = boolval
        departmentCloseBtn.disabled = boolval
        btnClose.disabled = boolval
        if (boolval) {
            departmentSaveBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            `
        } else {
            departmentSaveBtn.innerHTML = "Save"

        }
    }

    departmentSaveBtn.onclick = () => {
        const url = "{{ route('admin.department.store') }}"
        const data = {
            id: parseInt(departmentID.value),
            department_name: departmentInput.value
        }
        removeValidation()
        departmentFormCondition(true)
        fetchStoreData(url, data, departmentData)
        function departmentData(data) {
            if (data.success) {
                addEditDepartmentModal.hide();
                sessionStorage.setItem('alertMsg', data.message)
                location.reload()
            } else {
                setValidationError(data.data)
                departmentFormCondition(false)
            }
        }
    }

    function deleteDepartment(id) {
        const url = '{{ route("admin.department.index") }}' + '/' + id
        const userConfirm = confirm("Are you sure delete this data?")
        if (userConfirm) {
            loadingStatus(true)
            fetchDeleteData(url)
        };
    }

    /* -------------------------------------------------------------------------- */
    /*                                   Section                                  */
    /* -------------------------------------------------------------------------- */
    modaladdEditSection.addEventListener('hidden.bs.modal', function(){
        selectSection.options[0].selected = true
        sectionInput.value = ""
        sectionID.value = ""
        sectionFormCondition(false)
        removeValidation()
    })

    function setSectionModal(event) {
        const mode = event.target.getAttribute('data-mode')
        const departmentID = event.target.getAttribute('data-department-id')
        if (mode == 'add') {
            sectionTitle.innerHTML = "Add New "
            if (departmentID) {
                for (let i = 0; i < selectSection.length; i++) {
                    if (departmentID == selectSection.options[i].value) {
                        selectSection.options[i].selected = true
                    }
                }
            }
        } else {
            sectionTitle.innerHTML = "Edit "
            sectionInput.value = event.target.getAttribute('data-name')
            sectionID.value = event.target.getAttribute('data-id')
            for (let i = 0; i < selectSection.length; i++) {
                if (departmentID == selectSection.options[i].value) {
                    selectSection.options[i].selected = true
                }
            }
        }
        sectionTitle.innerHTML += "Section"
    }

    function sectionFormCondition(boolval) {
        const sectionCloseBtn = document.getElementById('sectionCloseBtn')
        const btnClose = document.querySelector('.btn-close-section')

        sectionCloseBtn.disabled = boolval
        selectSection.disabled = boolval
        sectionInput.disabled = boolval
        sectionSaveBtn.disabled = boolval
        btnClose.disabled = boolval

        if (boolval) {
            sectionSaveBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            `
        } else {
            sectionSaveBtn.innerHTML = "Save"
        }
    }

    sectionSaveBtn.onclick = () => {
        const url = "{{ route('admin.section.store') }}"
        const depID = selectSection.options[selectSection.selectedIndex].value
        const data = {
            department_id: parseInt(depID),
            id: parseInt(sectionID.value),
            section_name: sectionInput.value
        }
        removeValidation()
        sectionFormCondition(true)
        fetchStoreData(url, data, sectionData)
        function sectionData(data) {
            if (data.success) {
                addEditSectionModal.hide()
                sessionStorage.setItem('alertMsg', data.message)
                location.reload();
            } else {
                setValidationError(data.data)
                sectionFormCondition(false)
            }
        }
    }

    function deleteSection(id) {
        const url = '{{ route('admin.section.index') }}' + '/' + id
        const userConfirm = confirm('Are you sure want to delete this data?')
        if (userConfirm) {
            loadingStatus(true)
            fetchDeleteData(url)
        }
    }
</script>
@endsection