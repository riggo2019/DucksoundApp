$('.navbar-minimalize').on('click', function (event) {

    if ($("body").hasClass("mini-navbar")) {
        $("body").removeClass("mini-navbar");
    } else {
        $("body").addClass("mini-navbar");
    }
});

const songsElement = document.getElementById('songsData');
const chartsElement = document.getElementById('chartData');
const typelistElement = document.getElementById('typelistData');
const singerlistElement = document.getElementById('singerlistData');
const albumlistElement = document.getElementById('albumlistData');
const playlistlistElement = document.getElementById('playlistlistData');
const favoritelistElement = document.getElementById('favoritelistData');
const roleElement = document.getElementById('userroleData');
const adsElement = document.getElementById('adsData');

const songs = songsElement ? JSON.parse(songsElement.textContent) : [];
const charts = chartsElement ? JSON.parse(chartsElement.textContent) : [];
const typelist = typelistElement ? JSON.parse(typelistElement.textContent) : [];
const singerlist = singerlistElement ? JSON.parse(singerlistElement.textContent) : [];
const albumlist = albumlistElement ? JSON.parse(albumlistElement.textContent) : [];
const playlistlist = playlistlistElement ? JSON.parse(playlistlistElement.textContent) : [];
const favoritelist = favoritelistElement ? JSON.parse(favoritelistElement.textContent) : [];
const role = roleElement ? JSON.parse(roleElement.textContent) : [];
const ads = adsElement ? JSON.parse(adsElement.textContent) : [];

console.log(ads);

let player = document.getElementById('player')
let playerActions = document.getElementById('player-actions')
let Playerdescription = document.getElementById('Playerdescription')
let ADdescription = document.getElementById('ADdescription')

let songName = document.getElementById('song_name')
let singerName = document.getElementById('singer_name')
let songImage = document.getElementById('song_image')
let views = document.getElementById('views')
let songIdDL = document.getElementById('song_idDL')
let songIdIV = document.getElementById('song_idIV')
let songIdFB = document.getElementById('song_idFB')
let increViews = document.getElementById('increViews')

let progress = document.getElementById('progress')
let play = document.getElementById('play')
let loopBtn = document.getElementById('loop_btn')
let shuffleBtn = document.getElementById('shuffle_btn')

let currentTime = document.getElementById('current_time')
let duration = document.getElementById('duration')
let volumeSlider = document.getElementById('volumeSlider')
let volumeIcon = document.getElementById('volumeIcon')

let downloadMp3 = document.getElementById('downloadMp3')
let shareFB = document.getElementById('shareFB')
var originalShareFBAction = document.getElementById('shareFB').action;
const toggleBtn = document.getElementById('toggle-btn');
const addPLToggleBtn = document.getElementById('addPL-toggle-btn');
const toggleProfile = document.getElementById('toggle-profile');
let optionsContainer = document.getElementById('options-container')
let profileContainer = document.getElementById('profile-container')
let addPlaylistContainer = document.getElementById('addPlaylist-container')

const lyricsDialog = document.getElementById('lyricsDialog');
const closeButton = document.getElementById('closeButton');
const lyricsContent = document.getElementById('lyricsContent');
const copyLinkPlayer = document.getElementById('copyLinkPlayer');
const favoriteFormPlayer = document.getElementById('favorite-form-player');
const favouriteBtn = document.getElementById('favourite_btn');
const FFPI = document.getElementById('favorite-form-player-input')

let typeChoose = document.getElementById('type-choose')
let filterType = document.getElementById('filter_type')
var basePath = 'http://localhost/ducksound/public/';
let isShuffle = false;
let songIndex = 0;
const adAudio = document.getElementById('adAudio');

const adInsertTime = 30;
let songsPlayedCount = -1;
let songList = charts
loadSong(songList[songIndex])

function saveCurrentSong() {
    const currentSong = {
        id: songList[songIndex].id,
        name: songList[songIndex].song_name,
        singer: songList[songIndex].singer_name,
        file: songList[songIndex].song_file,
        image: songList[songIndex].song_image
    };
    sessionStorage.setItem('currentSong', JSON.stringify(currentSong));
}
loadSavedSong();

function loadSavedSong() {
    const savedSong = sessionStorage.getItem('currentSong');
    if (savedSong) {
        const song = JSON.parse(savedSong);
        const songIndex = songList.findIndex(s => s.id === song.id);
        if (songIndex !== -1) {
            loadSong(songList[songIndex]);
        }
    }
}

function playChart(i) {
    songList = charts
    loadSong(songList[i])
    playSong()
}

function playDefault(i) {
    songList = songs
    loadSong(songList[i])
    playSong()
}

