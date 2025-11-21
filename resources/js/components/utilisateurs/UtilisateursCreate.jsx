import React, { useState } from "react";
import axios from "axios";
import { Link, useHistory } from "react-router-dom";

export default function UtilisateursCreate() {
    const history = useHistory();

    const [nom, setNom] = useState("");
    const [identifiant, setIdentifiant] = useState("");
    const [motPasse, setMotPasse] = useState("");

    const handleSubmit = (e) => {
        e.preventDefault();

        axios.post("/utilisateurs", {
            nom,
            identifiant,
            mot_de_passe: motPasse
        }).then(() => history.push("/utilisateurs"))
          .catch(err => console.error(err));
    };

    return (
        <div className="container mt-4">
            <h1>Ajouter un utilisateur</h1>

            <form onSubmit={handleSubmit}>
                <div className="mb-3">
                    <label>Nom :</label>
                    <input
                        type="text"
                        className="form-control"
                        onChange={(e) => setNom(e.target.value)}
                    />
                </div>

                <div className="mb-3">
                    <label>Identifiant :</label>
                    <input
                        type="text"
                        className="form-control"
                        onChange={(e) => setIdentifiant(e.target.value)}
                    />
                </div>

                <div className="mb-3">
                    <label>Mot de passe :</label>
                    <input
                        type="password"
                        className="form-control"
                        onChange={(e) => setMotPasse(e.target.value)}
                    />
                </div>

                <button className="btn btn-primary">Enregistrer</button>
                <Link to="/utilisateurs" className="btn btn-secondary ms-2">Retour</Link>
            </form>
        </div>
    );
}
