let favoriteContent = document.getElementById('favorite-content')
let chartContent = document.getElementById('chart-content')
let exploreContent = document.getElementById('explore-content')
let exploreSB = document.getElementById('exploreSB')
let chartSB = document.getElementById('chartSB')
let favoriteSB = document.getElementById('favoriteSB')


function exploreOpen() {
    favoriteContent.classList.add("dn")
    chartSB.classList.remove("active")
    favoriteSB.classList.remove("active")
    chartContent.classList.add("dn")

    if (exploreContent.classList.contains("dn")) {
        exploreContent.classList.remove("dn")
        exploreSB.classList.add("active")
    }
    
}

function chartOpen() {
    favoriteContent.classList.add("dn")
    favoriteSB.classList.remove("active")
    exploreSB.classList.remove("active")
    exploreContent.classList.add("dn")

    if (chartContent.classList.contains("dn")) {
        chartContent.classList.remove("dn")
        chartSB.classList.add("active")
    }
}
