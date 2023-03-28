var reEmail = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
var rePhone = /^\+7[\d\(\)\ -]{9,15}\d$/;

form.onsubmit = function () {
    var errorMessage = '';

    if (!reEmail.test(email.value)) {
        errorMessage = 'Проверьте правильность Email!'
    }
    if (!rePhone.test(phone.value)) {
        console.dir(rePhone);
        errorMessage = 'Проверьте правильность телефона!'
    }
    if (errorMessage !== '') {
        message.innerHTML = errorMessage;
        return false;
    }

    // здесь бы аякс сбацать или ...
    message.innerHTML = 'Форма успешно отправлена!'
    return false;
}
