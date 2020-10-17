import Cookies from 'js-cookie'

export default class Sidebar {
    /**
     * sidebar id.
     *
     * @param id
     */
    constructor(id) {
        this.id = id;
    }

    /**
     * collapse sidebar.
     */
    collapseSidebar() {
        $(`#${this.id}`).removeClass('expanded').addClass('collapsed');
        $('body').removeClass('expanded').addClass('collapsed');
    }

    /**
     * expend sidebar.
     */
    expendSidebar() {
        $(`#${this.id}`).addClass('expanded').removeClass('collapsed');
        $('body').addClass('expanded').removeClass('collapsed');
    }

    /**
     * register sidebar toggler btn.
     */
    registerTogglerClickEvent() {
        let that = this;

        $('[data-toggle="expand-sidebar"]').on('click', function () {
            if ($(`#${that.id}`).hasClass('expanded')) {
                that.collapseSidebar();
            } else {
                that.expendSidebar();
            }
        });
    }

    initialize() {
        this.registerTogglerClickEvent();

        return this;
    }
}
