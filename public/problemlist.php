<?php
// session_start();
// Example check - modify as per your login logic
// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit();
// }
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// for user
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Problems</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #1e1e2f, #3b3b56);
      color: #fff;
      min-height: 100vh;
      display: flex;
      flex-direction: row;
      flex-wrap: nowrap;
    }

    .sidebar {
      width: 280px;
      background: rgba(255, 255, 255, 0.05);
      padding: 30px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      backdrop-filter: blur(10px);
      border-right: 2px solid rgba(255,255,255,0.1);
      box-sizing: border-box;
    }

    .avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: url('https://api.dicebear.com/7.x/thumbs/svg?seed=Vishal') no-repeat center/cover;
      margin-bottom: 15px;
      border: 2px solid #ffd369;
      flex-shrink: 0;
    }

    .sidebar h2 {
      font-size: 1.3rem;
      color: #ffd369;
      margin: 10px 0;
      text-align: center;
    }

    .sidebar p {
      font-size: 0.95rem;
      text-align: center;
      line-height: 1.5;
      color: #e0e0e0;
      margin-bottom: 20px;
    }

    .quote {
      font-size: 0.85rem;
      font-style: italic;
      color: #aaa;
      margin-top: auto;
      text-align: center;
    }

    /* New logout button style */
    .logout-btn {
      margin-top: 20px;
      padding: 10px 25px;
      font-size: 1rem;
      font-weight: 600;
      color: white;
      background-color: #e63946; /* bright red */
      border: none;
      border-radius: 25px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
      max-width: 220px;
      user-select: none;
    }
    .logout-btn:hover {
      background-color: #b32b37;
    }

    .main-content {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 20px;
      box-sizing: border-box;
      min-width: 0;
    }

    h1 {
      margin: 0 0 10px;
      font-size: 2.3rem;
      font-weight: 700;
      text-align: center;
    }

    .tagline {
      font-size: 1.1rem;
      margin-bottom: 30px;
      color: #ffd369;
      background: -webkit-linear-gradient(45deg, #ffe259, #ffa751);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-align: center;
    }

    .problem-box {
      background: rgba(255, 255, 255, 0.08);
      border-radius: 15px;
      padding: 20px 25px;
      margin: 12px 0;
      cursor: pointer;
      transition: all 0.3s ease;
      width: 90%;
      max-width: 600px;
      display: flex;
      align-items: center;
      gap: 15px;
      backdrop-filter: blur(8px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
      user-select: none;
    }

    .problem-box:hover {
      transform: scale(1.04);
      background: rgba(255, 255, 255, 0.18);
    }

    .emoji {
      font-size: 1.7rem;
      flex-shrink: 0;
    }

    .text {
      font-size: 1.2rem;
      font-weight: 500;
      color: #fff;
      flex-grow: 1;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    footer {
      margin-top: 40px;
      padding: 10px;
      font-size: 0.95rem;
      color: #bbb;
      text-align: center;
      width: 100%;
      max-width: 600px;
    }

    @media (max-width: 768px) {
      body {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
        border-right: none;
        border-bottom: 2px solid rgba(255,255,255,0.1);
        padding: 20px 10px;
      }

      .avatar {
        width: 60px;
        height: 60px;
        margin-bottom: 10px;
      }

      h1 {
        font-size: 1.8rem;
      }

      .tagline {
        font-size: 1rem;
        margin-bottom: 20px;
      }

      .problem-box {
        width: 95%;
        padding: 15px 20px;
      }

      .text {
        font-size: 1rem;
      }

      footer {
        margin-top: 30px;
        font-size: 0.9rem;
        max-width: 100%;
      }
    }

    @media (max-width: 400px) {
      .text {
        font-size: 0.9rem;
      }

      .emoji {
        font-size: 1.4rem;
      }
    }

    /*modal*/
    /* Modal background */
/* Popup styling */
    #popup {
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.6);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    #popup .popup-content {
      background: white;
      padding: 30px;
      border-radius: 10px;
      text-align: center;
      max-width: 400px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.3);
    }

    #popup button {
      padding: 10px 20px;
      margin: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .ok-btn {
      background: #4caf50;
      color: white;
    }

    .cancel-btn {
      background: #f44336;
      color: white;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <div class="avatar"></div><h2>Welcome, <?php echo htmlspecialchars($_SESSION["name"]); ?>!</h2>
    <p>Finally aa hi gaye coding karne !! <br>Let’s solve some epic problems today 💪</p>
    <div class="quote">"Consistency beats talent when talent doesn’t show up."</div>

    <!-- Logout Button -->
    

    <form method="post" action="homepage.php">
      <button class="logout-btn" type="submit">Home</button>
      
    </form>
    <form method="post" action="logout.php">
      <button class="logout-btn" type="submit">Logout</button>
      
    </form>
  </div>

  <div class="main-content">
    <h1> Welcome to CodeArena</h1>
    <div class="tagline"> Daily Challenges • Practice • Mastery</div>

    <!-- Hardcoded problems (you can replace with DB loop later) -->
    <!-- <div class="problem-box" onclick="showPopup(1, 'Two Sum - Arrays')"> -->
        <!-- <div class="problem-box" onclick="showPopup(1, 'You are about to solve: Two Sum - Arrays')"> -->
            <div class="problem-box" onclick= " location.href='problem.php?id=1'">

      <div class="emoji">🧮</div>
      <div class="text">Two Sum - Arrays</div>
    </div>


    <!-- <div class="problem-box" onclick="showPopup(2, 'Palindrome Check - Strings')">
         -->
    <div class="problem-box" onclick="location.href='problem.php?id=2'">
      <div class="emoji">🔁</div>
      <div class="text">Palindrome Check - Strings</div>
    </div>
<!-- Popup -->
  <!-- <div id="popup" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.6); justify-content:center; align-items:center; display:flex;">
      <div class="popup-content" style="background:#fff; padding:20px; border-radius:10px; max-width:400px; text-align:center;">
        <h3 id="popup-title">You're about to solve a problem</h3>
        <p id="popup-message"></p>
        <button class="ok-btn" onclick="goToProblem()">OK</button>
        <button class="cancel-btn" onclick="closePopup()">Cancel</button>
      </div>
    </div> -->
  
    <footer>
       Made with ❤️ by Vishal Singh 
    </footer>
  </div>
  
  <!-- <script>
    let selectedId = null;

  function showPopup(id, message) {
    selectedId = id;
    const msgEl = document.getElementById('popup-message');
    if (msgEl) {
      msgEl.innerText = message;
    } else {
      console.error("popup-message element not found!");
    }
    document.getElementById('popup').style.display = 'flex';
  }

  function closePopup() {
    document.getElementById('popup').style.display = 'none';
  }

  function goToProblem() {
    alert("Going to problem id: " + selectedId); // For testing only
    // window.location.href = 'problem.php?id=' + selectedId;
  }
  </script> -->
</body>
</html>
