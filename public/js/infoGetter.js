const GetSyllabusJson = async () => {
    const response = await fetch(document.location.origin + "/api/syllabus");
    console.log(document.location.origin + "/api/syllabus");
    const beltJson = await response.json(); //extract JSON from the http response

    return beltJson
    // do something with myJson
}

const GetInfoJson = async () => {
    const response = await fetch(document.location.origin + "/api/info");
    console.log(document.location.origin + "/api/info");
    const infoJson = await response.json(); //extract JSON from the http response

    return infoJson
    // do something with myJson
}

const UpdateHomePageElements = (data) => {
    document.getElementById('name').innerHTML = `Welcome ${data.name} : ${data.class}`;
}


const UpdateSyllabusPageElements = (data) => {
    document.getElementById('name').innerHTML = `Welcome ${data.name} : ${data.class}`;
    document.body.appendChild(genTable(data.syllabus, data.beltName));
}

function genTable(syllabus, beltName) {
    syllabus.reverse();
    var tableWrapper = document.createElement("div");
    tableWrapper.className = "table-wrapper";

    var table = document.createElement("table");
    table.className = 'fl-table';


    var header = table.createTHead();
    var beltNameRow = header.insertRow(0);
    var th = document.createElement("th");
    th.innerText = `${beltName} Belt Syllabus`;
    beltNameRow.appendChild(th);

    var body = table.createTBody();

    createSyllabusTableEntries(syllabus, body);

    console.log(table);
    tableWrapper.append(table);

    return tableWrapper;
}

function createSyllabusTableEntries(syllabus, body) {
    syllabus.forEach(setupTableEntry);

    function setupTableEntry(item) {
        var row = body.insertRow(0);
        var cell = row.insertCell(0);
        cell.innerHTML = (`${item}`);
        //cell.setAttribute("font-size", "50%")
    }
}

