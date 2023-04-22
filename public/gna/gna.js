/**
 *
 * @param {serverURL} url
 * @param {function} callBack
 */
function fetchGetData(url, callBack) {
    fetch(url)
        .then((res) => res.json())
        .then((res) => {
            const data = res.data;
            callBack(data);
        })
        .catch((err) => console.warn(err));
}
/**
 *
 * @param {serverURL} url
 */
function fetchDeleteData(url) {
    const method = "DELETE";
    fetch(url, {
        method: method,
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
    })
        .then((res) => res.json())
        .then((res) => {
            sessionStorage.setItem("alertMsg", res.message);
            window.location.reload();
        })
        .catch((err) => console.warn(err));
}
/**
 *
 * @param {serverURL} url
 * @param {bodyData} data
 * @param {function} callBack
 */
function fetchStoreData(url, data, callBack) {
    const method = "POST";
    fetch(url, {
        method: method,
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify(data),
    })
        .then((res) => res.json())
        .then((res) => callBack(res))
        .catch((err) => console.log(err));
}
/**
 *
 * @param {data.data} data
 */
function setValidationError(data) {
    const errorKey = Object.keys(data);
    if (errorKey.length > 0) {
        for (let i = 0; i < errorKey.length; i++) {
            const divError = document.querySelector(`.${errorKey[i]}`);
            const errorMsg = data[errorKey[i]];
            const html = `<span class="error" style="color: red; font-size: 14px;">${errorMsg}</span>`;
            if (divError) {
                divError.insertAdjacentHTML("afterend", html);
            } else {
                console.warn("DOM not set yet");
            }
            // console.log(divError);
        }
        // console.log(data);
    }
    // console.log(errorKey);
}

function removeValidation() {
    const errorValidation = document.querySelectorAll(".error");
    if (errorValidation) {
        errorValidation.forEach((el) => {
            el.remove();
        });
    }
}

window.onload = function () {
    const alertMessage = sessionStorage.getItem("alertMsg");
    if (alertMessage) {
        alert(alertMessage);
        sessionStorage.removeItem("alertMsg");
    }
};

function loadingStatus(boolval) {
    const bodyContainer = document.querySelector("body");
    const loadingImg = document.getElementById("loadingImg");
    if (boolval) {
        loadingImg.style.display = "block";
        bodyContainer.style.overflow = "hidden";
    } else {
        loadingImg.style.display = "none";
        bodyContainer.removeAttribute("style");
    }
}

/**
 *
 * @param {className} className
 * @param {buttonSave} btnSave
 * @param {boolean} boolval
 */
function onLoadingFormCondition(className, btnSave, boolval) {
    const formElement = document.querySelectorAll(`.${className}`);
    if (boolval) {
        btnSave.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
        `;
        btnSave.disabled = true;
    } else {
        btnSave.innerHTML = "Save";
        btnSave.disabled = false;
    }
    if (formElement.length > 0) {
        formElement.forEach((element) => {
            element.disabled = boolval;
        });
    }
}
