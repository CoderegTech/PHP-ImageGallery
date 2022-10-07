<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/main.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="js/script.js" defer></script>
    <script src="js/post.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="lib/moment/moment.min.js"></script>
    <title>PHP Gallery</title>
</head>

<body>

    <!-- Warning alert -->
    <div class="alert hide">
        <p class="alert-msg"></p>
        <span id="alert-close"><i class="fa-solid fa-xmark"></i></span>
    </div>
    <div class="container">
        <header>
            <h1 class="title">Gallery.</h1>

            <button type="button" onclick="uploadModalActive()" class="upload-modal-btn">
                Upload Post
            </button>
        </header>

        <div class="gallery-container"></div>
    </div>
    <!-- Upload Post Modal -->
    <div class="uploadModal modal">
        <h2>Post</h2>
        <form id="uploadForm" class="form" enctype="multipart/form-data">
            <input id="postTitle" type="text" placeholder="Title..." name="postTitle" />
            <textarea id="postDescription" name="postDescription" placeholder="Description..."></textarea>
            <div class="droparea">
                <div class="imageBox">
                    <span class="removeBtn"><i class="fa-sharp fa-solid fa-xmark"></i></span>
                    <img src="" alt="" />
                </div>
                <i class="fa-regular fa-images"></i>
                <h2 id="msg">Drag & Drop Image to upload</h2>
                <span>or</span>
                <input id="fileInput" type="file" hidden name="postImage" accept="image/png,image/jpeg,image/jpg" />
                <button id="browseBtn" type="button">Browse File</button>
            </div>
            <div class="formBtn">
                <button type="button" onclick="uploadModalDeactive()" class="cancel-btn">
                    Cancel
                </button>
                <button id="postSubmit" type="submit" class="submit-btn" name="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
    <!-- Edit Post Modal -->
    <div class="editpost-modal modal">
        <h2>Edit Post</h2>
        <form id="updateForm" class="form" enctype="multipart/form-data">
            <input id="newTitle" type="text" placeholder="New Title..." name="newTitle" />
            <textarea id="newDescription" name="newDescription" placeholder="New Description..."></textarea>
            <div class="formBtn">
                <button type="button" onclick="editPostModalDeactive()" class="cancel-btn">
                    Cancel
                </button>
                <button id="updateSubmit" type="submit" class="submit-btn" name="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
</body>

</html>