<style>
    /* Style for the full-screen loading spinner */
    .loading-spinner {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.3);
        /* Light overlay */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        /* Make sure it's above everything */
    }

    /* The spinner itself */
    .spinner {
        border: 2px solid #f3f3f3;
        /* Light gray */
        border-top: 2px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
    }

    /* Animation for the spinner */
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>


<!-- Loading Spinner -->
<div id="loading-spinner" class="loading-spinner">
    <div class="spinner"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loadingSpinner = document.getElementById('loading-spinner');

        // Show the spinner when the page starts loading
        window.addEventListener('load', function() {
            loadingSpinner.style.display = 'none'; // Hide the spinner
        });

        // Optional: Show the spinner when navigating away from the page
        window.addEventListener('beforeunload', function() {
            loadingSpinner.style.display = 'flex'; // Show the spinner again
        });
    });
</script>
