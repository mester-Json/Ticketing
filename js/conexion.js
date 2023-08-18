const contactForm = document.getElementById('contactForm');

contactForm.addEventListener('submit', (event) => {
  event.preventDefault();

  const UserInput = document.getElementById("User");
  const MailInput = document.getElementById("Mail");
  const PasswordInput = document.getElementById("Password");



  const formData = {
    User: UserInput.value,
    Mail: MailInput.value,
    Password: PasswordInput.value,
  }

  const errors = {
    User: false,
    Mail: false,
    Password: false,
  }

  const UserError = document.getElementById('UserError');
  const MailError = document.getElementById('MailError');
  const PasswordError = document.getElementById('PasswordError');


  UserError.style.display = 'none';
  MailError.style.display = 'none';
  PasswordError.style.display = 'none';


  if (!formData.User || !formData.Mail || !formData.Password) {
    const emailRegex = /[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}/igm;
    const UserRegex = /^[a-zA-Z ]+$/
    const PasswordRegrex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}/; 

    if (!formData.User || !UserRegex.test(formData.User)) {
      errors.User = true;
      UserError.style.display = 'block';
    }
    if (!formData.Mail || !emailRegex.test(formData.Mail)) {
      errors.Mail = true;
      MailError.style.display = 'block';
    }
    if (!formData.Password ||  !PasswordRegrex.test(formData.Password)) {
      errors.Password = true;
      PasswordError.style.display = 'block';
    }

  }

})
