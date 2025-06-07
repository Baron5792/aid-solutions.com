document.addEventListener('DOMContentLoaded', function() {
    // (Your array of questions goes here)
const questions = [
    {
        question: "Which project management tool is popular among freelancers for organizing tasks and tracking project progress?",
        options: ["Trello", "Adobe XD", "Canva", "Slack"],
        correct: "Trello"
    },
    {
        question: "What is the primary purpose of a Gantt chart in project management?",
        options: ["To track financial expenses", "To visualize project timelines and milestones", "To communicate with clients", "To store project files"],
        correct: "To visualize project timelines and milestones"
    },
    {
        question: "Which version control system is widely used by freelancers to manage code changes?",
        options: ["Git", "SVN", "Mercurial", "CVS"],
        correct: "Git"
    },
    {
        question: "What is the best practice for responding to client emails?",
        options: ["Respond within a week", "Respond within 24-48 hours", "Respond immediately, regardless of current tasks", "Ignore until the end of the project"],
        correct: "Respond within 24-48 hours"
    },
    {
        question: "Which platform is commonly used by freelancers to conduct video calls with clients?",
        options: ["Zoom", "WhatsApp", "Instagram", "Trello"],
        correct: "Zoom"
    },
    {
        question: "Why is it important to have a project brief before starting work?",
        options: ["To bill the client more hours", "To have a clear understanding of client expectations and project scope", "To show off your skills", "To find errors in the client's requirements"],
        correct: "To have a clear understanding of client expectations and project scope"
    },
    {
        question: "Which tool can freelancers use to invoice clients and track payments?",
        options: ["FreshBooks", "Photoshop", "Dropbox", "Trello"],
        correct: "FreshBooks"
    },
    {
        question: "What is the recommended practice for setting freelance rates?",
        options: ["Based on the average market rate and personal skill level", "The lowest possible to get more clients", "Fixed rate for all types of work", "Higher than all competitors"],
        correct: "Based on the average market rate and personal skill level"
    },
    {
        question: "What is an important aspect of managing freelance finances?",
        options: ["Mixing personal and business finances", "Keeping detailed records of income and expenses", "Only tracking large payments", "Ignoring taxes until the end of the year"],
        correct: "Keeping detailed records of income and expenses"
    },
    {
        question: "What should be included in a freelance contract?",
        options: ["Project scope, payment terms, deadlines, and deliverables", "Only payment terms", "Client's personal information", "Project scope and deliverables"],
        correct: "Project scope, payment terms, deadlines, and deliverables"
    },
    {
        question: "Why is it important to have a written agreement with clients?",
        options: ["To enforce legal boundaries and clarify expectations", "To charge more money", "To have something to argue over", "To delay the project start"],
        correct: "To enforce legal boundaries and clarify expectations"
    },
    {
        question: "Which of the following is a critical component of a freelance contract?",
        options: ["Penalty for late payments", "Client's hobbies", "Freelancer's social media links", "Non-professional contact details"],
        correct: "Penalty for late payments"
    },
    {
        question: "Which platform is commonly used by freelancers to showcase their portfolio?",
        options: ["Behance", "LinkedIn", "Twitter", "Reddit"],
        correct: "Behance"
    },
    {
        question: "What is a key strategy for acquiring new freelance clients?",
        options: ["Networking and building relationships", "Spamming potential clients", "Only relying on job boards", "Offering free services indefinitely"],
        correct: "Networking and building relationships"
    },
    {
        question: "What should be included in a freelancer's online portfolio?",
        options: ["Samples of previous work and client testimonials", "Personal photos", "Only contact information", "Daily schedule"],
        correct: "Samples of previous work and client testimonials"
    },
    {
        question: "Which website offers courses and certifications for freelancers to improve their skills?",
        options: ["Coursera", "Facebook", "Pinterest", "Reddit"],
        correct: "Coursera"
    },
    {
        question: "Why is continuous learning important for freelancers?",
        options: ["To keep up with industry trends and improve service quality", "To delay client projects", "To fill up free time", "To charge more without improving skills"],
        correct: "To keep up with industry trends and improve service quality"
    },
    {
        question: "What is the benefit of attending industry conferences and workshops?",
        options: ["Networking and staying updated with industry developments", "To take a vacation", "To avoid client work", "To get free stuff"],
        correct: "Networking and staying updated with industry developments"
    },
    {
        question: "Which tool is commonly used for designing graphics and visuals?",
        options: ["Adobe Photoshop", "Microsoft Word", "Google Sheets", "Trello"],
        correct: "Adobe Photoshop"
    },
    {
        question: "What is the purpose of using time-tracking software as a freelancer?",
        options: ["To track billable hours and manage productivity", "To waste time", "To monitor clients", "To reduce workload"],
        correct: "To track billable hours and manage productivity"
    },
    {
        question: "Which platform is known for freelancers to find and bid on projects?",
        options: ["Upwork", "Instagram", "YouTube", "WhatsApp"],
        correct: "Upwork"
    },
    {
        question: "What is an effective strategy for negotiating freelance rates with clients?",
        options: ["Understanding the client's budget and justifying your rate with value", "Accepting the first offer", "Ignoring client needs", "Asking for the highest possible rate without explanation"],
        correct: "Understanding the client's budget and justifying your rate with value"
    },
    {
        question: "Why is it important to set clear project milestones?",
        options: ["To ensure structured progress and manage client expectations", "To delay payment", "To confuse the client", "To complete the project as quickly as possible"],
        correct: "To ensure structured progress and manage client expectations"
    },
    {
        question: "Which of the following is a good practice when delivering a project update to a client?",
        options: ["Providing a detailed report on progress and any issues", "Giving minimal information", "Only updating at the end of the project", "Ignoring client questions"],
        correct: "Providing a detailed report on progress and any issues"
    },
    {
        question: "What is a recommended practice for maintaining a healthy work-life balance as a freelancer?",
        options: ["Setting regular work hours and taking breaks", "Working non-stop", "Ignoring personal needs", "Accepting every project regardless of workload"],
        correct: "Setting regular work hours and taking breaks"
    },
    {
        question: "How can freelancers improve their productivity?",
        options: ["By using productivity tools and setting clear goals", "By multitasking on unrelated activities", "By constantly checking social media", "By working without a plan"],
        correct: "By using productivity tools and setting clear goals"
    },
    {
        question: "Which tool can help freelancers manage their tasks and deadlines effectively?",
        options: ["Asana", "Instagram", "Netflix", "WhatsApp"],
        correct: "Asana"
    },
    {
        question: "Why is it important to get client feedback during a project?",
        options: ["To ensure the project is on track and meets client expectations", "To charge more", "To reduce work quality", "To complete the project faster"],
        correct: "To ensure the project is on track and meets client expectations"
    },
    {
        question: "What should a freelancer do if they encounter a problem they can't solve?",
        options: ["Communicate with the client and seek help if needed", "Ignore the problem", "Blame the client", "Quit the project"],
        correct: "Communicate with the client and seek help if needed"
    },
    {
        question: "What is the benefit of delivering high-quality work to clients?",
        options: ["It leads to repeat business and positive referrals", "It allows for higher rates without justification", "It reduces the need for contracts", "It eliminates the need for client communication"],
        correct: "It leads to repeat business and positive referrals"
    }
];

let selectedQuestions = [];

function getRandomQuestions(arr, num) {
    const shuffled = arr.sort(() => 0.5 - Math.random());
    return shuffled.slice(0, num);
}

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

function displayQuestions() {
    selectedQuestions = getRandomQuestions(questions, 10);
    const container = document.getElementById('questionsContainer');
    container.innerHTML = ''; // Clear previous questions

    selectedQuestions.forEach((q, index) => {
        const options = [...q.options];
        shuffleArray(options); // Shuffle the options
        
        const questionDiv = document.createElement('div');
        questionDiv.classList.add('form-group', 'question');
        questionDiv.innerHTML = `
            <label>${index + 1}. ${q.question}</label>
            ${options.map((option, i) => `
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question${index}" id="question${index}_option${i}" value="${option}">
                    <label class="form-check-label" for="question${index}_option${i}">
                        ${option}
                    </label>
                </div>
            `).join('')}
        `;
        container.appendChild(questionDiv);
    });
}

function checkAnswers() {
    const form = document.getElementById('surveyForm');
    const formData = new FormData(form);
    let correctAnswersCount = 0;

    selectedQuestions.forEach((q, index) => {
        const answer = formData.get(`question${index}`);
        if (answer === q.correct) {
            correctAnswersCount++;
        }
    });

    return correctAnswersCount;
}

// Initial display of questions
displayQuestions();

// Event listener for form submission
document.getElementById('surveyForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const correctAnswersCount = checkAnswers();
    document.getElementById("result").value = correctAnswersCount;
    // alert(`Correct answers: ${correctAnswersCount}`); // Use alert to display the result
});
});










