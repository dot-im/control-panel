import Jquery from "jquery";
import Axios from "axios";

class ForumSupport {

    constructor() {
        this.listenFormSubmit();
    }

    /**
     * change data in view.
     *
     * @param data
     */
    changeView = data => Jquery('[data-view]').html(data);

    /**
     * listen form submit.
     *
     */
    listenFormSubmit =  () => {
        $('[data-ajax-submit]').on('submit', async (event) => {
            event.preventDefault();
            let form = Jquery(event.currentTarget);
            let submitButton = form.find(':submit');
            let formData = new FormData(event.currentTarget);
            let submitButtonText = submitButton.html();

            submitButton.attr('disabled', 'disabled');
            submitButton.html('<i class="fa fa-fw fa-pulse fa-spinner"></i>');

            try {
                let response = await Axios({
                    method: form.attr('method'),
                    url: form.attr('action'),
                    data: formData,
                    config: {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'X-Requested-Withs': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    }
                });

                if (form.children('.alert').length) {
                    form.children('.alert').remove();
                }

                if ($('.invalid-feedback').length) {
                    $('.invalid-feedback').remove();
                }
                if ($('.is-invalid').length) {
                    $('.is-invalid').removeClass('is-invalid');
                }

                this.validate(response);

                if (this.success(response)) {
                    form.prepend(`<div class="alert alert-success" role="alert">${response.data.message}</div>`);
                    Jquery(document).scrollTop(0);
                } else if (this.fails(response)) {
                    form.prepend(`<div class="alert alert-danger" role="alert">${response.data.message}</div>`);
                    Jquery(document).scrollTop(0);
                }

                submitButton.html(submitButtonText);
                submitButton.attr('disabled', false);
            } catch (error) {
                console.log(error.response)
                // server side error from laravel.
                if (error.response) {
                    error = `
                        <p class="alert-link">Exception : ${error.response.data.exception}</p>
                        <p class="alert-link">File : ${error.response.data.file}</p>
                        <p class="alert-link">Line : ${error.response.data.line}</p>
                        <p class="alert-link">Message : ${error.response.data.message}</p>
                    `;
                }

                this.changeView(`<div class="alert alert-danger">${error}</div>`);
            }
        });
    };

    /**
     * check laravel validation errors.
     *
     * @param response
     * @return {boolean}
     */
    validate = response => {
        if (typeof response.data.validate_fails !== undefined) {
            jQuery.each(response.data, function(i, val) {
                $(`[name=${i}]`).addClass('is-invalid').parent().append(`<strong class="invalid-feedback">${val[0]}</strong>`);
            });

            return false;
        }

        return true;
    };

    /**
     * check if has success response.
     *
     * @param response
     * @return {boolean|boolean}
     */
    success = response => {
        return (typeof response.data.type !== 'undefined' && response.data.type === 'success');
    }

    /**
     * check if has fails response.
     *
     * @param response
     * @return {boolean|boolean}
     */
    fails = response => {
        return (typeof response.data.type !== 'undefined' && response.data.type === 'fails');
    }
}

window.formSupport = new ForumSupport();

Jquery(document).ready(function () {
    Jquery('[data-on-select="change-value"]').on('change', function (event) {
        let selectMenu = Jquery(event.currentTarget);
        let target = Jquery(selectMenu.attr('data-target'));

        if (selectMenu.val() !== 'custom') {
            target.val(this.value);
        } else {
            target.focus();
        }
    });
});
