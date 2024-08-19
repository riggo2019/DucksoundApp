let singerContent = document.getElementById('singer-content')
let chartContent = document.getElementById('chart-content')
let exploreContent = document.getElementById('explore-content')
let exploreSB = document.getElementById('exploreSB')
let chartSB = document.getElementById('chartSB')
let singerSB = document.getElementById('singerSB')
let singerChoose = document.getElementById('singer-choose')
let filterSinger = document.getElementById('filter_singer')

function exploreOpen() {
    singerContent.classList.add("dn")
    chartSB.classList.remove("active")
    singerSB.classList.remove("active")
    chartContent.classList.add("dn")

    if (exploreContent.classList.contains("dn")) {
        exploreContent.classList.remove("dn")
        exploreSB.classList.add("active")
    }
    
}

function chartOpen() {
    singerContent.classList.add("dn")
    singerSB.classList.remove("active")
    exploreSB.classList.remove("active")
    exploreContent.classList.add("dn")

    if (chartContent.classList.contains("dn")) {
        chartContent.classList.remove("dn")
        chartSB.classList.add("active")
    }
}

function chooseSinger(id) {
    singerChoose.value = id
    filterSinger.submit()
}