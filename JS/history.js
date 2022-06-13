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

get("../php/history.php")
.then((res) => {
    let jArray=JSON.parse(res);
    document.getElementById("footprint").appendChild(generateTable(jArray));
})
function post_time(){
    var a = document.getElementById("from_date").value;
    var b = document.getElementById("to_date").value;
    get("../php/history.php?from="+a+"&to="+b)
    .then((res) => {
        let jArray=JSON.parse(res);
        var footprint = document.getElementById("footprint");
        while(footprint.lastChild){
            footprint.removeChild(footprint.lastChild);
        }
        footprint.appendChild(generateTable(jArray));
    })
}
function post_quicktime(){
    howlong = document.querySelector('input[name="howlong"]:checked').value;

    dateObject = new Date();

    dateObject=dateObject.setDate(dateObject.getDate()+1);
    dateObject = new Date(dateObject);


    var a = dateObject.toISOString().split(":",3)[0]+":"+dateObject.toISOString().split(":",3)[1];
    
    d = new Date(dateObject.getFullYear(), (dateObject.getMonth()), (dateObject.getDate()-Number(howlong)));
    var b=d.toISOString().split(":",3)[0]+":"+dateObject.toISOString().split(":",3)[1];
    
    // alert(b+"\n"+a);
    get("../php/history.php?from="+b+"&to="+a)
    .then((res) => {
        let jArray=JSON.parse(res);
        var footprint = document.getElementById("footprint");
        while(footprint.lastChild){
            footprint.removeChild(footprint.lastChild);
        }
        footprint.appendChild(generateTable(jArray));
    })
}
function post_is_epidemic(){
    if(document.getElementById("is_epidemic").checked){
        get("../php/history2.php")
        .then((res) => {
            let jArray=JSON.parse(res);
            var footprint = document.getElementById("footprint");
            while(footprint.lastChild){
                footprint.removeChild(footprint.lastChild);
            }
            footprint.appendChild(generateTable(jArray));
        })
    }
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

function search(){

}

