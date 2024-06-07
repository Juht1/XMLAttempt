function toggleXML() {
    const pre = document.getElementById('xmlContent');
    if (pre.style.display === 'block') {
        pre.style.display = 'none';
    } else {
        fetch('tooted.xml')
            .then(response => response.text())
            .then(data => {
                pre.textContent = data;
                pre.style.display = 'block';
                displayXMLTable(data);
            })
            .catch(error => console.error('Error fetching XML:', error));
    }
}

function displayXMLTable(xmlString) {
    const parser = new DOMParser();
    const xmlDoc = parser.parseFromString(xmlString, "application/xml");
    const products = xmlDoc.getElementsByTagName("toode");
    let table = '<table border="1"><tr><th>Nimetus</th><th>Kirjeldus</th><th>Hind</th></tr>';

    for (let i = 0; i < products.length; i++) {
        const nimetus = products[i].getElementsByTagName("nimetus")[0].textContent;
        const kirjeldus = products[i].getElementsByTagName("kirjeldus")[0].textContent;
        const hind = products[i].getElementsByTagName("hind")[0].textContent;
        table += `<tr><td>${nimetus}</td><td>${kirjeldus}</td><td>${hind}</td></tr>`;
    }

    table += '</table>';
    document.getElementById('xmlTable').innerHTML = table;
}

window.addEventListener('load', () => {
    fetch('tooted.xml')
        .then(response => response.text())
        .then(data => displayXMLTable(data))
        .catch(error => console.error('Error fetching XML:', error));
});
