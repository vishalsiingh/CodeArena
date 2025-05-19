<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Popup Test</title>
<style>
  #popup {
    display:none;
    position:fixed; top:0; left:0; width:100%; height:100%;
    background-color: rgba(0,0,0,0.6);
    justify-content:center; align-items:center; display:flex;
  }
  .popup-content {
    background:#fff; padding:20px; border-radius:10px; max-width:400px; text-align:center;
  }
  #popup-message {
    background: yellow; /* Highlight to debug */
    color: black;
  }
  .problem-box {
    padding: 10px;
    margin: 10px;
    background: #5a82d6;
    color: white;
    cursor: pointer;
    width: 200px;
    border-radius: 5px;
  }
</style>
</head>
<body>

<div class="problem-box" onclick="showPopup(1, 'You are about to solve: Two Sum - Arrays')">Two Sum - Arrays</div>
<div class="problem-box" onclick="showPopup(2, 'You are about to solve: Palindrome Check - Strings')">Palindrome Check - Strings</div>

<div id="popup">
  <div class="popup-content">
    <h3 id="popup-title">You're about to solve a problem</h3>
    <p id="popup-message"></p>
    <button onclick="goToProblem()">OK</button>
    <button onclick="closePopup()">Cancel</button>
  </div>
</div>

<script>
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
</script>

</body>
</html>
