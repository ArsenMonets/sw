current_type = 'all'

function fetchPosts(type = 'all') {
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
                    
                    const postText = document.createElement('p');
                    postText.textContent = post.text;
                    postContent.appendChild(postText);
                    
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
                            fetchPosts(type);
                        });
                        actionButtons.appendChild(deleteButton);

                        actionButtons.className = 'action-buttons d-flex gap-2'; 
                    } else {
                        const likeButton = document.createElement('button');
                        likeButton.className = 'btn btn-outline-success btn-sm';
                        likeButton.textContent = 'Like';
                        likeButton.addEventListener('click', () => {
                            likePost(post.login);
                            fetchPosts(type); 
                        });
                        actionButtons.appendChild(likeButton);
                    }

                    postItem.appendChild(actionButtons);
                    
                    postsList.appendChild(postItem);
                });
            }
        })
        .catch(error => console.error('Error fetching posts:', error));
    current_type = type;
}


function likePost(postLogin) {
    fetch(`../backend/posts/like_post.php?login=${encodeURIComponent(postLogin)}`)
        .then(response => response.json())
        .then(data => {
            console.log('Post liked:', data);
        })
        .catch(error => console.error('Error liking post:', error));
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
    fetch(`../backend/posts/delete_post.php?post_id=${encodeURIComponent(postId)}`, {
        method: 'POST',
    })
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
    const newTitle = prompt('Enter new title:');
    const newText = prompt('Enter new text:');

    if (newTitle && newText) {
        fetch(`../backend/posts/edit_post.php`, {
            method: 'POST',
            body: JSON.stringify({ id: postId, top: newTitle, text: newText }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Post updated successfully');
                fetchPosts(current_type);  
            } else {
                alert('Error updating post');
            }
        })
        .catch(error => console.error('Error updating post:', error));
    } else {
        alert('Title and text cannot be empty');
    }
}

fetchPosts(current_type);