document.getElementById('contactForm').addEventListener('submit', function(event) {
    if (!validateForm()) {
      event.preventDefault();
    }
  });
  
  function validateForm() {
    const firstName = document.getElementById('firstName').value.trim();
    const lastName = document.getElementById('lastName').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const messages = document.getElementById('messages').value.trim();
      
    const errorMessages = document.getElementById('errorMessages');
    errorMessages.innerHTML = '';
    
    let isValid = true;
    
    if (!firstName) {
      errorMessages.innerHTML += '<p>Please enter your first name.</p>';
      isValid = false;
    }
  
    if (!lastName) {
      errorMessages.innerHTML += '<p>Please enter your last name.</p>';
      isValid = false;
    }
  
    if (!email) {
      errorMessages.innerHTML += '<p>Please enter your email address.</p>';
      isValid = false;
    } else {
      const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      if (!emailPattern.test(email)) {
        errorMessages.innerHTML += '<p>Please enter a valid email address.</p>';
        isValid = false;
      }
    }
  
    if (!phone) {
      errorMessages.innerHTML += '<p>Please enter your phone number.</p>';
      isValid = false;
    } else {
      const phonePattern = /^[0-9]{10}$/;
      if (!phonePattern.test(phone)) {
        errorMessages.innerHTML += '<p>Please enter a valid 10-digit phone number.</p>';
        isValid = false;
      }
    }
  
    if (!messages) {
      errorMessages.innerHTML += '<p>Please enter your message.</p>';
      isValid = false;
    }
  
    return isValid;
  }

  