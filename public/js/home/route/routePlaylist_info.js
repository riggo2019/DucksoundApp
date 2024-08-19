let playlistListContent = document.getElementById('playlist-list-content')
let chartContent = document.getElementById('chart-content')
let exploreContent = document.getElementById('explore-content')
let exploreSB = document.getElementById('exploreSB')
let chartSB = document.getElementById('chartSB')
let playlistSB = document.getElementById('playlistSB')

const editPlaylistform = document.getElementById('editPlaylistform')

function exploreOpen() {
    playlistListContent.classList.add("dn")
    chartSB.classList.remove("active")
    listSB.classList.remove("active")
    chartContent.classList.add("dn")

    if (exploreContent.classList.contains("dn")) {
        exploreContent.classList.remove("dn")
        exploreSB.classList.add("active")
    }
    
}

function chartOpen() {
    playlistListContent.classList.add("dn")
    listSB.classList.remove("active")
    exploreSB.classList.remove("active")
    exploreContent.classList.add("dn")

    if (chartContent.classList.contains("dn")) {
        chartContent.classList.remove("dn")
        chartSB.classList.add("active")
    }
}

function editPlaylistOn() {
    editPlaylistform.classList.remove('dn')
    playlistListContent.classList.add('dn')
}

function editPlaylistOff() {
    editPlaylistform.classList.add('dn')
    playlistListContent.classList.remove('dn')
}