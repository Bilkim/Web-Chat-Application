const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector('.chat-box'); 

form.onsubmit = (e)=>{
    e.preventDefault(); //prevents form from submitting
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest(); //create XML object
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = ""; //once message is inserted into the database
                scrollToBottom();
            }
        }
    }
    //we have to send the form data through ajax to php
    let formData = new FormData(form);
    xhr.send(formData); //sending the form data to php 
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(()=>{
    let xhr = new XMLHttpRequest(); //create XML object
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){// if active class not contains in chatbox the scroll to bottom 
                    scrollToBottom();
                }
                 
                
            }
        } 
    }

    //we have to send the form data through ajax to php
    let formData = new FormData(form);
    xhr.send(formData); //sending the form data to php 
    
}, 500); //will run frequently after 500ms

function scrollToBottom(){
    chatBox.scrollTo = chatBox.scrollHeight;
}
