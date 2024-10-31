// Variables to keep track of pagination
const itemsPerPage = 8; // Number of items per page
let currentPage = 1; // Current page number
let totalPages = 0; // Total number of pages
let data = []; // Global variable to store fetched data

// Function to fetch data from the API
async function fetchData() {
    try {
        const response = await fetch("https://kenyan-news-api.p.rapidapi.com/news/English", {
            "method": "GET",
            "headers": {
                "X-RapidAPI-Key": "205074b7d7msh8802ab10635d6eap183cf6jsn39bc913f5000",
                "X-RapidAPI-Host": "kenyan-news-api.p.rapidapi.com"
            }
        });
        data = await response.json();

        console.log("Response data:", data);

        if (data && data.length > 0) {
            totalPages = Math.ceil(data.length / itemsPerPage);
            displayPage(currentPage); // Display the initial page
            displayPagination();
        } else {
            console.log("No news items found in the response data");
        }
    } catch (error) {
        console.error("Error fetching or displaying news items:", error);
    }
}

// Function to display items for a specific page
function displayPage(page) {
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const pageData = data.slice(startIndex, endIndex);

    const newsContainer = document.getElementById("newsContainer");
    newsContainer.innerHTML = ""; // Clear previous content

    pageData.forEach(newsItem => {
        displayNewsItem(newsItem, newsContainer);
    });
}

// Function to display pagination controls
function displayPagination() {
    const paginationContainer = document.getElementById("pagination");
    paginationContainer.innerHTML = ""; // Clear previous pagination

    const prevButton = document.createElement("button");
    prevButton.textContent = "Previous";
    prevButton.disabled = currentPage === 1; // Disable if on first page
    prevButton.addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            displayPage(currentPage);
            updateButtonsState();
        }
    });
    paginationContainer.appendChild(prevButton);

    const nextButton = document.createElement("button");
    nextButton.textContent = "Next";
    nextButton.disabled = currentPage === totalPages; // Disable if on last page
    nextButton.addEventListener("click", () => {
        if (currentPage < totalPages) {
            currentPage++;
            displayPage(currentPage);
            updateButtonsState();
        }
    });
    paginationContainer.appendChild(nextButton);

    // Function to update buttons state (enabled/disabled) based on current page
    function updateButtonsState() {
        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage === totalPages;
    }
}

// Function to create and display news item elements
function displayNewsItem(newsItem, container) {
    const newsItemElement = document.createElement("div");
    newsItemElement.classList.add("news-item");

    newsItemElement.innerHTML = `
        <h2>${newsItem.title}</h2>
        <p>Author: ${newsItem.author}</p>
        <p>Published At: ${newsItem.publishedAt}</p>
        <img src="${newsItem.imgUrl}" alt="${newsItem.title}">
        <p><a href="${newsItem.url}" target="_blank">Read More</a></p>
    `;

    container.appendChild(newsItemElement);
}

fetchData(); // Fetch and display the initial page of data
