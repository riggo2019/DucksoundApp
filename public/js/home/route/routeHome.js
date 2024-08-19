let homeContent = document.getElementById('home-content')
let chartContent = document.getElementById('chart-content')
let exploreContent = document.getElementById('explore-content')
let exploreSB = document.getElementById('exploreSB')
let chartSB = document.getElementById('chartSB')
const isSearchingElement = document.getElementById('isSearching');

const isSearching = isSearchingElement ? JSON.parse(isSearchingElement.textContent) : flase;

function exploreOpen() {
    homeContent.classList.add("dn")
    chartSB.classList.remove("active")
    chartContent.classList.add("dn")

    if (exploreContent.classList.contains("dn")) {
        exploreContent.classList.remove("dn")
        exploreSB.classList.add("active")
    }
    
}

if(isSearching){
    exploreOpen()
}

function chartOpen() {
    homeContent.classList.add("dn")
    exploreSB.classList.remove("active")
    exploreContent.classList.add("dn")

    if (chartContent.classList.contains("dn")) {
        chartContent.classList.remove("dn")
        chartSB.classList.add("active")
    }
}