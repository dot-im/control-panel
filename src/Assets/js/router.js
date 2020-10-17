import Axios from "axios";
import Jquery from "jquery";

export default class Router {

    constructor(options = {routeSelector: null, viewSelector: null, indexPage: null, axiosConfig : {}}) {
        this.routeSelector = `[${options.routeSelector}]`;
        this.viewSelector  = `[${options.viewSelector}]`;
        this.indexPage = options.indexPage;
        this.axiosConfig = options.axiosConfig;

        this.listenHashChanged();
        this.registerRoutes();
    }

    /**
     * listen on hash changed.
     *
     */
    listenHashChanged = () => {
        window.addEventListener('hashchange', () => this.changeViewFromResponse(window.location.hash.substr(1)));

        // if in load page has hash load hash page.
        if(window.location.hash) {
            (() => this.changeViewFromResponse(window.location.hash.substring(1)))();
        } else {
            // if not has hash in url load index page.
            window.location.hash = `#${this.indexPage}`;
            window.history.pushState({}, '', `#${this.indexPage}`);
        }
    };

    /**
     * change data in view.
     *
     * @param data
     */
    changeView = data => {
        Jquery(this.viewSelector).html(data);
    };

    /**
     * change data in view form response.
     *
     * @param url
     * @return {Promise<void>}
     */
    changeViewFromResponse = async url => {
        try {
            let response = await Axios.get(url, this.axiosConfig);
            window.history.pushState({}, '', `#${url}`);
            this.changeView(response.data);
        } catch (error) {
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
        } finally {
            // active route btn.
            this.activeRouteLink(`${this.routeSelector}[href="#${url}"]`);
        }
    };

    /**
     * register routes form route selector.
     *
     */
    registerRoutes = () => {
        document.querySelectorAll(this.routeSelector).forEach((link)  =>{
            let url  = link.getAttribute('href').substr(1);

            link.addEventListener('click', () => () => this.changeViewFromResponse(url));
        });
    };

    /**
     * active route link.
     *
     * @param route
     */
    activeRouteLink(route) {
        // remove all active links.
        document.querySelectorAll(this.routeSelector).forEach((link)  =>{
            link.classList.remove('active');
        });

        route = document.querySelector(route);

        if (route) {
            // if parent is collapsed show.
            route.parentElement.classList.add('active');

            // active target link.
            route.classList.add('active');
        }
    }
}
