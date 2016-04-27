function appearDelete(id) {
    document.getElementById('img'+id).style.display = "none";
    document.getElementById('delete'+id).style.visibility = "inline";
}

function hideDelete(id) {
    document.getElementById('img'+id).style.visibility = "inline";
    document.getElementById('delete'+id).style.visibility = "none";
}