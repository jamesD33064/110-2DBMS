function get(url) {

        return new Promise((resolve, reject)=> {
            var req = new XMLHttpRequest();
            req.open('GET', url);
            req.onload = function() {
                if (req.status == 200 && req.readyState==4) {
                    resolve(req.response);
                }
            };
            req.send();
        });
}

get("../php/overview.php")
.then((res) => {
    let jArray=JSON.parse(res);
    document.getElementById("overview").appendChild(generateTable(jArray));
})
function generateTable (jArray) {
    let tbody = document.createElement('tbody');
    let thead = document.createElement('thead');
    let table = document.createElement('table');

    // 將所有資料列的資料轉成tbody
    jArray.forEach(row => {
        let tr = document.createElement('tr');

        Object.keys(row).forEach(tdName => {
            let td = document.createElement('td');
            td.textContent= row[tdName];
            td.style.cssText="padding: 20px;";
            tr.appendChild(td);
        });
        tbody.appendChild(tr);
    });
    table.appendChild(tbody);

    // 將所有資料列的欄位轉成thead
    let headerTr = document.createElement('tr')

    Object.keys(jArray[0]).forEach(header => {
        let th = document.createElement('th')
        th.textContent = header

        headerTr.appendChild(th)
    });

    // 新增thead到table上
    thead.appendChild(headerTr);
    table.appendChild(thead);

    return table;
}


get("../php/overview_taiwan.php?type=week")
.then((res) => {
    let jArray=JSON.parse(res);
    document.getElementById("pernumber").appendChild(generateTable(jArray));
})

function weekormonth(){
    var type = document.querySelector('input[name="type"]:checked').value;
    // alert(type);
    get("../php/overview_taiwan.php?type="+type)
    .then((res) => {
        let jArray=JSON.parse(res);
        var pernumber = document.getElementById("pernumber");
        while(pernumber.lastChild){
            pernumber.removeChild(pernumber.lastChild);
        }
        pernumber.appendChild(generateTable(jArray));
    })
}