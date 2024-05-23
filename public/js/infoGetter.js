const GetSyllabusJsonCacheOrNetwork = async () => {
    var networkDataReceived = false;

    var networkUpdate = await fetch(document.location.origin + "/api/info")
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            networkDataReceived = true;
            UpdateSyllabusPageElements(data);
        });

    // fetch cached data
    caches
        .match('/syllabus.json')
        .then(function (response) {
            if (!response) throw Error('No data');
            return response.json();
        })
        .then(function (data) {
            // don't overwrite newer network data
            if (!networkDataReceived) {
                UpdateSyllabusPageElements(data);
            }
        })
        .catch(function () {
            // we didn't get cached data, the network is our last hope:
            return networkUpdate;
        })
}

const GetJson = async (route) => {
    const response = await fetch(document.location.origin + `/api/${route}`);
    console.log(document.location.origin + `/api/${route}`);
    const json = await response.json(); //extract JSON from the http response

    return json
    // do something with myJson
}

const UpdateHomePageInfo = (data) => {
    document.getElementById('name').innerHTML = `Welcome ${data.name}`;
}

const UpdateHomePageAnnouncements = (data) => {
    document.getElementById('ATitle').innerHTML = data.title;
    document.getElementById('AMessage').innerText = data.message;
    const date = new Date(data.timestamp);
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = new Intl.DateTimeFormat('en-UK', options).format(date);
    document.getElementById('ADate').innerText = formattedDate;
}


const UpdateSyllabusPageElements = (data) => {
    document.getElementById('name').innerHTML = `${data.name}`;
    document.body.appendChild(genTable(data.syllabus, data.beltName));
}

function genTable(syllabus, beltName) {
    console.log(syllabus);
    var tableWrapper = document.createElement("div");
    tableWrapper.className = "table-wrapper";

    var table = document.createElement("table");
    table.className = 'fl-table';

    //TODO: Set up colour array for belts
    var header = table.createTHead(-1);
    var beltNameRow = header.insertRow(-1);
    var th = document.createElement("th");
    th.style.backgroundColor = '#fdfdfd';
    th.style.color = '#101213';
    th.innerText = `${beltName} Belt Syllabus`;
    th.colSpan = 2;
    beltNameRow.appendChild(th);

    var header = table.createTHead(-1);
    var headerRow = header.insertRow(-1);
    var th = document.createElement("th");
    th.innerText = `Technique`;
    th.colSpan = 2;
    th.style.fontWeight = "normal";
    headerRow.appendChild(th);

    var body = table.createTBody();


    createSyllabusTableEntries(syllabus, body);

    console.log(table);
    tableWrapper.append(table);

    return tableWrapper;
}

function createSyllabusTableEntries(syllabus, body) {
    syllabus.forEach(setupTableEntry);

    function setupTableEntry(item) {
        if (item[1] == "N") {
            createSyllabusRow(body, item);
        }
        else {
            createLRSyllabusRow(body, item);
        }
        //cell.setAttribute("font-size", "50%")
    }
}

function createSyllabusRow(body, item) {
    var row = body.insertRow(-1);
    var cell = row.insertCell(0);
    cell.innerHTML = (`${item[0]}`);
    var cell2 = row.insertCell(1);
    var techniqueSide = "N/A"
    cell2.innerHTML = (`${techniqueSide}`);
}

function createLRSyllabusRow(body, item) {

    var row = body.insertRow(-1);
    var cell1 = row.insertCell(-1);
    cell1.innerHTML = (`${item[0]}`);
    cell1.rowSpan = 2;
    var cell2 = row.insertCell(-1);
    var techniqueSide = "L"
    cell2.innerHTML = (`${techniqueSide}`);

    var row2 = body.insertRow(-1);
    var cell3 = row2.insertCell(-1);
    var techniqueSide = "R"
    cell3.innerHTML = (`${techniqueSide}`);
}
