import React, { useEffect, useState } from "react";
import axios from "axios";

export default function AdminRecettes() {
    const [recettes, setRecettes] = useState([]);
    const [user, setUser] = useState(null);

    useEffect(() => {
        // récupérer user_auth_data envoyé dans monopage.blade.php
        if (window.user_auth_data?.isLoggedin) {
            setUser(window.user_auth_data.user);
        }

        axios.get("/recettes")
            .then(res => setRecettes(res.data))
            .catch(err => console.error(err));
    }, []);

    return (
        <div className="container mt-4">

            <h1 className="mb-4 text-center">Espace Administrateur</h1>

            {user && (
                <div className="alert alert-success text-center">
                    Bonjour {user.nom} 👋 — vous êtes connecté en tant qu’
                    <strong>ADMIN</strong>.
                </div>
            )}

            <h3 className="mt-4">Liste des recettes</h3>

            {recettes.length === 0 ? (
                <p>Aucune recette trouvée pour le moment.</p>
            ) : (
                <table className="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Date création</th>
                        </tr>
                    </thead>
                    <tbody>
                        {recettes.map((recette) => (
                            <tr key={recette.id}>
                                <td>{recette.id}</td>
                                <td>{recette.titre}</td>
                                <td>{recette.description?.substring(0, 60)}...</td>
                                <td>{recette.created_at}</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            )}
        </div>
    );
}
