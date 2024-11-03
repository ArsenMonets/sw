function addFriend(friendLogin) {
    fetch(`../backend/add_friends/add_friend.php?friend=${encodeURIComponent(friendLogin)}`, {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            alert(`Error adding friend: ${data.message}`);
        }
    })
    .catch(error => console.error('Error adding friend:', error));
}

function removeFriend(friendLogin) {

}

function fetchFriends(query = '') {
    fetch(`../backend/add_friends/display_users.php?query=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            const friendsList = document.getElementById('friendsList');
            friendsList.innerHTML = ''; 
            
            if (data.length > 0) {
                data.forEach(friend => {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item d-flex justify-content-between align-items-center';

                    const actionButton = document.createElement('button');
                    actionButton.className = 'btn btn-primary btn-sm';

                    if (friend['isFriend'] == '1') {
                        actionButton.textContent = 'Remove Friend';
                        actionButton.addEventListener('click', () => {
                            removeFriend(friend['login']);
                            fetchFriends(query);
                        });
                    } else {
                        actionButton.textContent = 'Add Friend';
                        actionButton.addEventListener('click', () => {
                            addFriend(friend['login']);
                            fetchFriends(query);
                        });
                    }

                    listItem.innerHTML = friend.login; 
                    listItem.appendChild(actionButton); 
                    friendsList.appendChild(listItem);
                });
            }
        })
        .catch(error => console.error('Error fetching friends:', error));
}

fetchFriends();

document.getElementById('friendSearch').addEventListener('input', function() {
    const query = this.value;
    fetchFriends(query);  
});