// Light-Blue Theme JavaScript

// Smooth scrolling for navigation links
document.querySelectorAll('nav ul li a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);  // Get the target section ID
        const targetElement = document.getElementById(targetId);

        // Scroll to the section with an offset of 50px for better alignment
        window.scrollTo({
            top: targetElement.offsetTop - 50,
            behavior: 'smooth'
        });
    });
});

// Highlight active section on scroll
window.addEventListener('scroll', () => {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('nav ul li a');

    let currentSection = ''; // Track the current section in view

    sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;  // Offset for the header
        if (window.scrollY >= sectionTop) {
            currentSection = section.getAttribute('id');  // Update the active section
        }
    });

    // Update active link based on the current section
    navLinks.forEach(link => {
        link.classList.remove('active');  // Remove active class from all links
        if (link.getAttribute('href').substring(1) === currentSection) {
            link.classList.add('active');  // Add active class to the current section's link
        }
    });
});

// Toggle mobile navigation menu (for smaller screens)
document.querySelector('.mobile-menu-toggle').addEventListener('click', () => {
    // Toggle the class to show or hide the mobile menu
    document.querySelector('nav ul').classList.toggle('show');
});

// Display project details dynamically (for easy project updates)
const projects = [
    { title: "College Management System", description: "A comprehensive system for managing college operations including student records, staff, and courses." },
    { title: "E-commerce Gift Card App", description: "An application for buying and selling gift cards online with secure payment options." },
    { title: "Agricultural Web Platform", description: "A platform connecting farmers with buyers and providing agricultural resources." }
];

const projectsContainer = document.querySelector('.projects');  // Get the container for project listings

projects.forEach(project => {
    const projectElement = document.createElement('div');  // Create a new div for each project
    projectElement.classList.add('project');  // Add the 'project' class to style it
    projectElement.innerHTML = `
        <h3>${project.title}</h3>  <!-- Project title -->
        <p>${project.description}</p>  <!-- Project description -->
    `;
    projectsContainer.appendChild(projectElement);  // Append the project to the container
});

// Optionally, you can style the active navigation link for a better user experience
// (This is CSS that you can add to your style.css for the active class)
