import React, { useEffect, useState } from "react";
import axios from "axios";
import { Link, useParams, useHistory } from "react-router-dom";

export default function UtilisateursEdit() {
    const { id } = useParams();
    const history = useHistory();

    const [nom, setNom] = useState("");
    const [identifiant, setIdentifiant] = useState("");
    const [motPasse, setMotPasse] = useState("");

    useEffect(() => {
        axios.get(`/utilisateurs/${id}`)
            .then(res => {
                setNom(res.data.nom);
                setIdentifiant(res.data.identifiant);
                setMotPasse(res.data.mot_de_passe);
            })
            .catch(err => console.error(err));
    }, [id]);

    const handleSubmit = (e) => {
        e.preventDefault();

        axios.put(`/utilisateurs/${id}`, {
            nom,
            identifiant,
            mot_de_passe: motPasse
        }).then(() => history.push(`/utilisateurs/${id}`))
          .catch(err => console.error(err));
    };

    return (
        <div className="container mt-4">
            <h1>Modifier : {nom}</h1>

            <form onSubmit={handleSubmit}>

                <div className="mb-3">
                    <label>Nom :</label>
                    <input
                        type="text"
                        className="form-control"
                        value={nom}
                        onChange={(e) => setNom(e.target.value)}
                    />
                </div>

                <div className="mb-3">
                    <label>Identifiant :</label>
                    <input
                        type="text"
                        className="form-control"
                        value={identifiant}
                        onChange={(e) => setIdentifiant(e.target.value)}
                    />
                </div>

                <div className="mb-3">
                    <label>Mot de passe :</label>
                    <input
                        type="password"
                        className="form-control"
                        value={motPasse}
                        onChange={(e) => setMotPasse(e.target.value)}
                    />
                </div>

                <button className="btn btn-primary">Mettre à jour</button>
                <Link to={`/utilisateurs/${id}`} className="btn btn-secondary ms-2">
                    Annuler
                </Link>
            </form>
        </div>
    );
}
