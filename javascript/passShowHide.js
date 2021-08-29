const pwdField = document.querySelector(".form input[type='password']"),
toggleaBtn = document.querySelector(".form .field i");

toggleaBtn.onclick = ()=>{
    if(pwdField.type == "password"){
        pwdField.type = "text";
        toggleaBtn.classList.add("active");
    }else{
        pwdField.type = "password";
        toggleaBtn.classList.remove("active");
    }
}