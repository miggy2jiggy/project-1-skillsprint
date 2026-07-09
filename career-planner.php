<?php
/***************************************
 Career Planner Processing
 Collects user input, validates the form,
 searches the selected career, and
 generates a personalized roadmap.
****************************************/
?>

<?php session_start(); ?>
<?php include 'includes/data.php'; ?>

<?php
/***************************************
 Form Variables
****************************************/
$name = "";
$career = "";
$level = "";
$hours = "";
$style = "";
$errors = [];
$selectedTrack = null;

/***************************************
 Form Validation
****************************************/

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $career = trim($_POST["career"]);
    $level = trim($_POST["level"]);
    $hours = trim($_POST["hours"]);
    $style = trim($_POST["style"]);

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($career)) {
        $errors[] = "Please select a career path.";
    }

    if (empty($level)) {
        $errors[] = "Please select your experience level.";
    }

    if (empty($hours)) {
        $errors[] = "Please select your weekly study availability.";
    }

    if (empty($style)) {
        $errors[] = "Please select your preferred learning style.";
    }

    if (empty($errors)) {
        foreach ($careerTracks as $track) {
            if ($career === $track["id"]) {
                $selectedTrack = $track;
                break;
            }
        }
        $_SESSION["user_name"] = $name;
        $_SESSION["career_title"] = $selectedTrack["title"];
    }
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>

<main>
    <section class="page-intro">
        <h1>Career Planner</h1>
        <p>
            Answer a few questions and SkillSprint will help create a simple
            learning roadmap based on your goals.
        </p>
    </section>

    <div class="planner-section">

        <?php if (!empty($errors)): ?>
/***************************************
 Find the Selected Career Track
****************************************/
            <div class="error-box">
                <h2>Please fix the following:</h2>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
             </ul>
            </div>
        <?php endif; ?>

        <form class="planner-form" method="POST" action="career-planner.php">
            <label for="name">Your Name</label>
            <input 
                type="text" 
                id="name" 
                name="name"
                value="<?php echo htmlspecialchars($name); ?>"
            >

            <label for="career">Career Interest</label>
            <select id="career" name="career">
                <option value="">Select a career path</option>
                <?php foreach ($careerTracks as $track): ?>
                <option
                    value="<?php echo $track["id"]; ?>"
                    <?php
                        if ($career === $track["id"]) {
                            echo "selected";
                        }
                    ?>
                >
                    <?php echo $track["title"]; ?>
                </option>
                <?php endforeach; ?>
            </select>

            <label for="level">Current Experience Level</label>
            <select id="level" name="level">
                <option value="">Select your level</option>
                <option 
                    value="beginner"
                    <?php
                        if ($level === "beginner") {
                            echo "selected";
                        }
                    ?>
                >
                    Beginner
                </option>
                <option 
                    value="some-experience"
                    <?php
                        if ($level === "some-experience") {
                            echo "selected";
                        }
                    ?>
                >
                    Some Experience
                </option>
                <option 
                    value="intermediate"
                    <?php
                        if ($level === "intermediate") {
                            echo "selected";
                        }
                    ?>
                >
                    Intermediate
                </option>
            </select>

            <label for="hours">Weekly Study Availability</label>
            <select id="hours" name="hours">
                <option value="">Select weekly hours</option>
                <option 
                    value="3-5"
                    <?php
                        if ($hours === "3-5") {
                            echo "selected";
                        }
                    ?>
                >
                    3–5 hours
                </option>
                <option 
                    value="6-10"
                    <?php
                        if ($hours === "6-10") {
                            echo "selected";
                        }
                    ?>
                >
                    6–10 hours
                </option>
                <option 
                    value="10-plus"
                    <?php
                        if ($hours === "10-plus") {
                            echo "selected";
                        }
                    ?>
                >
                    10+ hours
                </option>
            </select>

            <label for="style">Preferred Learning Style</label>
            <select id="style" name="style">
                <option value="">Select learning style</option>
                <option 
                value="videos"
                <?php
                    if ($style === "videos") {
                        echo "selected";
                    }
                ?>
                >
                    Video tutorials
                </option>
                <option 
                value="reading"
                <?php
                    if ($style === "reading") {
                        echo "selected";
                    }
                ?>
                >
                    Reading documentation
                </option>
                <option 
                value="projects"
                <?php
                    if ($style === "projects") {
                        echo "selected";
                    }
                ?>
                >
                    Hands-on projects
                </option>
            </select>

            <button type="submit">Generate My Roadmap</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && empty($errors) && $selectedTrack): ?>
/***************************************
 Personalized Roadmap Output
****************************************/
            <div class="roadmap-result">
                <h2>Your Personalized SkillSprint Roadmap</h2>

                <p>
                    Welcome, <?php echo htmlspecialchars($name); ?>! You selected
                    <strong><?php echo htmlspecialchars($selectedTrack["title"]); ?></strong>
                    as your career goal.
                </p>

                <h3>Career Overview</h3>
                <p><?php echo htmlspecialchars($selectedTrack["description"]); ?></p>

                <h3>Career Snapshot</h3>
                <ul>
                    <li><strong>Difficulty:</strong> <?php echo htmlspecialchars($selectedTrack["difficulty"]); ?></li>
                    <li><strong>Expected Salary:</strong> <?php echo htmlspecialchars($selectedTrack["salary"]); ?></li>
                    <li><strong>Best For:</strong> <?php echo htmlspecialchars($selectedTrack["best_for"]); ?></li>
                    <li><strong>Experience Level:</strong> <?php echo htmlspecialchars($level); ?></li>
                    <li><strong>Weekly Study Time:</strong> <?php echo htmlspecialchars($hours); ?> hours</li>
                    <li><strong>Preferred Learning Style:</strong> <?php echo htmlspecialchars($style); ?></li>
                </ul>

                <h3>Recommended Skills</h3>
                <ul>
                    <?php foreach ($selectedTrack["skills"] as $skill): ?>
                        <li><?php echo htmlspecialchars($skill); ?></li>
                    <?php endforeach; ?>
                </ul>

                <h3>Recommended First Steps</h3>
                <ol>
                    <li>Review the basic skills connected to <?php echo htmlspecialchars($selectedTrack["title"]); ?>.</li>
                    <li>Choose one beginner-friendly resource that matches your learning style.</li>
                    <li>Practice consistently based on your weekly study availability.</li>
                    <li>Build one small project or practice activity to apply what you learn.</li>
                    <li>Update your roadmap as your skills improve.</li>
                </ol>
            </div>

        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>