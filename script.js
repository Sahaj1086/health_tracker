// Smooth page transition on load
document.addEventListener("DOMContentLoaded", function () {
  document.body.classList.add("fade-in");
});

// Smooth redirect with fade-out effect
function redirectTo(page) {
  document.body.classList.remove("fade-in");
  document.body.classList.add("fade-out");

  setTimeout(() => {
    window.location.href = page;
  }, 500); // wait for fade-out to finish
}

// Login logic
function login() {
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  // TEMP check – Replace with real DB later
  if (email === "test@gmail.com" && password === "1234") {
    redirectTo("dashboard.php");
  } else {
    alert("Invalid email or password");
  }
}

// Signup redirect (you can call this on signup form if needed)
function signupRedirect() {
  redirectTo("signup.php");
}

// Back to login
function backToLogin() {
  redirectTo("index.php");
}
