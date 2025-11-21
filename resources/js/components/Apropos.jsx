import React from "react";

export default function Apropos() {
    return (
        <div className="apropos-page container mt-4">
            <h1>À propos</h1>
            <hr />

            <h3>Auteur</h3>
            <p><strong>Nom :</strong> Umar Siddiqui</p>

            <h3>Cours</h3>
            <p>
                <strong>Titre :</strong> 420-5H6 MO - Applications Web transactionnelles<br />
                <strong>Session :</strong> Automne 2023, Collège Montmorency
            </p>

            <h3>Étapes pour vérifier le bon fonctionnement</h3>
            <ol>
                <li><strong>Multilingue :</strong> utilisez le menu FR / EN / ES.</li>
                <li><strong>Vérification du courriel :</strong> créez un compte puis activez-le via Mailtrap.</li>
                <li><strong>Rôles :</strong> USER ne peut pas accéder à /admin.</li>
                <li><strong>Recettes :</strong> testez CRUD + upload image.</li>
                <li><strong>Ingrédients :</strong> testez CRUD + lien aux recettes.</li>
                <li><strong>Autocomplétion :</strong> testez la barre de recherche.</li>
            </ol>

            <h3>Diagramme de la base de données</h3>
            <p>Structure actuelle :</p>
            <img
                src="/images/dbdiagram.png"
                alt="Diagramme BD"
                className="img-fluid"
                style={{ maxWidth: "600px", borderRadius: "10px" }}
            />

            <h3>Sources d’inspiration</h3>
            <ul>
                <li><a href="https://www.marmiton.org/" target="_blank">Marmiton.org</a></li>
                <li><a href="https://getbootstrap.com/" target="_blank">Bootstrap</a></li>
            </ul>
        </div>
    );
}
