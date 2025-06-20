<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>afficher</title>
</head>
<body>
<div class="container">
    <center>
    <div>Liste des <b>candidats !!</b></div>
    </center>
        
        <!-- Inclusion d'un fichier externe pour afficher les candidats inscrits -->
        <table border="0" width="50%" align="center" bgcolor="green">
            <tr>
                <td align="center">
                    <?php include("affiche.php"); ?>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>