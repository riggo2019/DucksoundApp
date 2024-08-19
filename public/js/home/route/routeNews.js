let newsContent = document.getElementById('news-content')
let chartContent = document.getElementById('chart-content')
let exploreContent = document.getElementById('explore-content')
let exploreSB = document.getElementById('exploreSB')
let chartSB = document.getElementById('chartSB')
let newsSB = document.getElementById('newsSB')


function exploreOpen() {
    newsContent.classList.add("dn")
    chartSB.classList.remove("active")
    newsSB.classList.remove("active")
    chartContent.classList.add("dn")

    if (exploreContent.classList.contains("dn")) {
        exploreContent.classList.remove("dn")
        exploreSB.classList.add("active")
    }
    
}

function chartOpen() {
    newsContent.classList.add("dn")
    newsSB.classList.remove("active")
    exploreSB.classList.remove("active")
    exploreContent.classList.add("dn")

    if (chartContent.classList.contains("dn")) {
        chartContent.classList.remove("dn")
        chartSB.classList.add("active")
    }
}