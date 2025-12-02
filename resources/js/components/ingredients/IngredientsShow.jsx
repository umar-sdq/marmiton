import React, { useEffect, useState } from "react";
import axios from "../../axios";
import { Link, useParams, useHistory } from "react-router-dom";

export default function IngredientsShow() {
    const { id } = useParams();
    const [ingredient, setIngredient] = useState(null);
    const history = useHistory();

    useEffect(() => {
        axios.get(`/ingredients/${id}`)
            .then(res => setIngredient(res.data))
            .catch(err => console.error(err));
    }, [id]);

    const handleDelete = () => {
        axios.delete(`/ingredients/${id}`)
            .then(() => history.push("/ingredients"))
            .catch(err => console.error(err));
    };

    if (!ingredient) return <p>Chargement…</p>;

    return (
        <div className="container mt-4">
            <h1>{ingredient.nom}</h1>

            <p><strong>Détails :</strong> {ingredient.liste_ingredients}</p>
            <p><strong>Recette :</strong> {ingredient.recette?.titre || "—"}</p>

            <Link
                to={`/ingredients/${id}/edit`}
                className="btn btn-info me-2"
            >
                Modifier
            </Link>

            <button className="btn btn-danger" onClick={handleDelete}>
                Supprimer
            </button>

            <br /><br />
            <Link to="/ingredients" className="btn btn-secondary">Retour</Link>
        </div>
    );
}
