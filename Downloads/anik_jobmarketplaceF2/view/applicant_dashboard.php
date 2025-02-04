<?php
session_start();
require_once('../model/userModel.php');


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'applicant') {
    header('Location: ../view/login.html');
    exit;
}

$applicant_id = $_SESSION['user_id'];
$con = getConnection();

$search_term = ''; 
$search_location = ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['job_id'])) { 
        $job_id = intval($_POST['job_id']);
        $stmt = $con->prepare("INSERT INTO anik_applications (job_id, applicant_id) VALUES (?, ?)");
        $stmt->bind_param('ii', $job_id, $applicant_id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['save_job_id'])) { 
        $post_id = intval($_POST['save_job_id']);
        $stmt = $con->prepare("INSERT INTO anik_saved_jobs (user_id, post_id) VALUES (?, ?)");
        $stmt->bind_param('ii', $applicant_id, $post_id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['remove_saved_job_id'])) { 
        $post_id = intval($_POST['remove_saved_job_id']);
        $stmt = $con->prepare("DELETE FROM anik_saved_jobs WHERE user_id = ? AND post_id = ?");
        $stmt->bind_param('ii', $applicant_id, $post_id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['search_term'])) { 
        $search_term = trim($_POST['search_term']);
    } elseif (isset($_POST['location'])) { 
        $search_location = trim($_POST['location']);
    }
}

if (!empty($search_term)) {
    $stmt = $con->prepare("SELECT * FROM anik_jobs WHERE (title LIKE ? OR description LIKE ?) AND status = 'approved'");
    $like_term = '%' . $search_term . '%';
    $stmt->bind_param('ss', $like_term, $like_term);
} elseif (!empty($search_location)) {
    $stmt = $con->prepare("SELECT * FROM anik_jobs WHERE location = ? AND status = 'approved'");
    $stmt->bind_param('s', $search_location);
} else {
    $stmt = $con->prepare("SELECT * FROM anik_jobs WHERE status = 'approved'");
}
$stmt->execute();
$jobs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


$stmt = $con->prepare("SELECT j.title, j.description FROM anik_applications a JOIN anik_jobs j ON a.job_id = j.id WHERE a.applicant_id = ?");
$stmt->bind_param('i', $applicant_id);
$stmt->execute();
$applications = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


$stmt = $con->prepare("SELECT j.id, j.title, j.description FROM anik_saved_jobs s JOIN anik_jobs j ON s.post_id = j.id WHERE s.user_id = ?");
$stmt->bind_param('i', $applicant_id);
$stmt->execute();
$saved_jobs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Applicant Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        h1, h2 {
            color: #333;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        button {
            padding: 8px 12px;
            margin: 5px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }
        button:hover {
            background-color: #45a049;
        }
        form {
            display: inline;
        }
        .container {
            margin-top: 20px;
        }

        .logout-btn {
        background-color: #f44336;
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 20px;
    }
    .logout-btn:hover {
        background-color: #e53935;
    }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?> (Applicant)</h1>

    <div>
        <form action="../view/resume_builder.php" method="GET">
            <button type="submit">Resume Builder</button>
        </form>
        <form action="../view/skill_assessment.php" method="GET">
            <button type="submit">Skill Assessment Test</button>
        </form>
    </div>

    <h2>Filter Jobs by Location</h2>
    <div>
        <?php
        $locations = ['Dhaka', 'Chattogram', 'Rajshahi', 'Khulna', 'Barishal', 'Sylhet', 'Rangpur', 'Mymensingh'];
        foreach ($locations as $location) {
            echo "<form method='POST' style='display:inline; margin: 0 5px;'>
                    <input type='hidden' name='location' value='$location'>
                    <button type='submit'>$location</button>
                  </form>";
        }
        ?>
        
    </div>
    <form method="POST">
       
       <button type="submit">Show All Jobs</button>

   </form>

    <h2>Search Jobs</h2>
    <form method="POST">
       
        <input type="text" name="search_term" placeholder="Search jobs by title or description" value="<?php echo htmlspecialchars($search_term); ?>">
        <button type="submit">Search</button>

    </form>

   

    <h2>Available Jobs</h2>
    <table>
        <tr>
            <th>Job Title</th>
            <th>Description</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
        <?php if (!empty($jobs)): ?>
            <?php foreach ($jobs as $job): ?>
            <tr>
                <td><?php echo htmlspecialchars($job['title']); ?></td>
                <td><?php echo htmlspecialchars($job['description']); ?></td>
               
                <td><?php echo htmlspecialchars($job['location']); ?></td>
                
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['id']); ?>">
                        <button type="submit">Apply</button>
                    </form>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="save_job_id" value="<?php echo htmlspecialchars($job['id']); ?>">
                        <button type="submit">Save</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No jobs found.</td></tr>
        <?php endif; ?>
    </table>

    <h2>Applied Jobs</h2>
    <table>
        <tr>
            <th>Job Title</th>
            <th>Description</th>
        </tr>
        <?php if (!empty($applications)): ?>
            <?php foreach ($applications as $application): ?>
            <tr>
                <td><?php echo htmlspecialchars($application['title']); ?></td>
                <td><?php echo htmlspecialchars($application['description']); ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="2">You have not applied for any jobs yet.</td></tr>
        <?php endif; ?>
    </table>

    <h2>Saved Jobs</h2>
    <table>
        <tr>
            <th>Job Title</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php if (!empty($saved_jobs)): ?>
            <?php foreach ($saved_jobs as $saved_job): ?>
            <tr>
                <td><?php echo htmlspecialchars($saved_job['title']); ?></td>
                <td><?php echo htmlspecialchars($saved_job['description']); ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="remove_saved_job_id" value="<?php echo htmlspecialchars($saved_job['id']); ?>">
                        <button type="submit">Remove from Saved</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No saved jobs.</td></tr>
        <?php endif; ?>
    </table>

    <a href="../controller/logout.php" class="logout-btn">Logout</a>
</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let searchInput = document.querySelector('[name="search_term"]');
    
    searchInput.addEventListener('input', function() {
        let searchTerm = searchInput.value;
        
     
        if (searchTerm.length >= 3) {
            let jsonData = {
                'search_term': searchTerm
            };
            let data = JSON.stringify(jsonData);
            
            let xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'application_dashboardcheck.php', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('mydata=' + data);
            
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let jobs = JSON.parse(this.responseText);
                    let jobList = document.querySelector('ul');
                    jobList.innerHTML = '';
                    
                    if (jobs.length > 0) {
                        jobs.forEach(function(job) {
                            let li = document.createElement('li');
                            li.innerHTML = job.title + " - " + job.description + " (" + job.location + ")";
                            jobList.appendChild(li);
                        });
                    } else {
                        jobList.innerHTML = '<li>No jobs found.</li>';
                    }
                }
            };
        }
    });
});
</script>
</html>
