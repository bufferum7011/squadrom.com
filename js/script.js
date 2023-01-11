function btn_search(btn) { alert("Кнопка поиска"); }
function btn_filter(btn) { alert("Кнопка фильтра"); }

// modal_windows
let btns = document.querySelectorAll("*[data-modal-btn]");
for(let i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
        let name = btns[i].getAttribute("data-modal-btn");
        let modal = document.querySelector("[data-modal='" + name + "']");
        let close = document.querySelector(".login_close");

        modal.style.display = "block";
        
        close.addEventListener("click", function() {
            modal.style.display = "none";
        });
    });
}

window.onclick = function(event) {
    if(event.target.hasAttribute('data-modal')) {
        event.target.style.display = "none";
    }
}