let songContent = document.getElementById('song-content')
let chartContent = document.getElementById('chart-content')
let exploreContent = document.getElementById('explore-content')
let exploreSB = document.getElementById('exploreSB')
let chartSB = document.getElementById('chartSB')

function exploreOpen() {
    songContent.classList.add("dn")
    chartSB.classList.remove("chart_active")
    chartContent.classList.add("dn")

    if (exploreContent.classList.contains("dn")) {
        exploreContent.classList.remove("dn")
        exploreSB.classList.add("explore_active")
    }
}

function chartOpen() {
    songContent.classList.add("dn")
    exploreSB.classList.remove("explore_active")
    exploreContent.classList.add("dn")

    if (chartContent.classList.contains("dn")) {
        chartContent.classList.remove("dn")
        chartSB.classList.add("chart_active")
    }
}