function playtheoType(i) {
    songList = typelist
    songIndex = i
    loadSong(songList[songIndex])
    playSong()
}

function playtheoSinger(i) {
    songList = singerlist
    songIndex = i
    loadSong(songList[songIndex])
    playSong()
}

function playtheoAlbum(i) {
    songList = albumlist
    songIndex = i
    loadSong(songList[songIndex])
    playSong()
}

function playtheoPlaylist(i) {
    songList = playlistlist
    songIndex = i
    loadSong(songList[songIndex])
    playSong()
}

function playtheoFavorite(i) {
    songList = favoritelist
    songIndex = i
    loadSong(songList[songIndex])
    playSong()
}

function playSongs(i) {
    songList = songs
    for (var j = 0; j < songList.length; j++) {
        if (songList[j].id == i) {
            songIndex = j
            break
        }
    }
    loadSong(songList[songIndex])
    playSong()
}

function loadSong(song) {
    songsPlayedCount++
    console.log(songsPlayedCount)
    player.src = `${basePath}storage/song_file/${song.song_file}`
    songName.innerText = song.song_name
    singerName.innerText = song.singer_name
    views.value = `Lượt nghe: ${(song.views).toLocaleString('en-US')}`
    songImage.src = `${basePath}images/song/${song.song_image}`
    if (song.lyrics != null) {
        lyricsContent.textContent = song.lyrics
    } else {
        lyricsContent.textContent = "Bài hát này hiện chưa được cập nhật lời bài hát"
    }
    songIdDL.value = song.id
    songIdIV.value = song.id
    songIdFB.value = song.id
    copyLinkPlayer.addEventListener("click", function () {
        copyLink(song.id);
    });

    if (exists = favoritelist.some(item => item.id === song.id)) {
        favouriteBtn.classList.add("favourited");
    } else {
        favouriteBtn.classList.remove("favourited");
    }
    if (!favouriteBtn.classList.contains('favourited')) {
        favouriteBtn.addEventListener('click', function () {
            FFPI.value = song.id
            favoriteFormPlayer.submit()
            favouriteBtn.classList.add('favourited')
        })
    }

    shareFB.action = originalShareFBAction.replace('temp', song.id);
    increViews.submit();
    pauseSong()
}

function formatTime(time) {
    const minutes = Math.floor(time / 60);
    const seconds = Math.floor(time % 60);
    return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
}

//Thời gian thực của bài hát
player.onloadedmetadata = function () {
    progress.max = player.duration
    progress.value = player.currentTime
    duration.textContent = formatTime(player.duration)
}





function playSong() {
    player.classList.add('playing')
    play.classList.remove("bx-play")
    play.classList.add("bx-pause")
    player.play()
    saveCurrentSong();
}

function pauseSong() {
    player.classList.remove('playing')
    play.classList.remove("bx-pause")
    play.classList.add("bx-play")
    player.pause()
}
//nút bắt đầu, tạm dừng
function playPause() {
    const isPlaying = player.classList.contains('playing')
    if (isPlaying) {
        pauseSong()
    } else {
        playSong()
    }
}

//nút next bài mới, về bài trước đó

function prevSong() {
    songIndex--
    if (songIndex < 0) songIndex = songList.length - 1
    loadSong(songList[songIndex])
    playSong()
}

function shuffleSong() {
    songIndex = Math.floor(Math.random() * songList.length)
    loadSong(songList[songIndex])
    playSong()
}

function loopSong() {
    player.loop = !player.loop;
    if (player.loop) {
        loopBtn.classList.add("looping")
        if (shuffleBtn.classList.contains("shuffling")) {
            shuffleBtn.classList.remove("shuffling")
            isShuffle = false
        }
    } else {
        loopBtn.classList.remove("looping")
    }
}

function shuffle() {
    isShuffle = !isShuffle

    if (isShuffle) {
        player.addEventListener('ended', shuffleSong)
        shuffleBtn.classList.add("shuffling")
        if (loopBtn.classList.contains("looping")) {
            loopBtn.classList.remove("looping")
            player.loop = false
        }
    } else {
        shuffleBtn.classList.remove("shuffling")
        player.removeEventListener('ended', shuffleSong)
    }
}


function nextSong() {
    
    songIndex++
    if (songIndex > songList.length - 1) songIndex = 0
    loadSong(songList[songIndex])
    playSong()
}

function setProgress(e) {
    const width = this.clientWidth
    const clickX = e.offsetX
    const duration = player.duration
    player.currentTime = (clickX / width) * duration

}

// if (player.play()) {
//     setInterval(() => {
//         progress.value = player.currentTime
//         currentTime.textContent = formatTime(player.currentTime)
//     })
// }

