<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
$userEmail = $_SESSION["user_email"] ?? "User";

$problemId = $_GET['id'] ?? null;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Code Editor</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      display: flex;
      height: 100vh;
      overflow: hidden;
      background: linear-gradient(to right, #1e1e2f, #3b3b56);
      color: #fff;
      flex-direction: column;
    }

    header {
      padding: 15px 30px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 1.2rem;
      color: #ffd369;
      font-weight: 600;
      border-bottom: 1px solid rgba(255,255,255,0.2);
    }

    header .greeting {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    header .greeting span {
      font-size: 1.5rem;
    }

    header .warning {
      font-size: 1rem;
      color: #ff6b6b;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .container {
      flex: 1;
      display: flex;
      overflow: hidden;
    }

    .left {
      width: 40%;
      padding: 30px;
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(10px);
      border-right: 1px solid rgba(255,255,255,0.2);
      overflow-y: auto;
    }

    .right {
      width: 60%;
      padding: 30px;
      display: flex;
      flex-direction: column;
      background: rgba(255, 255, 255, 0.04);
      backdrop-filter: blur(8px);
    }

    h2 {
      font-size: 1.8rem;
      margin-bottom: 20px;
      color: #ffd369;
    }

    #description {
      white-space: pre-wrap;
      line-height: 1.6;
      font-size: 1rem;
      color: #eee;
    }

    select, button, input[type="file"] {
      padding: 12px 16px;
      font-size: 1rem;
      border-radius: 8px;
      border: none;
      outline: none;
      margin-bottom: 12px;
      user-select: none;
    }

    select, input[type="file"] {
      background-color: #2c2c3e;
      color: #fff;
      border: 1px solid #444;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    select:hover, input[type="file"]:hover {
      background-color: #3d3d57;
    }

    textarea {
      flex: 1;
      padding: 16px;
      font-size: 15px;
      border-radius: 10px;
      font-family: 'Courier New', monospace;
      background: #1e1e2f;
      color: #fff;
      border: 1px solid #444;
      resize: none;
      margin-bottom: 15px;
      transition: box-shadow 0.3s ease;
    }

    textarea:focus {
      outline: none;
      box-shadow: 0 0 8px #00ffd5;
    }

    button {
      background-color: #00b894;
      color: white;
      width: fit-content;
      cursor: pointer;
      transition: background 0.2s, transform 0.2s;
      user-select: none;
    }

    button:disabled {
      background-color: #555;
      cursor: not-allowed;
    }

    button:hover:enabled {
      background-color: #00a383;
      transform: scale(1.03);
    }

    footer {
      text-align: center;
      padding: 12px;
      font-size: 0.9rem;
      color: #aaa;
      margin-top: auto;
      user-select: none;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }
      .left, .right {
        width: 100%;
        height: 50vh;
      }
    }
  </style>
</head>
<body>

  <header>
    <div class="greeting">
      <span>👋</span>
      <div id="userEmailDisplay">Hello, <?= htmlspecialchars($_SESSION["name"]) ?>! What’s up? </div>
    </div>
    <div class="warning">⚠️ Cheating to solve? Make sure it’s your own code! ✍️</div>
  </header>

  <div class="container">
    <div class="left">
      <h2>📄 Problem Description</h2>
      <div id="description">Loading...</div>
    </div>

    <div class="right">
      <select id="language" onchange="updateFileAccept()">
        <option value="java">☕ Java</option>
        <option value="python">🐍 Python</option>
        <option value="c">🔧 C</option>
        <option value="cpp">🚀 C++</option>
      </select>

      <input type="file" id="codeFile" accept=".java" onchange="handleFileUpload()" />

      <textarea id="code" placeholder="💻 Upload your code file or type here..." readonly></textarea>
      <button id="submitBtn" onclick="submitCode()" disabled>🚀 Submit Code</button>
    </div>
  </div>

  <footer>Made with ❤️ by Vishal Singh</footer>

  <script>
    const problems = {
      1: `🧮 Problem 1: Two Sum
Given an array of integers, return the indices of the two numbers that add up to a specific target.

Example:
Input: [2, 7, 11, 15], target = 9
Output: [0, 1]`,

      2: `🔁 Problem 2: Palindrome Checker
Write a function to check whether a string is a palindrome.

Example:
Input: 'racecar'
Output: true`
    };

    const userEmail = <?= json_encode($userEmail); ?>;

    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    const description = problems[id];
    document.getElementById('description').innerText = description || 'Problem not found.';

    const submitBtn = document.getElementById('submitBtn');
    const codeEditor = document.getElementById('code');
    const codeFileInput = document.getElementById('codeFile');
    const languageSelect = document.getElementById('language');

    function updateFileAccept() {
      const language = languageSelect.value;

      switch (language) {
        case 'java': codeFileInput.accept = '.java'; break;
        case 'python': codeFileInput.accept = '.py'; break;
        case 'c': codeFileInput.accept = '.c'; break;
        case 'cpp': codeFileInput.accept = '.cpp'; break;
        default: codeFileInput.accept = '';
      }

      codeFileInput.value = '';
      codeEditor.value = '';
      codeEditor.readOnly = true;
      submitBtn.disabled = true;
    }

    function handleFileUpload() {
      const file = codeFileInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          codeEditor.value = e.target.result;
          codeEditor.readOnly = false;
          submitBtn.disabled = false;
        };
        reader.readAsText(file);
      }
    }

    codeEditor.addEventListener('input', () => {
      submitBtn.disabled = codeEditor.value.trim() === '';
    });

    async function submitCode() {
      const lang = languageSelect.value;
      const code = codeEditor.value.trim();

      if (!code) {
        alert('Please write or upload some code before submitting!');
        return;
      }

      const formData = new FormData();
      formData.append('username', userEmail);

      if (codeFileInput.files.length > 0) {
        formData.append('codeFile', codeFileInput.files[0]);
      } else {
        const blob = new Blob([code], { type: 'text/plain' });
        formData.append('codeFile', blob, `code.${lang}`);
      }

      try {
        const response = await fetch('upload.php', {
          method: 'POST',
          body: formData,
        });
        const result = await response.json();

       if (result.success) {
      alert('File uploaded successfully!');
      submitBtn.textContent = '✅ Submitted';
      submitBtn.disabled = true;  // Disable button after submission
      codeEditor.readOnly = true; // Optional: make editor readonly after submit
      codeFileInput.disabled = true; // Optional: disable file input
      languageSelect.disabled = true; // Optional: disable language select
    } else {
      alert('Upload failed: ' + result.message);
    }
  } catch (error) {
    alert('An error occurred: ' + error.message);
  }
}

    updateFileAccept(); // On load
  </script>
</body>
</html>
