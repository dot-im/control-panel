import Jquery from "jquery";
import Sidebar from './sidebar.js';
import Router from './router.js';
import 'popper.js';
import "bootstrap";

window.$ = window.jQuery = Jquery;

window.router  = (options) => new Router(options);

const sidebar = new Sidebar('sidebar').initialize();

/**
 * hide sidebar dropdown menu in click out toggler
 */
$(document).on("click", function(event){
    let toggler = $("#sidebar.collapsed .sidebar-collapse-toggler");

    if(toggler !== $(event.currentTarget)){
        $("#sidebar.collapsed .sidebar-collapse-dropdown").removeClass('show');
    }
});



$('[data-toggle="tooltip"]').tooltip();




