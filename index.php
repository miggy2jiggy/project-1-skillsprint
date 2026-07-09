<?php session_start(); ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>

<main>
    <h1>Welcome to SkillSprint</h1>

    <p>
        Discover technology careers, build your skills,
        and create a personalized learning roadmap.
    </p>
    <?php if (isset($_SESSION["user_name"]) && isset($_SESSION["career_title"])): ?>
        <div class="session-message">
            <p>
                Welcome back, <?php echo htmlspecialchars($_SESSION["user_name"]); ?>!
                Your current SkillSprint path is
                <strong><?php echo htmlspecialchars($_SESSION["career_title"]); ?></strong>.
            </p>
        </div>
    <?php endif; ?>
    <a href="career-planner.php" class="btn">Build Your Roadmap</a>
</main>

<?php include 'includes/footer.php'; ?>