<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        section {
            padding: 2rem;
            margin: 1rem 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container {
            text-align: center;
        }
        .form-container {
            display: inline-block;
            text-align: left;
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container input[type="file"],
        .form-container select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container .bouton {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container .bouton:hover {
            background-color: #218838;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        #previewImg {
            display: none;
            max-width: 100px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <table bgcolor="green" width="100%">
        <tr>
            <td><a href="contact.php">Contact</a></td>
            <td><a href="tp4.php">TP 4</a></td>
        </tr>
    </table>
    <section>
    <div class="container">
        <div>Veuillez ajouter un candidat à la liste des inscrits!!</div>
        <div class="form-container">
            <form action="intermediaire.php" method="post" class="f1" id="form_1" enctype="multipart/form-data">
                <label for="numero">Numero</label>
                <input type="number" name="numero" id="numero" placeholder="Saisir l'article"><br/>

                <label for="nom">Nom</label><br/>
                <input type="text" name="nom" id="nom" placeholder="Saisir le nom" required><br/>

                <label for="prenom">Prenom</label><br/>
                <input type="text" name="prenom" id="prenom" placeholder="Saisir le prenom" required><br/>

                <label for="file">Mon cv</label>
                <input type="file" name="file" id="file" placeholder="choisir le cv"><br/>
                <label for="image">Image</label>
                <input type="file" name="image" id="image" required onchange="previewImg(event)"><br/>

                <label for="cour">Niveau</label><br/>
                <select name="cour" id="cour">
                    <option value="FM">FM</option>
                    <option value="BT">BT</option>
                    <option value="BTS">BTS</option>
                    <option value="LP">LP</option>
                    <option value="MP">MP</option>
                </select><br/>

                <input class="bouton" type="submit" value="Envoyer"/>
                <input class="bouton" type="reset" value="Annuler"/>
                <a class="bouton" "affiche2.php">voir votre affiche</a>
            </form>
            <img id="previewImg" src="#" alt="Aperçu de l'image">
        </div>
    </div>
    </section>
    
    <script>
        function previewImg(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('previewImg').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>