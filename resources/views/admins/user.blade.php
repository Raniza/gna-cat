@extends('layouts.app')

@section('content')
<div class="col p-2">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span class="fw-semibold">User</span>
                    <form class="d-flex" role="search" method="POST" action="{{ route('user.search') }}">
                        @csrf
                        <input class="form-control me-2 form-control-sm" type="search" placeholder="Search" aria-label="Search" name="keywords" value="{{ old('keywords') }}">
                        <button class="btn btn-outline-success btn-sm" type="submit">Search</button>
                    </form>
            <button onclick="addUser()" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addEditUserModal">Add User</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm fs-7">
                    <thead class="table-success">
                        <tr>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Section</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->count() > 0)
                        @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $key }}</td>
                            <td>{{ $user->nik }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->position->name }}</td>
                            <td>{{ $user->department->name }}</td>
                            <td>{{ $user->section->name }}</td>
                            <td>{{ $user->isAdmin == 1 ? "Admin" : "User" }}</td>
                            <td style="white-space: nowrap;">
                                <button type="button" onclick="editUser(event)" class="btn badge rounded-pill text-bg-primary" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-nik="{{ $user->nik }}" data-email="{{ $user->email }}"
                                    data-position="{{ $user->position->id }}" data-department="{{ $user->department->id }}" data-section="{{ $user->section->id }}" data-isadmin="{{ $user->isAdmin }}">
                                    Edit
                                </button>
                                <button type="button" onclick="deleteUser({{ $user->id }})" class="btn badge rounded-pill text-bg-danger" data-id="{{ $user->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8">No Data</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
            
        </div>
    </div>
</div>
@include('admins.modals.add-edit-user')
<script>
    'use strict'
    const departmentDatas = {{ Js::from($departments) }}

    const isAdmin = document.getElementById('isAdmin')
    const department = document.getElementById('department')
    const section = document.getElementById('section')
    const modalAddEditUser = document.getElementById('addEditUserModal')
    const addEditUserModalLabel = document.getElementById('addEditUserModalLabel')
    const userId = document.getElementById('userId')
    const nik = document.getElementById('nik')
    const userName = document.getElementById('userName')
    const email = document.getElementById('email')
    const position = document.getElementById('position')
    const btnSaveUser = document.getElementById('btnSaveUser')
    let addEditUserModal
    /* -------------------------------------------------------------------------- */
    /*                                Modal Set Up                                */
    /* -------------------------------------------------------------------------- */

    document.addEventListener('DOMContentLoaded', () => {
        addEditUserModal = new bootstrap.Modal(document.getElementById('addEditUserModal'))
    })

    modalAddEditUser.addEventListener('hidden.bs.modal', function() {
        removeValidation()
        addEditUserModalLabel.innerHTML = ""
        userId.value = ""
        nik.value = ""
        userName.value = ""
        email.value = ""
        position.options[0].selected = true
        department.options[0].selected = true
        section.innerHTML = '<option value="">Open this menu</option>'
        section.disabled = true
        isAdmin.checked = false
    })

    department.onchange = function() {
        const departmentIndex = this.options[department.selectedIndex].getAttribute('key')
        const sectionDatas = departmentIndex ? departmentDatas[departmentIndex].sections : ""

        async function setHTMLSection () {
            section.innerHTML = ''
            let html = '<option class="opt-section" value="">Open this menu</option>'
            for (let i = 0; i < sectionDatas.length; i++) {
                const sectId = sectionDatas[i].id
                const sectName = sectionDatas[i].name
                html += `
                    <option class="opt-section" value="${sectId}">${sectName}</option>
                `
            }
            return html
        }

        setHTMLSection().then(
            function (value) {
                if (departmentIndex) {
                    section.insertAdjacentHTML('beforeend', value)
                    section.disabled = false
                } else {
                    section.disabled = true
                    section.innerHTML = '<option class="opt-section" value="">Open this menu</option>'
                }
            }
        )
        
    }

    isAdmin.onchange = () => {
        const labelIsAdmin = document.getElementById('labelIsAdmin')
        if (isAdmin.checked) {
            labelIsAdmin.innerHTML = "Admin"
        } else {
            labelIsAdmin.innerHTML = "User"
        }
    }

    function addUser() {
        addEditUserModalLabel.innerHTML = "Add New User"
    }

    function editUser(event) {
        const et = event.target
        const positionId = et.getAttribute('data-position')
        const departmentId = et.getAttribute('data-department')
        const sectionId = et.getAttribute('data-section')
        const isAdminData = et.getAttribute('data-isadmin')
        const optPosition = document.querySelectorAll('.opt-position')
        const optDepartment = document.querySelectorAll('.opt-department')
        const optSection = document.querySelectorAll('.opt-section')

        addEditUserModalLabel.innerHTML = "Update User Data"
        userId.value = et.getAttribute('data-id')
        nik.value = et.getAttribute('data-nik')
        userName.value = et.getAttribute('data-name')
        email.value = et.getAttribute('data-email')

        optPosition.forEach(el => {
            if (el.value == positionId) {
                el.selected = true
            }
        });
        
        async function callDepartment() {
            let optDepartmentValue
            for (let i = 0; i < optDepartment.length; i++) {
                optDepartmentValue = optDepartment[i].value
                if (optDepartmentValue == departmentId) {
                    optDepartment[i].selected = true
                    department.onchange()
                    break
                }
            }
            return optDepartmentValue
        }

        callDepartment().then(
            function (data) {
                const newOptSection = document.querySelectorAll('.opt-section')
                for (let i = 0; i < newOptSection.length; i++) {
                    if (sectionId == newOptSection[i].value) {
                        newOptSection[i].selected = true
                        break
                    }
                }
            }
        )

        isAdmin.checked = isAdminData == 1 ? true : false
        addEditUserModal.show()
    }

    /* -------------------------------------------------------------------------- */
    /*                                CRUD Function                               */
    /* -------------------------------------------------------------------------- */
    btnSaveUser.onclick = () => {
        const url = '{{ route('admin.user.store') }}'
        const data = {
            id: userId.value,
            nik: nik.value,
            userName: userName.value,
            email: email.value,
            position: parseInt(position.value),
            department: parseInt(department.value),
            section: parseInt(section.value),
            isAdmin: isAdmin.checked ? 1 : 0
        }
        removeValidation()
        onLoadingFormCondition('user', btnSaveUser, true)
        fetchStoreData(url, data, addEditUser)

        function addEditUser(data) {
            if (data.success) {
                addEditUserModal.hide()
                sessionStorage.setItem('alertMsg', data.message)
                location.reload();
            } else {
                setValidationError(data.data)
            }
            onLoadingFormCondition('user', btnSaveUser, false)
        }
    }

    function deleteUser(id) {
        const userConfirm = confirm('Are you sure to delete this data?');
        if (userConfirm) {
            const url = '{{ route('admin.user.index') }}' + '/' + id;
            loadingStatus(true)
            fetchDeleteData(url)
        }
    }

    function backToUser () {
        location.href = '{{ route('admin.user.index') }}'
    }
</script>
@endsection