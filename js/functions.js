function activateMainMenuItem(e) {
    // reset highlight of selected menu-item
    document.querySelectorAll("#navbar_mainmenu li").forEach(function(node) {
        node.className = null;
    })
    e.parentElement.className="active";
}

function clearMainContent() {
    let root = document.querySelector("#main");
    while (root.firstChild) {
        root.removeChild(root.firstChild);
    }
}

function setMainContent(data) {
    document.querySelector("#main").innerHTML = data;
}

// get async the users with fetch
async function getUsersAsync(api) {
    clearMainContent();
    let html = [];
    const response = await fetch(api);
    const data = await response.json();


    //console.log(data.users);
    data.users.forEach(obj => {
        Object.entries(obj).forEach(([key, value]) => {
            html.push(`<div>${key} ${value}</div>`);
        });
    });
    setMainContent(html.join('')); // return a html string
}


