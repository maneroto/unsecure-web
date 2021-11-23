const login = async (data) => {
    const response = await server.post('Auth.php', data);

    return response.data;
};

const getFormData = (form) => {
    form = new FormData(form);
    return {
        email: form.get('email'),
        password: form.get('password'),
    };
};

const setLoginForm = () => {
    const form = document.querySelector('#sign-form');

    form.onsubmit = function (e) {
        e.preventDefault();
        const data = getFormData(form);
        login(data).then((res) => {
            if (res) {
                window.location.replace('/unsecure-web');
            }
        });
    };
};
document.addEventListener('DOMContentLoaded', function () {
    setLoginForm();
});
