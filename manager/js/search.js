function search_place(){
    var end = document.getElementById("end");
    var id = document.getElementById("search_place").value;
    get("../db/search_place.php?search_place="+id)
    .then((res) => {
        let jArray=JSON.parse(res);
        // alert(id);
        while(end.lastChild){
            end.removeChild(end.lastChild);
        }
        end.appendChild(generateTable(jArray));
    })
}
function search_customer(){
    var end = document.getElementById("end");
    var id = document.getElementById("search_customer").value;
    get("../db/search_customer.php?search_customer="+id)
    .then((res) => {
        let jArray=JSON.parse(res);
        // alert(id);
        while(end.lastChild){
            end.removeChild(end.lastChild);
        }
        end.appendChild(generateTable(jArray));
    })
}

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