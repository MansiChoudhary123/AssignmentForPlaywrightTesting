document.getElementById("signupForm").addEventListener("submit", async function (e) {
  e.preventDefault();

  // Get input values
  const firstName = document.getElementById("firstName").value.trim();
  const lastName = document.getElementById("lastName").value.trim();
  const email = document.getElementById("email").value.trim();
  const phone = document.getElementById("phone").value.trim();
  const password = document.getElementById("password").value;
  const rePassword = document.getElementById("rePassword").value;
  const dob = document.getElementById("dob").value.trim();
  const city = document.getElementById("city").value.trim();
  const state = document.getElementById("state").value.trim();

  // Clear previous error messages
  document.querySelectorAll(".error-message").forEach((el) => (el.innerText = ""));
  document.getElementById("successMessage").innerText = "";

  let isValid = true;

  // Validation checks
  if (firstName === "") {
      showError("firstNameError", "First Name is required.");
      isValid = false;
  }

  if (lastName === "") {
      showError("lastNameError", "Last Name is required.");
      isValid = false;
  }

  if (!/^\S+@\S+\.\S+$/.test(email)) {
      showError("emailError", "Valid email is required.");
      isValid = false;
  }

  if (!/^\d{10}$/.test(phone)) {
      showError("phoneError", "Phone number must be 10 digits.");
      isValid = false;
  }

  if (password.length < 8) {
      showError("passwordError", "Password must be at least 8 characters.");
      isValid = false;
  }

  if (rePassword !== password) {
      showError("rePasswordError", "Passwords do not match.");
      isValid = false;
  }

  if (dob === "") {
      showError("dobError", "Date of Birth is required.");
      isValid = false;
  }

  if (city === "") {
      showError("cityError", "City is required.");
      isValid = false;
  }

  if (state === "") {
      showError("stateError", "State is required.");
      isValid = false;
  }

  if (!isValid) return;

  // Send form data via AJAX to PHP
  const formData = new FormData(this);
  const response = await fetch("signup.php", {
      method: "POST",
      body: formData,
  });

  const result = await response.json();
  if (result.status === "success") {
      document.getElementById("successMessage").innerText = result.message;
      this.reset();
  } else {
      alert(result.message);
  }
});

function showError(id, message) {
  document.getElementById(id).innerText = message;
}
