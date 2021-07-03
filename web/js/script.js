
controlsInit();
if (window.onload == null) {
    window.onload = () => document.readyState == 'complete';
}

if (window.onpopstate == null)
    window.onpopstate = controlsInit;

async function controlsInit() {
    let flag = await window.onload;
    if (!flag)
        flag = await window.onload;
    let optionsTogglers = document.querySelectorAll("li>input");
    console.log(optionsTogglers.length);
    let tableToggledCols = getToggledColsCookie();
    for (let i = 0; i < optionsTogglers.length; ++i) {
        if (tableToggledCols[i] == 'hidden') {
            if (optionsTogglers[i].checked == 1) {
            optionsTogglers[i].toggleAttribute('checked');
            toggleColVisibility(i + 2);
            }
        } else {
            if (optionsTogglers[i].checked != 1) {
                optionsTogglers[i].toggleAttribute('checked');
                toggleColVisibility(i + 2);
            }
        }
        optionsTogglers[i].onclick = registerVisibilityChange.bind(null, i + 2);
    }
    setToggledColsCookie(tableToggledCols);
}

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
      "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : '[]';
}

function getToggledColsCookie() {
    let tableToggledCols = JSON.parse(getCookie('tableToggledCols'));
    if (tableToggledCols == '') {
        for (let i = 0; i <= 4; ++i)
        {
            tableToggledCols[i] = 'visible';
        }
    }
    return tableToggledCols;
}

function setToggledColsCookie(toggledColsCookie) {
    document.cookie = "tableToggledCols=" + JSON.stringify(toggledColsCookie);
}

function registerVisibilityChange(colWithChangedVisibility) {
    let tableToggledCols = getToggledColsCookie();
    console.log("before: (" + tableToggledCols + ")");
    tableToggledCols[colWithChangedVisibility - 2] = 
        tableToggledCols[colWithChangedVisibility - 2] == 'hidden' ? 'visible' : 'hidden';
    
    setToggledColsCookie(tableToggledCols);
    console.log("after: (" + getToggledColsCookie() + ")");
    toggleColVisibility(colWithChangedVisibility);
}

function toggleColVisibility(col) {
    let tableToggledCols = getToggledColsCookie();
    let cols = document.querySelectorAll(`tr > *:nth-child(${col})`);
    if (tableToggledCols[col - 2] == 'hidden' && !cols[0].classList.contains('hidden'))
        for (let i = 0; i < cols.length; ++i) {
            cols[i].classList.toggle("hidden");
        }
    else if (tableToggledCols[col - 2] == 'visible' && cols[0].classList.contains('hidden'))
        for (let i = 0; i < cols.length; ++i) {
            cols[i].classList.toggle("hidden");
        }
}