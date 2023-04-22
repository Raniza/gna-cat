<!-- Modal -->
<div class="modal fade" id="changeUserPassModal" tabindex="-1" aria-labelledby="changeUserPassLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header p-2">
                <h1 class="modal-title fs-5" id="changeUserPassLabel">Change Password</h1>
                <button type="button" class="btn-close change_pass" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-error mb-2" style="display: none" id="changePassErrorDiv">
                    <span id="changePassErrorMsg"></span>
                </div>
                <div class="mb-2">
                    <label for="current-pass" class="form-label text-dark fw-normal">Current Password</label>
                    <input type="password" class="form-control form-control-sm change_pass currentPass" id="current-pass">
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label text-dark fw-normal">New Password</label>
                    <input type="password" class="form-control form-control-sm change_pass password" id="password">
                </div>
                <div class="mb-2">
                    <label for="confirm-pass" class="form-label text-dark fw-normal">Confirmation Password</label>
                    <input type="password" class="form-control form-control-sm change_pass confirmPass" id="confirm-pass">
                </div>
                <div class="form-check pointer">
                    <input class="form-check-input change_pass" type="checkbox" id="showPassCheck">
                    <label class="form-check-label text-dark fw-normal change_pass" for="showPassCheck">
                        Show Password
                    </label>
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary btn-sm change_pass" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="btnSaveChangePass">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    const showPassCheck = document.getElementById('showPassCheck')
    const password = document.getElementById('password')
    const currentPass = document.getElementById('current-pass')
    const confirmPass = document.getElementById('confirm-pass')
    const btnSaveChangePass = document.getElementById('btnSaveChangePass')
    const modalChangeUserPass = document.getElementById('changeUserPassModal')
    let changeUserPassModal

    document.addEventListener('DOMContentLoaded', () => {
        changeUserPassModal = new bootstrap.Modal(document.getElementById('changeUserPassModal'))
    })

    modalChangeUserPass.addEventListener('show.bs.modal', function() {
        removeValidation()
        onLoadingFormCondition('change_pass', btnSaveChangePass, false)
        password.classList.remove('is-invalid')
        confirmPass.classList.remove('is-invalid')
        currentPass.classList.remove('is-invalid')
        currentPass.value = ""
        password.value = ""
        confirmPass.value = ""
        changePassErrorMsg.innerHTML = ""
        changePassErrorDiv.style.display = 'none'
    })

    showPassCheck.onchange = function () {
        if (this.checked) {
            password.setAttribute('type', 'text')
            currentPass.setAttribute('type', 'text')
            confirmPass.setAttribute('type', 'text')
        } else {
            password.setAttribute('type', 'password')
            currentPass.setAttribute('type', 'password')
            confirmPass.setAttribute('type', 'password')
        }
    }

    btnSaveChangePass.onclick = () => {
        const url = '{{ route('change.pass') }}'
        const data = {
            id: {{ Auth::user()->id }},
            currentPass: currentPass.value,
            password: password.value,
            confirmPass: confirmPass.value
        }
        removeValidation()
        if (password.value != confirmPass.value) {
            alert('Your new and confirmation password didn\'t macth with our records.')
            password.classList.add('is-invalid')
            confirmPass.classList.add('is-invalid')
            return false
        }

        onLoadingFormCondition('change_pass', btnSaveChangePass, true)
        fetchStoreData(url, data, changePassData)
        
        function changePassData(data) {
            if (data.success) {
                async function loggedOut () {
                    location.href = '{{ route('logout') }}'
                    return ('Password changed successfuly')
                }

                loggedOut().then(
                    (msg) => {
                        alert(msg)
                    }
                )
            } else {
                if (data.message == 'Validation errors') {
                    setValidationError(data.data)
                } else {
                    const changePassErrorDiv = document.getElementById('changePassErrorDiv')
                    const changePassErrorMsg = document.getElementById('changePassErrorMsg')
                    changePassErrorMsg.innerHTML = data.data
                    changePassErrorDiv.style.display = 'block'
                    currentPass.classList.add('is-invalid')
                }
            }
            onLoadingFormCondition('change_pass', btnSaveChangePass, false)
        }
    }
</script>