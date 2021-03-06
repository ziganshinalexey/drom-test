(function (jquery) {
    jquery('#login-form').on('submit', function (event) {
        event.preventDefault();
        const $form = jquery(this);

        let data = {};
        $.each($form.serializeArray(), function (index, input) {
            data[input.name] = input.value;
        });

        $.ajax({
            url: "/user/auth",
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
                localStorage.accessToken = response.data.accessToken;
                window.location.href = '/todo/index';
            }
        });
    });
})(window.jQuery);
