document.addEventListener('DOMContentLoaded', function () {
    checkAuthStatus();
});

function checkAuthStatus() {
    fetch('check_session.php')
        .then(response => response.json())
        .then(data => {
            updateNavigation(data);
        })
        .catch(error => {
            console.error('Error checking auth status:', error);
            updateNavigation({ loggedIn: false });
        });
}

function updateNavigation(authData) {
    const signinBtn = document.querySelector('.signin-btn');
    const navContainer = document.querySelector('.container');

    if (!signinBtn || !navContainer) {
        console.error('Navigation elements not found');
        return;
    }

    if (authData.loggedIn) {
        // User is logged in - show greeting and sign out button
        signinBtn.style.display = 'none';

        // Create greeting and sign-out button
        let greetingContainer = document.querySelector('.user-greeting');
        if (!greetingContainer) {
            greetingContainer = document.createElement('div');
            greetingContainer.className = 'user-greeting';
            greetingContainer.innerHTML = `
                <span>Hello, ${authData.username}</span>
                <button class="signout-btn signin-btn">Sign Out</button>
            `;
            navContainer.appendChild(greetingContainer);
        
            // Add event listener for sign out
            const signoutBtn = greetingContainer.querySelector('.signout-btn');
            signoutBtn.addEventListener('click', handleSignOut);
        }
    } else {
        // User is not logged in - show sign in button
        signinBtn.style.display = 'inline-block';

        // Remove greeting and sign-out button if they exist
        const greetingContainer = document.querySelector('.user-greeting');
        if (greetingContainer) {
            greetingContainer.remove();
        }
    }
}
if (!greetingContainer) {
    greetingContainer = document.createElement('div');
    greetingContainer.className = 'user-greeting';
    greetingContainer.innerHTML = `
        <span id="welcome-text">Hello, ${authData.username}</span>
        <button class="signin-btn signout-btn">Sign Out</button>
    `;
    navContainer.appendChild(greetingContainer);

    // Add event listener for sign out
    const signoutBtn = greetingContainer.querySelector('.signout-btn');
    signoutBtn.addEventListener('click', handleSignOut);
}
function handleSignOut() {
    fetch('logout.php', { method: 'POST' })
        .then(response => {
            if (response.ok) {
                // Redirect to the signin page after logout
                window.location.href = 'signin.html';
            } else {
                console.error('Logout failed');
            }
        })
        .catch(error => {
            console.error('Error during sign out:', error);
        });
        const signoutBtn = document.querySelector('.signout-btn');
if (signoutBtn) {
    signoutBtn.addEventListener('click', handleSignOut);
}
}