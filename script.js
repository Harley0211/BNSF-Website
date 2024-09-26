function openDialog() {
  document.getElementById("uploadDialog").style.display = "block";
}

function closeDialog() {
  document.getElementById("uploadDialog").style.display = "none";
}

function previewImage(event) {
  const preview = document.getElementById("previewPic");
  const file = event.target.files[0];
  const reader = new FileReader();
  reader.onload = function () {
    preview.src = reader.result;
  };
  if (file) {
    reader.readAsDataURL(file);
  }
}

function saveProfile() {
  const profilePic = document.getElementById("profilePic");
  const previewPic = document.getElementById("previewPic").src;
  profilePic.src = previewPic;
  closeDialog(); 

function toggleSubjects() {
  const moreSubjects = document.getElementById("moreSubjects");
  const toggleButton = document.getElementById("toggleButton");

  if (moreSubjects.classList.contains("show-subjects")) {
    moreSubjects.classList.remove("show-subjects");
    toggleButton.innerHTML = "&#x25BC;"; 
    toggleButton.classList.remove("up");
  } else {
    moreSubjects.classList.add("show-subjects");
    toggleButton.innerHTML = "&#x25B2;"; 
    toggleButton.classList.add("up");
  }
}


var modal = document.getElementById("id01");

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
}