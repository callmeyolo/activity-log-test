<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Log</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="app">
        <div class="container">
            <h1>Activity Log</h1>
            <activity-log :logs="activityLogs"></activity-log>

            <form @submit.prevent="addActivity" class="mb-4">
                <div class="form-group">
                <label for="user">User:</label>
                <input type="text" class="form-control" id="user" v-model="newActivity.user_name" required>
                </div>
                <div class="form-group">
                <label for="action">Action:</label>
                <input type="text" class="form-control" id="action" v-model="newActivity.activity_type" required>
                </div>
                <div class="form-group">
                <label for="details">Details:</label>
                <input type="text" class="form-control" id="details" v-model="newActivity.description">
                </div>
                <button type="submit" class="btn btn-primary">Add Activity</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/vue@2.6.14"></script>
    <script src="app.js"></script>
    <script src="script.js"></script>
</body>
</html>
