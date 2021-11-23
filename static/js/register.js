const register = async (data) => {
    const response = await server.post('User.php', data);

    return response.data;
};

const getFormData = (form) => {
    form = new FormData(form);
    return {
        email: form.get('email'),
        password: form.get('password'),
        password_confirm: form.get('password_confirm'),
    };
};

const setRegisterForm = () => {
    const form = document.querySelector('#sign-form');

    form.onsubmit = function (e) {
        e.preventDefault();
        const data = getFormData(form);
        register(data).then((res) => {
            if (res) {
                window.location.replace('/unsecure-web/login');
            }
        });
    };
};
document.addEventListener('DOMContentLoaded', function () {
    setRegisterForm();
});
