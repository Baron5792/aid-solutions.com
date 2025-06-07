function showConnectionStatus(isOnline) {
    // Create a popup element
    let popup = document.createElement('div');
    popup.innerText = isOnline ? "You’re back online! Connection restored." : "You’re offline! Check your internet connection.";
    
    // Apply styles based on connection status
    popup.style.position = 'fixed';
    popup.style.top = '10px';
    popup.style.right = '10px';
    popup.style.padding = '10px';
    popup.style.backgroundColor = isOnline ? '#4CAF50' : '#FF5733';  // Green for online, red for offline
    popup.style.color = '#fff';
    popup.style.borderRadius = '5px';
    popup.style.zIndex = '1000';

    // Append the popup to the body
    document.body.appendChild(popup);

    // Remove the popup after 3 seconds
    setTimeout(() => {
        popup.remove();
    }, 3000);
}

// Listen for online and offline events
window.addEventListener('online', () => showConnectionStatus(true));
window.addEventListener('offline', () => showConnectionStatus(false));
