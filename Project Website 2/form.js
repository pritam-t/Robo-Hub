// script.js
document.getElementById('infoForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Collect the form data
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const project = document.getElementById('project').value;
    const description = document.getElementById('description').value;

    // Create a new page using the collected data
    const newPageContent = `
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>${project}</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <h1>${project}</h1>
            <h2>By: ${name}</h2>
            <p>Email: ${email}</p>
            <h3>Description:</h3>
            <p>${description}</p>
        </body>
        </html>
    `;

    // Store the new page content in localStorage
    localStorage.setItem('generatedPage', newPageContent);

    // Redirect to the new page
    window.location.href = 'generated.html';
});
