<?php 


//Fonction qui affiche le message
function displayMessage($messages, $key){
        echo "<div class='alert alert-{$messages[$key]['bootstrapColor']} mt-4 alert-dismissible fade show' role='alert'>
        <div class='row'>
            <div class='col-11'>
                <h4 class='alert-heading'>{$messages[$key]['title']}</h4>
            </div>
            <div class='col-1'>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        </div>
        <div>
            <p>{$messages[$key]['message']}</p>
        </div>
    </div>";
}



