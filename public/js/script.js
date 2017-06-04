var sidebar = document.querySelector(".sidebar");
var sidebar_close = document.querySelector(".sidebar-close");
sidebar_close.onclick = toggleSidebar;
var sidebar_open = document.querySelector(".sidebar-open")
sidebar_open.onclick = toggleSidebar;

function toggleSidebar() {
	if (sidebar.style.display === 'none') {
        sidebar.style.display = 'block';
    } else {
        sidebar.style.display = 'none';
    }
};