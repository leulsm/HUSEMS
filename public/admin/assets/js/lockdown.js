// // Lockdown the browser
// function lockdownBrowser() {
//     // Disable right-click
//     document.addEventListener("contextmenu", function (event) {
//         event.preventDefault();
//     });

//     // Disable navigation

//     // Disable navigation
//     window.addEventListener("beforeunload", function (event) {
//         event.preventDefault();
//         event.returnValue = "";
//     });

//     // Disable keyboard shortcuts (e.g., Ctrl+Shift+I for opening DevTools)
//     document.addEventListener("keydown", function (event) {
//         // Disable F5 and Ctrl+R (page refresh)
//         if (event.key === "F5" || (event.ctrlKey && event.key === "r")) {
//             event.preventDefault();
//         }

//         // Disable Ctrl+Shift+I (DevTools)
//         if (event.ctrlKey && event.shiftKey && event.key === "I") {
//             event.preventDefault();
//         }
//     });

//     // Prevent focus change outside the desired context
//     var desiredContext = document.getElementById("desired-context");

//     document.addEventListener("blur", function (event) {
//         if (!desiredContext.contains(event.relatedTarget)) {
//             event.preventDefault();
//             desiredContext.focus();
//         }
//     });
//     history.pushState(null, null, location.href);
//     window.addEventListener("popstate", function (event) {
//         history.pushState(null, null, location.href);
//     });
// }

// // Call the lockdownBrowser function to initiate browser lockdown
// lockdownBrowser();
// Check for browser support
if (typeof document.hidden === "undefined") {
    // Page Visibility API not supported
    console.log("Page Visibility API is not supported in this browser.");
} else {
    // Set the name of the hidden property and the visibility change event
    var hidden = "hidden";
    var visibilityChange = "visibilitychange";

    // Add the event listener for visibility changes
    document.addEventListener(visibilityChange, handleVisibilityChange);

    // Function to handle visibility change
    function handleVisibilityChange() {
        if (document[hidden]) {
            // User switched tabs or moved away from the page
            // Show warning message or take appropriate action
            showWarningMessage();
        } else {
            // User switched back to the page
            // Hide the warning message or restore normal behavior
            hideWarningMessage();
        }
    }

    // Function to show the warning message
    function showWarningMessage() {
        // Display a warning message to the student
        alert(
            "Warning: Leaving this page or switching tabs is not allowed during the exam."
        );
    }

    // Function to hide the warning message
    function hideWarningMessage() {
        // Hide or remove the warning message
        // Implement the necessary logic based on your specific requirements
    }
}
