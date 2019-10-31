(function (jquery) {
    jquery('#register-form').on('submit', function (event) {
        event.preventDefault();
        const $form = jquery(this);

        let data = {};
        $.each($form.serializeArray(), function (index, input) {
            data[input.name] = input.value;
        });

        $.ajax({
            url: "/user/create",
            method: 'post',
            headers: {'x-access-token': localStorage.accessToken},
            data: data
        }).done(function (response) {
            if (Array.isArray(response.errors) && response.errors.length) {
                let message = '';
                response.errors.forEach(function (error) {
                    message = message + ' ' + error.system + '\n';
                });
                alert(message);
            } else {
                window.location.href = '/user/login';
            }
        });
    });
})(window.jQuery);
