/*
 * 
 */
function ajaxGetRequest(url) {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); 
    xhr.send();
    return xhr;
}

function login() {
    let name = document.getElementById('name').value;
    ajaxGetRequest("src/Ajax/AjaxLogin.php?name=" + name).onload = function() {
        if (this.readyState === 4 && this.status === 200) {
            window.location.reload();
        }
    };
}

function logout() {
    ajaxGetRequest("src/Ajax/AjaxLogout.php").onload = function() {
        if (this.readyState === 4 && this.status === 200) {
            window.location.reload();
        }
    };
}
