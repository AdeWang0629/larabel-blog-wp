
function previewFile(id) {
    console.log(id);
    const fileInput = document.getElementById('upload-file'+id);
    const fileIcon = document.getElementById('file-icon'+id);
    const selectedFile = document.getElementById('selected-file'+id);

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            fileIcon.style.display = 'none';
            selectedFile.src = e.target.result;
            selectedFile.style.display = 'inline-block';
        }
        reader.readAsDataURL(fileInput.files[0]);
    } else {
        fileIcon.style.display = 'inline-block';
        selectedFile.style.display = 'none';
    }
}