//thanh process
setInterval(() => {
    if (player) {
        progress.value = player.currentTime;
        currentTime.textContent = formatTime(player.currentTime);
    }
});

//Tăng giảm âm lượng
volumeSlider.addEventListener('input', (e) => {
    player.volume = e.target.value
    if (player.volume == 0) {
        volumeIcon.classList.remove("bx-volume-full")
        volumeIcon.classList.add("bx-volume-mute")
    } else {
        volumeIcon.classList.remove("bx-volume-mute")
        volumeIcon.classList.add("bx-volume-full")
    }
})
//Mute
volumeIcon.onclick = () => {
    if (player.volume === 0) {
        player.volume = 1
        volumeSlider.value = 1
        volumeIcon.classList.remove("bx-volume-mute")
        volumeIcon.classList.add("bx-volume-full")
    } else {
        player.volume = 0
        volumeSlider.value = 0
        volumeIcon.classList.remove("bx-volume-full")
        volumeIcon.classList.add("bx-volume-mute")
    }
}

toggleBtn.addEventListener('click', function (event) {
    event.stopPropagation();
    optionsContainer.classList.contains("dn") ? optionsContainer.classList.remove("dn") : optionsContainer.classList.add("dn");
});

toggleProfile.addEventListener('click', function (event) {
    event.stopPropagation();
    profileContainer.classList.contains("dn") ? profileContainer.classList.remove("dn") : profileContainer.classList.add("dn");
});

addPLToggleBtn.addEventListener('click', function (event) {
    
    // event.stopPropagation();
    // addPlaylistContainer.classList.contains("dn") ? addPlaylistContainer.classList.remove("dn") : addPlaylistContainer.classList.add("dn");
});

document.querySelectorAll('.bx-plus').forEach(btn => {
    btn.addEventListener('click', function (event) {
        event.stopPropagation();
        var addPlaylistContainer = this.querySelector('.addPL_items');
        if (addPlaylistContainer.classList.contains("dn")) {
            document.querySelectorAll('.addPL_items').forEach(container => container.classList.add("dn"));
            addPlaylistContainer.classList.remove("dn");
        } else {
            addPlaylistContainer.classList.add("dn");
        }
    });
});



document.addEventListener('click', function (event) {
    if (!optionsContainer.contains(event.target) && event.target !== toggleBtn) {
        optionsContainer.classList.add("dn");
    }

    if (!profileContainer.contains(event.target) && event.target !== toggleProfile) {
        profileContainer.classList.add("dn");
    }
    document.querySelectorAll('.addPL_items').forEach(container => container.classList.add("dn"));
});

function showLyrics() {
    lyricsDialog.style.display = 'flex';
}
closeButton.addEventListener('click', function () {
    lyricsDialog.style.display = 'none';
});

function download() {
    downloadMp3.submit()
    showToast('Đã tải bài hát', 'success');
}
// Đóng dialog khi nhấn ra ngoài
window.addEventListener('click', function (event) {
    if (event.target === lyricsDialog) {
        lyricsDialog.style.display = 'none';
    }
});


function copyLink(id) {
    navigator.clipboard.writeText(`${basePath}songs/${id}`)
        .then(function () {
            // Thành công
            showToast('Copy thành công', 'success');
        })
        .catch(function (err) {
            // Thất bại
            showToast('Copy thất bại', 'error');
            console.error('Copy thất bại: ', err);
        });
}

function shareFBBtn() {
    shareFB.submit();
}



function chooseType(id) {
    typeChoose.value = id
    filterType.submit()
}
if(role == 2){
    player.addEventListener('timeupdate', function () {
        if (songsPlayedCount >= 3) {
            if (player.currentTime >= adInsertTime && !player.paused) {
                if(!playerActions.classList.contains('dn') && !Playerdescription.classList.contains('dn') && ADdescription.classList.contains('dn')){
                    playerActions.classList.add('dn');
                    Playerdescription.classList.add('dn')
                    ADdescription.classList.remove('dn')
                }
                player.pause();
                adAudio.play();
                songsPlayedCount = 0
            }
        }
    });
    adAudio.addEventListener('ended', function () {
        player.play();
        if(playerActions.classList.contains('dn') && Playerdescription.classList.contains('dn') && !ADdescription.classList.contains('dn')){
            playerActions.classList.remove('dn');
            Playerdescription.classList.remove('dn')
            ADdescription.classList.add('dn')
        }
    });
}


// Khi quảng cáo kết thúc, tiếp tục phát bài hát

progress.addEventListener('click', setProgress)

player.addEventListener('ended', nextSong)


