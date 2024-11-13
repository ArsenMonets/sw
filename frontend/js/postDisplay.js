current_type = 'all'

function fetchPosts(type = 'all') {
    current_type = type;
    fetch(`../backend/posts/display_posts.php?type=${encodeURIComponent(type)}`)
        .then(response => response.json())
        .then(data => {
            const postsList = document.getElementById('postList');
            postsList.innerHTML = '';  
            
            if (data.length > 0) {
                data.forEach(post => {
                    const postItem = document.createElement('li');
                    postItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                    
                    const postContent = document.createElement('div');
                    postContent.className = 'post-content';
                    
                    const postTitle = document.createElement('h5');
                    postTitle.textContent = post.top;
                    postContent.appendChild(postTitle);
                    
                    const postPar = document.createElement('p');
                    const postText = document.createElement('pre');
                    postText.textContent = post.text;
                    postPar.appendChild(postText);
                    postContent.appendChild(postPar);
                    
                    const postAuthor = document.createElement('small');
                    postAuthor.textContent = `Posted by: ${post.login}`;
                    postContent.appendChild(postAuthor);
                    
                    postItem.appendChild(postContent);

                    const actionButtons = document.createElement('div');
                    actionButtons.className = 'action-buttons';

                    if (type === 'my') {
                        const editButton = document.createElement('button');
                        editButton.className = 'btn btn-outline-primary btn-sm';
                        editButton.textContent = 'Edit';
                        editButton.addEventListener('click', () => {
                            editPost(post.id);
                        });
                        actionButtons.appendChild(editButton);

                        const deleteButton = document.createElement('button');
                        deleteButton.className = 'btn btn-outline-danger btn-sm';
                        deleteButton.textContent = 'Delete';
                        deleteButton.addEventListener('click', () => {
                            removePost(post.id);
                        });
                        actionButtons.appendChild(deleteButton);

                        actionButtons.className = 'action-buttons d-flex gap-2'; 
                    } else {
                        const likeButton = document.createElement('button');
                        if (post.is_user_like) {
                            likeButton.className = 'btn btn-outline-danger btn-sm';  // Using 'danger' for "Unlike"
                            likeButton.textContent = 'Unlike';
                        } else {
                            likeButton.className = 'btn btn-outline-success btn-sm';  // Corrected typo here
                            likeButton.textContent = 'Like';            
                        }
                        
                        likeButton.addEventListener('click', () => {
                            if (post.is_user_like) {
                                unlikePost(post.id);
                            } else {
                                likePost(post.id);
                            }
                        });
                        actionButtons.appendChild(likeButton);
                    }

                    postItem.appendChild(actionButtons);
                    
                    postsList.appendChild(postItem);

                    const likeCount = document.createElement('span');
                    likeCount.className = 'like-count';
                    likeCount.textContent = `Likes: ${post.likes}`; 
                    actionButtons.appendChild(likeCount);
                });
            }
        })
        .catch(error => console.error('Error fetching posts:', error));
}

function likePost(postId) {
    fetch(`../backend/posts/likes/like_post.php?id=${postId}`)
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.error('Error liking post:', data);
            } else {
                fetchPosts(current_type);
            }
        })
        .catch(error => console.error('Error liking post:', error));
}

function unlikePost(postId) {
    fetch(`../backend/posts/likes/unlike_post.php?id=${postId}`)
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.error('Error unliking post:', data);
            } else {
                fetchPosts(current_type);
            }
        })
        .catch(error => console.error('Error unliking post:', error));
}

document.getElementById('btnAllPosts').addEventListener('click', () => {
    fetchPosts('all');  
});

document.getElementById('btnFriendsPosts').addEventListener('click', () => {
    fetchPosts('friends');  
});

document.getElementById('btnMyPosts').addEventListener('click', () => {
    fetchPosts('my');  
});

document.getElementById('btnReload').addEventListener('click', () => {
    fetchPosts(current_type);  
});

function removePost(postId) {
    fetch(`../backend/posts/delete_post.php?post_id=${encodeURIComponent(postId)}`)
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            alert(`Error removing post: ${data.message}`);
        } else {
            fetchPosts(current_type); 
        }
    })
    .catch(error => {
        console.error('Error removing post:', error);
        alert('There was an error removing the post.');
    });
}

function editPost(postId) {
    const url = `edit_post.php?postId=${encodeURIComponent(postId)}`;
    window.location.assign(url);
}


fetchPosts(current_type);