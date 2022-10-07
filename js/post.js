// SendHttpRequest
const sendHttpRequest = (method, route, data) => {
  const promise = new Promise((resolve, reject) => {
    let xhr = new XMLHttpRequest();
    xhr.open(method, `http://localhost/phpGallery/php${route}`, true);
    xhr.onload = () => {
      resolve(xhr.response);
    };

    xhr.send(data);
  });
  return promise;
};

// Get Selected Post
const getSelectedPost = async (id) => {
  let formData = new FormData();
  formData.append("uid", id);

  await sendHttpRequest("POST", "/getSelectedPost.php", formData)
    .then((response) => {
      const { uid, postTitle, postDescription } = JSON.parse(response)[0];

      updatePost(uid, postTitle, postDescription);
    })
    .catch((error) => {
      console.log(error);
    });
};

const galleryContainer = document.querySelector(".gallery-container");

// View Post
const viewPosts = async () => {
  await sendHttpRequest("GET", "/getPosts.php")
    .then((response) => {
      if (response) {
        const results = JSON.parse(response);
        const posts = results.map(
          ({ uid, postTitle, postDescription, postImage, postCreated }) => {
            return `
            <div class="post">
              <div class="img-box">
                  <img src="php/uploads/${postImage}" alt="" />
              </div>
              <div class="text-content">
                  <div class="options">
                      <span class="timeago">${moment(
                        postCreated
                      ).fromNow()} </span>
                      <div class="options-btn">
                          <span onclick="editPostModalActive('${uid}')" class="edit"><i
                                  class="fa-solid fa-pen-to-square"></i></span>
                          <span onclick="deletePost('${uid}', '${postImage}')" class="del"><i
                                  class="fa-solid fa-trash-can"></i></span>
                      </div>
                  </div>
                  <div class="title-row">
                      <h2>${postTitle}</h2>
                  </div>
                  <p>
                      ${postDescription}
                  </p>
              </div>
          </div>
              `;
          }
        );
        galleryContainer.innerHTML = posts.join("");
      } else {
        galleryContainer.innerHTML = "<h2>No Posts!</h2>";
      }
    })
    .catch((error) => {
      alertMsg(error, "error");
    });
};

document.addEventListener("DOMContentLoaded", viewPosts);

// Edit Post Modal Activate
const editPostModal = document.querySelector(".editpost-modal");
const editPost = (id) => editPostModal.classList.add("show");

// Upload Post
const uploadPost = (file) => {
  const postSubmit = document.querySelector("#postSubmit");

  const postTitle = document.querySelector("#postTitle");
  const postDescription = document.querySelector("#postDescription");
  const postImage = document.querySelector("#fileInput");
  const postCreated = moment().format("YYYY-MM-DD HH:mm:ss");

  let formData = new FormData();
  formData.append("postTitle", postTitle.value);
  formData.append("postDescription", postDescription.value);
  formData.append("postImage", postImage.files[0] || file);
  formData.append("postCreated", postCreated);

  postSubmit.onclick = async () => {
    if (!postTitle.value || !postDescription.value || !postImage.files) {
      alertMsg("Please Fill up all fields", "error");
    } else {
      await sendHttpRequest("POST", "/uploadPost.php", formData)
        .then((response) => {
          alertMsg(response, "success");
          viewPosts();
        })
        .catch((error) => {
          alertMsg(error, "error");
        });
    }

    postTitle.value = "";
    postDescription.value = "";
    imageBox.style.display = "none";
  };
};

// Update Post
const updatePost = (uid, postTitle, postDescription) => {
  const newTitle = document.querySelector("#newTitle");
  const newDescription = document.querySelector("#newDescription");

  newTitle.value = postTitle;
  newDescription.value = postDescription;

  const updateSubmitBtn = document.querySelector("#updateSubmit");

  updateSubmitBtn.onclick = async () => {
    let formData = new FormData();
    formData.append("uid", uid);
    formData.append("newPostTitle", newTitle.value);
    formData.append("newPostDescription", newDescription.value);

    if (!newTitle.value || !newDescription.value) {
      alertMsg("Please Fill up all fields", "error");
    } else {
      await sendHttpRequest("POST", "/updatePost.php", formData)
        .then((response) => {
          alertMsg(response, "success");
          viewPosts();
        })
        .catch((error) => {
          alertMsg(error, "error");
        });
    }

    newTitle.value = "";
    newDescription.value = "";
  };
};

// Delte Post
const deletePost = async (id, postImageName) => {
  let formData = new FormData();
  formData.append("uid", id);
  formData.append("postImage", postImageName);

  await sendHttpRequest("POST", "/deletePost.php", formData)
    .then((response) => {
      alertMsg(response, "success");
      viewPosts();
    })
    .catch((error) => {
      alertMsg(error, "error");
    });
};
