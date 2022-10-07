// Add Post Modal Activate
const uploadModalActive = (selectedFile) => {
  document.querySelector(".uploadModal").classList.add("show");
  document.querySelector(".editpost-modal").classList.remove("show");
  document.querySelector("html").style.overflow = "hidden";

  uploadPost(selectedFile);
};

// Add Post Modal Deactivate
const uploadModalDeactive = () => {
  document.querySelector(".uploadModal").classList.remove("show");
  document.querySelector("html").style.overflow = "";
};

// Add Post Modal Activate
const editPostModalActive = (id) => {
  document.querySelector(".editpost-modal").classList.add("show");
  document.querySelector("html").style.overflow = "hidden";

  // Update Post function
  getSelectedPost(id);
};

// Add Post Modal Deactivate
const editPostModalDeactive = () => {
  document.querySelector(".editpost-modal").classList.remove("show");
  document.querySelector("html").style.overflow = "";
};

// Upload Image
const fileInput = document.querySelector("#fileInput");
const browseBtn = document.querySelector("#browseBtn");
const uploadForm = document.querySelector("#uploadForm");
const updateForm = document.querySelector("#updateForm");
const imageBox = document.querySelector(".imageBox");
const cancelBtn = document.querySelector(".removeBtn");
const imageView = imageBox.querySelector("img");

// Accepted File Types
const acceptedFiles = ["image/png", "image/jpeg", "image/jpg"];

// To prevent browser reload when form submitted
uploadForm.onsubmit = (e) => e.preventDefault();
updateForm.onsubmit = (e) => e.preventDefault();

// To trigger Browse File button
browseBtn.onclick = () => fileInput.click();
fileInput.addEventListener("change", () => {
  const selectedFile = fileInput.files[0];

  selectedFileFunc(selectedFile);
});

// Drag & drop
const dropArea = document.querySelector(".droparea");
const dropAreaMsg = dropArea.querySelector("#msg");

// When Drag file is over the dropArea
dropArea.addEventListener("dragover", (e) => {
  e.preventDefault();
  const msgDrop = "Drop your file to upload";
  dropAreaMsg.textContent = msgDrop;
});

// When Drag file Leave the dropArea
dropArea.addEventListener("dragleave", () => {
  console.log("leave");
  dropAreaMsg.textContent = "Drag & Drop Image to upload";
});

dropArea.addEventListener("drop", (e) => {
  e.preventDefault();
  const dt = e.dataTransfer;
  const selectedFile = dt.files[0];

  selectedFileFunc(selectedFile);
});

// function that ge the selectFile
const selectedFileFunc = (selectedFile) => {
  // Required file size is 2000000 bytes that is equal to 2mb(megabytes)
  if (selectedFile.size < 2000000) {
    // Validate File Type
    if (acceptedFiles.includes(selectedFile.type)) {
      // Preview File to User
      filePreview(selectedFile);

      uploadModalActive(selectedFile);
    } else {
      alertMsg("Invalid File Type!", "error");
    }
  } else {
    alertMsg("Your file is to big!", "error");
  }
};

// Preview Selected File
const filePreview = (file) => {
  // FileReader Class
  let fileReader = new FileReader();

  fileReader.readAsDataURL(file);
  fileReader.onload = (e) => {
    imageBox.style.display = "block";
    imageView.src = e.target.result;
  };

  // Cancel Image
  cancelBtn.onclick = () => {
    imageView.src = "";
    imageBox.style.display = "none";
  };
};

// Alert message
const alertMsg = (msg, msgAlertType) => {
  const alert = document.querySelector(".alert");
  const alertMsg = document.querySelector(".alert-msg");
  const alertClose = document.querySelector("#alert-close");

  if (msgAlertType === "success") {
    alertMsg.textContent = msg;
    alert.style.background = "rgb(0, 192, 48)";
    alert.classList.replace("hide", "show");
  } else if (msgAlertType === "error") {
    alertMsg.textContent = msg;
    alert.style.background = "rgb(255, 0, 0)";
    alert.classList.replace("hide", "show");
  }

  setTimeout(() => {
    alert.classList.replace("show", "hide");
  }, 5000);

  alertClose.onclick = () => alert.classList.replace("show", "hide");
};
