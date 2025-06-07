<?php
include __DIR__ . '/../database.php'; // Ensure this file includes the database connection logic

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jobTitle = $_POST['jobTitle'];

    // Prepare the SQL query to search for job titles or descriptions
    $query = "SELECT * FROM job WHERE title LIKE ? OR description LIKE ?";
    $stmt = $connection->prepare($query);
    $searchTerm = '%' . $jobTitle . '%';
    $stmt->bind_param('ss', $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $skill = $row['skills'];
            $experience = $row['experience'];
            // $salary_start = $row['salary_start'];
            $salary_stop = $row['salary_stop'];
            $location = $row['location'];
            $deadline = $row['deadline'];
            $for = $row['schedule'];
            $category = $row['category'];
            $contact_name = $row['contact_name'];
            $contact_email = $row['contact_email'];
            $date = $row['date'];
            $applications = $row['applications'];

            // Shortened description
            $short = substr($description, 0, 35);
            $desc_ext = $short . "...";

            // Shortened skills
            $short_skill = substr($skill, 0, 35);
            $skill_ex = $short_skill . "...";

            echo "<tr>
                    <td>{$title}</td>
                    <td>{$desc_ext}</td>
                    <td>{$skill_ex}</td>
                    <td>{$experience}</td>
                    <td>{$salary_stop}</td>
                    <td>{$location}</td>
                    <td>{$applications}</td>
                    <td>{$deadline}</td>
                    <td>{$for}</td>
                    <td>{$category}</td>
                    <td>{$contact_name}</td>
                    <td>{$contact_email}</td>
                    <td>{$date}</td>
                    <td><a href='edit-job.php?id={$id}'><button type='button' class='btn btn-warning'>Edit</button></a></td>
                    <td><a href='delete-job.php?id={$id}'><button type='button' class='btn btn-danger'>Delete</button></a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='14'>No results found</td></tr>";
    }

    $stmt->close();
    $connection->close();
}
?>
