document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Collect form data
    const projectName = document.getElementById('project-name').value;
    const projectDescription = document.getElementById('project-description').value;
    const projectCode = document.getElementById('project-code').value;
    const youtubeLink = document.getElementById('youtube-link').value;

    // Handle project image
    const projectImageFile = document.getElementById('project-image').files[0]; // Get the uploaded project image
    if (projectImageFile) {
        const projectImageReader = new FileReader();
        projectImageReader.onload = function(e) {
            localStorage.setItem('projectImage', e.target.result); // Store the project image data in localStorage
        }
        projectImageReader.readAsDataURL(projectImageFile); // Read the project image file as data URL
    }

    // Handle circuit diagram image
    const circuitDiagramFile = document.getElementById('circuit-diagram').files[0]; // Get the uploaded circuit diagram
    if (circuitDiagramFile) {
        const circuitDiagramReader = new FileReader();
        circuitDiagramReader.onload = function(e) {
            localStorage.setItem('circuitDiagram', e.target.result); // Store the circuit diagram data in localStorage
        }
        circuitDiagramReader.readAsDataURL(circuitDiagramFile); // Read the circuit diagram file as data URL
    }

    // Store other data in localStorage
    localStorage.setItem('projectName', projectName);
    localStorage.setItem('projectDescription', projectDescription);
    localStorage.setItem('projectCode', projectCode);
    localStorage.setItem('youtubeLink', youtubeLink);

    // Redirect to generated.html
    window.location.href = "generated.html";
});
