function btn_search() { alert("Кнопка поиска"); }
function btn_filter() { alert("Кнопка фильтра"); }
function btn_delete_product(title, id) {
    if(confirm("Уверены что хотите удалить " + title)) {
        window.location.href = "http://squadrom.com/handler.php?id=" + id;
    }
}

// modal_windows
window.onclick = function(event) {
    if(event.target.hasAttribute("data-modal")) { event.target.style.display = "none"; }
}
function modal_login() {
    let modal_window = document.querySelector("#modal_window");
    let modal_login = document.querySelector("#modal_login");
    let modal_register = document.querySelector("#modal_register");
    modal_window.style.display = "block";
    modal_login.style.display = "block";
    modal_register.style.display = "none";
}
function modal_login_close() {
    let modal_window = document.querySelector("#modal_window");
    let modal_login = document.querySelector("#modal_login");
    let modal_register = document.querySelector("#modal_register");
    modal_window.style.display = "none";
    modal_login.style.display = "none";
    modal_register.style.display = "none";
}
function modal_register() {
    let modal_window = document.querySelector("#modal_window");
    let modal_login = document.querySelector("#modal_login");
    let modal_register = document.querySelector("#modal_register");
    modal_window.style.display = "block";
    modal_login.style.display = "none";
    modal_register.style.display = "block";
}
function modal_register_close() {
    let modal_window = document.querySelector("#modal_window");
    let modal_login = document.querySelector("#modal_login");
    let modal_register = document.querySelector("#modal_register");
    modal_window.style.display = "none";
    modal_login.style.display = "none";
    modal_register.style.display = "none";
}