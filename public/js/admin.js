const addTypeForm = document.getElementById('addTypeForm');
const editTypeForm = document.getElementById('editTypeForm');
const addSingerForm = document.getElementById('addSingerForm');
const editSingerForm = document.getElementById('editSingerForm');
const addAlbumForm = document.getElementById('addAlbumForm');
const editAlbumForm = document.getElementById('editAlbumForm');

function openTypeAdd() {
    if (addTypeForm.classList.contains('dn')){
        addTypeForm.classList.remove('dn');
    }
    editTypeForm.classList.add('dn');
}
function closeTypeAdd() {
    if (!addTypeForm.classList.contains('dn')){
        addTypeForm.classList.add('dn');
    }
}
function openTypeEdit(value) {
    document.getElementById('editTypeName').value = value
    if (editTypeForm.classList.contains('dn')){
        editTypeForm.classList.remove('dn');
    }
    addTypeForm.classList.add('dn');
}
function closeTypeEdit() {
    if (!editTypeForm.classList.contains('dn')){
        editTypeForm.classList.add('dn');
    }
}


function openSingerAdd() {
    if (addSingerForm.classList.contains('dn')){
        addSingerForm.classList.remove('dn');
    }
    editSingerForm.classList.add('dn');
}
function closeSingerAdd() {
    if (!addSingerForm.classList.contains('dn')){
        addSingerForm.classList.add('dn');
    }
}
function openSingerEdit(value) {
    document.getElementById('editSingerName').value = value
    if (editSingerForm.classList.contains('dn')){
        editSingerForm.classList.remove('dn');
    }
    addSingerForm.classList.add('dn');
}
function closeSingerEdit() {
    if (!editSingerForm.classList.contains('dn')){
        editSingerForm.classList.add('dn');
    }
}

function openAlbumAdd() {
    if (addAlbumForm.classList.contains('dn')){
        addAlbumForm.classList.remove('dn');
    }
    editAlbumForm.classList.add('dn');
}
function closeAlbumAdd() {
    if (!addAlbumForm.classList.contains('dn')){
        addAlbumForm.classList.add('dn');
    }
}
function openAlbumEdit(album_id, singer_name) {
    console.log(album_id + singer_name )
    document.getElementById('editAlbumName').value = album_id
    document.getElementById('editAlbumSinger').value = singer_name
    if (editAlbumForm.classList.contains('dn')){
        editAlbumForm.classList.remove('dn');
    }
    addAlbumForm.classList.add('dn');
}
function closeAlbumEdit() {
    if (!editAlbumForm.classList.contains('dn')){
        editAlbumForm.classList.add('dn');
    }
}