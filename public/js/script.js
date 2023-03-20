const form = document.querySelector("form");
const confirmedPasswordInput = form.querySelector('input[name="confirmedPassword"]');

function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}

confirmedPasswordInput.addEventListener('keyup', function () {
    setTimeout(function () {
        const condition = arePasswordsSame(
            confirmedPasswordInput.previousElementSibling.value,
            confirmedPasswordInput.value
        );
        markValidation(confirmedPasswordInput.previousElementSibling, condition);
        markValidation(confirmedPasswordInput, condition);
       },
        500
    );
});

