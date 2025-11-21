import React, { useEffect, useState } from "react";
import axios from "axios";
import { Link, useParams, useHistory } from "react-router-dom";

export default function UtilisateursShow() {
    const { id } = useParams();
    const history = useHistory();
    const [utilisateur, setUtilisateur] = useState(null);

    useEffect(() => {
        axios.get(`/utilisateurs/${id}`)
            .then(res => setUtilisateur(res.data))
            .catch(err => console.error(err));
    }, [id]);

    const handleDelete = () => {
        axios.delete(`/utilisateurs/${id}`)
            .then(() => history.push("/utilisateurs"))
            .catch(err => console.error(err));
    };

    if (!utilisateur) return <p>Chargement…</p>;

    return (
        <div className="container mt-4">
            <h1>{utilisateur.nom}</h1>

            <p><strong>Identifiant :</strong> {utilisateur.identifiant}</p>
            <p><strong>Mot de passe :</strong> {utilisateur.mot_de_passe}</p>

            <div className="mt-3">
                <Link
                    to={`/utilisateurs/${id}/edit`}
                    className="btn btn-info me-2"
                >
                    Modifier
                </Link>

                <Link to="/utilisateurs" className="btn btn-secondary me-2">
                    Retour
                </Link>

                <button className="btn btn-danger" onClick={handleDelete}>
                    Supprimer
                </button>
            </div>
        </div>
    );
}
