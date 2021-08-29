const form = document.querySelector(".login form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-txt");

form.onsubmit = (e)=>{
    e.preventDefault(); //prevents form from submitting
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest(); //create XML object
    xhr.open("POST", "php/login.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                if(data == "success"){
                    location.href = "users.php";
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";                   

                }
            }
        }
    }
    //we have to send the form data through ajax to php
    let formData = new FormData(form);
    xhr.send(formData); //sending the form data to php 
}