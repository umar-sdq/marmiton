import React, { useEffect, useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";

export default function UtilisateursIndex() {
    const [utilisateurs, setUtilisateurs] = useState([]);

    useEffect(() => {
        axios.get("/utilisateurs")
            .then(res => setUtilisateurs(res.data))
            .catch(err => console.error(err));
    }, []);

    return (
        <div className="container mt-4">

            <div className="d-flex justify-content-between align-items-center">
                <h2>Liste des utilisateurs</h2>
                <Link className="btn btn-success" to="/utilisateurs/create">
                    Ajouter un utilisateur
                </Link>
            </div>

            <div className="row mt-4">
                {utilisateurs.map((u) => (
                    <div className="col-md-4" key={u.id}>
                        <div className="card card-body mb-3 shadow-sm">
                            <h3>{u.nom}</h3>
                            <p><strong>Identifiant :</strong> {u.identifiant}</p>

                            <Link
                                to={`/utilisateurs/${u.id}`}
                                className="btn btn-outline-primary"
                            >
                                Lire plus
                            </Link>
                        </div>
                    </div>
                ))}
            </div>

        </div>
    );
}
