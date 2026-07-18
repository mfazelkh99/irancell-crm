const sidebar = document.querySelector(".sidebar");
const toggle = document.querySelector(".menu-toggle");
const overlay = document.querySelector(".sidebar-overlay");

if(toggle){

    toggle.addEventListener("click",()=>{

        sidebar.classList.toggle("open");

        overlay.classList.toggle("show");

    });

}

if(overlay){

    overlay.addEventListener("click",()=>{

        sidebar.classList.remove("open");

        overlay.classList.remove("show");

    });

}