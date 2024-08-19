let listContent = document.getElementById('list-content')
let chartContent = document.getElementById('chart-content')
let exploreContent = document.getElementById('explore-content')
let exploreSB = document.getElementById('exploreSB')
let chartSB = document.getElementById('chartSB')
let listSB = document.getElementById('listSB')

const addPlaylistform = document.getElementById('addPlaylistform')


function exploreOpen() {
    listContent.classList.add("dn")
    chartSB.classList.remove("active")
    listSB.classList.remove("active")
    chartContent.classList.add("dn")

    if (exploreContent.classList.contains("dn")) {
        exploreContent.classList.remove("dn")
        exploreSB.classList.add("active")
    }
    
}

function chartOpen() {
    listContent.classList.add("dn")
    listSB.classList.remove("active")
    exploreSB.classList.remove("active")
    exploreContent.classList.add("dn")
    
    if (chartContent.classList.contains("dn")) {
        chartContent.classList.remove("dn")
        chartSB.classList.add("active")
    }
}
function addPlaylistOn() {
    addPlaylistform.classList.remove('dn')
}

function addPlaylistOff() {
    addPlaylistform.classList.add('dn')
}