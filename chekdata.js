//da modificare. deve essere questa pagine js a fare la fetch a carica_dati_user.php dopo che ha controllato che i dati andassero bene


function checkMail(mail){
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(mail);  //se la password rispetta torno false
}

function checkPassword(password){
    
    // console.log(password);
    if(password.length<8){
        return false;
    }
    const lowerCase=/[a-z]/.test(password);
    const upperCase=/[A-Z]/.test(password);
    const number=/[0-9]/.test(password);
    const speciale=/[^a-zA-Z0-9]/.test(password);

    console.log(lowerCase);
    console.log(upperCase);
    console.log(number);
    console.log(speciale);

    if(lowerCase && upperCase && number && speciale){  //se tutti sono true(la psw rispetta le specifiche)
        return true;  //true=password corretta
    }else return false;
}


function checkData(event) {
    

    console.log(form.email.value);
    console.log(form.password.value);
    
    if (form.email.value.length == 0 ||
        form.password.value.length == 0) {
        const boxmail = document.querySelector('.errore-email');
        boxmail.classList.remove('hidden');

        const boxpassword = document.querySelector('.errore-password');
        boxpassword.classList.remove('hidden');

        event.preventDefault();
    }else if(!checkMail(form.email.value)){

        const boxmail = document.querySelector('.errore-email');
        boxmail.textContent="Insirisci un indirizzo mail valido";
        boxmail.classList.remove('hidden');
        event.preventDefault()
    }else if(!checkPassword(form.password.value)){

        const boxpassword = document.querySelector('.errore-password');
        boxpassword.textContent="La password deve contenere almeno un carattere minuscolo, uno maiuscolo,un numero e un carattere speciale"

        boxpassword.classList.remove('hidden');
        event.preventDefault();
    }else{
        /*console.log("CIAO");*/               
        
    }
}

const form = document.forms['signin-data'];
form.addEventListener('submit', checkData);



