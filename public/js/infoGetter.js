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

const GetImage = async (route) => {
    const response = await fetch(document.location.origin + `/api/${route}`);
    console.log(document.location.origin + `/api/${route}`);
    const imgBlob = await response.blob();

    const urlCreator = window.URL || window.webkitURL;

    return urlCreator.createObjectURL(imgBlob);
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

const UpdateProfilePicElement = (data) => {
    document.getElementById('profile_picture').src = data;
}

const UpdateProfilePageElements = (data) => {
    document.getElementById('name').innerHTML = `${data.name}`;

    data.belt_grades.forEach(createTable);

    function createTable(belt_grade) {
        document.body.appendChild(genProfileTable(belt_grade));
    }
}

function genProfileTable(belt_grade) {
    console.log(belt_grade);
    var tableWrapper = document.createElement("div");
    tableWrapper.className = "table-wrapper";

    var table = document.createElement("table");
    table.className = 'fl-table';

    //TODO: Set up colour array for belts

    var header = table.createTHead(-1);
    var headerRow = header.insertRow(-1);
    var th = document.createElement("th");
    th.innerText = `Grading Record`;
    th.colSpan = 100;
    th.style.color = '#fdfdfd';
    th.style.backgroundColor = '#191c1e';
    headerRow.appendChild(th);

    var body = table.createTBody();

    createProfileEntries(belt_grade, body);

    console.log(table);
    tableWrapper.append(table);

    return tableWrapper;
}

function createProfileEntries(belt_grade, body) {

    var row = body.insertRow(-1);
    var cell = row.insertCell(0);
    cell.style.textAlign = 'center';
    cell.innerHTML = (`<b>KYU</b>`);

    var cell2 = row.insertCell(1);
    cell2.style.textAlign = 'center';
    cell2.innerHTML = (`<b>Date</b>`);

    var cell3 = row.insertCell(2);
    cell3.style.textAlign = 'center';
    cell3.innerHTML = (`<b>Grade</b>`);

    var cell4 = row.insertCell(3);
    cell4.style.textAlign = 'center';
    cell4.innerHTML = (`<b>Examiner</b>`);

    belt_grade.forEach(createProfileRow);

    function createProfileRow(item) {
        var row = body.insertRow(-1);
        var cell = row.insertCell(0);
        cell.style.textAlign = 'center';
        cell.innerHTML = (`<b>${item[0]}</b>`);
        var cell2 = row.insertCell(1);
        cell2.style.textAlign = 'center';
        var passedString = "FULL GRADE PASSED";
        if (item[4].includes("Tag")) {
            console.log("here");
            var passedString = "PART ONE PASSED";
        }
        if (item[4].includes("Double Tag")) {
            var passedString = "PART TWO PASSED";
        }
        cell2.innerHTML = (`<b>${passedString} - ${item[1]}</b>`);
        var cell3 = row.insertCell(2);
        cell3.style.textAlign = 'center';
        cell3.style.fontFamily = 'edo-sz';
        cell3.innerHTML = (`${item[2]}`);
        var cell4 = row.insertCell(3);
        cell4.style.textAlign = 'center';
        cell4.innerHTML = (`<b>${item[3]}</b>`);
    }
}




const UpdateSyllabusPageElements = (data) => {
    document.getElementById('name').innerHTML = `${data.name}`;

    data.syllabus.forEach(createTables);

    function createTables(beltSyllabusPair) {
        document.body.appendChild(genSyllabusTable(beltSyllabusPair[1], beltSyllabusPair[0]));
        linebreak = document.createElement("br");
        document.body.appendChild(linebreak);
        linebreak = document.createElement("br");
        document.body.appendChild(linebreak);
        linebreak = document.createElement("br");
        document.body.appendChild(linebreak);
    }
}

function genSyllabusTable(syllabus, beltName) {
    console.log(syllabus);
    var tableWrapper = document.createElement("div");
    tableWrapper.className = "table-wrapper";

    var table = document.createElement("table");
    table.className = 'fl-table';

    //TODO: Set up colour array for belts
    var header = table.createTHead(-1);
    var beltNameRow = header.insertRow(-1);
    var th = document.createElement("th");
    th.style.color = '#fdfdfd';
    th.style.backgroundColor = convertBeltToColorVarString(beltName);
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
    if (item[0].includes("Kata") || item[0].includes("Waza")) {
        cell.innerHTML = (`<b>${item[0]}<b>`);
    }
    else {
        cell.innerHTML = (`${item[0]}`);
    }

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

function convertBeltToColorVarString(belt) {
    var wordArray = belt.split(" ");
    var beltString = "--";
    wordArray.forEach(setUpArrayString);
    function setUpArrayString(word) {
        console.log(word);
        beltString = beltString.concat(`${word}-`)
    }

    beltString = beltString.toLocaleLowerCase();

    console.log(`var(${beltString}color)`);

    return `var(${beltString}color)`;
}