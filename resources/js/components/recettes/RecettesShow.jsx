import React, { useEffect, useState } from "react";
import axios from "../../axios";
import { Link, useParams, useHistory } from "react-router-dom";

export default function RecettesShow() {
    const { id } = useParams();
    const history = useHistory();
    const [recette, setRecette] = useState(null);

    useEffect(() => {
        axios.get(`/recettes/${id}`)
        
            .then(res => setRecette(res.data))
            
            .catch(err => console.error(err));
    }, [id]);

    const handleDelete = () => {
        axios.delete(`/recettes/${id}`)
            .then(() => history.push("/recettes"))
            .catch(err => console.error(err));
    };

    if (!recette) return <p>Chargement…</p>;

    return (
        <div className="container mt-4">

            <h1>{recette.titre}</h1>

            {recette.photo && (
                <img
                   src={`http://127.0.0.1:8000/storage/${recette.photo}`}
                    alt={recette.titre}
                    className="img-fluid rounded mb-4"
                />
            )}

            <p><strong>Description :</strong> {recette.description}</p>
            <p>
                <strong>Auteur :</strong> {recette.utilisateur?.nom || "Inconnu"}
            </p>

            <h3>Ingrédients</h3>
            <ul>
                {recette.ingredients?.map((ing) => (
                    <li key={ing.id}>
                        <strong>{ing.nom}</strong> — {ing.liste_ingredients}
                    </li>
                ))}
            </ul>

            <div className="mt-4">
                <Link to={`/recettes/${id}/edit`} className="btn btn-info me-2">Modifier</Link>
                <Link to="/recettes" className="btn btn-secondary me-2">Retour</Link>
                <button className="btn btn-danger" onClick={handleDelete}>Supprimer</button>
            </div>

        </div>
    );
}
