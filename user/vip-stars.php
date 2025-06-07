
    <style>
        .freelancer-card {
            text-align: center;
            margin-bottom: 30px;
        }
        .freelancer-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .rating {
            color: #FFD700; /* Gold for the stars */
        }
    </style>

    <div class="container mt-5">
    <div class="col-12 col-md-12 dash_heaer_con mt-5">
        <div class="container dash_con">
            <p class="dash_header col-12 col-md-12">Top-Rated Freelancers</p>
        </div>
    </div>
        <div class="row mt-4" id="freelancers">
            <!-- Freelancer cards will be dynamically generated here -->
        </div>
    </div>

    <script>
        // Function to fetch random users from Random User API
        function fetchRandomUsers() {
            fetch('https://randomuser.me/api/?results=4') // Fetch 4 random users
                .then(response => response.json())
                .then(data => {
                    const users = data.results.map(user => {
                        return {
                            name: `${user.name.first} ${user.name.last}`,
                            picture: user.picture.large,
                            rating: Math.floor(Math.random() * 5) + 1 // Random rating between 1-5
                        };
                    });

                    // Store users in localStorage with timestamp
                    const timestamp = new Date().getTime();
                    localStorage.setItem('freelancers', JSON.stringify(users));
                    localStorage.setItem('lastFetchTime', timestamp);

                    // Display users
                    displayUsers(users);
                })
                .catch(error => console.error('Error fetching users:', error));
        }

        // Function to display users
        function displayUsers(users) {
            const freelancerContainer = document.getElementById('freelancers');
            freelancerContainer.innerHTML = ''; // Clear previous content

            users.forEach(user => {
                const freelancerCard = `
                    <div class="col-md-3">
                        <div class="freelancer-card">
                            <img src="${user.picture}" alt="${user.name}" class="freelancer-image">
                            <h5>${user.name}</h5>
                            <div class="rating">${generateStars(user.rating)}</div>
                        </div>
                    </div>
                `;
                freelancerContainer.innerHTML += freelancerCard;
            });
        }

        // Function to generate star ratings
        function generateStars(rating) {
            let stars = '';
            for (let i = 0; i < 5; i++) {
                stars += i < rating ? '<span>&#9733;</span>' : '<span>&#9734;</span>';
            }
            return stars;
        }

        // Check if we need to fetch new users or use cached ones
        function checkAndUpdateUsers() {
            const lastFetchTime = localStorage.getItem('lastFetchTime');
            const currentTime = new Date().getTime();
            const twentyFourHours = 24 * 60 * 60 * 1000;

            if (lastFetchTime && (currentTime - lastFetchTime) < twentyFourHours) {
                // Use cached users
                const cachedUsers = JSON.parse(localStorage.getItem('freelancers'));
                if (cachedUsers) {
                    displayUsers(cachedUsers);
                }
            } else {
                // Fetch new users if 24 hours have passed
                fetchRandomUsers();
            }
        }

        // Initial check to load users
        checkAndUpdateUsers();

    </script>

