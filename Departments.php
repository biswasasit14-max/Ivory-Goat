<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location: access-denied.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Departments</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Internal CSS -->
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        header h1 {
            margin: 0;
            font-size: 2em;
        }

        hr {
            border: none;
            border-top: 2px solid #ccc;
            margin: 0;
        }

        img {
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            margin-top: 15px;
        }

        main {
            flex: 1;
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        section {
            margin-bottom: 30px;
        }

        h2 {
            color: #4CAF50;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .table-container {
            margin-top: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
            width: 30%;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e8f5e9;
        }

        /* Back Button Styling */
        .back-btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            font-size: 1em;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .back-btn:hover {
            background-color: #2e7d32;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transform: translateY(-2px);
        }

        footer {
            background-color: #222;
            color: #ccc;
            text-align: center;
            padding: 15px;
            font-size: 0.9em;
            box-shadow: 0 -2px 6px rgba(0,0,0,0.2);
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Departments of St. Teresa's School</h1> 
    </header>
    <hr>
    <p style="text-align: center;">
        <img src="STS.jpg" alt="St. Teresa's School Berhampore" width="125" height="125">
    </p>
    <main>
        <!-- Back Button -->
        <a href="Home.php" class="back-btn">← Back</a>

        <section>
            <h2>Our Departments</h2>
            <div class="table-container">
                <table>
                    <tr>
                        <th>Subjects</th>
                        <th>Teachers</th>
                    </tr>
    <tr>
        <td>Physics</td>
        <td>Mr. Bishal Saha</td>
    </tr>
    <tr>
        <td>Chemistry</td>
        <td>Mr. Soumajeet Sarkar</td>
    </tr>
    <tr>
        <td>Biology</td>
        <td>Mr. Pijush Mazumdar</td>
    </tr>
    <tr>
        <td>Mathematics</td>
        <td>Mr. Bishal Saha</td>
    </tr>
    <tr>
        <td>English Lit. & Lang.</td>
        <td>Mrs. Soumi Nath</td>
    </tr>
    <tr>
        <td>Geography</td>
        <td>Mrs. Emily Ghosh</td>
    </tr>
    <tr>
        <td>History & Civics</td>
        <td>Mrs. Vibha Das</td>
    </tr>
    <tr>
        <td>P.E./Games</td>
        <td>Mr. Prakash</td>
    </tr>
    <tr>
        <td>SUPW</td>
        <td>Mr. Sonimesh Baskey</td>
    </tr>
    <tr>
        <td>Computer Science</td>
        <td>Mr. Soumajeet Sarkar</td>
    </tr>
    <tr>
        <td>Languages</td>
        <td>Mrs. Shreya Chandra<br>Mrs. Ferdous Ara Begam</td>
    </tr>
</table>

            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2015 St. Teresa's School. All rights reserved.</p>
    </footer>        
</body>
</html>




