<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>


</head>

<body>

    <div class="container">
        <h1>Soumettre une nouvelle proposition</h1>
        <form method="post" action="addProposition.php">
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Entrez le titre de votre proposition">
            </div>
            <div class="mb-3">
                <label for="text_proposition" class="form-label">Texte</label>
                <textarea class="form-control" id="text_proposition" name="text_proposition" rows="3" placeholder="Entrez votre proposition ici"></textarea>
            </div>
            <p><small>Lorsque vous créez une proposition, vous votez forcément pour elle.</small></p>
            <div class="col-auto">
                <button type="submit" class="btn mb-3" style="background-color: blueviolet; color:white">Créer la proposition</button>
            </div>
        </form>
        <a href="dashbord.php" style="color:blueviolet">Retourner au tableau de bord</a>


    </div>


</body>

</html>